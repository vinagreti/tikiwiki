<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-usergroup_tracker.php 64616 2017-11-18 00:02:17Z rjsmelo $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}

/**
 * @return array
 */
function module_usergroup_tracker_info()
{
	return [
		'name' => tra('User-Group Tracker'),
		'description' => tra('User and Group tracker links.'),
		'prefs' => ['feature_trackers'],
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_usergroup_tracker($mod_reference, $module_params)
{
}
