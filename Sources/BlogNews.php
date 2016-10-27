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
}