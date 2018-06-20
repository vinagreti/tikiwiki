<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: javascript.php 65347 2018-01-28 14:12:46Z jonnybradley $

function prefs_javascript_list()
{
	return [
		'javascript_cdn' => [
			'name' => tra('Use CDN for JavaScript'),
			'description' => tra('Obtain jQuery and jQuery UI libraries through a content delivery network (CDN).'),
			'type' => 'list',
			'options' => [
				'none' => tra('None'),
				'google' => tra('Google'),
				'jquery' => tra('jQuery'),
			],
			'default' => 'none',
			'tags' => ['basic'],
		],
		'javascript_assume_enabled' => [
			'name' => tra('Assume JavaScript is enabled even if not supported'),
			'description' => tra('Assume JavaScript is enabled even if not supported, could be useful for load testing using tools like JMeter.'),
			'type' => 'flag',
			'default' => 'n',
			'tags' => ['advanced'],
		],
	];
}
