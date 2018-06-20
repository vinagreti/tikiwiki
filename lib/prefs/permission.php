<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: permission.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_permission_list()
{
	return [
		'permission_denied_url' => [
			'name' => tra('Send to URL'),
			'description' => tra('URL to redirect to on "permission denied"'),
			'type' => 'text',
			'size' => '50',
			'default' => '',
			'tags' => ['basic'],
		],
		'permission_denied_login_box' => [
			'name' => tra('On permission denied, display login module'),
			'description' => tra('If an Anonymous visitor attempts to access a page to which he does have permission, Tiki will automatically display the Login module. 
Alternatively, use the Send to URL field to display a specific page (relative to your Tiki installation) instead.'),
			'type' => 'flag',
			'default' => 'n',
			'tags' => ['basic'],
		],
	];
}
