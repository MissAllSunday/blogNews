<?php

/**
 * @package blogNews
 * @version 1.0
 * @author Jessica Gonz�lez <suki@missallsunday.com>
 * @copyright Copyright (c) 2015, Jessica Gonz�lez
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