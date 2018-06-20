<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: QueryParsingException.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_Elastic_QueryParsingException extends Search_Elastic_Exception
{
	private $string;

	function __construct($string)
	{
		$this->string = $string;
		parent::__construct(tr('Parsing search query failed: "%0"', $this->string));
	}
}
