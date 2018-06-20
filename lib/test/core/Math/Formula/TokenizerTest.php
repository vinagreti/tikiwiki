<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: TokenizerTest.php 64624 2017-11-19 11:24:47Z rjsmelo $

class Math_Formula_TokenizerTest extends TikiTestCase
{
	function testSimpleToken()
	{
		$tokenizer = new Math_Formula_Tokenizer;

		$this->assertEquals(['test'], $tokenizer->getTokens('test'));
	}

	function testWithParenthesis()
	{
		$tokenizer = new Math_Formula_Tokenizer;

		$this->assertEquals(['test', ')'], $tokenizer->getTokens('test)'));
	}

	function testWithMultipleParenthesis()
	{
		$tokenizer = new Math_Formula_Tokenizer;

		$this->assertEquals(['(', 'test', ')'], $tokenizer->getTokens('(test)'));
	}

	function testIgnoreSpaces()
	{
		$tokenizer = new Math_Formula_Tokenizer;

		$this->assertEquals(['(', 'test', ')'], $tokenizer->getTokens(" (test\n\t\r) "));
	}

	function testWithMultipleWords()
	{
		$tokenizer = new Math_Formula_Tokenizer;
		$this->assertEquals(['hello', 'world', 'foo-bar'], $tokenizer->getTokens('hello world foo-bar'));
	}

	function testWordsAfterParenthesis()
	{
		$tokenizer = new Math_Formula_Tokenizer;
		$this->assertEquals(['hello', '(', 'world', ')', 'foo-bar'], $tokenizer->getTokens('hello (world) foo-bar'));
	}

	function testQuotesAroundArguments()
	{
		$tokenizer = new Math_Formula_Tokenizer;
		$this->assertEquals(['hello', '(', 'world', '"test hello"', '"foo bar baz"', ')', 'foo-bar'], $tokenizer->getTokens('hello (world "test hello" "foo bar baz") foo-bar'));
	}

	function testUnterminatedString()
	{
		$tokenizer = new Math_Formula_Tokenizer;
		$this->assertEquals(['hello', '(', 'world', '"test hello) foo-bar'], $tokenizer->getTokens('hello (world "test hello) foo-bar'));
	}

	function testEndWithString()
	{
		$tokenizer = new Math_Formula_Tokenizer;
		$this->assertEquals(['hello', '(', 'world', '"(test hello)"'], $tokenizer->getTokens('hello (world "(test hello)"'));
	}
}
