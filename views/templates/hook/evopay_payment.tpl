{**
 * Module Evo pay for PrestaShop
 * Fully Remasterized by HAMDI BAKLOUTI for Prestashop 1.5 & 1.6 versions - 21/03/2017
 *  @author HAMDI BAKLOUTI <bakloutihamdi@gmail.com>
 *  @copyright  2017 HAMDI BAKLOUTI
 * Based on the original script of HAMDI BAKLOUTI
 * email: bakloutihamdi@gmail.com
 *}

<p class="payment_module">
	<a href="{$link->getModuleLink('evopay', 'payment', [], true)|escape:'html'}" title="{l s='Pay by cart' mod='evopay'}">
		<img src="{$_path}views/templates/img/evopay.png" alt="{l s='Pay by check' mod='evopay'}" width="239" height="59" />
		{l s='Pay by cart' mod='evopay'}
	</a>
</p>
