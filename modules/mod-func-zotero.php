<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-zotero.php 64616 2017-11-18 00:02:17Z rjsmelo $

if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}

/**
 * @return array
 */
function module_zotero_info()
{
	return [
		'name' => tra('Bibliography Search'),
		'description' => tra('Search the group\'s Zotero library for entries with the specified tags'),
		'prefs' => ['zotero_enabled'],
		'params' => [
		],
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_zotero($mod_reference, $module_params)
{
	$zoterolib = TikiLib::lib('zotero');
	$smarty = TikiLib::lib('smarty');

	$smarty->assign('zotero_authorized', $zoterolib->is_authorized());
}
