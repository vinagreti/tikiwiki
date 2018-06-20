<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: NotAvailable.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Services_Exception_NotAvailable extends Services_Exception
{
	function __construct($message)
	{
		parent::__construct($message, 405);
	}
}
