<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace laxslash\lolcalc\migrations;

use phpbb\db\migration\migration;

class v01a extends migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v319');
	}

	public function update_data()
	{
		return array(
			// New config values.
			array('config.add', array('laxslash_lolcalc_version', '0.1 ALPHA')),
			array('config.add', array('laxslash_lolcalc_assist_var', '0.75')),
			array('config.add', array('laxslash_lolcalc_zero_is_qualified', true)),

			// New permissions.
			array('permission.add', array('a_laxslash_lolcalc_set_vars')),
			array('permission.add', array('u_laxslash_lolcalc_use_calc')),

			// Set the new permissions by default accordingly.
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_laxslash_lolcalc_set_vars')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_laxslash_lolcalc_use_calc')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_laxslash_lolcalc_set_vars')),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_laxslash_lolcalc_use_calc')),

			// Add the ACP Module.
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CAT_LAXSLASH_LOLCALC',
			)),
			array('module.add', array(
				'acp',
				'ACP_CAT_LAXSLASH_LOLCALC',
				array(
					'module_basename'		=>		'\laxslash\lolcalc\acp\acp_lolcalc_settings_module',
					'modes'					=>		array('config'),
				),
			)),
		);
	}
}
