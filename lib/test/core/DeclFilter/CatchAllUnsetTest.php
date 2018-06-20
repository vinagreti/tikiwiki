<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: CatchAllUnsetTest.php 64624 2017-11-19 11:24:47Z rjsmelo $

/**
 * @group unit
 *
 */

class DeclFilter_CatchAllUnsetTest extends TikiTestCase
{
	function testMatch()
	{
		$rule = new DeclFilter_CatchAllUnsetRule();

		$this->assertTrue($rule->match('hello'));
	}

	function testApply()
	{
		$rule = new DeclFilter_CatchAllUnsetRule();

		$data = [
			'hello' => '123abc',
		];

		$rule->apply($data, 'hello');

		$this->assertFalse(isset($data['hello']));
	}
}
