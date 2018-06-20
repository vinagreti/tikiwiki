<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: YoutubeTest.php 65399 2018-01-31 22:12:50Z rjsmelo $

require_once('lib/wiki-plugins/wikiplugin_youtube.php');

class WikiPlugin_YoutubeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider provider
	 */
	public function testWikiPluginCode($data, $expectedOutput, $params = [])
	{
		$this->assertEquals($expectedOutput, wikiplugin_youtube($data, $params));
	}

	public function provider()
	{
		return [
			['', '^Plugin YouTube error: the movie parameter is empty.'],
			['', '~np~<iframe src="//www.youtube.com/embed/bPHuY7QL568?" frameborder="0" width="425" height="350" allowfullscreen=""></iframe>~/np~', ['movie' => 'http://www.youtube.com/watch?v=bPHuY7QL568']],
			['', '~np~<iframe src="//www.youtube.com/embed/deby_Yb1-ac?" frameborder="0" width="425" height="350" allowfullscreen=""></iframe>~/np~', ['movie' => 'https://www.youtube.com/watch?v=deby_Yb1-ac']],
			['', '~np~<iframe src="//www.youtube.com/embed/deby_Yb1-ac?" frameborder="0" width="425" height="350" allowfullscreen=""></iframe>~/np~', ['movie' => 'https://youtu.be/deby_Yb1-ac']],
			['', '~np~<iframe src="//www.youtube-nocookie.com/embed/deby_Yb1-ac?" frameborder="0" width="425" height="350" allowfullscreen=""></iframe>~/np~', ['movie' => 'https://youtu.be/deby_Yb1-ac', 'privacyEnhanced' => 'y']],
		];
	}
}
