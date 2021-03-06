<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: sitead.php 65462 2018-02-07 09:35:44Z drsassafras $

function prefs_sitead_list()
{
	return [
		'sitead_publish' => [
			'name' => tra('Publish'),
			'type' => 'flag',
			'description' => tra('Make the Banner visible to all site visitors.'),
			'dependencies' => [
				'feature_sitead',
			],
			'hint' => tra('Activate must be turned on for Publish to take effect.'),
			'default' => 'n',
		],
	];
}
