<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-whats_related.php 64616 2017-11-18 00:02:17Z rjsmelo $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}

/**
 * @return array
 */
function module_whats_related_info()
{
	return [
		'name' => tra('Related Items'),
		'description' => tra('Lists objects which share a category with the viewed object.'),
		'prefs' => ['feature_categories'],
		'params' => []
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_whats_related($mod_reference, $module_params)
{
	$smarty = TikiLib::lib('smarty');
	$categlib = TikiLib::lib('categ');

	$WhatsRelated = $categlib->get_link_related($_SERVER["REQUEST_URI"]);
	$smarty->assign_by_ref('WhatsRelated', $WhatsRelated);
}
