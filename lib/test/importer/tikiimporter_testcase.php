<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tikiimporter_testcase.php 64624 2017-11-19 11:24:47Z rjsmelo $

//require_once('PHPUnit/Framework/TestCase.php');

/**
 * @group importer
 */
abstract class TikiImporter_TestCase extends PHPUnit_Framework_TestCase
{
	protected $backupGlobals = false;
}
