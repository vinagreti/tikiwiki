<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_attributes.php 64629 2017-11-19 12:06:52Z rjsmelo $

function wikiplugin_attributes_info()
{
	return [
		'name' => tra('Attributes'),
		'documentation' => 'PluginAttributes',
		'description' => tra('Assign generic attributes to the current object'),
		'prefs' => [ 'wikiplugin_attributes' ],
		'extraparams' => true,
		'defaultfilter' => 'text',
		'iconname' => 'cog',
		'introduced' => 6,
		'params' => [
		],
	];
}

function wikiplugin_attributes_save($context, $data, $params)
{
	$attributelib = TikiLib::lib('attribute');

	foreach ($params as $key => $value) {
		$key = str_replace('_', '.', $key);
		$attributelib->set_attribute($context['type'], $context['object'], $key, $value);
	}
}

function wikiplugin_attributes($data, $params)
{
	return '';
}
