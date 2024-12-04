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

 class CreaTest extends ObjectModel
{
    public $nom;
    public $description;

    public static $definition = [
        'table' => 'crea_test',
        'primary' => 'id_test',
        'multilang' => true,
        'fields' => [
            'nom' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 255],
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true],
        ],
    ];
    public static function getCreaTest($id_lang)
    {
        $sql = 'SELECT * 
        FROM ' . _DB_PREFIX_ . 'crea_test ct 
        LEFT JOIN ' . _DB_PREFIX_ . 'crea_test_lang ctl 
        ON ct.id_test = ctl.id_test 
        WHERE ctl.id_lang = ' . (int)$id_lang;
        
        return Db::getInstance()->executeS($sql);
    }
}
