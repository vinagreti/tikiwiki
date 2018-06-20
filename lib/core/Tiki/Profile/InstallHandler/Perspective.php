<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Perspective.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Tiki_Profile_InstallHandler_Perspective extends Tiki_Profile_InstallHandler
{
	function getData()
	{
		if ($this->data) {
			return $this->data;
		}

		$defaults = [
			'preferences' => [],
		];

		$data = array_merge($defaults, $this->obj->getData());

		$data['preferences'] = Tiki_Profile::convertLists($data['preferences'], ['enable' => 'y', 'disable' => 'n']);

		$data['preferences'] = Tiki_Profile::convertYesNo($data['preferences']);

		return $this->data = $data;
	}

	function canInstall()
	{
		$data = $this->getData();
		if (! isset($data['name'])) {
			return false;
		}

		return true;
	}

	function _install()
	{
		$perspectivelib = TikiLib::lib('perspective');

		$data = $this->getData();

		$this->replaceReferences($data);

		if ($persp = $perspectivelib->replace_perspective(0, $data['name'])) {
			$perspectivelib->replace_preferences($persp, $data['preferences']);
		}

		return $persp;
	}
}
