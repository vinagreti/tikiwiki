<?php
/**
 * @package tikiwiki
 */
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-accounting_entry.php 64604 2017-11-17 02:02:41Z rjsmelo $

$section = 'accounting';
require_once('tiki-setup.php');

$access->checkAuthenticity();


// Feature available?
if ($prefs['feature_accounting'] != 'y') {
	$smarty->assign('msg', tra('This feature is disabled') . ': feature_accounting');
	$smarty->display('error.tpl');
	die;
}

$globalperms = Perms::get();
$objectperms = Perms::get([ 'type' => 'accounting book', 'object' => $bookId ]);

if (! ($globalperms->acct_book or $objectperms->acct_book)) {
	$smarty->assign('msg', tra('You do not have the right to book'));
	$smarty->display('error.tpl');
	die;
}

if (! isset($_REQUEST['bookId'])) {
	$smarty->assign('msg', tra('Missing book id'));
	$smarty->display('error.tpl');
	die;
}
$bookId = $_REQUEST['bookId'];
$smarty->assign('bookId', $bookId);

$accountinglib = TikiLib::lib('accounting');
$book = $accountinglib->getBook($bookId);
$smarty->assign('book', $book);

$accounts = $accountinglib->getAccounts($bookId, $all = true);
$smarty->assign('accounts', $accounts);

if ($_REQUEST['journal_Year']) {
	$journalDate = new DateTime();
	$journalDate->setDate(
		$_REQUEST['journal_Year'],
		$_REQUEST['journal_Month'],
		$_REQUEST['journal_Day']
	);
}

if (isset($_REQUEST['book']) && $access->ticketMatch()) {
	$result = $accountinglib->book(
		$bookId,
		$journalDate,
		$_REQUEST['journalDescription'],
		$_REQUEST['debitAccount'],
		$_REQUEST['creditAccount'],
		$_REQUEST['debitAmount'],
		$_REQUEST['creditAmount'],
		$_REQUEST['debitText'],
		$_REQUEST['creditText']
	);
	if (is_numeric($result)) {
		if (isset($_REQUEST['statementId'])) {
			$accountinglib->updateStatement($bookId, $_REQUEST['statementId'], $result);
		}
	}
} else {
	$result = 0;
}

if (is_array($result)) {
	$smarty->assign('errors', $result);
	$smarty->assign('journalDate', $journalDate);
	$smarty->assign('journalDescription', $_REQUEST['journalDescription']);
	$smarty->assign('debitAccount', $_REQUEST['debitAccount']);
	$smarty->assign('creditAccount', $_REQUEST['creditAccount']);
	$smarty->assign('debitAmount', $_REQUEST['debitAmount']);
	$smarty->assign('creditAmount', $_REQUEST['creditAmount']);
	$smarty->assign('debitText', $_REQUEST['debitText']);
	$smarty->assign('creditText', $_REQUEST['creditText']);
	if (isset($_REQUEST['statementId'])) {
		$smarty->assign('statementId', $_REQUEST['statementId']);
	}
} else {
	$smarty->assign('debitAccount', ['']);
	$smarty->assign('creditAccount', ['']);
	$smarty->assign('debitAmount', ['']);
	$smarty->assign('creditAmount', ['']);
	$smarty->assign('debitText', ['']);
	$smarty->assign('creditText', ['']);
}

$journal = $accountinglib->getJournal($bookId, '%', '`journalId` DESC', 5);
$smarty->assign('journal', $journal);

$smarty->assign('req_url', $_SERVER['REQUEST_URI']);
$smarty->assign('mid', 'tiki-accounting_entry.tpl');
$smarty->display('tiki.tpl');
