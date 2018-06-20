<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Blog.php 64622 2017-11-18 19:34:07Z rjsmelo $

class Tiki_Profile_InstallHandler_Blog extends Tiki_Profile_InstallHandler
{
	function getData()
	{
		if ($this->data) {
			return $this->data;
		}

		$defaults = [
			'description' => '',
			'user' => 'admin',
			'public' => 'n',
			'max_posts' => 10,
			'heading' => '',
			'post_heading' => '',
			'use_find' => 'y',
			'comments' => 'n',
			'show_avatar' => 'n',
		];

		$data = array_merge($defaults, $this->obj->getData());

		$data = Tiki_Profile::convertYesNo($data);

		return $this->data = $data;
	}

	function canInstall()
	{
		$data = $this->getData();
		if (! isset($data['title'])) {
			return false;
		}

		return true;
	}

	function _install()
	{
		$bloglib = TikiLib::lib('blog');

		$data = $this->getData();

		$this->replaceReferences($data);

		$blogId = $bloglib->replace_blog(
			$data['title'],
			$data['description'],
			$data['user'],
			$data['public'],
			$data['max_posts'],
			0,
			$data['heading'],
			$data['use_author'],
			$data['add_date'],
			$data['use_find'],
			$data['allow_comments'],
			$data['show_avatar'],
			$data['post_heading']
		);

		return $blogId;
	}

	/**
	 * Remove blog
	 *
	 * @param string $blog
	 * @return bool
	 */
	function remove($blog)
	{
		if (! empty($blog)) {
			$bloglib = TikiLib::lib('blog');
			$blog = $bloglib->get_blog_by_title($blog);
			if (! empty($blog['blogId']) && $bloglib->remove_blog($blog['blogId'])) {
				return true;
			}
		}
		return false;
	}
}
