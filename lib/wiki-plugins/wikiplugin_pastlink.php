<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_pastlink.php 64629 2017-11-19 12:06:52Z rjsmelo $

// File name: wikiplugin_pastlink.php
// Required path: /lib/wiki-plugins
//
// Programmer: Robert Plummer
//
// Purpose: Plugin that instantiates a pastlink within a page

function wikiplugin_pastlink_info()
{
	return [
		'name' => tra('PastLink'),
		'documentation' => 'PluginPastLink',
		'description' => tra('Link content to another site'),
		'keywords' => ['forward', 'futurelink', 'futurelink-protocol', 'futurelinkprotocol', 'protocol'],
		'prefs' => [ 'feature_wiki', 'wikiplugin_pastlink', 'feature_futurelinkprotocol' ],
		'iconname' => 'link',
		'introduced' => 13,
		'body' => tra('Text to link to futurelink'),
		'params' => [
			'clipboarddata' => [
				'required' => true,
				'name' => tra('Clipboard Data'),
				'since' => '13.0',
				'default' => false
			],
		],
	];
}

function wikiplugin_pastlink($data, $params)
{
	global $page;

	$params = array_merge(["clipboarddata" => ""], $params);

	$clipboarddata = json_decode(stripslashes(trim(urldecode($params['clipboarddata']))));

	if (empty($clipboarddata)) {
		return $data;
	}

	FutureLink_PastUI::add($clipboarddata, $page, $data);

	return $data;
}
