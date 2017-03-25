{**
 * Module Evo pay for PrestaShop
 * Fully Remasterized by HAMDI BAKLOUTI for Prestashop 1.5 & 1.6 versions - 21/03/2017
 *  @author HAMDI BAKLOUTI <bakloutihamdi@gmail.com>
 *  @copyright  2017 HAMDI BAKLOUTI
 * Based on the original script of HAMDI BAKLOUTI
 * email: bakloutihamdi@gmail.com
 *}
 <style>
 .form-group input{
    max-width: 271px;
}
 </style>
{capture name=path}
    <a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}" title="{l s='Go back to the Checkout' mod='evopay'}">{l s='Checkout' mod='evopay'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Evopay payment' mod='evopay'}
    {/capture}

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{if isset($nbProducts) && $nbProducts <= 0}
    <p class="warning">{l s='Your shopping cart is empty.' mod='evopay'}</p>
{else}

    <form action="{$link->getModuleLink('evopay', 'validation', [], true)|escape:'html'}" method="post">
        <p>
            <img src="{$_path}views/templates/img/evopay.png" alt="{l s='Check' mod='evopay'}" width="239" height="59" style="float:left; margin: 0px 10px 5px 0px;" />
            {l s='You have chosen to pay by check.' mod='evopay'}
            <br/><br />
            {l s='Here is a short summary of your order:' mod='evopay'}
        </p>
        <p style="margin-top:20px;">
            - {l s='The total amount of your order comes to:' mod='evopay'}
            <span id="amount" class="price">{displayPrice price=$total}</span>
            {if $use_taxes == 1}
                {l s='(tax incl.)' mod='evopay'}
            {/if}
        </p>               

        <div class="required form-group">
            <label for="" class="required">
                {l s='Name on Check' mod='evopay'}
            </label>
            <input class="is_required validate form-control" data-validate="isName" type="text" name="nameoncheck" value="{$nameoncheck}">
        </div>

        <div class="required form-group">
            <label for="" class="required">
                {l s='Account Number' mod='evopay'}
            </label>
            <input class="is_required validate form-control" data-validate="isNumber" type="text" name="accountnumber" value="{$accountnumber}">
        </div>

        <div class="required form-group">
            <label for="" class="required">
                {l s='ABA Routing Number' mod='evopay'}
            </label>
            <input class="is_required validate form-control" type="text" name="abaroutingnumber " value="{$abaroutingnumber}">
        </div>

        <div class="required form-group">
            <label for="" class="required">
                {l s='Billing Address' mod='evopay'}
            </label>
            <input class="is_required validate form-control" type="text" name="billingaddress" value="{$billingaddress}">
        </div>

        <div class="form-group">
            <label for="">
                {l s='Street' mod='evopay'}
            </label>
            <input class="is_required validate form-control" type="text" name="street" value="{$street}">
        </div>

        <div class="form-group">
            <label for="">
                {l s='City' mod='evopay'}
            </label>
            <input class="validate form-control" type="text" name="city" value="{$city}">
        </div>

        <div class="form-group">
            <label for="">
                {l s='State' mod='evopay'}
            </label>
            <input class="form-control" type="text" name="state" value="{$state}">
        </div>

        <div class="required form-group">
            <label for="" class="required">
                {l s='Zip Code' mod='evopay'}
            </label>
            <input class="is_required validate form-control" data-validate="isNumber" type="text" name="zipcode" value="{$zipcode}">
        </div>

        <div class="required form-group">
            <label for="" class="required">
                {l s='Phone' mod='evopay'}
            </label>
            <input class="is_required validate form-control" data-validate="isNumber" type="text" name="phone" value="{$phone}">
        </div>
        
        <p class="cart_navigation" id="cart_navigation">
            <input type="submit" value="{l s='I confirm my order' mod='evopay'}" class="exclusive_large"/>
            <a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html'}" class="button_large">{l s='Other payment methods' mod='evopay'}</a>
        </p>
    </form>
{/if}
