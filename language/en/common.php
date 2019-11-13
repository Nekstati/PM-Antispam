<?php

/**
*
*  @package PMAntispam
*  @copyright (c) 2019 Nekstati
*  @license GNU General Public License, version 2 (GPL-2.0)
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'PMANTISPAM_CANNOT_PM'						=> 'You cannot send PMs more than once every %1$s minutes. Retry at %2$s. We are sorry, this is the spam countermeasure.',
));
