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

use Suki\Ohara;

class BlogNews extends \Suki\Ohara
{
	public $name = __CLASS__;
	public $useConfig = true;

	public function __construct()
	{
		$this->setRegistry();
	}

	public function addSettings()
	{

	}

	public function scheduledTask()
	{
		global $smcFunc;
	}

	protected function postNews()
	{

	}

	protected function between($string, $start, $end)
	{
		$string = ' ' . $string;
		$ini = mb_strpos($string, $start);

		if ($ini == 0)
			return '';

		$ini += mb_strlen($start);
		$len = mb_strpos($string, $end, $ini) - $ini;

		return mb_substr($string, $ini, $len);
	}
}
