<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: center.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_center_list()
{
	return [
		'center_shadow_start' => [
			'name' => tra('Center shadow start'),
			'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		],
		'center_shadow_end' => [
			'name' => tra('Center shadow end'),
			'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		],
	];
}
