<?php
/**
 * This file is a part of the LoL KDA Calculator extension for phpBB 3.1.
 *
 * @copyright (c) LaxSlash <https://www.github.com/LaxSlash>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace laxslash\lolcalc\controller;

use phpbb\user;
use phpbb\auth\auth;
use phpbb\controller\helper;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\config\config;
use \Symfony\Component\HttpFoundation\Response;

class calc_page
{
	/* @var user */
	protected $user;

	/* @var auth */
	protected $auth;

	/* @var helper */
	protected $helper;

	/* @var request*/
	protected $request;

	/* @var template */
	protected $template;

	/* @var config */
	protected $config;

	/**
	 * Constructor
	 *
	 * @param		user		$user
	 * @param		auth		$auth
	 * @param		helper		$helper
	 * @param		request		$request
	 * @param		template	$template;
	 * @param		config		$config;
	 * @access		public
	 */
	public function __construct(user $user, auth $auth, helper $helper, request $request, template $template, config $config)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->config = $config;
	}

	/**
	 * Handle the calculator.
	 *
	 * @throws		\phpbb\exception\http_exception
	 * @return		\Symfony\Component\HttpFoundation\Response		A Symfony Response Object
	 */
	public function handle()
	{
		// Authorization check.
		if (!$this->auth->acl_get('u_laxslash_lolcalc_use_calc'))
		{
			// No auth.
			throw new \phpbb\exception\http_exception(403, 'LAXSLASH_LOLCALC_NO_AUTH_USE_CALC', array());
		}

		// If we're here, authorization is good. Make a form key. We probably won't need it since info is not being sent to the database, but putting it in for standards.
		add_form_key('laxslash/lolcalc');

		// Vars.
		$lolcalc_kills = $this->request->variable('lolcalc_kills', 0);
		$lolcalc_assists = $this->request->variable('lolcalc_assists', 0);
		$lolcalc_deaths = $this->request->variable('lolcalc_deaths', 0);

		// Errors array.
		$errors = array();

		// If submit...
		if ($this->request->is_set_post('check_lolkda'))
		{
			// Form key check.
			if (!check_form_key('laxslash/lolcalc'))
			{
				$errors[] = $this->user->lang('FORM_INVALID');
			}

			// Ints only, and positive ints only.
			if (!is_int($lolcalc_kills) || $lolcalc_kills < 0)
			{
				$errors[] = $this->user->lang('LAXSLASH_LOLCALC_KILLS_NOT_INT');
				$lolcalc_kills = (int) 0;
			}

			if (!is_int($lolcalc_assists) || $lolcalc_assists < 0)
			{
				$errors[] = $this->user->lang('LAXSLASH_LOLCALC_ASSISTS_NOT_INT');
				$lolcalc_assists = (int) 0;
			}

			if (!is_int($lolcalc_deaths) || $lolcalc_deaths < 0)
			{
				$errors[] = $this->user->lang('LAXSLASH_LOLCALC_DEATHS_NOT_INT');
				$lolcalc_deaths = (int) 0;
			}

			// No errors? Check.
			if (!sizeof($errors))
			{
				// We're here, so let's give the user a result, shall we?
				$this->template->assign_var('S_LOLCALC_RESULT', true);
				// Formula. Grab the configuration value for the assists multiplier.
				$assists_mult = $this->config['laxslash_lolcalc_assist_var'];

				// Do the math.
				// KDA = (( K + ( A * x )) - D )
				$kda = (($lolcalc_kills + ($lolcalc_assists * $assists_mult)));
				if ($lolcalc_deaths > 0)
				{
					$kda = ($kda - $lolcalc_deaths);
				}

				if (($kda >= 0 && $this->config['laxslash_lolcalc_zero_is_qualified']) || ($kda > 0 && !$this->config['laxslash_lolcalc_zero_is_qualified']))
				{
					// Positive KDA, valid screenshot.
					$this->template->assign_var('S_VALID', true);
				}
			}
		}

		// Page creation.
		$this->template->assign_vars(array(
			'LOLCALC_KILLS'			=>		$lolcalc_kills,
			'LOLCALC_ASSISTS'		=>		$lolcalc_assists,
			'LOLCALC_DEATHS'		=>		$lolcalc_deaths,
			'S_ERROR'				=>		(sizeof($errors)) ? true : false,
			'ERROR_MSG'				=>		(sizeof($errors)) ? implode('<br />', $errors) : '',
			'S_CHECK_KDA_ACTION'	=>		$this->helper->route('laxslash_lolcalc_main_calc_route'),
			'S_SHOW_KDA'			=>		($this->auth->acl_get('a_laxslash_lolcalc_set_vars')) ? true : false,		// We show administrators the KDA for configuration testing.
			'KDA'					=>		($this->auth->acl_get('a_laxslash_lolcalc_set_vars') && isset($kda)) ? $kda : '',
		));

		unset($errors);

		return $this->helper->render('lol_calc.html');
	}
}
