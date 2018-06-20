<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Timestamp.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_Type_Timestamp implements Search_Type_Interface
{
	private $value;
	private $dateOnly;

	function __construct($value, $dateOnly = false)
	{
		$this->value = $value;
		$this->dateOnly = $dateOnly;
	}

	function getValue()
	{
		return $this->value;
	}

	function isDateOnly()
	{
		return $this->dateOnly;
	}
}
