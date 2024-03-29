<?php
$_SESSION['test-card'] = '';
?>
<?php if(arg(4) == 'invoice') : ?>
<script type="text/javascript">
(function($){
    $(document).ready(function(){
        $("ul.secondary").find("li").eq(1).attr("style","display: none;");
		$("div.error").attr("style","display: none;");
		$("#block-system-main").attr("style","width: 940px;");
    });
})(jQuery);
</script>
<?php elseif(arg(5) == 'mail') : ?>
<script type="text/javascript">
(function($){
    $(document).ready(function(){
        $('ul.secondary').find('li').eq(1).attr('style','display: none;');
		$('div.error').attr('style','display: none;');
		$('#block-system-main').attr('style','width: 940px;');
    });
})(jQuery);
</script>
<?php else : ?>
<script type="text/javascript">
(function($){
    $(document).ready(function(){
		$('div.error').attr('style','display: none;');
    });
})(jQuery);
</script>
<?php endif; ?>
<?php
	$query = db_select('checkout_vat_inc', 'z');
		$query->fields('z',array('id','payment_method','smac_no'))
		->condition('order_id', $order->order_id);
	$result = $query->execute();
	
	while($record = $result->fetchAssoc()) {
		$sales_invoice = $record['id'] ;
		$nex_smac = $record['smac_no'] ;
	}
	
	$new_sales_smac = isset($nex_smac) ? $nex_smac: 'N/A';
	if($new_sales_smac != 0){
		$new_sales_smac = substr($new_sales_smac,0,4).'-'.substr($new_sales_smac,4,4).'-'.substr($new_sales_smac,8,4).'-'.substr($new_sales_smac,12,4);
	}else{
		$new_sales_smac = 'N/A';
	}
    
	if(empty($sales_invoice)){
		$new_sales_invoice = '---';
	}
	else{
		$new_sales_invoice = '423-'.str_pad($sales_invoice,10, "0", STR_PAD_LEFT);
	}
	
	global $base_root;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center" style="font-family: verdana, arial, helvetica; font-size: small;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF" style="font-family: verdana, arial, helvetica; font-size: small;">
        <tr valign="top">
          <td><?php if ($thank_you_message): ?>
            <p><b><?php print t('Thanks for your order, !order_first_name! <br />', array('!order_first_name' => $order_first_name)); ?></b></p>
            <?php if (isset($order->data['new_user'])): ?>
            <p><b><?php print t('An account has been created for you with the following details:'); ?></b></p>
            <p><b><?php print t('Username:'); ?></b> <?php print $order_new_username; ?><br />
              <b><?php print t('Password:'); ?></b> <?php print $order_new_password; ?></p>
            <?php endif; ?>
            <p><b><?php print '<br />'.t('Want to manage your order online?'); ?></b><br />
              <?php print t('If you need to check the status of your order, please visit our home page at !store_link and click on "My account" in the menu or login with the link below:', array('!store_link' => $store_link)); ?> <br />
              <br />
              <?php print $site_login_link; ?></p>
            <?php endif; ?>
            <table cellpadding="4" cellspacing="0" border="0" width="100%" style="font-family: verdana, arial, helvetica; font-size: small;">
              <tr>
                <td colspan="2" bgcolor="#006699" style="color: white;"><b><?php print t('Purchasing Information:'); ?></b></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" cellspacing="0" cellpadding="0" style="font-family: verdana, arial, helvetica; font-size: small;">
                    <tr>
                      <td valign="top" width="50%"><b><?php print t('E-mail Address:'); ?></b> <br /> <?php print $order_email; ?><br />
                        </td>
                      <td valign="top" width="50%"><b><?php print t('SM Advantage/Prestige/BDO Card:'); ?></b><br /> <?php print $new_sales_smac; ?><br /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" cellspacing="0" cellpadding="0" style="font-family: verdana, arial, helvetica; font-size: small;">
                    <tr>
                      <td valign="top" width="50%"><b><?php print t('Billing Address:'); ?></b><br />
                        <?php print $order_billing_address; ?><br />
                        <br />
                        <b><?php print t('Billing Phone:'); ?></b><br />
                        <?php print $order_billing_phone; ?><br /></td>
                      <?php if ($shippable): ?>
                      <td valign="top" width="50%"><b><?php print t('Shipping Address:'); ?></b><br />
                        <?php print $order_shipping_address; ?><br />
                        <br />
                        <b><?php print t('Shipping Phone:'); ?></b><br />
                        <?php print $order_shipping_phone; ?><br /></td>
                      <?php endif; ?>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td nowrap="nowrap"><b><?php print t('Order Grand Total:'); ?></b></td>
                <td width="98%"><b><?php print $order_total; ?></b></td>
              </tr>
              <tr>
                <td nowrap="nowrap"><b><?php print t('Payment Method:'); ?></b></td>
                <td width="98%"><?php print $order_payment_method; ?></td>
              </tr>
             
             <?php if ($help_text || $email_text || $store_footer): ?>
                  </table>
                  <hr noshade="noshade" size="1" />
                  <br />
                  <?php if ($help_text): ?>
                  <p><b><?php print t('Where can I get assistance for my online transactions?'); ?></b><br />
                    <?php print t('Call our toll free number: Mondays through Sundays: 9:00AM to 9:00PM'); ?> <br />
                  </p>
                  <?php endif; ?>
                  <?php if ($email_text): ?>
                  <p><?php print t('Metro Manila: 833-8888'); ?></p>
                  <p><?php print t('Outside Metro Manila: 1-800-10833-8888'); ?></p>
                  <p><?php print t('Or email us through: inquiries@smappliance.com'); ?></p>
                  <?php endif; ?>
                  <?php if ($store_footer): ?>
                  <p><b><?php print $store_link; ?></b><br />
                    <b><?php print $site_slogan; ?></b></p>
                  <?php endif; ?></td>
              </tr>
              <?php endif; ?>
            </table></td>
          . </tr>
      </table></td>
  </tr>
</table>
