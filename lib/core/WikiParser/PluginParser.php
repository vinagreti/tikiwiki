<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: PluginParser.php 65507 2018-02-10 10:28:24Z rjsmelo $

class WikiParser_PluginParser
{
	private $argumentParser;
	private $pluginRunner;

	function parse($text)
	{
		if (! $this->argumentParser || ! $this->pluginRunner) {
			return $text;
		}
	}

	function setArgumentParser($parser)
	{
		$this->argumentParser = $parser;
	}

	function setPluginRunner($runner)
	{
		$this->pluginRunner = $runner;
	}
}
