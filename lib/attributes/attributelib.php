<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: attributelib.php 64632 2017-11-19 12:22:53Z rjsmelo $

/**
 * AttributeLib
 *
 * @uses TikiDb_Bridge
 */
class AttributeLib extends TikiDb_Bridge
{
	private $attributes;
	private $cache;

	/**
	 *
	 */
	function __construct()
	{
		$this->attributes = $this->table('tiki_object_attributes');
		$this->cache = [];
	}

	/**
	 * Get all attributes for an object
	 *
	 * @param $type string      One of \ObjectLib::get_supported_types()
	 * @param $objectId mixed   Object id (or name for wiki pages)
	 * @return array            Array [attribute => value]
	 */
	function get_attributes($type, $objectId)
	{
		if (count($this->cache) > 2048) {
			$this->cache = [];
		}
		if (! isset($this->cache[$type . $objectId])) {
			$this->cache[$type . $objectId] = $this->attributes->fetchMap(
				'attribute',
				'value',
				['type' => $type,'itemId' => $objectId,]
			);
		}
		return $this->cache[$type . $objectId];
	}

	/**
	 * Get a single attribute
	 *
	 * @param $type string          One of \ObjectLib::get_supported_types()
	 * @param $objectId mixed       Object id (or name for wiki pages)
	 * @param $attribute string     At least two dots and only lowercase letters
	 * @return string|boolean       Contents of the attribute on the object or false if not present
	 */
	function get_attribute($type, $objectId, $attribute)
	{
		return $this->attributes->fetchOne(
			'value',
			['type' => $type, 'itemId' => $objectId, 'attribute' => $attribute]
		);
	}

	/**
	 * The attribute must contain at least two dots and only lowercase letters.
	 */

	/**
	 * NAMESPACE management and attribute naming.
	 * Please see http://dev.tiki.org/Object+Attributes+and+Relations for guidelines on
	 * attribute naming, and document new tiki.*.* names that you add
	 * (also grep "set_attribute" just in case there are undocumented names already used)
	 */
	function set_attribute($type, $objectId, $attribute, $value)
	{
		if (false === $name = $this->get_valid($attribute)) {
			return false;
		}

		if ($value == '') {
			$this->attributes->delete(
				[
					'type' => $type,
					'itemId' => $objectId,
					'attribute' => $name,
				]
			);
		} else {
			$this->attributes->insertOrUpdate(
				['value' => $value],
				[
					'type' => $type,
					'itemId' => $objectId,
					'attribute' => $name,
				]
			);
		}

		return true;
	}

		/**
		 * @param $name
		 * @return mixed
		 */
	private function get_valid($name)
	{
		$filter = TikiFilter::get('attribute_type');
		return $filter->filter($name);
	}

		/**
		 * @param $attribute
		 * @param $value
		 * @return mixed
		 */
	function find_objects_with($attribute, $value)
	{
		$attribute = $this->get_valid($attribute);

		return $this->attributes->fetchAll(
			['type', 'itemId'],
			['attribute' => $attribute, 'value' => $value,]
		);
	}
}
