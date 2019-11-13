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
	'PMANTISPAM_CANNOT_PM'						=> 'Вы не можете отправлять личные сообщения чаще чем раз в %1$s минут. Попробуйте заново в %2$s. Приносим извинения за неудобства; это мера защиты от спама.',
));
