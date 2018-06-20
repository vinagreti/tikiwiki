<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-map_search_location.php 64616 2017-11-18 00:02:17Z rjsmelo $

if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}


/**
 * @return array
 */
function module_map_search_location_info()
{
	return [
		'name' => tra('Map location search'),
		'description' => tra("Simple search controls for the map."),
		'prefs' => [],
		'params' => [
		],
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_map_search_location($mod_reference, $module_params)
{
	static $counter = 0;
	$smarty = TikiLib::lib('smarty');
	$smarty->assign('search_location_id', 'search_location_' . ++$counter);
}
