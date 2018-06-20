<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Controller.php 64622 2017-11-18 19:34:07Z rjsmelo $
class Services_Score_Controller
{

	function setUp()
	{
	}

	function action_create_score_event($input)
	{

		$eventType = $input->eventType->text();

		if ($input->rowOnly->text() == 'y') {
			$rowOnly = 1;
		} else {
			$rowOnly = 0;
		}

		if ($input->rowCount->text() > 0) {
			$rowCount = $input->rowCount->text();
		} else {
			$rowCount = 0;
		}

		return  [
			'eventType' => $eventType,
			'rowOnly' => $rowOnly,
			'rowCount' => $rowCount,
		];
	}
}
