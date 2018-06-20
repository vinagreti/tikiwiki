<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: social.php 64628 2017-11-19 12:03:08Z rjsmelo $

function prefs_social_list()
{
	return [
		'social_network_type' => [
			'name' => tra('Social network type'),
			'description' => tra('Select how the friendship relations within the social network should be treated.'),
			'type' => 'list',
			'options' => [
				'follow' => tr('Follow (as in Twitter)'),
				'friend' => tr('Friend (as in Facebook)'),
				'follow_approval' => tr('Followers need approval'),
			],
			'default' => 'follow',
		],
	];
}
