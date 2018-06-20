<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: QueryRepositoryTest.php 65282 2018-01-21 20:21:29Z rjsmelo $

class Search_Elastic_QueryRepositoryTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
		$elasticSearchHost = empty(getenv('ELASTICSEARCH_HOST')) ? 'localhost' : getenv('ELASTICSEARCH_HOST');
		$connection = new Search_Elastic_Connection('http://' . $elasticSearchHost . ':9200');

		$status = $connection->getStatus();
		if (! $status->ok) {
			$this->markTestSkipped('Elasticsearch needs to be available on ' . $elasticSearchHost . ':9200 for the test to run.');
		}

		if (version_compare($status->version->number, '1.1.0') < 0) {
			$this->markTestSkipped('Elasticsearch 1.1+ required');
		}

		$this->index = new Search_Elastic_Index($connection, 'test_index');
		$this->index->destroy();
		$factory = $this->index->getTypeFactory();
		$this->index->addDocument([
			'object_type' => $factory->identifier('wiki page'),
			'object_id' => $factory->identifier('HomePage'),
			'contents' => $factory->plaintext('Hello World'),
		]);
	}

	function tearDown()
	{
		if ($this->index) {
			$this->index->destroy();
		}
	}

	function testNothingToMatch()
	{
		$tf = $this->index->getTypeFactory();
		$names = $this->index->getMatchingQueries([
			'object_type' => $tf->identifier('wiki page'),
			'object_id' => $tf->identifier('HomePage'),
			'contents' => $tf->plaintext('Hello World!'),
		]);

		$this->assertEquals([], $names);
	}

	function testFilterBasicContent()
	{
		$query = new Search_Query('Hello World');
		$query->store('my_custom_name', $this->index);

		$tf = $this->index->getTypeFactory();
		$names = $this->index->getMatchingQueries([
			'object_type' => $tf->identifier('wiki page'),
			'object_id' => $tf->identifier('HomePage'),
			'contents' => $tf->plaintext('Hello World!'),
		]);

		$this->assertEquals(['my_custom_name'], $names);
	}

	function testFilterFailsToFindContent()
	{
		$query = new Search_Query('Foobar');
		$query->store('my_custom_name', $this->index);

		$tf = $this->index->getTypeFactory();
		$names = $this->index->getMatchingQueries([
			'object_type' => $tf->identifier('wiki page'),
			'object_id' => $tf->identifier('HomePage'),
			'contents' => $tf->plaintext('Hello World!'),
		]);

		$this->assertEquals([], $names);
	}

	function testRemoveQuery()
	{
		$query = new Search_Query('Hello World');
		$query->store('my_custom_name', $this->index);
		$this->index->unstore('my_custom_name');

		$tf = $this->index->getTypeFactory();
		$names = $this->index->getMatchingQueries([
			'object_type' => $tf->identifier('wiki page'),
			'object_id' => $tf->identifier('HomePage'),
			'contents' => $tf->plaintext('Hello World!'),
		]);

		$this->assertEquals([], $names);
	}
}
