<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: SearchableSource.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_GlobalSource_SearchableSource implements Search_GlobalSource_Interface
{
	function getProvidedFields()
	{
		return ['searchable'];
	}

	function getGlobalFields()
	{
		return [];
	}

	function getData($objectType, $objectId, Search_Type_Factory_Interface $typeFactory, array $data = [])
	{
		// Unless specified by content source explicitly, everything is searchable

		if (isset($data['searchable'])) {
			return [];
		}

		return [
			'searchable' => $typeFactory->identifier('y'),
		];
	}
}
