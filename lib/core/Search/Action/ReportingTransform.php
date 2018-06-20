<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ReportingTransform.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_Action_ReportingTransform
{
	private $data = [];

	function setStatus($objectType, $objectId, $success)
	{
		$this->data["$objectType:$objectId"] = $success ? 'success' : 'error';
	}

	function __invoke($entry)
	{
		$identifier = "{$entry['object_type']}:{$entry['object_id']}";
		$entry['report_status'] = isset($this->data[$identifier]) ? $this->data[$identifier] : 'none';
		return $entry;
	}
}
