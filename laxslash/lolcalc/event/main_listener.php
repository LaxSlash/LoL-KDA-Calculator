<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace laxslash\lolcalc\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{

	/**
	 * Constructor
	 *
	 * @access		public
	 */
	public function __construct()
	{
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'		=>		'add_new_permissions',
			'core.user_setup'		=>		'on_user_setup',
		);
	}

	public function on_user_setup($event)
	{
		// Lang.
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name'		=>		'laxslash/lolcalc',
			'lang_set'			=>		'common_laxslash_lolcalc',
		);
		$event['lang_set_ext'] = $lang_set_ext;
		unset($lang_set_ext);
	}

	public function add_new_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['a_laxslash_lolcalc_set_vars'] = array(
			'lang'		=>		'ACL_A_LAXSLASH_LOLCALC_SET_VARS',
			'cat'		=>		'settings',
		);
		$permissions['u_laxslash_lolcalc_use_calc'] = array(
			'lang'		=>		'ACL_U_LAXSLASH_LOLCALC_USE_CALC',
			'cat'		=>		'misc',
		);
		$event['permissions'] = $permissions;
		unset($permissions);
	}
}
