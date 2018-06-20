<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Floor.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Math_Formula_Function_Floor extends Math_Formula_Function
{
	function evaluate($element)
	{
		$elements = [];

		if (count($element) > 1) {
			$this->error(tr('Too many arguments on floor.'));
		}

		foreach ($element as $child) {
			$elements[] = $this->evaluateChild($child);
		}


		$number = array_shift($elements);

		return floor($number);
	}
}
