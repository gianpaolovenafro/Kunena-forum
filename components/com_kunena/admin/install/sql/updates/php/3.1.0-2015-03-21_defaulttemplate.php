<?php
/**
 * Kunena Component
 * @package Kunena.Installer
 *
 * @copyright (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

// Kunena 3.1.0: Set crypsis as default template under J!3.x series
function kunena_310_2015_03_21_defaulttemplate($parent) {
	$config = KunenaFactory::getConfig ();

	if ($config->template == 'blue_eagle' && version_compare(JVERSION, '3.0', '>='))
	{
		$config->template = 'crypsis';
		$config->save();
	}

	return null;
}
