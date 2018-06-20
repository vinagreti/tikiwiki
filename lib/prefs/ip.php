<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ip.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_ip_list()
{
	return [
		'ip_can_be_checked' => [
			'name' => tra('IP can be checked'),
			'description' => tra("Check anonymous votes by user's IP"),
			'type' => 'flag',
			'default' => 'n',
		],
	];
}
