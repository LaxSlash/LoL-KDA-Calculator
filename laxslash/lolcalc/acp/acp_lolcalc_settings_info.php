<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace laxslash\lolcalc\acp;

class acp_lolcalc_settings_info
{
	public function module()
	{
		return array(
			'filename'		=>		'laxslash\lolcalc\acp\acp_lolcalc_settings_module',
			'title'			=>		'ACP_CAT_LAXSLASH_LOLCALC',
			'version'		=>		'0.1 ALPHA',
			'modes'			=>		array(
				'config'		=>		array(
					'title'			=>		'ACP_LAXSLASH_LOLCALC_CONFIG',
					'auth'			=>		'ext_laxslash/lolcalc && acl_a_laxslash_lolcalc_set_vars',
					'cat'			=>		'ACP_CAT_LAXSLASH_LOLCALC',
				),
			),
		);
	}
}
