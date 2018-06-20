<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ArticlePutProvider.php 64622 2017-11-18 19:34:07Z rjsmelo $

namespace Tiki\MailIn\Provider;

use Tiki\MailIn\Action;

class ArticlePutProvider implements ProviderInterface
{
	function isEnabled()
	{
		global $prefs;
		return $prefs['feature_submissions'] == 'y';
	}

	function getType()
	{
		return 'article-put';
	}

	function getLabel()
	{
		return tr('Create or update article');
	}

	function getActionFactory(array $acc)
	{
		return new Action\DirectFactory('Tiki\MailIn\Action\ArticlePut', [
			'topic' => $acc['article_topicId'],
			'type' => $acc['article_type'],
		]);
	}
}
