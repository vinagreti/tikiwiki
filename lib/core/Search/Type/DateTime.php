<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: DateTime.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_Type_DateTime implements Search_Type_Interface
{
	private $value;

	function __construct($value, $dateOnly = false)
	{
		if (is_numeric($value)) {
			if ($dateOnly) {
				// dates are stored as formatted strings in Tiki timezone to prevent date shifts when timezones differ
				$oldTz = date_default_timezone_get();
				date_default_timezone_set(TikiLib::lib('tiki')->get_display_timezone());
				$this->value = date('Y-m-d', $value);
				date_default_timezone_set($oldTz);
			} else {
				// dates with times are stored in GMT
				$this->value = gmdate(DateTime::W3C, $value);
			}
		}
	}

	function getValue()
	{
		return $this->value;
	}
}
