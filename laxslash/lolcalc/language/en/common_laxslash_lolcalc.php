<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit();
}

if (!is_array($lang) || empty($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	// ACP
	// Forms
	'LAXSLASH_LOLCALC_CONFIG_HDR'						=>		'Manage LoL KDA Calculator configuration',
	'LAXSLASH_LOLCALC_CONFIG_EXPLAIN'					=>		'Use this page to manage the settings that the LoL KDA Calculator will use to determine if the given KDA Ratio is positive or negative.',
	'LAXSLASH_LOLCALC_MULTIPLIERS_LEGEND'				=>		'Multipliers',
	'LAXSLASH_LOLCALC_ASSISTS_MULTIPLAYER_LBL'			=>		'Assists multiplier',
	'LAXSLASH_LOLCALC_SETTINGS_LEGEND'					=>		'Generic settings',
	'LAXSLASH_LOLCALC_COUNT_ZERO_AS_POSITIVE_OPT_LBL'	=>		'Count zero KDA as positive',

	// Messages
	'LAXSLASH_LOLCALC_SUCCESS_UPD_CONFIG'				=>		'Successfully updated the LoL KDA Calculator configuration.',
	'LAXSLASH_LOLCALC_ERR_MULTIPLAYER_MUST_BE_FLOAT'	=>		'The assists multiplier must be an integer or a float.',
	'LAXSLASH_LOCALC_INVALID_MODE'						=>		'Invalid mode selected for League of Legends KDA Calculator administration.',

	// Logs
	'LAXSLASH_LOLCALC_LOG_CONFIG_CHANGE'				=>		'<strong>Altered LoL KDA Calculator settings</strong>',


	// User Interface
	// Forms
	'LAXSLASH_LOLCALC_CALC_HDR'							=>		'League of Legends KDA Calculator',
	'LAXSLASH_LOLCALC_CALC_EXPLAIN'						=>		'Place in the number of kills, deaths and assists in their appropriate fields, and press submit in order to determine if the values represent a positive or a negative KDA.',
	'LAXSLASH_LOLCALC_KILLS_LBL'						=>		'Kills',
	'LAXSLASH_LOLCALC_ASSISTS_LBL'						=>		'Assists',
	'LAXSLASH_LOLCALC_DEATHS_LBL'						=>		'Deaths',

	//Results
	'LAXSLASH_LOLCALC_IS_VALID'							=>		'The entered KDA is <strong>POSITIVE</strong>',
	'LAXSLASH_LOLCALC_IS_INVALID'						=>		'The entered KDA is <strong>NEGATIVE</strong>',

	// Errors
	'LAXSLASH_LOLCALC_KILLS_NOT_INT'					=>		'Kills must be a valid and positive integer. Decimals are not accepted.',
	'LAXSLASH_LOLCALC_ASSISTS_NOT_INT'					=>		'Assists must be a valid and positive integer. Decimals are not accepted.',
	'LAXSLASH_LOLCALC_DEATHS_NOT_INT'					=>		'Deaths must be a valid and positive integer. Decimals are not accepted.',
));
