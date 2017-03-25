<?php

/**
 * Module Evo pay for PrestaShop
 * Fully Remasterized by HAMDI BAKLOUTI for Prestashop 1.5 & 1.6 versions - 21/03/2017
 *  @author HAMDI BAKLOUTI <bakloutihamdi@gmail.com>
 *  @copyright  2017 HAMDI BAKLOUTI
 * Based on the original script of HAMDI BAKLOUTI
 * email: bakloutihamdi@gmail.com
 */
class evopay extends PaymentModule {

    private $_html = '';
    private $_postErrors = array();

    public function __construct() {
        $this->name = 'evopay';
        $this->author = 'HAMDI BAKLOUTI';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->currencies = true;
        $this->currencies_mode = 'radio';
        $this->controllers = array('payment', 'validation');
        $this->bootstrap = true;
        parent::__construct();
        /* The parent construct is required for translations */
        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Evo pay');
        $this->description = $this->l('Evo pay');

        $this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
        $this->orderPaymentName = $this->l('Evo pay'); //The name of the means of payment which will appear in the list of orders
        $this->orderPaymentNameTest = $this->l('Evo pay'); //The name of the means of payment which will appear in the list of orders
    }

    public function install() {
        if (!parent::install() OR !$this->registerHook('paymentReturn') OR !$this->registerHook('payment'))
            return false;
        return true;
    }

    public function hookPaymentReturn($params) {
        if (!$this->active)
            return;

        return $this->display(__FILE__, 'confirmation.tpl');
    }

    public function uninstall() {
        if (!parent::uninstall())
            return false;
        return true;
    }

    public function getContent() {
        
    }

    public function hookPayment($params) {
        $this->smarty->assign(array(
            '_path' => $this->_path,
        ));
        return $this->display(__FILE__, 'evopay_payment.tpl');
    }


}

?>
