<?php

/**
 * Module Evo pay for PrestaShop
 * Fully Remasterized by HAMDI BAKLOUTI for Prestashop 1.5 & 1.6 versions - 21/03/2017
 *  @author HAMDI BAKLOUTI <bakloutihamdi@gmail.com>
 *  @copyright  2017 HAMDI BAKLOUTI
 * Based on the original script of HAMDI BAKLOUTI
 * email: bakloutihamdi@gmail.com
 */
class EvopayValidationModuleFrontController extends ModuleFrontController {

    public function __construct() {
        parent::__construct();
        $this->display_header = false;
        $this->display_footer = false;
        $this->display_column_left = false;
        $this->display_column_right = false;
    }

    public function postProcess() {
        $cart = $this->context->cart;
//        if (Tools::getValue('nameoncheck') == '' || Tools::getValue('accountnumber') == '' || Tools::getValue('abaroutingnumber') == '' || Tools::getValue('billingaddress') == '' || Tools::getValue('zipcode') == '' || Tools::getValue('phone') == '')
//            Tools::redirect('index.php?controller=order&step=1');
        
        if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active)
            Tools::redirect('index.php?controller=order&step=1');

        // Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
        $authorized = false;
        foreach (Module::getPaymentModules() as $module)
            if ($module['name'] == 'evopay') {
                $authorized = true;
                break;
            }

        if (!$authorized)
            die($this->module->l('This payment method is not available.', 'validation'));

        $customer = new Customer($cart->id_customer);

        if (!Validate::isLoadedObject($customer))
            Tools::redirect('index.php?controller=order&step=1');

        $currency = $this->context->currency;
        $total = (float) $cart->getOrderTotal(true, Cart::BOTH);

        $mailVars = array();

        $this->module->validateOrder((int) $cart->id, Configuration::get('PS_OS_CHEQUE'), $total, $this->module->displayName, NULL, $mailVars, (int) $currency->id, false, $customer->secure_key);

        $msg = new Message();
        $message = 'Name on Check:' . Tools::getValue('nameoncheck');
        $message = 'Account Number:' . Tools::getValue('accountnumber');
        $message = 'ABA Routing Number:' . Tools::getValue('abaroutingnumber');
        $message = 'Billing Address:' . Tools::getValue('billingaddress');
        if (Tools::getIsset('street') && Tools::getValue('street') != '')
            $message = 'Street:' . Tools::getValue('street');
        if (Tools::getIsset('city') && Tools::getValue('city') != '')
            $message = 'City:' . Tools::getValue('city');
        if (Tools::getIsset('state') && Tools::getValue('state') != '')
            $message = 'State:' . Tools::getValue('state');
        $message = 'Zip Code:' . Tools::getValue('zipcode');
        $message = 'Phone:' . Tools::getValue('phone');
        $message = strip_tags($message, '<br>');
        if (Validate::isCleanHtml($message)) {
            $msg->message = $message;
            $msg->id_order = (int) $this->module->currentOrder;
            $msg->private = 1;
            $msg->add();
        }
        Tools::redirect('index.php?controller=order-confirmation&id_cart=' . (int) $cart->id . '&id_module=' . (int) $this->module->id . '&id_order=' . $this->module->currentOrder . '&key=' . $customer->secure_key);
    }

}