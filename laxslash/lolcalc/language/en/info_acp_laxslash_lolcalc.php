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
	// ACP Categories
	'ACP_CAT_LAXSLASH_LOLCALC'	=>	'LoL KDA Calculator',

	// ACP Modules
	'ACP_LAXSLASH_LOLCALC_CONFIG'	=>	'Calculator configuration',
));
