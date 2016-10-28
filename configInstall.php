<?php

/**
 * @package blogNews
 * @version 1.0
 * @author Jessica González <suki@missallsunday.com>
 * @copyright Copyright (c) 2015, Jessica González
 * @license http://www.mozilla.org/MPL/ MPL 2.0
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');

else if(!defined('SMF'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php and SSI.php files.');

if ((SMF == 'SSI') && !$user_info['is_admin'])
	die('Admin priveleges required.');

// Prepare and insert this mod's config array.
$_config = array(
	'_availableHooks' => array(
		'simpleSettings' => 'integrate_general_mod_settings',
	),
	'simpleSettings' => array(
		'title',
		array('type' => 'check', 'name' => 'master'),
		array('type' => 'text', 'name' => 'file'),
		array('type' => 'int', 'name' => 'board'),
		array('type' => 'int', 'name' => 'poster'),
		'',
	),
);

// All good.
updateSettings(array('_configBlogNews' => json_encode($_config)));

if (SMF == 'SSI')
	echo 'Database changes are complete!';