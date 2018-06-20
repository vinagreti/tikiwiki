<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Str.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Math_Formula_Function_Str extends Math_Formula_Function
{
	function evaluate($element)
	{
		$out = [];

		foreach ($element as $child) {
			if ($child instanceof Math_Formula_InternalString) {
				$out[] = $child->getContent();
			} elseif ($child instanceof Math_Formula_Element) {
				$out[] = $this->evaluateChild($child);
			} else {
				$out[] = str_replace("~nl~", "\n", $child);
			}
		}

		return implode(' ', $out);
	}
}
