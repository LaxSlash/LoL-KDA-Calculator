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
	'ACL_A_LAXSLASH_LOLCALC_SET_VARS'		=>		'Can alter League of Legends KDA Calculator settings',
	'ACL_U_LAXSLASH_LOLCALC_USE_CALC'		=>		'Can use League of Legends KDA Calculator',
));
