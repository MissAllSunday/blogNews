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
	die('Admin privileges required.');

	global $smcFunc, $context;

	db_extend('packages');

	// Create the scheduled task.
	if (empty($context['uninstalling']))
		$smcFunc['db_insert'](
			'insert',
			'{db_prefix}scheduled_tasks',
			array(
				'id_task' => 'int',
				'next_time' => 'int',
				'time_offset' => 'int',
				'time_regularity' => 'int',
				'time_unit' => 'string',
				'disabled' => 'int',
				'task' => 'string',
				'callable' => 'string',
			),
			array(
				0, 0, 0, 2, 'w', 0, 'BlogNews', 'BlogNews.php|BlogNews::scheduledTask#',
			),
			array(
				'id_task',
			)
		);

if (SMF == 'SSI')
	echo 'Database changes are complete!';
