<?php

include 'paypal.class.php';


	global $wp_query, $wpdb;
	$pid = $wp_query->query_vars['pid'];
		$current_user = wp_get_current_user();
	$uid = $current_user->ID;


$action = $_GET['action'];
$business = trim(get_option('AuctionTheme_paypal_email'));
if(empty($business)) die('Error. Admin, please add your paypal email in backend!');

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url

//--------------

	$AuctionTheme_paypal_enable_sdbx = get_option('AuctionTheme_paypal_enable_sdbx');
	if($AuctionTheme_paypal_enable_sdbx == "yes")
	$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

//--------------

$this_script = get_bloginfo('siteurl').'/?a_action=deposit_pay';

if(empty($action)) $action = 'process';



switch ($action) {



   case 'process':      // Process and order...

	$total = trim($_GET['am']);

//---------------------------------------------

      $p->add_field('business', $business);
	  $p->add_field('currency_code', get_option('AuctionTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
	  $p->add_field('bn', 'SiteMile_SP');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', "Deposit Credits");
	  $p->add_field('custom', $uid.'|'.current_time('timestamp',0));
      $p->add_field('amount', AuctionTheme_formats_special($total,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   case 'success':      // Order was successful...
	case 'ipn':



	if(isset($_POST['custom']))
	{

		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);

		$uid					= $cust[0];
		$datemade				= $cust[1];

		$op = get_option('AuctionTheme_deposit_'.$uid.$datemade);

		//----------------------------------------------------------

		if($op != "1")
		{
			$mc_gross = $_POST['mc_gross'] - $_POST['mc_fee'];

			$cr = auctionTheme_get_credits($uid);
			auctionTheme_update_credits($uid,$mc_gross + $cr);

			update_option('AuctionTheme_deposit_'.$uid.$datemade, "1");
			$reason = __("Deposit through PayPal.","AuctionTheme");
			auctionTheme_add_history_log('1', $reason, $_POST['mc_gross'], $uid);


			$reason = __("PayPal deposit fee.","AuctionTheme");
			auctionTheme_add_history_log('0', $reason, $_POST['mc_fee'], $uid);

		}


	}


	wp_redirect(auctionTheme_get_payments_link());
   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(auctionTheme_my_account_link());

       break;




 }

?>
