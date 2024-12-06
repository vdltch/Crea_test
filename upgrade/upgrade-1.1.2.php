<?php
/**
 * Copyright since 2002 Creabilis
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@creabilis.com so we can send you a copy immediately.
 *
 * @author    Creabilis <contact@creabilis.com>
 * @copyright Since 2002 Creabilis
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of Creabilis
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_1_2($module)
{
    $sql[] = 'ALTER TABLE `' . _DB_PREFIX_ . 'crea_test` ADD `hook_name` VARCHAR(255) NOT NULL AFTER `title`';

    foreach ($sql as $query) { 
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }

    return true;
}