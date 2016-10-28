<?php

/**
 * @package blogNews
 * @version 1.0
 * @author Jessica González <suki@missallsunday.com>
 * @copyright Copyright (c) 2015, Jessica González
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

if (!defined('SMF'))
	die('No direct access...');

// Ohara autoload!
require_once $sourcedir .'/ohara/src/Suki/autoload.php';

use Suki\Ohara;

class BlogNews extends \Suki\Ohara
{
	public $name = __CLASS__;
	public $useConfig = true;

	public function __construct()
	{
		$this->setRegistry();
	}

	public function scheduledTask()
	{
		global $smcFunc;

		// Mod is disabled.
		if(!$this->enable('master'))
			return;

		// Get the needed data!
		$news = $this->getNews();

		// No?
		if (empty($news))
			return true;

		// Post it.
		require_once($this->sourceDir . '/Subs-Post.php');

		$msgOptions = array(
			'subject' => $news['title'],
			'body' => $news['body'],
			'approved' => true,
			'smileys_enabled' => true,
			'icon' => 'xx',
		);
		$topicOptions = array(
			'id' => 0,
			'board' => $this->setting('board', 0),
			'is_approved' => true,
			'lock_mode' => null,
		);
		$posterOptions = array(
			'id' => $this->setting('poster', 1),
			'update_post_count' => true,
		);

		// All done!
		return createPost($msgOptions, $topicOptions, $posterOptions);
	}

	protected function getNews()
	{
		// Get the file.
		$file = $this['tools']->parser($this->setting('file', ''), array(
			'boarddir' => $this->boardDir,
			'sourcedir' => $this->sourceDir,
		));

		if (!file_exists($file) || is_writable($file))
			return false;

		$news = array();

		// XML because reasons!
		$doc = new DOMDocument;
		$doc->load($file);

		$message = $doc->documentElement->getElementsByTagName('message')->item(0);

		if (!empty($message) && is_object($message))
			$news = array(
				'title' => $message->getElementsByTagName('title')->item(0)->nodeValue,
				'body' => $message->getElementsByTagName('body')->item(0)->nodeValue,
			);

		else
			return false;

		// Remove the message.
		$doc->documentElement->removeChild($message);

		// Save it.
		$doc->saveXML();
		$doc->save($file);

		return $news;
	}
}
