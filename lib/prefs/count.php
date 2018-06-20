<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: count.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_count_list()
{
	return [
		'count_admin_pvs' => [
			'name' => tra('Count admin pageviews'),
			'description' => tra('Include pageviews by Admin when reporting stats.'),
			'type' => 'flag',
			'default' => 'n',
		],
	];
}
