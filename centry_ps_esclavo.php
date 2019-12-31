<?php
require_once _PS_MODULE_DIR_ . 'centry_ps_esclavo/classes/ConfigurationCentry.php';

if (!defined('_PS_VERSION_')) {
    exit;
}

class Centry_PS_esclavo extends Module
{
    public function __construct()
    {
        $this->name = 'centry_ps_esclavo';
        $this->tab = 'market_place';
        $this->version = '1.0.0';
        $this->author = 'Centry';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Centry Esclavo');
        $this->description = $this->l('Modulo que funciona como esclavo para Centry.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }


    public function install(){

      if (Shop::isFeatureActive()) {
          Shop::setContext(Shop::CONTEXT_ALL);
      }

      if (!parent::install() ||
          !$this->registerHook('leftColumn') ||
          !$this->registerHook('header') ||
          !$this->registerHook('actionValidateOrder') ||
          !$this->registerHook('actionOrderHistoryAddAfter')
      ) {
          return false;
      }

      return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('MYMODULE_NAME')
        ) {
            return false;
        }

        return true;
    }

    public function hookactionValidateOrder($params){
        //TODO: encolar notificacion, todo el seteo de info de la orden se va al controlador
        error_log(print_r("hookactionValidateOrder", true));
        error_log(print_r($params, true));
    }



    public function hookactionOrderHistoryAddAfter($params){
        //TODO: encolar notificacion, todo el seteo de info de la orden se va al controlador
        error_log(print_r("hookactionOrderHistoryAddAfter", true));
        error_log(print_r($params, true));
    }
}
