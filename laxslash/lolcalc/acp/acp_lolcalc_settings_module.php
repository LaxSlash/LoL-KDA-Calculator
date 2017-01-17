<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace laxslash\lolcalc\acp;

class acp_lolcalc_settings_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main($id, $mode)
	{
		global $config, $auth, $user, $template, $request, $phpbb_log;

		// Global vars go here.
		$this->tpl_name = 'lolcalc_settings';
		$template->assign_var('U_ACTION', $this->u_action);

		switch ($mode)
		{
			case 'config':
				// Permission?
				if (!$auth->acl_get('a_laxslash_lolcalc_set_vars'))
				{
					trigger_error($user->lang('LAXSLASH_LOLCALC_NO_AUTH'), E_USER_ERROR);
				}

				// Add the form key.
				add_form_key('laxslash/lolcalc');

				// And any arrays that we'll need.
				$errors = array();

				// Get the multiplayer.
				$lolcalc_assists_multiplayer = $request->variable('lolcalc_assists_multiplayer', $config['laxslash_lolcalc_assist_var']);

				// Do we count a score of 0 as positive?
				$count_zero_as_positive = $request->variable('count_zero_as_positive', $config['laxslash_lolcalc_zero_is_qualified']);

				// Submitted?
				if ($request->is_set_post('lolcalc_config_update'))
				{
					// Error check.
					if (!check_form_key('laxslash/lolcalc'))
					{
						$errors[] = $user->lang('FORM_INVALID');
					}

					// Float check.
					// If int, convert to float.
					if (is_numeric($lolcalc_assists_multiplayer))
					{
						$lolcalc_assists_multiplayer = floatval($lolcalc_assists_multiplayer);
					}

					if (!is_float($lolcalc_assists_multiplayer))
					{
						$errors[] = $user->lang('LAXSLASH_LOLCALC_ERR_MULTIPLAYER_MUST_BE_FLOAT');

						// Set the value back to config.
						$lolcalc_assists_multiplayer = $config['laxslash_lolcalc_assist_var'];
					}

					// We good?
					if (empty($errors))
					{
						// Unset what we do not neeed anymore
						unset($errors);

						// Set the new config variables.
						$config->set('laxslash_lolcalc_assist_var', $lolcalc_assists_multiplayer);
						$config->set('laxslash_lolcalc_zero_is_qualified', $count_zero_as_positive);

						// Log.
						$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LAXSLASH_LOLCALC_LOG_CONFIG_CHANGE', time(), array());

						// Go on.
						trigger_error($user->lang('LAXSLASH_LOLCALC_SUCCESS_UPD_CONFIG') . adm_back_link($this->u_action));
					}
				}

				$template->assign_vars(array(
					'LOLCALC_ASSISTS_MULTIPLAYER'	=>	$lolcalc_assists_multiplayer,
					'COUNT_ZERO_AS_POSITIVE'		=>	$count_zero_as_positive,
					'S_ERROR'						=>	(sizeof($errors)) ? true : false,
					'ERROR_MSG'						=>	(sizeof($errors)) ? implode('<br />', $errors) : '',
				));
			break;

			default:
				trigger_error($user->lang('LAXSLASH_LOLCALC_INVALID_MODE'), E_USER_ERROR);
			break;
		}
	}
}
