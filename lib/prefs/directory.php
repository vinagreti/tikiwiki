<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: directory.php 65458 2018-02-07 07:00:57Z drsassafras $

function prefs_directory_list()
{
	return [
		'directory_country_flag' => [
			'name' => tra('Show country flag'),
			'description' => tra('Show the country flag'),
			'type' => 'flag',
			'default' => 'y',
		],
		'directory_cool_sites' => [
			'name' => tra('Enable "popular sites"'),
			'description' => tra(''),
			'type' => 'flag',
			'default' => 'y',
		],
		'directory_validate_urls' => [
			'name' => tra('Validate URLs'),
			'description' => tra('Should Tiki check the URL?'),
			'type' => 'flag',
			'default' => 'n',
		],
		'directory_columns' => [
			'name' => tra('Columns per page'),
			'description' => tra('Number of columns per page when listing directory categories'),
			'type' => 'list',
			'units' => tra('columns'),
			'options' => [
				'1' => tra('1'),
				'2' => tra('2'),
				'3' => tra('3'),
				'4' => tra('4'),
				'5' => tra('5'),
				'6' => tra('6')],
			'default' => 3,
			],
		'directory_links_per_page' => [
			'name' => tra('Links per page'),
			'description' => tra('How many links should be displayed per page.'),
			'type' => 'text',
			'units' => tra('links'),
			'default' => 20,
			],
		'directory_open_links' => [
			'name' => tra('Method to open Directory links'),
			'description' => tra('The linked-to website can be opened in various ways'),
			'type' => 'list',
			'options' => [
				'r' => tra('Replace the current window'),
				'n' => tra('Open a new window'),
				'f' => tra('Open an iframe')],
			'default' => 'n',
			],
	];
}
