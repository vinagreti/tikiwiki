<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: FilterTest.php 64624 2017-11-19 11:24:47Z rjsmelo $

/**
 * @group unit
 *
 */
class JitFilter_FilterTest extends TikiTestCase
{
	private $array;

	function setUp()
	{
		$this->array = [
			'foo' => 'bar123',
			'bar' => 10,
			'baz' => [
				'hello',
				'world !',
			],
			'content' => '10 > 5 <script>',
		];

		$this->array = new JitFilter($this->array);
		$this->array->setDefaultFilter(new Zend\I18n\Filter\Alnum);
	}

	function tearDown()
	{
		$this->array = null;
	}

	function testValid()
	{
		$this->assertEquals('bar123', $this->array['foo']);
		$this->assertEquals(10, $this->array['bar']);
	}

	function testInvalid()
	{
		$this->assertEquals('world', $this->array['baz'][1]);
	}

	function testSpecifiedFilter()
	{
		$this->assertEquals('bar123', $this->array['foo']);

		$this->array->replaceFilter('foo', new Zend\Filter\Digits);
		$this->assertEquals('123', $this->array['foo']);
	}

	function testMultipleFilters()
	{
		$this->array->replaceFilters(
			[
				'foo' => new Zend\Filter\Digits,
				'content' => new Zend\Filter\StripTags,
				'baz' => [1 => new Zend\Filter\StringToUpper,],
			]
		);

		$this->assertEquals('123', $this->array['foo']);
		$this->assertEquals('10  5 ', $this->array['content']);
		$this->assertEquals('WORLD !', $this->array['baz'][1]);
	}

	function testNestedDefault()
	{
		$this->array->replaceFilters(
			[
				'foo' => new Zend\Filter\Digits,
				'content' => new Zend\Filter\StripTags,
				'baz' => new Zend\Filter\StringToUpper,
			]
		);

		$this->assertEquals('123', $this->array['foo']);
		$this->assertEquals('10  5 ', $this->array['content']);
		$this->assertEquals('WORLD !', $this->array['baz'][1]);

		$this->array->replaceFilter('baz', new Zend\I18n\Filter\Alpha);
		$this->assertEquals('world', $this->array['baz'][1]);

		$this->array->replaceFilters(
			['baz' => [1 => new Zend\Filter\Digits,],]
		);

		$this->assertEquals('hello', $this->array['baz'][0]);
		$this->assertEquals('', $this->array['baz'][1]);
	}
}
