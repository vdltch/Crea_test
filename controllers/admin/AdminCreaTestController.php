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
require_once _PS_MODULE_DIR_ . '/crea_test/classes/CreaTest.php';

class AdminCreaTestController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = CreaTest::$definition['table'];
        $this->identifier = CreaTest::$definition['primary'];
        $this->className = CreaTest::class;
        $this->lang = true;

        parent::__construct();

        $this->fields_list = [
            'id_test' => [
                'title' => $this->module->l('ID', 'AdminCreaTestController'),
                'class' => 'fixed-width-xs',
                'align' => 'center',
            ],
            'nom' => [
                'title' => $this->module->l('Title', 'AdminCreaTestController'),
                'align' => 'left',
            ],
            'description' => [
                'title' => $this->module->l('Description', 'AdminCreaTestController'),
                'align' => 'left',
            ],
        ];
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    public function renderForm()
    {
        $this->fields_form = [
            'legend' => [
                'title' => $this->module->l('Crea Test'),
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->module->l('Nom'),
                    'name' => 'nom',
                    'required' => true,
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->module->l('Description'),
                    'name' => 'description',
                    'lang' => true,
                    'required' => true,
                    'autoload_rte' => true,
                ],
            ],
            'submit' => [
                'title' => $this->module->l('Save'),
            ],
        ];

        return parent::renderForm();
    }
    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['new'] = [
            'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
            'desc' => $this->module->l('Add new message'),
            'icon' => 'process-icon-new',
        ];

        parent::initPageHeaderToolbar();
    }
}