<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: PluginParserTest.php 65400 2018-01-31 22:14:35Z rjsmelo $

/**
 * @group unit
 *
 */


class WikiParser_PluginParserTest extends TikiTestCase
{
	function testNothingToParse()
	{
		$data = 'Hello world this is a simple test';
		$parser = new WikiParser_PluginParser;

		$this->assertEquals($data, $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testCallToArgumentParser()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginArgumentParser')
			->expects($this->once())
			->method('parse')
			->with($this->equalTo('hello=world'));

		$data = 'This is a {TEST(hello=world)}Hello{TEST} without any changes';

		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($this->createMock('WikiParser_PluginRunner'));
		$parser->setArgumentParser($mock);
		$parser->parse($data);
	}

	function testPluginWithoutRunner()
	{
		$data = 'This is a {TEST(hello=world)}Hello{TEST} without any changes';
		$parser = new WikiParser_PluginParser;

		$this->assertEquals($data, $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testFullSyntax()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->with(
				$this->equalTo('test'),
				$this->equalTo('Hello'),
				$this->equalTo(['hello' => 'world'])
			)
			->will($this->returnValue('test'));

		$data = 'This is a {TEST(hello=world)}Hello{TEST} and will change';
		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('This is a test and will change', $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testShortSyntax()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->with(
				$this->equalTo('test'),
				$this->equalTo(null),
				$this->equalTo(['hello' => 'world'])
			)
			->will($this->returnValue('test'));

		$data = 'This is a {test hello=world} and will change';
		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('This is a test and will change', $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testShortSyntaxWithoutArguments()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->with(
				$this->equalTo('test'),
				$this->equalTo(null),
				$this->equalTo([])
			)
			->will($this->returnValue('test'));

		$data = 'This is a {test} and will change';
		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('This is a test and will change', $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testSkipNoParse()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->with($this->equalTo('b'), $this->equalTo(null), $this->equalTo([]))
			->will($this->returnValue('return'));

		$data = '~np~ {a} ~/np~ {b} ~np~ {c} ~/np~';
		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('~np~ {a} ~/np~ return ~np~ {c} ~/np~', $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testNestingNoSecondCall()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->with($this->equalTo('a'), $this->equalTo(' {b} '), $this->equalTo([]))
			->will($this->returnValue('no plugin'));

		$data = '{A()} {b} {A}';
		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('no plugin', $parser->parse($data));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testPluginReturningPlugin()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->exactly(2))
			->method('run')
			->will($this->onConsecutiveCalls('__{b}__', 'hello'));

		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('before __hello__ after', $parser->parse('before {a} after'));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testInnerPluginNotExecutedFirst()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->exactly(2))
			->method('run')
			->will($this->onConsecutiveCalls('__{b}__', 'hello'));

		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$this->assertEquals('__hello__', $parser->parse('{A()} {b} {A}'));
	}

	/**
	 * @group marked-as-incomplete
	 */
	function testPluginReturnsNonParseCode()
	{
		$this->markTestIncomplete('Implementation not written yet');
		$mock = $this->createMock('WikiParser_PluginRunner')
			->expects($this->once())
			->method('run')
			->will($this->returnValue('~np~{b}~/np~'));

		$parser = new WikiParser_PluginParser;
		$parser->setPluginRunner($mock);
		$parser->setArgumentParser(new WikiParser_PluginArgumentParser);
		$parser->parse('{a}');
	}
}
