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

    public function initContent() {
        
    }

}