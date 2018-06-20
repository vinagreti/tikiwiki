<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Concat.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Math_Formula_Function_Concat extends Math_Formula_Function
{
	function evaluate($element)
	{
		$out = '';

		foreach ($element as $child) {
			$child = $this->evaluateChild($child);
			if (is_array($child)) {
				$out .= implode('', $child);
			} else {
				$out .= $child;
			}
		}

		return $out;
	}
}
