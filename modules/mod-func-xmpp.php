<?php
// (c) Copyright 2002-2017 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-xmpp.php 64616 2017-11-18 00:02:17Z rjsmelo $

if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}

/**
 * @return array
 */
function module_xmpp_info()
{
	return [
		'description' => tra('Hold a chat session using XMPP (uses the ConverseJS client).'),
		'name' => tra('XMPP'),
		'params' => [],
		'prefs' => ['xmpp_feature'],
		'title' => tra('XMPP'),
		'type' => 'function'
	];
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_xmpp($mod_reference, &$module_params)
{
	global $user;
	$xmpplib = TikiLib::lib('xmpp');
	$smarty = TikiLib::lib('smarty');

	$xmpp = [
		'server_http_bind' => $xmpplib->server_http_bind,
		'user_jid' => $xmpplib->get_user_jid($user)
	];

	$smarty->assign('xmpp', $xmpp);
}
