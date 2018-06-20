<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: webcron.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_webcron_list()
{
	return [
		'webcron_enabled' => [
			'name' => tra('Enabled'),
			'description' => tra('Cron jobs can be triggered from a URL or JavaScript. A token is required to run the cron manually'),
			'help' => 'Cron#Web_Cron',
			'type' => 'flag',
			'default' => 'n',
		],
		'webcron_type' => [
			'name' => tra('How to trigger Web Cron'),
			'description' => tra(''),
			'type' => 'list',
			'options' => [
				'url' => tra('Calling the Web Cron URL'),
				'js' => tra('Adding JavaScript that calls Web Cron'),
				'both' => tra('URL and JavaScript'),
			],
			'default' => 'both',
		],
		'webcron_run_interval' => [
			'name' => tra('Run interval'),
			'description' => tra('The amount of time of each run'),
			'type' => 'text',
			'size' => 5,
			'filter' => 'digits',
			'units' => tra('seconds'),
			'default' => 60,
		],
		'webcron_token' => [
			'name' => tra('Token'),
			'description' => tra('The token to use when running the cron manually'),
			'type' => 'text',
			'default' => md5(phpseclib\Crypt\Random::string(100)),
		],
	];
}