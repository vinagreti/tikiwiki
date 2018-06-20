<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Random.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Math_Formula_Function_Random extends Math_Formula_Function
{
	function evaluate($element)
	{
		$range = [0, 9999];

		foreach ($element as $child) {
			$range[] = $this->evaluateChild($child);
		}

		return mt_rand(min($range), max($range));
	}
}
