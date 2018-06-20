<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: GlobalFactory.php 64622 2017-11-18 19:34:07Z rjsmelo $

/**
 * The global ResolverFactory is used as the fallback factory. It provides
 * a constant hash (so it will be queries only once) and obtains the global
 * permissions for all groups.
 *
 * Bulk does not apply to this factory.
 */
class Perms_ResolverFactory_GlobalFactory implements Perms_ResolverFactory
{
	function getHash(array $context)
	{
		return 'global';
	}

	function getResolver(array $context)
	{
		$perms = [];
		$db = TikiDb::get();

		$result = $db->fetchAll('SELECT `groupName`,`permName` FROM users_grouppermissions');
		foreach ($result as $row) {
			$group = $row['groupName'];
			$perm = $this->sanitize($row['permName']);

			if (! isset($perms[$group])) {
				$perms[$group] = [];
			}

			$perms[$group][] = $perm;
		}

		return new Perms_Resolver_Static($perms);
	}

	function bulk(array $baseContext, $bulkKey, array $values)
	{
		return [];
	}

	private function sanitize($name)
	{
		if (strpos($name, 'tiki_p_') === 0) {
			return substr($name, strlen('tiki_p_'));
		} else {
			return $name;
		}
	}
}
