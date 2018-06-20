<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: CommentSource.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Search_GlobalSource_CommentSource implements Search_GlobalSource_Interface
{
	private $commentslib;
	private $table;

	function __construct()
	{
		$this->commentslib = TikiLib::lib('comments');
		$this->table = TikiDb::get()->table('tiki_comments');
	}

	function getProvidedFields()
	{
		return [
			'comment_count',
			'comment_data',
		];
	}

	function getGlobalFields()
	{
		return [
			'comment_data' => false,
		];
	}

	function getData($objectType, $objectId, Search_Type_Factory_Interface $typeFactory, array $data = [])
	{
		$data = '';
		if ($objectType == 'forum post') {
			$forumId = $this->commentslib->get_comment_forum_id($objectId);
			$comment_count = $this->commentslib->count_comments_threads("forum:$forumId", $objectId);
		} else {
			$comment_count = $this->commentslib->count_comments("$objectType:$objectId");

			$data = implode(' ', $this->table->fetchColumn('data', [
				'object' => $objectId,
				'objectType' => $objectType,
			]));
		}
		return [
			'comment_count' => $typeFactory->numeric($comment_count),
			'comment_data' => $typeFactory->plaintext($data),
		];
	}
}
