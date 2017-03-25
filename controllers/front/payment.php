<?php

/**
 * Module Evo pay for PrestaShop
 * Fully Remasterized by HAMDI BAKLOUTI for Prestashop 1.5 & 1.6 versions - 21/03/2017
 *  @author HAMDI BAKLOUTI <bakloutihamdi@gmail.com>
 *  @copyright  2017 HAMDI BAKLOUTI
 * Based on the original script of HAMDI BAKLOUTI
 * email: bakloutihamdi@gmail.com
 */
class EvopayPaymentModuleFrontController extends ModuleFrontController {

    public function __construct() {
        parent::__construct();
        $this->ssl = true;
        $this->display_column_left = false;
    }

    public function initContent() {
        parent::initContent();
        $cart = $this->context->cart;
        $address = new Address((int) $cart->id_address_invoice);
        $this->context->smarty->assign(array(
            'nbProducts' => $cart->nbProducts(),
            'total' => $cart->getOrderTotal(true, Cart::BOTH),
            '_path' => $this->module->getPathUri(),
            'nameoncheck' => $address->firstname . ' ' . $address->lastname,
            'accountnumber' => '',
            'abaroutingnumber' => '',
            'billingaddress' => $address->address1,
            'street' => '',
            'city' => $address->city,
            'state' => $address->country,
            'zipcode' => $address->postcode,
            'phone' => $address->phone == '' ? $address->phone_mobile : $address->phone,
        ));

        $this->setTemplate('payment_form.tpl');
    }

}
