<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ArticleTopic.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Tiki_Profile_InstallHandler_ArticleTopic extends Tiki_Profile_InstallHandler
{
	function getData()
	{
		if ($this->data) {
			return $this->data;
		}

		$data = $this->obj->getData();
		$data = Tiki_Profile::convertYesNo($data);

		return $this->data = $data;
	}

	function canInstall()
	{
		$data = $this->getData();

		if (! isset($data['name'])) {
			return false;
		}

		return true;
	}

	function _install()
	{
		$artlib = TikiLib::lib('art');
		$data = $this->getData();

		$this->replaceReferences($data);

		$id = $artlib->add_topic($data['name'], null, null, null, null);

		return $id;
	}

	public static function export(Tiki_Profile_Writer $writer, $topicId)
	{
		$artlib = TikiLib::lib('art');
		$info = $artlib->get_topic($topicId);

		if ($info) {
			$writer->addObject('article_topic', $topicId, [
				'name' => $info['name'],
			]);

			return true;
		}

		return false;
	}

	/**
	 * Remove article topic
	 *
	 * @param string $articleTopic
	 * @return bool
	 */
	function remove($articleTopic)
	{
		if (! empty($articleTopic)) {
			$artlib = TikiLib::lib('art');
			$articleTopicId = $artlib->get_topicId($articleTopic);
			if (! empty($articleTopicId) && $artlib->remove_topic($articleTopicId)) {
				return true;
			}
		}
		return false;
	}
}
