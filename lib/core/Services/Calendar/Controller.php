<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Controller.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Services_Calendar_Controller
{
	function setUp()
	{
		Services_Exception_Disabled::check('feature_calendar');
	}

	function action_move($input)
	{
		$itemId = $this->getItemId($input);
		$delta = $input->delta->int();

		$calendarlib = TikiLib::lib('calendar');
		$calendarlib->move_item($itemId, $delta);

		return [
			'calitemId' => $itemId,
		];
	}

	function action_resize($input)
	{
		$itemId = $this->getItemId($input);
		$delta = $input->delta->int();

		$calendarlib = TikiLib::lib('calendar');
		$calendarlib->resize_item($itemId, $delta);

		return [
			'calitemId' => $itemId,
		];
	}

	private function getItemId($input)
	{
		$calendarlib = TikiLib::lib('calendar');
		$item = $input->calitemId->int();

		$cal_id = $calendarlib->get_calendarid($item);

		if (! $item || ! $cal_id) {
			throw new Services_Exception_NotFound;
		}

		$calperms = Perms::get([ 'type' => 'calendar', 'object' => $cal_id ]);
		if (! $calperms->change_events) {
			throw new Services_Exception_Denied;
		}

		return $item;
	}
}
