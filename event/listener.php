<?php

/**
*
*  @package PMAntispam
*  @copyright (c) 2019 Nekstati
*  @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace nekstati\PMAntispam\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.ucp_pm_compose_modify_data'	=> 'check_time',
		);
	}

	protected $db, $config, $request, $template, $user, $phpbb_root_path;

	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path)
	{
		$this->db = $db;
		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	public function check_time()
	{
		if (!$this->user->data['user_new'])
		{
			return;
		}

		$sql = 'SELECT message_time
			FROM ' . PRIVMSGS_TABLE . '
			WHERE author_id = ' . $this->user->data['user_id'] . '
			ORDER BY message_time DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$last_pm_time = $this->db->sql_fetchfield('message_time');
		$this->db->sql_freeresult($result);

		if (!empty($last_pm_time) && time() - $last_pm_time < 1800)
		{
			$this->user->add_lang_ext('nekstati/PMAntispam', 'common');
			trigger_error($this->user->lang('PMANTISPAM_CANNOT_PM', 1800 / 60, $this->user->format_date($last_pm_time + 1800, 'H:i')));
		}
	}
}
