<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: trackerfield.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_trackerfield_list($partial = false)
{
	$factory = new Tracker_Field_Factory(false);
	$types = $factory->getFieldTypes();

	$prefs = [];
	foreach ($types as $type) {
		$name = array_shift($type['prefs']);
		$prefs[$name] = [
			'name' => $type['name'],
			'description' => $type['description'],
			'tags' => isset($type['tags']) ? $type['tags'] : '',
			'default' => $type['default'],
			'dependencies' => $type['prefs'],
			'type' => 'flag',
			'warning' => isset($type['warning']) ? $type['warning'] : false,
			'help' => isset($type['help']) ? urlencode($type['help']) : false,
		];
	}

	return $prefs;
}
