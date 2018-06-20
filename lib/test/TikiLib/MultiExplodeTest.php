<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: MultiExplodeTest.php 64624 2017-11-19 11:24:47Z rjsmelo $

class TikiLib_MultiExplodeTest extends PHPUnit_Framework_TestCase
{
	private $saved;

	function setUp()
	{
		global $prefs;
		$this->saved = $prefs['namespace_separator'];
	}

	function tearDown()
	{
		global $prefs;
		$prefs['namespace_separator'] = $this->saved;
	}

	function testSimple()
	{
		$lib = TikiLib::lib('tiki');
		$this->assertEquals(['A', 'B'], $lib->multi_explode(':', 'A:B'));
		$this->assertEquals(['A', '', 'B'], $lib->multi_explode(':', 'A::B'));
		$this->assertEquals(['A', '', '', 'B'], $lib->multi_explode(':', 'A:::B'));
	}

	function testEmpty()
	{
		$lib = TikiLib::lib('tiki');
		$this->assertEquals([''], $lib->multi_explode(':', ''));
		$this->assertEquals(['', ''], $lib->multi_explode(':', ':'));
		$this->assertEquals(['', 'B'], $lib->multi_explode(':', ':B'));
		$this->assertEquals(['A', ''], $lib->multi_explode(':', 'A:'));
	}

	function testIgnoreCharactersUsedInNamespace()
	{
		global $prefs;
		$lib = TikiLib::lib('tiki');

		$prefs['namespace_separator'] = ':+:';
		$this->assertEquals(['A:+:B:+:C', 'A:+:B'], $lib->multi_explode(':', 'A:+:B:+:C:A:+:B'));
		$this->assertEquals(['A', '-', 'B:+:C', 'A:+:B'], $lib->multi_explode(':', 'A:-:B:+:C:A:+:B'));

		$prefs['namespace_separator'] = ':-:';
		$this->assertEquals(['A', '+', 'B', '+', 'C', 'A', '+', 'B'], $lib->multi_explode(':', 'A:+:B:+:C:A:+:B'));
		$this->assertEquals(['A:-:B', '+', 'C', 'A', '+', 'B'], $lib->multi_explode(':', 'A:-:B:+:C:A:+:B'));
	}

	function testSimpleImplode()
	{
		$lib = TikiLib::lib('tiki');
		$this->assertEquals('A:B', $lib->multi_implode(':', ['A', 'B']));
		$this->assertEquals('A+C:B+D', $lib->multi_implode([':', '+'], [['A', 'C'], ['B', 'D']]));
	}
}
