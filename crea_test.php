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
require_once __DIR__ . '/classes/CreaTest.php';

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Crea_Test extends Module implements WidgetInterface
{
    public function __construct()
    {
        $this->name = 'crea_test';
        $this->tab = 'others';
        $this->version = '1.1.0';
        $this->author = 'Creabilis';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Crea Test');
        $this->description = $this->l('Prestashop module for test.');
    }

    public function renderWidget($hookName, array $configuration)
    {

        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        $crea_test = CreaTest::getCreaTest((int) $this->context->language->id);

        if ($crea_test) {
            return $this->fetch('module:crea_test/views/templates/hook/crea_test.tpl');
        }
        return [];
    }
    public function getWidgetVariables($hookName, array $configuration)
    {
        $crea_test = CreaTest::getCreaTest((int) $this->context->language->id);
        
        return [
            'crea_test' => $crea_test,
        ];
    }

    public function install()
    {
        return parent::install() 
            && $this->installTab() 
            && $this->installSql() 
            && $this->registerHook('displayHome');
    }

    private function installTab()
    {
        $tab = new Tab();
        $tab->class_name = 'AdminCreaTest';
        $tab->id_parent = (int) Tab::getIdFromClassName('AdminParentModulesSf'); // Onglet "Modules"
        $tab->module = $this->name;
        $tab->name = [];

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Crea Test';
        }

        return $tab->add();
    }

    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminCreaTest'));
    }

    protected function installSql()
    {
        $sql = [];

        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'crea_test` (
                `id_test` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `nom` VARCHAR(255) NOT NULL,
                PRIMARY KEY (`id_test`)
                ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;'
        ;

        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'crea_test_lang` (
                `id_test` INT(10) UNSIGNED NOT NULL,
                `id_lang` INT(10) UNSIGNED NOT NULL,
                `description` TEXT,
                PRIMARY KEY (`id_test`, `id_lang`)
                ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;'
        ;

        foreach ($sql as $query) {
            if (Db::getInstance()->execute($query) == false) {
                return false;
            }
        }

        return true;
    }

    public function uninstall()
    {
        return parent::uninstall()
            && $this->uninstallTab();
    }
    
    private function uninstallTab()
    {
        $id_tab = (int) Tab::getIdFromClassName('AdminCreaTest');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            return $tab->delete();
        }
    
        return true;
    }
    
}
