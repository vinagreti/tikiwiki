<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-file_galleries.php 64616 2017-11-18 00:02:17Z rjsmelo $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}

/**
 * @return array
 */
function module_file_galleries_info()
{
	return [
		'name' => tra('File Galleries'),
		'description' => tra('Displays links to file galleries.'),
		'prefs' => ['feature_file_galleries'],
		'params' => [],
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_file_galleries($mod_reference, $module_params)
{
	$filegallib = TikiLib::lib('filegal');
	$smarty = TikiLib::lib('smarty');

	$smarty->assign('tree', $filegallib->getTreeHTML());
}
