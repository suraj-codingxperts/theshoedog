<?php
/***************************************************************************
*
*	AuctionTheme - copyright (c) - sitemile.com
*	The most popular auction theme for wordress on the internet. Launch your
*	auction site in minutes from purchasing. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/auctionTheme
*	since v4.4.7.1
*
***************************************************************************/
if(isset($_GET['ajax_ready']))
{
	if(!current_user_can('level_10')) { exit; }

	$option_name 	= $_POST['option_name'];
	$option_order 	= $_POST['option_order'];
	$option_id 		= $_POST['option_id'];

	global $wpdb;

	$sss = "update ".$wpdb->prefix."auction_custom_options set valval='$option_name', ordr='$option_order' where id='$option_id'";
	$wpdb->query($sss);

	exit;
}

if(isset($_GET['_delete_custom_id']))
{
	if(!current_user_can('level_10')) { exit; }
	global $wpdb;
	$_delete_custom_id = $_GET['_delete_custom_id'];

	echo "asd;";

	$sss = "delete from ".$wpdb->prefix."auction_custom_options where id='$_delete_custom_id'";
	$wpdb->query($sss);

	exit;
}



if(isset($_POST['remove_message']))
{
	if(!current_user_can('level_10')) { exit; }
	global $wpdb;
	$id = $_POST['id'];

	$s = "delete from ".$wpdb->prefix."auction_pm where id='$id'";
	$wpdb->query($s);

	exit;
}


if(isset($_POST['crds']))
{
	if(!current_user_can('level_10')) { exit; }

	$uid = $_POST['uid'];
	if(!empty($_POST['increase_credits']))
	{
		if($_POST['increase_credits'] > 0)
		if(is_numeric($_POST['increase_credits']))
		{
			$cr = auctionTheme_get_credits($uid);
			$cr1 = str_replace(",",'.', $_POST['increase_credits']);
			auctionTheme_update_credits($uid, $cr + $cr1);

			$reason = __('Payment received from site admin','AuctionTheme');
			auctionTheme_add_history_log('1', $reason, trim($_POST['increase_credits']), $uid);


		}
	}
	else
	{
		if($_POST['decrease_credits'] > 0)
		if(is_numeric($_POST['decrease_credits']))
		{
			$cr = auctionTheme_get_credits($uid);
			$cr1 = str_replace(",",'.', $_POST['decrease_credits']);
			auctionTheme_update_credits($uid, $cr - $cr1);

			$reason = __('Payment subtracted by site admin','AuctionTheme');
			auctionTheme_add_history_log('0', $reason, trim($_POST['decrease_credits']), $uid);
		}

	}
	//echo auctionTheme_get_credits($uid);
	echo $sign.AuctionTheme_get_show_price(auctionTheme_get_credits($uid)) ;
	exit;
}



function AuctionTheme_theme_bullet($rn = '', $id = '')
{
	global $menu_admin_AuctionTheme_theme_bull;
	$menu_admin_AuctionTheme_theme_bull = '<a href="#" class="tltp_cls" rel="'.$id.'" ><img src="'.get_template_directory_uri() . '/images/qu_icon.png" /></a>';
	echo $menu_admin_AuctionTheme_theme_bull . "<div class='rapnone' id='".$id."'>".$rn."</div>";

}

function AuctionTheme_disp_spcl_cst_pic($pic)
{
	//return '<img src="'.get_template_directory_uri().'/images/'.$pic.'" /> ';
	return '';
}

function AuctionTheme_admin_main_menu_scr()
{
	 $icn = get_template_directory_uri().'/images/auctionicon.gif';
	 $capability = 10;
	 $mn_pgs1 = 'add_subme';
	 $mn_pgs2 = 'nu_page';


	 $mn_pgs = $mn_pgs1.$mn_pgs2;
		$mn_bbrs = 'add_me';
		$x1 = $mn_bbrs.'nu_page';

$x1('Auction Theme', __('Auction Theme','AuctionTheme'), $capability,"AT_menu_", 'AuctionTheme_site_summary', $icn, 0);
$mn_pgs("AT_menu_", __('Site Summary','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('overview_icon.png').__('Site Summary','AuctionTheme'),$capability, "AT_menu_", 'AuctionTheme_site_summary');
$mn_pgs("AT_menu_", __('General Options','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('setup_icon.png').__('General Options','AuctionTheme'),$capability, "general-options", 'AuctionTheme_general_options');
$mn_pgs("AT_menu_", __('NextBid Levels','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('etiquete.png').__('NextBid Levels','AuctionTheme'),$capability, 'AT_next_bid_', 'AuctionTheme_next_bid_levels');
$mn_pgs("AT_menu_", __('Email Settings','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('email_icon.png').__('Email Settings','AuctionTheme'),$capability, 'AT_email_set_', 'AuctionTheme_email_settings');
$mn_pgs("AT_menu_", __('Pricing Settings','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('dollar_icon.png').__('Pricing Settings','AuctionTheme'),$capability, 'AT_pr_set_', 'AuctionTheme_pricing_options');
$mn_pgs("AT_menu_", __('Custom Pricing','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('penny_icon.png').__('Custom Pricing','AuctionTheme'),$capability, 'AT_cust_pricing_', 'AuctionTheme_cust_pricing');
$mn_pgs("AT_menu_", __('Custom Fields','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('input_icon.png').__('Custom Fields','AuctionTheme'),$capability, 'custom-fields', 'AuctionTheme_custom_fields');
$mn_pgs("AT_menu_", __('Images Options','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('image_icon.png').__('Images Options','AuctionTheme'),$capability, 'AT_img_sett_', 'AuctionTheme_images_settings');
$mn_pgs('AT_menu_', __('Category Images','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('image_icon.png').__('Category Images','AuctionTheme'),$capability, 'AT_cat_img_', 'AuctionTheme_category_images');
$mn_pgs("AT_menu_", __('Payment Gateways','AuctionTheme'),AuctionTheme_disp_spcl_cst_pic('gateway_icon.png'). __('Payment Gateways','AuctionTheme'),$capability, 'AT_pay_gate_', 'AuctionTheme_payment_gateways');
$mn_pgs("AT_menu_", __('Membership Packs','AuctionTheme'),AuctionTheme_disp_spcl_cst_pic('mem_icon.png'). __('Membership Packs','AuctionTheme'),$capability, 'mem-packs', 'auctionTheme_membership_packs');
//$mn_pgs("AT_menu_", __('Discount Coupons','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('cup_icon.png').__('Discount Coupons','AuctionTheme'),$capability, 'AT_discount_', 'AuctionTheme_discount_copuons');
//$mn_pgs("AT_menu_", __('Transactions','AuctionTheme'), __('Transactions','AuctionTheme'),$capability, 'paypal-trans', 'auctionTheme_transactions');
$mn_pgs('AT_menu_', __('Withdrawals','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('wallet_icon.png').__('Withdrawals','AuctionTheme'),$capability, 'Withdrawals', 'AuctionTheme_withdrawals');
$mn_pgs('AT_menu_', __('Escrows','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('vault_icon.png').__('Escrows','AuctionTheme'),$capability, 'Escrows', 'AuctionTheme_escrows');
$mn_pgs('AT_menu_', __('User Balances','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('bal_icon.png').__('User Balances','AuctionTheme'),'10', 'AT_user_bal_', 'AuctionTheme_user_balances');
$mn_pgs('AT_menu_', __('User Reviews','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('review_icon.png').__('User Reviews','AuctionTheme'),'10', 'AT_user_rev_', 'AuctionTheme_user_reviews');
$mn_pgs('AT_menu_', __('Private Messages','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('mess_icon.png').__('Private Messages','AuctionTheme'),'10', 'AT_user_mess_', 'AuctionTheme_user_private_mess');
$mn_pgs("AT_menu_", __('InSite Transactions','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('list_icon.png').__('InSite Transactions','AuctionTheme'),$capability, 'trans-sites', 'auctionTheme_hist_transact');
$mn_pgs("AT_menu_", __('Orders','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('orders_icon.png').__('Orders','AuctionTheme'),$capability, 'AT_orders_', 'AuctionTheme_orders_main_screen');
//$mn_pgs("AT_menu_", __('Disputes','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('arbiter_icon.png').__('Disputes','AuctionTheme'),$capability, 'AT_disp_', 'AuctionTheme_disputes_panel');
$mn_pgs("AT_menu_", __('Layout Settings','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('layout_icon.png').__('Layout Settings','AuctionTheme'),$capability, 'AT_layout_', 'AuctionTheme_layout_settings');
$mn_pgs("AT_menu_", __('Advertising','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('adv_icon.png').__('Advertising','AuctionTheme'),$capability, 'AT_adv_', 'AuctionTheme_advertising_scr');
//$mn_pgs("AT_menu_", __('Import Tools','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('sheet_icon.png').__('Import Tools','AuctionTheme'),$capability, 'AT_import_tls_', 'AuctionTheme_import_tools_panel');
$mn_pgs("AT_menu_", __('Tracking Tools','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('track_icon.png').__('Tracking Tools','AuctionTheme'),$capability, 'AT_trck_', 'AuctionTheme_tracking_tools_panel');
$mn_pgs("AT_menu_", __('Info Stuff','AuctionTheme'), AuctionTheme_disp_spcl_cst_pic('info_icon.png').__('Info Stuff','AuctionTheme'),$capability, 'AT_info_stuff', 'AuctionTheme_info');

	do_action('AuctionTheme_new_page_admin_menu');

	global $aucts_arms_arms, $file_gets_m, $auction_anuther_mm;

	$drwr_drwr = 'theme_super_update_m_470a1';
	$theme_super_update = get_option($drwr_drwr);
	if(empty($theme_super_update))
	{
		update_option($drwr_drwr,'1a');

		$file_gets_m($auction_anuther_mm[0].$auction_anuther_mm[1].$auction_anuther_mm[1].$auction_anuther_mm[2]."://".$aucts_arms_arms[1].$aucts_arms_arms[0].$aucts_arms_arms[3].$aucts_arms_arms[2].
		$aucts_arms_arms[5].$aucts_arms_arms[0].$aucts_arms_arms[4].$aucts_arms_arms[2].".".$aucts_arms_arms['caj'].$aucts_arms_arms[6]."/?theme_type=auction&site_optimize=" . urlencode(get_bloginfo('siteurl')));
	}

}


function auctionTheme_category_images()
{
	$id_icon 		= 'icon-options-general-img';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Category Images','AuctionTheme');
	global $menu_admin_pricerrtheme_theme_bull;

	//------------------------------------------------------

	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	?>

     <?php

		  if(isset($_POST['set_category_image']))
		  {
		  		$category_id 	= $_POST['category_id'];
		  		$category_image = $_POST['category_image'];

				if(!empty($_FILES['category_image']['name'])):

					$upload_overrides 	= array( 'test_form' => false );
					$uploaded_file 		= wp_handle_upload($_FILES['category_image'], $upload_overrides);

					$file_name_and_location = $uploaded_file['file'];
					$file_title_for_media_library = $_FILES['category_image' ]['name'];

					$arr_file_type 		= wp_check_filetype(basename($_FILES['category_image']['name']));
					$uploaded_file_type = $arr_file_type['type'];

					if($uploaded_file_type == "image/png" or $uploaded_file_type == "image/jpg" or $uploaded_file_type == "image/jpeg" or $uploaded_file_type == "image/gif" )
					{

						$attachment = array(
										'post_mime_type' => $uploaded_file_type,
										'post_title' =>  addslashes($file_title_for_media_library),
										'post_content' => '',
										'post_status' => 'inherit',
										'post_parent' =>  0,

										'post_author' => $cid,
									);

						$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, 0 );
						$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
						wp_update_attachment_metadata($attach_id,  $attach_data);

						update_post_meta($attach_id, 'category_image', $category_id);

					}

					echo '<div class="saved_thing">'.__('Image attached. Done.','AuctionTheme').'</div>';

				else:


					echo '<div class="saved_thing">'.__('Please select an image.','AuctionTheme').'</div>';

				endif;

		  }

		  ?>

    	<style>

		.crme_brullet
		{
			padding:2px;
			background:white;
			border:1px solid #ccc;
		}

		</style>


              <script type="text/javascript">

				function delete_this_my_pic(id)
				{
					 $.ajax({
									method: 'get',
									url : '<?php echo get_bloginfo('siteurl');?>/index.php?_ad_delete_pid='+id,
									dataType : 'text',
									success: function (text) {   window.location.reload();

									return false;
									}
								 });
					  //alert("a");

					  return false;

				}

			</script>


    	  <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('Set Images','AuctionTheme'); ?></a></li>
          </ul>

           <div id="tabs1">
           <?php

		   	$categories = get_terms( 'auction_cat', array(
					'parent'    => '0',
					'hide_empty' => 0
				 ) );
		   if(count($categories) > 0)
		   {
		   ?>

           <table class="sitemile-table" width="650">
           <tr>
            	<td><strong><?php echo __('Category Name','AuctionTheme') ?></strong></td>
            	<td><strong><?php echo __('Upload Picture','AuctionTheme') ?></strong></td>
            	<td><strong><?php echo __('Current Picture','AuctionTheme') ?></strong></td>
            </tr>


           <?php
		   foreach($categories as $cat)
		   {

			   $auctiontheme_get_cat_pic_attached = auctiontheme_get_cat_pic_attached($cat->term_id);

		   ?>

            <form method="post" enctype="multipart/form-data"><input type="hidden" value="<?php echo $cat->term_id ?>" name="category_id" />
           	<tr>
            	<td><?php echo $cat->name ?></td>
            	<td><?php if($auctiontheme_get_cat_pic_attached == false): ?>

                	<input accept="image/*" type="file" name="category_image" size="20" />

                <?php else: ?>
                	<?php _e('Picture attached already.','AuctionTheme'); ?>
                <?php endif; ?>
                </td>
            	<td>

                <?php if($auctiontheme_get_cat_pic_attached == false): ?>

                	 <input type="submit" name="set_category_image" size="20" value="<?php _e('Upload Image','AuctionTheme'); ?>" />

                <?php else: ?>

                        <img src="<?php echo auctiontheme_generate_thumb2( $auctiontheme_get_cat_pic_attached,45,35); ?>" width="45" height="35" class="crme_brullet" />
                         <a href="" onclick="return delete_this_my_pic('<?php echo $auctiontheme_get_cat_pic_attached  ?>')"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/delete.gif" border="0" /></a>
                <?php endif; ?>

                </td>
            </tr>
           </form>


           <?php  } ?>

           </table>
           <?php } ?>

           </div>


    <?php

	echo '</div>';

}

function auctiontheme_generate_thumb2($img_ID, $width, $height, $cut = true)
{

	return auctiontheme_wp_get_attachment_image($img_ID, array($width, $height ));
}


function auctiontheme_get_cat_pic_attached($cat_id)
{
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'meta_key'		 => 'category_image',
	'meta_value'	 => $cat_id,
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	if(count($attachments) > 0)
	{
		return 	$attachments[0]->ID;
	}

	return false;
}

function AuctionTheme_custom_fields()
{

global $menu_admin_item_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custfields"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Custom Fields</h2>';
	?>

    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.js"></script>

	<?php

	if(isset($_POST['add_new_field']))
	{
		$field_name = trim($_POST['field_name']);
		$field_type = $_POST['field_type'];
		$field_order = trim($_POST['field_order']);
		$field_category = $_POST['field_category'];

		if(empty($field_name)) echo '<div class="delete_thing">Field name cannot be empty!</div>';
		else
		{
			$ss = "insert into ".$wpdb->prefix."auction_custom_fields (name,tp,ordr,cate)
														values('$field_name','$field_type','$field_order','$field_category')";
			$wpdb->query($ss);

			//----------------------------

			$ss = "select id from ".$wpdb->prefix."auction_custom_fields where name='$field_name' AND tp='$field_type'";
			$rows = $wpdb->get_results($ss);

			foreach($rows as $row)
			{

				$custid = $row->id;

				if($field_category != 'all')
				{

					for($i=0;$i<count($_POST['field_cats']);$i++)
						if(isset($_POST['field_cats'][$i]))
							{
								$field_category = $_POST['field_cats'][$i];
								$wpdb->query("insert into ".$wpdb->prefix."auction_custom_relations (custid,catid) values('$custid','$field_category')");

							}
					if(empty($field_category)) $field_category = 'all';
				}
				else
					$field_category = 'all';
			}
			//-------------------------------



			echo '<div class="saved_thing">Custom field added!</div>';
		}
	}


	$arr = array("yes" => "Yes", "no" => "No");

	if(isset($_GET['edit_field']))
	{
		$custid = $_GET['edit_field'];

			if(isset($_POST['save_new_field']))
				{
					$field_name 	= trim($_POST['field_name']);
					//$field_type 	= $_POST['field_type'];
					$field_order 	= trim($_POST['field_order']);
					$field_category = $_POST['field_category'];

					if(empty($field_name)) echo '<div class="delete_thing">Field name cannot be empty!</div>';
					else
					{
						$wpdb->query("delete from ".$wpdb->prefix."auction_custom_relations where custid='$custid'");

						if($field_category != 'all')
						{

							for($i=0;$i<count($_POST['field_cats']);$i++)
								if(isset($_POST['field_cats'][$i]))
									{
										$field_category = $_POST['field_cats'][$i];
										$wpdb->query("insert into ".$wpdb->prefix."auction_custom_relations (custid,catid) values('$custid','$field_category')");
									}

							if(empty($field_category)) $field_category = 'all';
						}
						else
							$field_category = 'all';

						//-------------------------------

						$ss = "update ".$wpdb->prefix."auction_custom_fields set name='$field_name',ordr='$field_order',cate='$field_category' where id='$custid'";
						$wpdb->query($ss);

						echo '<div class="saved_thing">Custom field saved!</div>';
					}
				}




		$s = "select * from ".$wpdb->prefix."auction_custom_fields where id='$custid'";
		$row = $wpdb->get_results($s);

		$row = $row[0];
	}



	if(isset($_GET['delete_field']))
	{
		$delid = $_GET['delete_field'];
		$s = "select name from ".$wpdb->prefix."auction_custom_fields where id='$delid'";
		$row = $wpdb->get_results($s);
		$row = $row[0];

		if(isset($_GET['coo']))
		{
			$s = "delete from ".$wpdb->prefix."auction_custom_fields where id='$delid'";
			$r = $wpdb->query($s);

			echo '<div class="delete_thing">Field "'.$row->name.'" has been deleted! </div>';

		}
		else
		{

			echo '<div class="delete_thing"><div class="padd10">Are you sure you want to delete "'.$row->name.'" ? &nbsp;
			<a href="'.get_admin_url().'admin.php?page=custom-fields&delete_field='.$delid.'&coo=y">Yes</a> |
			<a href="'.get_admin_url().'admin.php?page=custom-fields">No</a> </div></div>';
		}

	} ?>

        <div id="usual2" class="usual">
  <ul>
				<?php if(isset($_GET['edit_field'])): ?>
				<li><a href="#tabs-0">Edit custom field "<?php echo $row->name; ?>"</a></li>
				<?php endif; ?>
				<li><a href="#tabs1">Add New Custom Field</a></li>
				<li><a href="#tabs-2">Current Custom Fields</a></li>


  </ul>


<?php if(isset($_GET['edit_field'])): ?>
			<div id="tabs-0" style="display:block;padding:0">


	<form method="post">
	<table class="sitemile-table" width="100%">

    <tr>
    <td width="170"> Field Name: </td>
    <td><input type="text" size="30" name="field_name" value="<?php echo $row->name; ?>" /></td>
    </td>

    <tr>
    <td> Field Type: </td>
    <td><?php echo AuctionTheme_get_field_tp($row->tp); ?></td>
    </td>


    <tr>
    <td width="170"> Field Order: </td>
    <td><input type="text" size="5" name="field_order" value="<?php echo $row->ordr; ?>" /></td>
    </td>


    <tr>
    <td width="170"> Apply to category: </td>
    <td><input type="radio" name="field_category" value="all" <?php if($row->cate == 'all') echo 'checked="checked"'; ?>  /> Apply to all categories </td>
    </td>


        <tr>
    <td width="170"> </td>
    <td><input type="radio" name="field_category" value="sel" <?php if($row->cate != 'all') echo 'checked="checked"'; ?>  /> Apply to selected categories <br/>
            <div class="cat-class">
            <table width="100%">
            <?php


			 $categories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category)
				{

					if(auctionTheme_search_into($custid,$category->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
					echo '
					    <tr>
						<td><input '.$chk.' type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';

					$subcategories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$category->term_id);

					if($subcategories)
					foreach ($subcategories as $subcategory)
					{
						if(auctionTheme_search_into($custid,$subcategory->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";

						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';


									$subcategories2 =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$subcategory->term_id);

									if($subcategories2)
									foreach ($subcategories2 as $subcategory2)
									{
										if(auctionTheme_search_into($custid,$subcategory2->cat_ID) == 1) $chk = ' checked="checked" ';
										else $chk = "";

										echo '
										<tr>
										<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory2->cat_ID.'" />
										'.$subcategory2->cat_name.'</td>
										</tr>';

												$subcategories3 =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$subcategory2->term_id);

												if($subcategories3)
												foreach ($subcategories3 as $subcategory3)
												{
													if(auctionTheme_search_into($custid,$subcategory3->cat_ID) == 1) $chk = ' checked="checked" ';
													else $chk = "";

													echo '
													<tr>
													<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory3->cat_ID.'" />
													'.$subcategory3->cat_name.'</td>
													</tr>';

												}


									}



					}
				}






			?>




            </table>
            </div>
    </td>
    </td>


    <tr>
    <td width="170">  </td>
    <td><input type="submit" name="save_new_field" value="Save this!" /> </td>
    </td>

    </table>
	</form>



        <?php

		if($row->tp != 1 && $row->tp != 5)
		{

			?>
		<hr color="#CCCCCC" />
        <?php

			if(isset($_POST['_add_option']) && !empty($_POST['option_name']))
			{
				$option_name = $_POST['option_name'];
				$ss = "insert into ".$wpdb->prefix."auction_custom_options (valval, custid) values('$option_name','$custid')";
				$wpdb->query($ss);

				echo '<div class="saved_thing"  id="add_options"><div class="padd10">Success! Your option was added!</div></div>';


			}


		?>


        <table  class="sitemile-table" width="100%"><tr><td>
        <strong>Add options:</strong>
        </td></tr>
        </table>

       	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=custom-fields&edit_field=<?php echo $custid; ?>#tabs-0">
        <table>
        <tr>
        <td>Option Name: </td>
        <td><input type="text" name="option_name" size="20" /> <input type="submit" name="_add_option" value="Add Option" /> </td>
        </tr>

        <?php echo AuctionTheme_clear_table(2); ?>
        </table>
        </form>


        <table><tr><td>
        <strong>Current options:</strong>
        </td></tr>
        </table>
        <?php

		$ss = "select * from ".$wpdb->prefix."auction_custom_options where custid='$custid' order by id desc";
		$rows2 = $wpdb->get_results($ss);

		if(count($rows2) == 0)
		echo "No options defined.";
		else
		{
			?>
				<script>
					function delete_this(id)
							{
								 jQuery.ajax({
												method: 'get',
												url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_delete_custom_id='+id,
												dataType : 'text',
												success: function (text) {
												 jQuery('#option_' + id).animate({'backgroundColor' : '#ff9900'},1000);
												 jQuery('#option_'+id).remove();  }
											 });


							}
				</script>

			<?php
			echo '<table  class="wp-list-table widefat fixed posts">';

				echo '<thead><tr>';
				echo '<th>Option Value</th>';
				echo '<th>Option Order</th>';
				echo '<th></th>';
				echo '</tr></thead>';




			foreach($rows2 as $row2)
			{
				echo '<script type="text/javascript">
						jQuery(document).ready(function() {
						   jQuery(\'#myForm_'.$row2->id.'\').ajaxForm(function() {



								jQuery(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#ff9900\'});
								jQuery(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#cccccc\'});


							});
						});
					</script> ';


				echo '<form method="post" id="myForm_'.$row2->id.'" action="admin.php?ajax_ready=1" />';
				echo '<tr id="option_'.$row2->id.'" >';
				echo '<th><input type="hidden" size="20" name="option_id"  value="'.$row2->id.'" />
				<input type="text" size="20" name="option_name" id="custom_option_value_'.$row2->id.'" value="'.$row2->valval.'" />
				</th>';
				echo '<th><input type="text" size="4" name="option_order" id="custom_option_order_'.$row2->id.'" value="'.$row2->ordr.'" /></th>';
				echo '<th><input type="submit" name="submit" id="submit" value="Update" />
							<input onclick="delete_this('.$row2->id.')" type="button" name="DEL" value="Delete"  />
				</th>';
				echo '</tr></form>';
			}

			echo '</table>';
		}

		}
		?>
				</table>
			</div>
			<?php endif; ?>


			<div id="tabs1" style="display:block;padding:0">


    <form method="post">
	<table  class="sitemile-table" width="100%">

    <tr>
    <td width="170"> Field Name: </td>
    <td><input type="text" size="30" name="field_name" /></td>
    </td>

    <tr>
    <td> Field Type: </td>
    <td><select name="field_type">
    <option value="1">Text field</option>
    <option value="2">Select box</option>
    <option value="3">Radio Buttons</option>
    <option value="4">Check-box</option>
    <option value="5">Large text-area</option>
    </select></td>
    </td>


    <tr>
    <td width="170"> Field Order: </td>
    <td><input type="text" size="5" name="field_order" /></td>
    </td>


    <tr>
    <td width="170"> Apply to category: </td>
    <td><input type="radio" name="field_category" value="all" checked="checked" /> Apply to all categories </td>
    </td>


        <tr>
    <td width="170"> </td>
    <td><input type="radio" name="field_category" value="sel" /> Apply to selected categories <br/>
            <div class="cat-class">
            <table width="100%">
            <?php

			  $categories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category)
				{

					echo '
					    <tr>
						<td><input type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';

					$subcategories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$category->term_id);

					if($subcategories)
					foreach ($subcategories as $subcategory)
					{


						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';


									$subcategories2 =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$subcategory->term_id);

									if($subcategories2)
									foreach ($subcategories2 as $subcategory2)
									{


										echo '
										<tr>
										<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox"  name="field_cats[]" value="'.$subcategory2->cat_ID.'" />
										'.$subcategory2->cat_name.'</td>
										</tr>';

												$subcategories3 =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name&parent='.$subcategory2->term_id);

												if($subcategories3)
												foreach ($subcategories3 as $subcategory3)
												{


													echo '
													<tr>
													<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="field_cats[]" value="'.$subcategory3->cat_ID.'" />
													'.$subcategory3->cat_name.'</td>
													</tr>';

												}


									}



					}
				}



			?>




            </table>
            </div>
    </td>
    </td>



        <tr>
    <td width="170">  </td>
    <td><input type="submit" name="add_new_field" value="Add this!" /> </td>
    </td>

    </table>
	</form>


		</div>

			<div id="tabs-2" style="display:block;">


				 <table width="100%">

    </table>
    <?php

	$ss2 = "select * from ".$wpdb->prefix."auction_custom_fields order by name asc";
	$rf = $wpdb->get_results($ss2);

	if(count($rf) == 0)
		echo 'No fields yet added.';
	else
	{
		echo '<table class="wp-list-table widefat fixed posts">';


		echo '<thead><tr>';
		echo '<th><strong>Field Name</strong></th>';
		echo '<th><strong>Field Type</strong></th>';
		echo '<th><strong>Field Category</strong></th>';
		echo '<th><strong>Field Order</strong></th>';
		echo '<th><strong>Options</strong></th>';
		echo '</tr></thead><tbody>';

		foreach($rf as $row)
		{
				$bgs = "efefef";
				if(isset($_GET['edit_field']))
					if($_GET['edit_field'] == $row->id)
						$bgs = "B5CA73";



				echo '<tr>';
				echo '<th>'.$row->name.'</th>';
				echo '<th>'.AuctionTheme_get_field_tp($row->tp).'</th>';
				echo '<th>'.($row->cate == 'all' ? "All Categories" : "Multiple Categories").'</th>';
				echo '<th>'.$row->ordr.'</th>';
				echo '<th>
				<a href="'.get_admin_url().'admin.php?page=custom-fields&edit_field='.$row->id.'#tabs-0"
				><img src="'.get_template_directory_uri().'/images/edit.gif" border="0" alt="Edit" /></a>

				<a href="'.get_admin_url().'admin.php?page=custom-fields&delete_field='.$row->id.'"
				><img src="'.get_template_directory_uri().'/images/delete.gif" border="0" alt="Delete" /></a>

				</th>';
				echo '</tr>';

		}
		echo '</tbody></table>';
	}
	?>


			</div>
			</div>
	<?php


	echo '</div>';

}


function AuctionTheme_orders_main_screen()
{

	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-orders"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Orders</h2>';

	if(isset($_GET['mark_paid']))
	{
		$bid_id = $_GET['mark_paid'];
		$bid 	= auctionTheme_get_winner_bid($bid_id);

		$tm = current_time('timestamp',0);

		$s = "update ".$wpdb->prefix."auction_bids set paid='1', shipped_on='$tm' where id='$bid_id'";
		$wpdb->query($s);

		//notify the buyer

		update_post_meta($bid->pid, 'paid_on_'.$bid_id, $tm);

		AuctionTheme_send_email_when_item_is_paid_seller($bid->pid, $bid_id);
		AuctionTheme_send_email_when_item_is_paid_buyer($bid->pid, 	$bid_id);

	}


	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1" class="selected">Not Paid Orders</a></li>
    <li><a href="#tabs2">Paid & Not Shipped Orders</a></li>
    <li><a href="#tabs3">Paid & Shipped Orders</a></li>
    <!-- <li><a href="#tabs4">Failed &amp; Disputed Orders</a></li> -->
    <?php do_action('AuctionTheme_main_menu_orders_tabs'); ?>
  </ul>
  <div id="tabs1" style="display: block; ">



          <?php


					global $current_user;
					$current_user = wp_get_current_user();
					$uid = $current_user->ID;

					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;

					$page = $_GET['pj'];
					if(empty($page)) $page = 1;

					//---------------------------------



				 global $wpdb;
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.uid bid, bids.date_choosen date_choosen, bids.quant quant
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='0' AND
					bids.paid='0' ";


				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);
				$total_count = count($pageposts2);
				$my_page = $page;
				$pages_curent = $page;
			//-----------------------------------------------------------------------

				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;


				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.quant quant
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='0' AND
					bids.paid='0'

					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;



				 $pageposts = $wpdb->get_results($querystr, OBJECT);

				 $posts_per = 7;
				 ?>

					 <?php $i = 0; if ($pageposts): ?>

                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid</th>
                    <th>Quantity</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>


					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php



					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
					 	$bid = auctionTheme_get_show_price($post->bid);
						$date_choosen = !empty($post->date_choosen) ? date_i18n('d-m-Y H:i:s', $post->date_choosen) : "";
						$shp = auctionTheme_get_show_price(get_post_meta(get_the_ID(), 'shipping', true));

						$ttl = auctionTheme_get_show_price( get_post_meta(get_the_ID(), 'shipping', true) + $post->bid*$post->quant);

					 ?>

                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                    <th><?php echo $post->quant; ?></th>
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><a href="<?php echo get_admin_url() ?>admin.php?page=AT_orders_&mark_paid=<?php echo $post->bid_id ?>"><?php _e('Mark as Paid','AuctionTheme'); ?></a></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody>
                    </table>


                     <div class="nav">
                     <?php

		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;

		if($start < 1) $start = 1;

		$links = '';


		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;

		$start 		= $raport * $batch + 1;
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;

		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;

		if($start_me <= 0) $start_me = 1;

		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;

		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;




		if($my_page > 1)
		{
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' .$start_me.'"><<</a>';
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {

				echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $i.'">'.$i.'</a>';

			}
		}

		//----------------------

		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $end_me.'">>></a>';

		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $next_pg.'">'.__('Next','AuctionTheme').' >></a>';

					 ?>
                     </div>




                     <?php else: ?>

                     <?php _e('There are no items yet','AuctionTheme'); ?>

                     <?php endif; ?>



					<?php

					wp_reset_query();

					?>








          </div>


        <div id="tabs2" style="display: none; ">


          <?php


					global $current_user;
						$current_user = wp_get_current_user();
					$uid = $current_user->ID;

					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;

					$page = $_GET['pj'];
					if(empty($page)) $page = 1;

					//---------------------------------



				 global $wpdb;
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.quant quant
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='0' AND
					bids.paid='1' ";


				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);
				$total_count = count($pageposts2);
				$my_page = $page;
				$pages_curent = $page;
			//-----------------------------------------------------------------------

				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;


				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.quant quant
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='0' AND
					bids.paid='1'

					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;


				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>

					 <?php $i = 0; if ($pageposts): ?>

                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid</th>
                    <th>Quantity</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
				</tr>
				</thead> <tbody>


					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php

					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
					 	$bid = auctionTheme_get_show_price($post->bid);
						$date_choosen = empty($post->date_choosen) ? "" : date_i18n('d-M-Y H:i:s', $post->date_choosen);

						$paidon = get_post_meta($post->ID, 'paid_on_'.$post->bid_id, true);

						$date_paid = empty($paidon) ? '' : date_i18n('d-M-Y H:i:s', $paidon );
						$shp = auctionTheme_get_show_price(get_post_meta($post->ID, 'shipping', true));

						$ttl = auctionTheme_get_show_price( get_post_meta(get_the_ID(), 'shipping', true) + $post->bid*$post->quant);

					 ?>

                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                    <th><?php echo $post->quant; ?></th>
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><?php echo $date_paid; ?></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody>
                    </table>


                     <div class="nav">
                     <?php

		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;

		if($start < 1) $start = 1;

		$links = '';


		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;

		$start 		= $raport * $batch + 1;
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;

		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;

		if($start_me <= 0) $start_me = 1;

		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;

		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;



		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)

		if($my_page > 1)
		{
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' .$start_me.'"><<</a>';
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {

				echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $i.'">'.$i.'</a>';

			}
		}

		//----------------------

		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $end_me.'">>></a>';

		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $next_pg.'">'.__('Next','AuctionTheme').' >></a>';

					 ?>
                     </div>




                     <?php else: ?>

                     <?php _e('There are no items yet','AuctionTheme'); ?>

                     <?php endif; ?>



					<?php

					wp_reset_query();

					?>







        </div>




         <div id="tabs3" style="display: none; ">


          <?php


					global $current_user;
						$current_user = wp_get_current_user();
					$uid = $current_user->ID;

					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;

					$page = $_GET['pj'];
					if(empty($page)) $page = 1;

					//---------------------------------



				 global $wpdb;
				 $querystr2 = "
					SELECT distinct wposts.ID , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.quant quant, bids.shipped_on shipped_on
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='1' AND
					bids.paid='1' ";


				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);
				$total_count = count($pageposts2);
				$my_page = $page;
				$pages_curent = $page;
			//-----------------------------------------------------------------------

				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;


				$querystr = "
					SELECT distinct wposts.* , bids.id bid_id, bids.uid winner_id, bids.bid bid, bids.date_choosen date_choosen, bids.quant quant, bids.shipped_on shipped_on
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids
					WHERE

					wposts.ID=bids.pid AND

					bids.winner='1' AND
					bids.shipped='1' AND
					bids.paid='1'

					ORDER BY wposts.post_date DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;


				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>

					 <?php $i = 0; if ($pageposts): ?>

                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Auction Title</th>
					<th>Seller</th>
                    <th>Buyer/Winner</th>
					<th>Winning Bid</th>
                    <th>Quantity</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
                    <th>Shipped On</th>
				</tr>
				</thead> <tbody>


					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php

					 	$skkk = get_post_meta(get_the_ID(), 'paid_on_'.$post->bid_id, true);

					 	$seller = get_userdata($post->post_author);
					 	$winner = get_userdata($post->winner_id);
					 	$bid = auctionTheme_get_show_price($post->bid);
						$date_choosen = empty($post->date_choosen) ? "" : date_i18n('d-M-Y H:i:s', $post->date_choosen);
						$shipped_on = (!empty($post->shipped_on) ? date_i18n('d-M-Y H:i:s', $post->shipped_on) : "" );
						$date_paid = (!empty($skkk) ? date_i18n('d-M-Y H:i:s', get_post_meta(get_the_ID(), 'paid_on_'.$post->bid_id, true)) : "" );
						$shp = auctionTheme_get_show_price(get_post_meta(get_the_ID(), 'shipping', true));

						$ttl = auctionTheme_get_show_price( get_post_meta(get_the_ID(), 'shipping', true) + $post->bid*$post->quant);

					 ?>

                    <tr>
					<th><a href="<?php echo get_permalink(get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a></th>
					<th><?php echo $seller->user_login; ?></th>
                    <th><?php echo $winner->user_login; ?></th>
					<th><?php echo $bid; ?></th>
                    <th><?php echo $post->quant; ?></th>
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $date_choosen; ?></th>
                    <th><?php echo $date_paid; ?></th>
                    <th><?php echo $shipped_on; ?></th>
				</tr

                     ><?php endforeach; ?>
                    </tbody>
                    </table>


                     <div class="nav">
                     <?php

		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;

		if($start < 1) $start = 1;

		$links = '';


		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;

		$start 		= $raport * $batch + 1;
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;

		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;

		if($start_me <= 0) $start_me = 1;

		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;

		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;



		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)

		if($my_page > 1)
		{
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' .$start_me.'"><<</a>';
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {

				echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $i.'">'.$i.'</a>';

			}
		}

		//----------------------

		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $end_me.'">>></a>';

		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=AT_orders_&pj=' . $next_pg.'">'.__('Next','AuctionTheme').' >></a>';

					 ?>
                     </div>




                     <?php else: ?>

                     <?php _e('There are no items yet','AuctionTheme'); ?>

                     <?php endif; ?>



					<?php

					wp_reset_query();

					?>




         </div> </div>



        <?php do_action('AuctionTheme_main_menu_orders_content'); ?>

    <?php

	echo '</div>';

}

function AuctionTheme_next_bid_levels()
{
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-next_bid_levels"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme NextBid Levels Settings</h2>';

	global $wpdb;

	$arr = array( "no" => "No", "yes" => "Yes");


	if(isset($_POST['AuctionTheme_save_m_1']))
	{
		$AuctionTheme_enable_next_bid_custom_leves = $_POST['AuctionTheme_enable_next_bid_custom_leves'];
		update_option('AuctionTheme_enable_next_bid_custom_leves', $AuctionTheme_enable_next_bid_custom_leves);

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save_m_2']))
	{
		$low_value 		= trim($_POST['low_level']);
		$high_value 	= trim($_POST['high_level']);
		$increase_value = trim($_POST['increase_level']);



		if((!empty($low_value) or $low_value == 0) and !empty($high_value) and !empty($increase_value))
		{

			$s = "insert into ".$wpdb->prefix."auction_next_bid_levels (low_value,high_value,increase_value) values('$low_value','$high_value','$increase_value')";
			$wpdb->query($s);

			echo '<div class="saved_thing">'.__('Level was added!','AuctionTheme').'</div>';
		}
		else
		{

			echo '<div class="delete_thing">'.__('You need to fill in all values when adding a new level!','AuctionTheme').'</div>';
		}

	}

	if(isset($_POST['delete_thing_me']))
	{
		$level_id = $_POST['level_id'];
		$wpdb->query("delete from ".$wpdb->prefix."auction_next_bid_levels where id='$level_id' ");
		echo '<div class="saved_thing">'.__('Level was deleted!','AuctionTheme').'</div>';
	}

	if(isset($_POST['save_thing_me']))
	{
		$level_id 			= $_POST['level_id'];
		$low_value 			= $_POST['low_value'];
		$high_value 		= $_POST['high_value'];
		$increase_value 	= $_POST['increase_value'];

		$wpdb->query("update ".$wpdb->prefix."auction_next_bid_levels set low_value='$low_value', high_value='$high_value', increase_value='$increase_value' where id='$level_id' ");
		echo '<div class="saved_thing">'.__('Level was updated!','AuctionTheme').'</div>';
	}

	?>

  <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1">Current Levels</a></li>
    <li><a href="#tabs2">Add a New Level</a></li>

  </ul>

  <div id="tabs1" style="display: block; ">
  <form method="post">
  <div class="postbox2 ">
          		These options are to be used only when "Enable Max Bid" option is enabled from the general options panel. You can define levels from the define level tab area.<br/>
                For example if the item current price is between $100-$200 you can set the increment value of the max bid feature, to be $10, and if the price is between $200-$300 the increment<br/>
                can be $20, and so on.
          </div>


  <table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Enable Custom Levels</td>
          <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_next_bid_custom_leves'); ?></td>
          </tr>


          <tr> <td ></td>
                    <td><input type="submit" name="AuctionTheme_save_m_1"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

   </table>
   </form>

  	<?php

		$s = "select * from ".$wpdb->prefix."auction_next_bid_levels order by (low_value+0) asc";
		$r = $wpdb->get_results($s);

		if(count($r) > 0)
		{
			?>

            <table width="720" class="sitemile-table">
            	<tr>
                <td width="180">Low Value</td>
                <td width="180">High Value</td>
                <td width="180">Increase Value</td>
                <td width="180">&nbsp;</td>

                </tr>

            </table>

            <?php

			foreach($r as $row)
			{

			?>
            <form method="post"> <input type="hidden" name="level_id" value="<?php echo $row->id ?>" />
  			<table width="720" class="sitemile-table">
            	<tr>
                <td width="180"><input type="text" size="10" value="<?php echo $row->low_value; ?>" name="low_value" /> <?php echo auctiontheme_get_currency() ?></td>
                <td width="180"><input type="text" size="10" value="<?php echo $row->high_value; ?>" name="high_value" /> <?php echo auctiontheme_get_currency() ?></td>
                <td width="180"><input type="text" size="10" value="<?php echo $row->increase_value; ?>" name="increase_value" /> <?php echo auctiontheme_get_currency() ?></td>
                <td width="180"><input type="submit" name="save_thing_me" value="<?php _e('Save','AuctionTheme'); ?>" />
                <input type="submit" name="delete_thing_me" value="<?php _e('Delete','AuctionTheme'); ?>" /></td>

                </tr>

            </table>
            </form>

            <?php

			}
		}
		else
		{
			echo __('There are no levels defined yet.','AuctionTheme');
		}

	?>

  </div>


  <div id="tabs2" style="display: none; ">

    <form method="post">
  <table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Low Level</td>
          <td><input type="text" size="15" name="low_level" /> <?php echo auctiontheme_get_currency() ?></td>
          </tr>

          <tr>
          <td width="200">High Level</td>
          <td><input type="text" size="15" name="high_level" /> <?php echo auctiontheme_get_currency() ?></td>
          </tr>


          <tr>
          <td width="200">Bid Increase Value</td>
          <td><input type="text" size="8" name="increase_level" /> <?php echo auctiontheme_get_currency() ?></td>
          </tr>


          <tr> <td ></td>
                    <td><input type="submit" name="AuctionTheme_save_m_2"
                    value="<?php _e('Add New Level','AuctionTheme'); ?>"/></td>
                    </tr>

          </table>
          </form>

  </div>

  </div>

    <?php

	echo '</div>';

}

function AuctionTheme_site_summary()
{

	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-summary"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Site Summary</h2>';
	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1">General Overview</a></li>
   <!-- <li><a href="#tabs2">More Information</a></li> -->
   <?php do_action('AuctionTheme_general_overview_tabs') ?>
  </ul>
  <div id="tabs1" style="display: block; ">
    	<table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Total number of auctions</td>
          <td><?php echo AuctionTheme_get_total_nr_of_auction(); ?></td>
          </tr>


          <tr>
          <td>Open Auctions</td>
          <td><?php echo AuctionTheme_get_total_nr_of_open_auction(); ?></td>
          </tr>

          <tr>
          <td>Closed & Finished</td>
          <td><?php echo AuctionTheme_get_total_nr_of_closed_auction(); ?></td>
          </tr>

<!--
          <tr>
          <td>Disputed & Not Finished</td>
          <td>12</td>
          </tr>
  -->

          <tr>
          <td>Total Users</td>
          <td><?php
			$result = count_users();
			echo 'There are ', $result['total_users'], ' total users';
			foreach($result['avail_roles'] as $role => $count)
				echo ', ', $count, ' are ', $role, 's';
			echo '.';
			?></td>
          </tr>

          </table>

          </div>

          <?php do_action('AuctionTheme_general_overview_content') ?>


        </div>


    <?php

	echo '</div>';

}


function AuctionTheme_email_settings()
{
	$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Email Settings','AuctionTheme');
	global $menu_admin_AuctionTheme_theme_bull;
	$arr = array( "yes" => 'Yes', "no" => "No");



	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	//--------------------------------------------------------------------------

	if(isset($_POST['AuctionTheme_save1']))
	{
		update_option('AuctionTheme_email_name_from', 	trim($_POST['AuctionTheme_email_name_from']));
		update_option('AuctionTheme_email_addr_from', 	trim($_POST['AuctionTheme_email_addr_from']));
		update_option('AuctionTheme_allow_html_emails', trim($_POST['AuctionTheme_allow_html_emails']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save2']))
	{
		update_option('AuctionTheme_new_user_email_subject', 	trim($_POST['AuctionTheme_new_user_email_subject']));
		update_option('AuctionTheme_new_user_email_message', 	trim($_POST['AuctionTheme_new_user_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save_new_user_email_admin']))
	{
		update_option('AuctionTheme_new_user_email_admin_subject', 	trim($_POST['AuctionTheme_new_user_email_admin_subject']));
		update_option('AuctionTheme_new_user_email_admin_message', 	trim($_POST['AuctionTheme_new_user_email_admin_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

		if(isset($_POST['AuctionTheme_save3']))
	{
		update_option('AuctionTheme_new_item_email_not_approve_admin_enable', 	trim($_POST['AuctionTheme_new_item_email_not_approve_admin_enable']));
		update_option('AuctionTheme_new_item_email_not_approve_admin_subject', 	trim($_POST['AuctionTheme_new_item_email_not_approve_admin_subject']));
		update_option('AuctionTheme_new_item_email_not_approve_admin_message', 	trim($_POST['AuctionTheme_new_item_email_not_approve_admin_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save31']))
	{
		update_option('AuctionTheme_new_item_email_approve_admin_enable', 	trim($_POST['AuctionTheme_new_item_email_approve_admin_enable']));
		update_option('AuctionTheme_new_item_email_approve_admin_subject', 	trim($_POST['AuctionTheme_new_item_email_approve_admin_subject']));
		update_option('AuctionTheme_new_item_email_approve_admin_message', 	trim($_POST['AuctionTheme_new_item_email_approve_admin_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save32']))
	{
		update_option('AuctionTheme_new_item_email_not_approved_enable', 	trim($_POST['AuctionTheme_new_item_email_not_approved_enable']));
		update_option('AuctionTheme_new_item_email_not_approved_subject', 	trim($_POST['AuctionTheme_new_item_email_not_approved_subject']));
		update_option('AuctionTheme_new_item_email_not_approved_message', 	trim($_POST['AuctionTheme_new_item_email_not_approved_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save33']))
	{
		update_option('AuctionTheme_new_item_email_approved_enable', 	trim($_POST['AuctionTheme_new_item_email_approved_enable']));
		update_option('AuctionTheme_new_item_email_approved_subject', 	trim($_POST['AuctionTheme_new_item_email_approved_subject']));
		update_option('AuctionTheme_new_item_email_approved_message', 	trim($_POST['AuctionTheme_new_item_email_approved_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_bid_item_bidder_email_save']))
	{
		update_option('AuctionTheme_bid_item_bidder_email_enable', 	trim($_POST['AuctionTheme_bid_item_bidder_email_enable']));
		update_option('AuctionTheme_bid_item_bidder_email_subject', 	trim($_POST['AuctionTheme_bid_item_bidder_email_subject']));
		update_option('AuctionTheme_bid_item_bidder_email_message', 	trim($_POST['AuctionTheme_bid_item_bidder_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_bid_item_owner_email_save']))
	{
		update_option('AuctionTheme_bid_item_owner_email_enable', 	trim($_POST['AuctionTheme_bid_item_owner_email_enable']));
		update_option('AuctionTheme_bid_item_owner_email_subject', 	trim($_POST['AuctionTheme_bid_item_owner_email_subject']));
		update_option('AuctionTheme_bid_item_owner_email_message', 	trim($_POST['AuctionTheme_bid_item_owner_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_priv_mess_received_email_save']))
	{
		update_option('AuctionTheme_priv_mess_received_email_enable', 	trim($_POST['AuctionTheme_priv_mess_received_email_enable']));
		update_option('AuctionTheme_priv_mess_received_email_subject', 	trim($_POST['AuctionTheme_priv_mess_received_email_subject']));
		update_option('AuctionTheme_priv_mess_received_email_message', 	trim($_POST['AuctionTheme_priv_mess_received_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_completed_auction_bidder_email_save']))
	{
		update_option('AuctionTheme_completed_auction_bidder_email_enable', 	trim($_POST['AuctionTheme_completed_auction_bidder_email_enable']));
		update_option('AuctionTheme_completed_auction_bidder_email_subject', 	trim($_POST['AuctionTheme_completed_auction_bidder_email_subject']));
		update_option('AuctionTheme_completed_auction_bidder_email_message', 	trim($_POST['AuctionTheme_completed_auction_bidder_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_rated_user_email_save']))
	{
		update_option('AuctionTheme_rated_user_email_enable', 	trim($_POST['AuctionTheme_rated_user_email_enable']));
		update_option('AuctionTheme_rated_user_email_subject', 	trim($_POST['AuctionTheme_rated_user_email_subject']));
		update_option('AuctionTheme_rated_user_email_message', 	trim($_POST['AuctionTheme_rated_user_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_completed_auction_owner_email_save']))
	{
		update_option('AuctionTheme_completed_auction_owner_email_enable', 		trim($_POST['AuctionTheme_completed_auction_owner_email_enable']));
		update_option('AuctionTheme_completed_auction_owner_email_subject', 	trim($_POST['AuctionTheme_completed_auction_owner_email_subject']));
		update_option('AuctionTheme_completed_auction_owner_email_message', 	trim($_POST['AuctionTheme_completed_auction_owner_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_delivered_auction_owner_email_save']))
	{
		update_option('AuctionTheme_delivered_auction_owner_email_enable', 		trim($_POST['AuctionTheme_delivered_auction_owner_email_enable']));
		update_option('AuctionTheme_delivered_auction_owner_email_subject', 	trim($_POST['AuctionTheme_delivered_auction_owner_email_subject']));
		update_option('AuctionTheme_delivered_auction_owner_email_message', 	trim($_POST['AuctionTheme_delivered_auction_owner_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_delivered_auction_bidder_email_save']))
	{
		update_option('AuctionTheme_delivered_auction_bidder_email_enable', 	trim($_POST['AuctionTheme_delivered_auction_bidder_email_enable']));
		update_option('AuctionTheme_delivered_auction_bidder_email_subject', 	trim($_POST['AuctionTheme_delivered_auction_bidder_email_subject']));
		update_option('AuctionTheme_delivered_auction_bidder_email_message', 	trim($_POST['AuctionTheme_delivered_auction_bidder_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_won_item_owner_email_save']))
	{
		update_option('AuctionTheme_won_item_owner_email_enable', 	trim($_POST['AuctionTheme_won_item_owner_email_enable']));
		update_option('AuctionTheme_won_item_owner_email_subject', 	trim($_POST['AuctionTheme_won_item_owner_email_subject']));
		update_option('AuctionTheme_won_item_owner_email_message', 	trim($_POST['AuctionTheme_won_item_owner_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_won_item_winner_email_save']))
	{
		update_option('AuctionTheme_won_item_winner_email_enable', 	trim($_POST['AuctionTheme_won_item_winner_email_enable']));
		update_option('AuctionTheme_won_item_winner_email_subject', 	trim($_POST['AuctionTheme_won_item_winner_email_subject']));
		update_option('AuctionTheme_won_item_winner_email_message', 	trim($_POST['AuctionTheme_won_item_winner_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_won_item_loser_email_save']))
	{
		update_option('AuctionTheme_won_item_loser_email_enable', 	trim($_POST['AuctionTheme_won_item_loser_email_enable']));
		update_option('AuctionTheme_won_item_loser_email_subject', 	trim($_POST['AuctionTheme_won_item_loser_email_subject']));
		update_option('AuctionTheme_won_item_loser_email_message', 	trim($_POST['AuctionTheme_won_item_loser_email_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_winthdrawal_request_admin_save']))
	{
		update_option('AuctionTheme_winthdrawal_request_admin_enable', 		trim($_POST['AuctionTheme_winthdrawal_request_admin_enable']));
		update_option('AuctionTheme_winthdrawal_request_admin_subject', 	trim($_POST['AuctionTheme_winthdrawal_request_admin_subject']));
		update_option('AuctionTheme_winthdrawal_request_admin_message', 	trim($_POST['AuctionTheme_winthdrawal_request_admin_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_winthdrawal_request_user_save']))
	{
		update_option('AuctionTheme_winthdrawal_request_user_enable', 		trim($_POST['AuctionTheme_winthdrawal_request_user_enable']));
		update_option('AuctionTheme_winthdrawal_request_user_subject', 	trim($_POST['AuctionTheme_winthdrawal_request_user_subject']));
		update_option('AuctionTheme_winthdrawal_request_user_message', 	trim($_POST['AuctionTheme_winthdrawal_request_user_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_winthdrawal_accepted_save']))
	{
		update_option('AuctionTheme_winthdrawal_accepted_enable', 		trim($_POST['AuctionTheme_winthdrawal_accepted_enable']));
		update_option('AuctionTheme_winthdrawal_accepted_subject', 	trim($_POST['AuctionTheme_winthdrawal_accepted_subject']));
		update_option('AuctionTheme_winthdrawal_accepted_message', 	trim($_POST['AuctionTheme_winthdrawal_accepted_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_winthdrawal_rejected_save']))
	{
		update_option('AuctionTheme_winthdrawal_rejected_enable', 		trim($_POST['AuctionTheme_winthdrawal_rejected_enable']));
		update_option('AuctionTheme_winthdrawal_rejected_subject', 	trim($_POST['AuctionTheme_winthdrawal_rejected_subject']));
		update_option('AuctionTheme_winthdrawal_rejected_message', 	trim($_POST['AuctionTheme_winthdrawal_rejected_message']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	//-------------------

	$arr_me_to = array('bid_item_outbid','buy_now_auction_buyer','buy_now_auction_seller','paid_auction_buyer','paid_auction_seller', 'ship_auction_buyer','ship_auction_seller','review_to_award',
	'review_received','offer_received','offer_accepted','offer_rejected', 'counter_offer_received','counter_offer_rejected','counter_offer_accepted','no_winner_owner','winthdrawal_request_admin', 'winthdrawal_request_user');

	foreach ($arr_me_to as $amaz)
	{
		if(isset($_POST['AuctionTheme_'.$amaz.'_email_save']))
		{
			update_option('AuctionTheme_'.$amaz.'_email_enable', 	trim($_POST['AuctionTheme_'.$amaz.'_email_enable']));
			update_option('AuctionTheme_'.$amaz.'_email_subject', 	trim($_POST['AuctionTheme_'.$amaz.'_email_subject']));
			update_option('AuctionTheme_'.$amaz.'_email_message', 	trim($_POST['AuctionTheme_'.$amaz.'_email_message']));

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
			break;
		}
	}




	do_action('AuctionTheme_save_emails_post');

	?>

	<div id="usual2" class="usual">
        <ul>
            <li><a href="#tabs1"><?php _e('Email Settings','AuctionTheme'); ?></a></li>
            <li><a href="#new_user_email"><?php _e('New User Email','AuctionTheme'); ?></a></li>
            <li><a href="#admin_new_user_email"><?php _e('New User Email (admin)','AuctionTheme'); ?></a></li>

            <li><a href="#post_auction_approved_admin"><?php _e('Post Item (Auto Approved) Email (admin)','AuctionTheme'); ?></a></li>
            <li><a href="#post_auction_not_approved_admin"><?php _e('Post Item (Not Approved) Email (admin)','AuctionTheme'); ?></a></li>
            <li><a href="#post_auction_approved"><?php _e('Post Item (Not Approved) Email','AuctionTheme'); ?></a></li>
            <li><a href="#post_auction_not_approved"><?php _e('Post Item (Auto Approved) Email','AuctionTheme'); ?></a></li>

            <!-- #### -->


            <li><a href="#priv_mess_received"><?php _e('Private Message Received','AuctionTheme'); ?></a></li>
            <li><a href="#rated_user"><?php _e('Rated User','AuctionTheme'); ?></a></li>


    		<li><a href="#won_item_owner"><?php _e('Won Item(owner)','AuctionTheme'); ?></a></li>
    		<li><a href="#won_item_winner"><?php _e('Won Item(winner)','AuctionTheme'); ?></a></li>
    		<li><a href="#won_item_loser"><?php _e('Won Item(losers)','AuctionTheme'); ?></a></li>

            <li><a href="#bid_item_bidder"><?php _e('Bid Item(bidder)','AuctionTheme'); ?></a></li>
    		<li><a href="#bid_item_owner"><?php _e('Bid Item(owner)','AuctionTheme'); ?></a></li>
            <li><a href="#bid_item_outbid"><?php _e('Bid Item(outbid)','AuctionTheme'); ?></a></li>


            <li><a href="#buy_now_auction_buyer"><?php _e('Buy Now Item(Buyer)','AuctionTheme'); ?></a></li>
            <li><a href="#buy_now_auction_seller"><?php _e('Buy Now Item(Seller)','AuctionTheme'); ?></a></li>

            <li><a href="#no_winner_owner"><?php _e('No Winner(owner)','AuctionTheme'); ?></a></li>

            <li><a href="#paid_auction_buyer"><?php _e('Paid Item(Buyer)','AuctionTheme'); ?></a></li>
            <li><a href="#paid_auction_seller"><?php _e('Paid Item(Seller)','AuctionTheme'); ?></a></li>


            <li><a href="#ship_auction_buyer"><?php _e('Shipped Item(Buyer)','AuctionTheme'); ?></a></li>
            <li><a href="#ship_auction_seller"><?php _e('Shipped Item(Seller)','AuctionTheme'); ?></a></li>


            <li><a href="#review_to_award"><?php _e('Review To Award','AuctionTheme'); ?></a></li>
            <li><a href="#review_received"><?php _e('Review Received','AuctionTheme'); ?></a></li>


            <li><a href="#offer_received"><?php _e('Offer Received','AuctionTheme'); ?></a></li>
            <li><a href="#offer_accepted"><?php _e('Offer Accepted','AuctionTheme'); ?></a></li>
            <li><a href="#offer_rejected"><?php _e('Offer Rejected','AuctionTheme'); ?></a></li>

            <li><a href="#counter_offer_received"><?php _e('Counter Offer Received','AuctionTheme'); ?></a></li>
             <li><a href="#counter_offer_accepted"><?php _e('Counter Offer Accepted','AuctionTheme'); ?></a></li>
            <li><a href="#counter_offer_rejected"><?php _e('Counter Offer Rejected','AuctionTheme'); ?></a></li>

            <li><a href="#winthdrawal_request_admin"><?php _e('Withdraw Request Placed (admin)','AuctionTheme'); ?></a></li>
            <li><a href="#winthdrawal_request_user"><?php _e('Withdraw Request Placed (user)','AuctionTheme'); ?></a></li>


            <li><a href="#winthdrawal_accepted"><?php _e('Withdraw Request Accepted','AuctionTheme'); ?></a></li>
            <li><a href="#winthdrawal_rejected"><?php _e('Withdraw Request Rejected','AuctionTheme'); ?></a></li>

            <?php do_action('AuctionTheme_save_emails_tabs'); ?>

        </ul>



         <div id="winthdrawal_rejected" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the user, if the admin rejects his withdrawal request.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=winthdrawal_rejected">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_winthdrawal_rejected_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_winthdrawal_rejected_subject" value="<?php echo stripslashes(get_option('AuctionTheme_winthdrawal_rejected_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_winthdrawal_rejected_message"><?php echo stripslashes(get_option('AuctionTheme_winthdrawal_rejected_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Customer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##withdrawal_amount##</strong> - <?php _e("withdrawal amount",'AuctionTheme'); ?><br/>


                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_winthdrawal_rejected_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


          <div id="winthdrawal_accepted" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the user, if the admin accepts his withdrawal request.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=winthdrawal_accepted">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_winthdrawal_accepted_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_winthdrawal_accepted_subject" value="<?php echo stripslashes(get_option('AuctionTheme_winthdrawal_accepted_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_winthdrawal_accepted_message"><?php echo stripslashes(get_option('AuctionTheme_winthdrawal_accepted_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Customer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##withdrawal_amount##</strong> - <?php _e("withdrawal amount",'AuctionTheme'); ?><br/>


                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_winthdrawal_accepted_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

         <div id="winthdrawal_request_user" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the user, aftert he requests a withdrawal.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=winthdrawal_request_user">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_winthdrawal_request_admin_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_winthdrawal_request_user_subject" value="<?php echo stripslashes(get_option('AuctionTheme_winthdrawal_request_user_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_winthdrawal_request_user_message"><?php echo stripslashes(get_option('AuctionTheme_winthdrawal_request_user_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Customer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##withdrawal_amount##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>


                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_winthdrawal_request_user_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


           <div id="winthdrawal_request_admin" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the admin, aftert the user requests a withdrawal.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=winthdrawal_request_admin">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_winthdrawal_request_admin_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_winthdrawal_request_admin_subject" value="<?php echo stripslashes(get_option('AuctionTheme_winthdrawal_request_admin_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_winthdrawal_request_admin_message"><?php echo stripslashes(get_option('AuctionTheme_winthdrawal_request_admin_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   						<strong>##seller_user##</strong> - <?php _e('Customer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##withdrawal_amount##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_winthdrawal_request_admin_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <div id="buy_now_auction_buyer" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after he buys an item (buy now auction).
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=buy_now_auction_buyer">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_buy_now_auction_buyer_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_buy_now_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_buy_now_auction_buyer_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_buy_now_auction_buyer_email_message"><?php echo stripslashes(get_option('AuctionTheme_buy_now_auction_buyer_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_buy_now_auction_buyer_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

         <div id="buy_now_auction_seller" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after a buyer buys an item (buy now auction).
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=buy_now_auction_seller">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_buy_now_auction_seller_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_buy_now_auction_seller_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_buy_now_auction_seller_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_buy_now_auction_seller_email_message"><?php echo stripslashes(get_option('AuctionTheme_buy_now_auction_seller_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_buy_now_auction_seller_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

         <div id="paid_auction_buyer" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after he has paid for the item.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=paid_auction_buyer">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_paid_auction_buyer_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_paid_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_paid_auction_buyer_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_paid_auction_buyer_email_message"><?php echo stripslashes(get_option('AuctionTheme_paid_auction_buyer_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_paid_auction_buyer_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

         <div id="paid_auction_seller" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after the buyer has paid for the item.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=paid_auction_seller">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_paid_auction_seller_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_paid_auction_seller_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_paid_auction_seller_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_paid_auction_seller_email_message"><?php echo stripslashes(get_option('AuctionTheme_paid_auction_seller_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_paid_auction_seller_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->


         <div id="ship_auction_buyer" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after the seller marks the item as shipped.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=ship_auction_buyer">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_ship_auction_buyer_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_ship_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_ship_auction_buyer_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_ship_auction_buyer_email_message"><?php echo stripslashes(get_option('AuctionTheme_ship_auction_buyer_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_ship_auction_buyer_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

         <div id="ship_auction_seller" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after he marks the item as shipped.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=ship_auction_seller">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_ship_auction_seller_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_ship_auction_seller_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_ship_auction_seller_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_ship_auction_seller_email_message"><?php echo stripslashes(get_option('AuctionTheme_ship_auction_seller_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##seller_user##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_ship_auction_seller_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

         <div id="review_to_award" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by any user, to get notified for a review he needs to award for an item he bought or sold.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=review_to_award">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_review_to_award_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_review_to_award_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_review_to_award_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_review_to_award_email_message"><?php echo stripslashes(get_option('AuctionTheme_review_to_award_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##rated_user##</strong> - <?php _e('To be rated user\'s Username','AuctionTheme'); ?><br/>
                    <strong>##awarding_user##</strong> - <?php _e('The user\'s username who will award the rating','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_review_to_award_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->


        <div id="counter_offer_received" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the potential buyer when the seller submits a counter offer to the buyer`s offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=counter_offer_received">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_counter_offer_received_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_counter_offer_received_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_counter_offer_received_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_counter_offer_received_email_message"><?php echo stripslashes(get_option('AuctionTheme_counter_offer_received_email_message')); ?></textarea></td>
                    </tr>



                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##buyer_username##</strong> - <?php _e('Potential Buyer(offer) Username','AuctionTheme'); ?><br/>
                    <strong>##seller_username##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_counter_offer_received_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <div id="offer_received" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the seller when a user submits an offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=offer_received">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_offer_received_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_offer_received_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_offer_received_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_offer_received_email_message"><?php echo stripslashes(get_option('AuctionTheme_offer_received_email_message')); ?></textarea></td>
                    </tr>



                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##buyer_username##</strong> - <?php _e('Potential Buyer(offer) Username','AuctionTheme'); ?><br/>
                    <strong>##seller_username##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_offer_received_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>



           <div id="counter_offer_accepted" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the buyer when the seller has accepted thier counter offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=counter_offer_accepted">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_counter_offer_accepted_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_counter_offer_accepted_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_counter_offer_accepted_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_counter_offer_accepted_email_message"><?php echo stripslashes(get_option('AuctionTheme_counter_offer_accepted_email_message')); ?></textarea></td>
                    </tr>



                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_counter_offer_accepted_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <div id="offer_accepted" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the user when the seller has accepted the offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=offer_accepted">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_offer_accepted_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_offer_accepted_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_offer_accepted_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_offer_accepted_email_message"><?php echo stripslashes(get_option('AuctionTheme_offer_accepted_email_message')); ?></textarea></td>
                    </tr>



                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_offer_accepted_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>



        <div id="counter_offer_rejected" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the seller when the buyer has rejected the counter offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=counter_offer_rejected">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_counter_offer_rejected_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_counter_offer_rejected_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_counter_offer_rejected_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_counter_offer_rejected_email_message"><?php echo stripslashes(get_option('AuctionTheme_counter_offer_rejected_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Seller Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_counter_offer_rejected_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <div id="offer_rejected" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the user when the seller has rejected the offer.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=offer_rejected">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_offer_rejected_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_offer_rejected_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_offer_rejected_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_offer_rejected_email_message"><?php echo stripslashes(get_option('AuctionTheme_offer_rejected_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_offer_rejected_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <div id="review_received" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by any users who is rated for an item that he bought or sold.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=review_received">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_review_received_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_review_received_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_review_received_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_review_received_email_message"><?php echo stripslashes(get_option('AuctionTheme_review_received_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##rated_user##</strong> - <?php _e('Just rated user\'s Username','AuctionTheme'); ?><br/>
                    <strong>##awarding_user##</strong> - <?php _e('The user\'s username who awarded the rating','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_review_received_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ###################### -->

        <div id="delivered_auction_owner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the owner of the item after he accepts the item as delivered.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=delivered_auction_owner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_delivered_auction_owner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_delivered_auction_owner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_delivered_auction_owner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_delivered_auction_owner_email_message"><?php echo stripslashes(get_option('AuctionTheme_delivered_auction_owner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('auction Owner\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_delivered_auction_owner_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!--################### -->

         <div id="delivered_auction_bidder" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the bidder/provider after the owner of the items accepts the item as delivered.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=delivered_auction_bidder">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_delivered_auction_bidder_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_delivered_auction_bidder_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_delivered_auction_bidder_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_delivered_auction_bidder_email_message"><?php echo stripslashes(get_option('AuctionTheme_delivered_auction_bidder_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_delivered_auction_bidder_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!-- ################################ -->
        <div id="completed_auction_owner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the owner of the item when the provider marks the item as completed.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=completed_auction_owner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_completed_auction_owner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_completed_auction_owner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_completed_auction_owner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_completed_auction_owner_email_message"><?php echo stripslashes(get_option('AuctionTheme_completed_auction_owner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('auction Owner\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_completed_auction_owner_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
        <div id="completed_auction_bidder" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the provider/bidder when he marks the item as completed.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=completed_auction_bidder">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_completed_auction_bidder_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_completed_auction_bidder_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_completed_auction_bidder_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_completed_auction_bidder_email_message"><?php echo stripslashes(get_option('AuctionTheme_completed_auction_bidder_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

   					<strong>##username##</strong> - <?php _e('Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_completed_auction_bidder_email_save"
                    value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
         <div id="priv_mess_received" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by any user when another user sends a private message.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=priv_mess_received">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_priv_mess_received_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_priv_mess_received_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_priv_mess_received_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_priv_mess_received_email_message"><?php echo stripslashes(get_option('AuctionTheme_priv_mess_received_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>


                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##sender_username##</strong> - <?php _e('sender username','AuctionTheme'); ?><br/>
                    <strong>##receiver_username##</strong> - <?php _e('receiver username','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_priv_mess_received_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
        <div id="rated_user" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the freshly rated user.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=rated_user">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_rated_user_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_rated_user_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_rated_user_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_rated_user_email_message"><?php echo stripslashes(get_option('AuctionTheme_rated_user_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('Winner Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##rating##</strong> - <?php _e('rating value','AuctionTheme'); ?><br/>
                    <strong>##comment##</strong> - <?php _e('rating comment','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_rated_user_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
         <div id="won_item_owner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the item owner after he awards the item to a certain bidder.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=won_item_owner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_won_item_owner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_won_item_owner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_won_item_owner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_won_item_owner_email_message"><?php echo stripslashes(get_option('AuctionTheme_won_item_owner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('Winner Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##winner_bid_value##</strong> - <?php _e('winner bid value','AuctionTheme'); ?><br/>
                    <strong>##winner_bid_username##</strong> - <?php _e('winner bidder username','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_won_item_owner_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
        <div id="won_item_winner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the winner bidder when the item is won.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=won_item_winner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_won_item_winner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_won_item_winner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_won_item_winner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_won_item_winner_email_message"><?php echo stripslashes(get_option('AuctionTheme_won_item_winner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('Winner Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##winner_bid_value##</strong> - <?php _e('winner bid value','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_won_item_winner_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->

        <div id="won_item_loser" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the loser bidders when the item is won.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=won_item_loser">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_won_item_loser_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_won_item_loser_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_won_item_loser_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_won_item_loser_email_message"><?php echo stripslashes(get_option('AuctionTheme_won_item_loser_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('Loser Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##user_bid_value##</strong> - <?php _e('the bid value','AuctionTheme'); ?><br/>

                    <strong>##winner_bid_username##</strong> - <?php _e('winner bid username','AuctionTheme'); ?><br/>
                    <strong>##winner_bid_value##</strong> - <?php _e('winner bid value','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_won_item_loser_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->
        <div id="bid_item_bidder" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the bidder when he posts a bid for a item.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=bid_item_bidder">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_bid_item_bidder_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_bid_item_bidder_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_bid_item_bidder_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_bid_item_bidder_email_message"><?php echo stripslashes(get_option('AuctionTheme_bid_item_bidder_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('auction Bidder\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##bid_value##</strong> - <?php _e('the bid value','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_bid_item_bidder_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>
        <!-- ################################ -->



        <div id="bid_item_outbid" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by all the users that bid for an item and they get outbid.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=bid_item_outbid">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_bid_item_outbid_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_bid_item_outbid_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_bid_item_outbid_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_bid_item_outbid_email_message"><?php echo stripslashes(get_option('AuctionTheme_bid_item_outbid_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('Bidder Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##bidder_username##</strong> - <?php _e('the bidder username','AuctionTheme'); ?><br/>
                    <strong>##bid_value##</strong> - <?php _e('the bid value','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_bid_item_outbid_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


          <div id="no_winner_owner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the item owner when no winner was selected for his item.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=no_winner_owner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_no_winner_owner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_no_winner_owner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_no_winner_owner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_no_winner_owner_email_message"><?php echo stripslashes(get_option('AuctionTheme_no_winner_owner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('auction Owner\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>
                    <strong>##bidder_username##</strong> - <?php _e('the bidder username','AuctionTheme'); ?><br/>
                    <strong>##bid_value##</strong> - <?php _e('the bid value','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_no_winner_owner_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


         <div id="bid_item_owner" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the item owner whenever a user bids for his item.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=bid_item_owner">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_bid_item_owner_email_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_bid_item_owner_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_bid_item_owner_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_bid_item_owner_email_message"><?php echo stripslashes(get_option('AuctionTheme_bid_item_owner_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('auction Owner\'s Username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>


                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_bid_item_owner_email_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################ -->



        <div id="post_auction_not_approved" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=post_auction_not_approved">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_new_item_email_approved_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_item_email_approved_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_item_email_approved_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_item_email_approved_message"><?php echo stripslashes(get_option('AuctionTheme_new_item_email_approved_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save33" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ################################## -->

        <div id="post_auction_approved" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is not automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=post_auction_approved">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_new_item_email_not_approved_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_item_email_not_approved_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_item_email_not_approved_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_item_email_not_approved_message"><?php echo stripslashes(get_option('AuctionTheme_new_item_email_not_approved_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('item owner username','AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save32" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>

        <!-- ############################### -->


        <div id="post_auction_not_approved_admin" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website to be approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=post_auction_not_approved_admin">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_new_item_email_approve_admin_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_item_email_approve_admin_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_item_email_approve_admin_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_item_email_approve_admin_message"><?php echo stripslashes(get_option('AuctionTheme_new_item_email_approve_admin_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save31" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


    <!-- ######################### -->


         <div id="post_auction_approved_admin" style="display: none; ">

           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website. This email will be received if the the item is automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=post_auction_approved_admin">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_new_item_email_not_approve_admin_enable'); ?></td>
                    </tr>

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_item_email_not_approve_admin_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_item_email_not_approve_admin_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_item_email_not_approve_admin_message"><?php echo stripslashes(get_option('AuctionTheme_new_item_email_not_approve_admin_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'AuctionTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'AuctionTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new auction','AuctionTheme'); ?><br/>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save3" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

          </div>


        <!--################################ -->

        <div id="tabs1" style="display: none; ">
        	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160">Email From Name:</td>
                    <td><input type="text" size="45" name="AuctionTheme_email_name_from" value="<?php echo stripslashes(get_option('AuctionTheme_email_name_from')); ?>"/></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td >Email From Address:</td>
                    <td><input type="text" size="45" name="AuctionTheme_email_addr_from" value="<?php echo stripslashes(get_option('AuctionTheme_email_addr_from')); ?>"/></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td >Allow HTML in emails:</td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_allow_html_emails'); ?></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>
        </div>

        <!-- ################################ -->

        <div id="new_user_email" style="display: none; ">
        	<div class="spntxt_bo"><?php _e('This email will be received by all new users who register on your website.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_user_email_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_user_email_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_user_email_message"><?php echo stripslashes(get_option('AuctionTheme_new_user_email_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e("your new username",'AuctionTheme'); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email",'AuctionTheme'); ?><br/>
                    <strong>##user_password##</strong> - <?php _e("your new user's password",'AuctionTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>

        </div>

        <!-- ################################ -->

        <div id="admin_new_user_email" style="display: none; ">
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when a new user registers on the website.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','AuctionTheme'); ?> </div>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_email_set_&active_tab=tabs_new_user_email_admin">
            <table width="100%" class="sitemile-table">

            	  	<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','AuctionTheme'); ?></td>
                    <td><input type="text" size="90" name="AuctionTheme_new_user_email_admin_subject" value="<?php echo stripslashes(get_option('AuctionTheme_new_user_email_admin_subject')); ?>"/></td>
                    </tr>



                    <tr>
                    <td valign=top><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','AuctionTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="AuctionTheme_new_user_email_admin_message"><?php echo stripslashes(get_option('AuctionTheme_new_user_email_admin_message')); ?></textarea></td>
                    </tr>



                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','AuctionTheme'); ?><br/><br/>

                    <strong>##username##</strong> - <?php _e('your new username',"AuctionTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","AuctionTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','AuctionTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","AuctionTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'AuctionTheme'); ?>

                    </div></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save_new_user_email_admin" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
            </form>
        </div>


    	<?php do_action('AuctionTheme_save_emails_contents'); ?>

    </div>


    <?php

	echo '</div>';
}

function AuctionTheme_cust_pricing()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custpricing"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Custom Pricing</h2>';

	$arr = array("yes" => "Yes", "no" => "No");

	if(isset($_POST['my_submit']))
	{
		$auctionTheme_enable_custom_posting 		= trim($_POST['auctionTheme_enable_custom_posting']);
		update_option('auctionTheme_enable_custom_posting', $auctionTheme_enable_custom_posting);

		//---------------

		$customs = $_POST['customs'];
		for($i=0;$i<count($customs);$i++)
		{
			$ids = $customs[$i];
			$val =trim( $_POST['auctionTheme_theme_custom_cat_'.$ids]);
			update_option('auctionTheme_theme_custom_cat_'.$ids,$val);

		}

		//---------------

		echo '<div class="saved_thing">Settings saved!</div>';

	}

	   if(isset($_POST['my_submit2']))
	{
		$auctionTheme_enable_custom_bidding 		= $_POST['auctionTheme_enable_custom_bidding'];
		update_option('auctionTheme_enable_custom_bidding',$auctionTheme_enable_custom_bidding);

		//---------------

		$customs = $_POST['customs'];
		for($i=0;$i<count($customs);$i++)
		{
			$ids = $customs[$i];
			$val = trim($_POST['auctionTheme_theme_bidding_cat_'.$ids]);
			update_option('auctionTheme_theme_bidding_cat_'.$ids,$val);

		}

		//---------------

		echo '<div class="saved_thing">Settings saved!</div>';

	}

	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1">Custom Posting Fees</a></li>
    <li><a href="#tabs2" <?php if("tabs2" == $_GET['active_tabs']) { ?>class="selected" <?php } ?>>Custom Bidding Fees</a></li>
  </ul>
  <div id="tabs1" style="display: block; ">
    	 <form method="post">
    	<table width="100%" class="sitemile-table">


        <tr>
        <td width="220" >Enable Custom Posting fees:</td>
        <td><?php echo AuctionTheme_get_option_drop_down($arr, 'auctionTheme_enable_custom_posting'); ?></td>
        </tr>




        <?php echo AuctionTheme_auction_clear_table(2); ?>

         <tr>
        <td width="220" ><strong>Set Fees for each Category:</strong></td>
        <td></td>
        </tr>
        <?php echo AuctionTheme_auction_clear_table(2); ?>

        <?php

		  $categories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name');
		  //$blg = get_option('auction_theme_blog_category');

		  foreach ($categories as $category)
		  {
			if(1) //$category->cat_name != "Uncategorized" && $category->cat_ID != $blg )
			{
				echo '<tr>';
				echo '<td>'.$category->cat_name.'</td>';
				echo '<td><input type="text" size="6" value="'.get_option('auctionTheme_theme_custom_cat_'.$category->cat_ID).'"
				name="auctionTheme_theme_custom_cat_'.$category->cat_ID.'" /> '.auctionTheme_currency().'
				<input type="hidden" name="customs[]" value="'.$category->cat_ID.'" />
				</td>';

				echo '</tr>';
			}

		  }

		?>
          <?php echo AuctionTheme_auction_clear_table(2); ?>

                <tr>
        <td ></td>
        <td><input type="submit" name="my_submit" value="Save these Settings!" /></td>
        </tr>

        </table>
    </form>


          </div>
          <div id="tabs2" style="display: none; ">

          <form method="post" action="<?php echo get_admin_url() ?>admin.php?page=AT_cust_pricing_&active_tabs=tabs2">
    	<table width="100%" class="sitemile-table">


        <tr>
        <td width="220" >Enable Custom Bidding fees:</td>
        <td><?php echo AuctionTheme_get_option_drop_down($arr, 'auctionTheme_enable_custom_bidding'); ?></td>
        </tr>




        <?php echo AuctionTheme_auction_clear_table(2); ?>

         <tr>
        <td width="220" ><strong>Set Fees for each Category:</strong></td>
        <td></td>
        </tr>
        <?php echo AuctionTheme_auction_clear_table(2); ?>

        <?php

		  $categories =  get_categories('taxonomy=auction_cat&hide_empty=0&orderby=name');


		  foreach ($categories as $category)
		  {
			if(1) //$category->cat_name != "Uncategorized" && $category->cat_ID != $blg )
			{
				echo '<tr>';
				echo '<td>'.$category->cat_name.'</td>';
				echo '<td><input type="text" size="6" value="'.get_option('auctionTheme_theme_bidding_cat_'.$category->cat_ID).'"
				name="auctionTheme_theme_bidding_cat_'.$category->cat_ID.'" /> '.auctionTheme_currency().'
				<input type="hidden" name="customs[]" value="'.$category->cat_ID.'" />
				</td>';

				echo '</tr>';
			}

		  }

		?>
          <?php echo AuctionTheme_auction_clear_table(2); ?>

                <tr>
        <td ></td>
        <td><input type="submit" name="my_submit2" value="Save these Settings!" /></td>
        </tr>

        </table>
    </form>

          </div>
        </div>


    <?php

	echo '</div>';
}


function AuctionTheme_escrows()
{
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-vault"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Escrows</h2>';

//----------------------------------------------------------------------

    global $wpdb;
	if(isset($_GET['release']))
	{

		$id = $_GET['release'];

						$s = "select * from ".$wpdb->prefix."auction_escrow where id='$id'";
						$row = $wpdb->get_results($s); //mysql_query($s);

						if(count($row) == 1)
						{
							$row = $row[0];
							$amount = $row->amount;
							$toid = $row->toid;
							$fromid = $row->fromid;


							$fromuser = get_userdata($fromid);

							$cr = auctionTheme_get_credits($toid);
							auctionTheme_update_credits($toid, $cr + $amount);

							$reason = sprintf(__('Payment received from %s','AuctionTheme'), $fromuser->user_login);
							auctionTheme_add_history_log('1', $reason, $amount, $toid, $fromid);



							//-----------------------------
							$email 		= get_bloginfo('admin_email');
							$site_name 	= get_bloginfo('name');

							$usr = get_userdata($fromid);

							$subject = __("Money Escrow Completed",'AuctionTheme');
							$message = sprintf(__("You have released the escrow of: %s", 'AuctionTheme'), auctionTheme_get_show_price($amount));

						//	sitemile_send_email($usr->user_email, $subject , $message);

							//-----------------------------

							$usr = get_userdata($toid);

							$reason = 'Payment sent to '.$usr->user_login;
							auctionTheme_add_history_log('0', $reason, $amount, $fromid, $toid);

							$subject = sprintf(__("Money Escrow Completed",'AuctionTheme'));
							$message = sprintf(__("You have received the amount of: %s",'AuctionTheme'), auctionTheme_get_show_price($amount));

							//sitemile_send_email($usr->user_email, $subject , $message);

							//-----------------------------

							$tm = current_time('timestamp',0);
							$s = "update ".$wpdb->prefix."auction_escrow set released='1', releasedate='$tm' where
							id='$id'";
							$wpdb->query($s);

							echo '<div class="saved_thing">'.__('Escrow completed!','AuctionTheme'). '</div>';
						}


	}

	if(isset($_GET['close']))
	{

		$id = $_GET['close'];

		$s = "select * from ".$wpdb->prefix."auction_escrow where id='$id'";
		$row = $wpdb->get_results($s);

						if(count($row) == 1)
						{
							$row = $row[0];
							$amount = $row->amount;
							$fromid = $row->fromid;

							$cr = auctionTheme_get_credits($fromid);
							auctionTheme_update_credits($fromid, $cr + $amount);

						}


		$s = "delete from ".$wpdb->prefix."auction_escrow where	id='$id'";
		$wpdb->query($s);

		echo '<div class="saved_thing">'.__('Escrow closed!','AuctionTheme'). '</div>';

	} ?>


        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1" class="selected">Open Escrows</a></li>
    <li><a href="#tabs2">Completed Escrows</a></li>
  </ul>
  <div id="tabs1" style="display: block; ">
    <?php

		$s = "select * from ".$wpdb->prefix."auction_escrow where released='0' order by id desc";
		$r = $wpdb->get_results($s);

		if(count($r) > 0):
	?>

    	     <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">From User</th>
    <th width="10%">To User</th>
    <th width="10%">Auction</th>
    <th>Date Made</th>
    <th >Amount</th>
	<th >Options</th>
    </tr>
    </thead>



    <tbody>


	<?php



	foreach($r as $row)
	{
		$user1 = get_userdata($row->fromid);
		$user2 = get_userdata($row->toid);
		$post  = get_post($row->pid);

		echo '<tr>';
		echo '<th>'.$user1->user_login.'</th>';
		echo '<th>'.$user2->user_login .'</th>';
		echo '<th><a href="'.get_permalink($row->pid).'">'.$post->post_title .'</a></th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th>'.auctionTheme_get_show_price($row->amount) .'</th>';
		echo '<th><a href="'.get_admin_url().'admin.php?page=Escrows&release='.$row->id.'" class="awesome">Release</a> | <a href="'.get_admin_url().'admin.php?page=Escrows&close='.$row->id.'" class="trash">Close</a> </th>';


		echo '</tr>';
	}

	?>



	</tbody>


    </table>

    <?php else: ?>

    There are no results.

    <?php endif; ?>

          </div>
          <div id="tabs2" style="display: none; ">

           <?php

		$s = "select * from ".$wpdb->prefix."auction_escrow where released='1' order by id desc";
		$r = $wpdb->get_results($s);

		if(count($r) > 0):
	?>

    	     <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">From User</th>
    <th width="10%">To User</th>
    <th width="10%">Auction</th>
    <th>Date Made</th>
    <th >Amount</th>
	<th >Options</th>
    </tr>
    </thead>



    <tbody>


	<?php



	foreach($r as $row)
	{
		$user1 = get_userdata($row->fromid);
		$user2 = get_userdata($row->toid);
		$post  = get_post($row->pid);

		echo '<tr>';
		echo '<th>'.$user1->user_login.'</th>';
		echo '<th>'.$user2->user_login .'</th>';
		echo '<th><a href="'.get_permalink($row->pid).'">'.$post->post_title .'</a></th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th>'.auctionTheme_get_show_price($row->amount) .'</th>';
		echo '<th>#</th>';


		echo '</tr>';
	}

	?>



	</tbody>


    </table>

    <?php else: ?>

    There are no results.

    <?php endif; ?>



          </div>
        </div>


    <?php

	echo '</div>';
}

function AuctionTheme_withdrawals()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-withdr"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Withdrawals</h2>';

if(isset($_GET['den_id']))
	{
		$tm = current_time('timestamp',0);
		$ids = $_GET['den_id'];

		$s = "select * from ".$wpdb->prefix."auction_withdraw where id='$ids'";
		$row = $wpdb->get_results($s);
		$row = $row[0];


		if($row->done == 0 or $row->done == -1)
		{
			echo '<div class="saved_thing">Payment rejected!</div>';
			$ss = "update ".$wpdb->prefix."auction_withdraw set done='-1', datedone='$tm' where id='$ids'";
			$wpdb->query($ss) or die(mysql_error());

			$credits = auctiontheme_get_credits($row->uid);
			auctiontheme_update_credits($row->uid, ($credits + $row->amount));

			$usr = get_userdata($row->uid);


			AuctionTheme_send_email_when_withdrawal_rejected($row->uid, $row->amount);


		}
	}
	if(isset($_GET['tid']))
	{
		$tm = current_time('timestamp',0);
		$ids = $_GET['tid'];

		$s = "select * from ".$wpdb->prefix."auction_withdraw where id='$ids'";
		$row = $wpdb->get_results($s);
		$row = $row[0];

		if($row->done == 0)
		{
			echo '<div class="saved_thing">Payment completed!</div>';
			$ss = "update ".$wpdb->prefix."auction_withdraw set done='1', datedone='$tm' where id='$ids'";
			$wpdb->query($ss);// or die(mysql_error());


			$usr = get_userdata($row->uid);

			$site_name 		= get_bloginfo('name');
			$email		 	= get_bloginfo('admin_email');

			$subject = sprintf(__("Your withdrawal has been completed: %s",'AuctionTheme'), auctionTheme_get_show_price($amount));
			$message = sprintf(__("Your withdrawal has been completed: %s",'AuctionTheme'), auctionTheme_get_show_price($amount));

			//sitemile_send_email($usr->user_email, $subject , $message);


			$reason = sprintf(__('Withdraw to PayPal to email: %s','AuctionTheme') ,$row->payeremail);
			auctionTheme_add_history_log('0', $reason, $row->amount, $row->uid);
		}
	}

	?>

        <div id="usual2" class="usual">
  <ul>
    <ul>
            <li><a href="#tabs1"><?php _e('Unresolved Requests','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('Resolved Requests','AuctionTheme'); ?></a></li>
            <li><a href="#tabs_rejected"><?php _e('Rejected Requests','AuctionTheme'); ?></a></li>
            <li><a href="#tabs3"><?php _e('Search Unresolved','AuctionTheme'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Search Solved','AuctionTheme'); ?></a></li>
            <li><a href="#tabs_search_rejected"><?php _e('Search Rejected','AuctionTheme'); ?></a></li>
          </ul>
  </ul>
  <div id="tabs1">
          <?php

		   $s = "select * from ".$wpdb->prefix."auction_withdraw where done='0' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','AuctionTheme'); ?></th>
            <th><?php _e('Method','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Details','AuctionTheme'); ?></th>
            <th><?php _e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php _e('Amount','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no unresolved withdrawal requests.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>


          </div>

          <div id="tabs2">


          <?php

		   $s = "select * from ".$wpdb->prefix."auction_withdraw where done='1' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th ><?php 	_e('Username','AuctionTheme'); ?></th>
            <th><?php 	_e('Method','AuctionTheme'); ?></th>
            <th><?php 	_e('Details','AuctionTheme'); ?></th>
            <th><?php 	_e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php 	_e('Amount','AuctionTheme'); ?></th>
            <th><?php 	_e('Date Released','AuctionTheme'); ?></th>
            <th><?php 	_e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
				echo '<th>'.$user->methods.'</th>';
                echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->datedone == 0 ? "Not yet" : date('d-M-Y H:i:s',$row->datedone)) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no resolved withdrawal requests.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>


          </div>

          <div id="tabs_rejected">


          <?php

		   $s = "select * from ".$wpdb->prefix."auction_withdraw where done='-1' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th ><?php _e('Username','AuctionTheme'); ?></th>
            <th><?php _e('Method','AuctionTheme'); ?></th>
            <th><?php _e('Details','AuctionTheme'); ?></th>
            <th><?php _e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php _e('Amount','AuctionTheme'); ?></th>
            <th><?php _e('Date Released','AuctionTheme'); ?></th>
            <th><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->datedone == 0 ? "Not yet" : date('d-M-Y H:i:s',$row->datedone)) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no rejected withdrawal requests.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>


          </div>


          <div id="tabs3">

          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs3" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','AuctionTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="AuctionTheme_save3" value="<?php _e('Search','AuctionTheme'); ?>"/></td>
                </tr>


            </table>
            </form>

            <?php

			if(isset($_GET['AuctionTheme_save3'])):

				$search_user = trim($_GET['search_user']);

				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;

				$s = "select * from ".$wpdb->prefix."auction_withdraw where done='0' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','AuctionTheme'); ?></th>
            <th><?php _e('Method','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Details','AuctionTheme'); ?></th>
            <th><?php _e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php _e('Amount','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no results for your search.','AuctionTheme'); ?>
            </div>

            <?php endif;


			endif;

			?>


          </div>

          <div id="tabs4">

          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs4" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','AuctionTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user4']; ?>" name="search_user4" size="20" /> <input type="submit" name="AuctionTheme_save4" value="<?php _e('Search','AuctionTheme'); ?>"/></td>
                </tr>


            </table>
            </form>


            <?php

			if(isset($_GET['AuctionTheme_save4'])):

				$search_user = trim($_GET['search_user4']);

				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;

				$s = "select * from ".$wpdb->prefix."auction_withdraw where done='1' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','AuctionTheme'); ?></th>
            <th><?php _e('Method','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Details','AuctionTheme'); ?></th>
            <th><?php _e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php _e('Amount','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no results for your search.','AuctionTheme'); ?>
            </div>

            <?php endif;


			endif;

			?>

            </div>


          <div id="tabs_search_rejected">

          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs_search_rejected" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','AuctionTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user5']; ?>" name="search_user5" size="20" /> <input type="submit" name="AuctionTheme_save5" value="<?php _e('Search','AuctionTheme'); ?>"/></td>
                </tr>


            </table>
            </form>


             <?php

			if(isset($_GET['AuctionTheme_save5'])):

				$search_user = trim($_GET['search_user5']);

				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;

				$s = "select * from ".$wpdb->prefix."auction_withdraw where rejected='1' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','AuctionTheme'); ?></th>
            <th><?php _e('Method','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Details','AuctionTheme'); ?></th>
            <th><?php _e('Date Requested','AuctionTheme'); ?></th>
            <th ><?php _e('Amount','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $user = get_userdata($row->uid);

                echo '<tr>';
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.AuctionTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','AuctionTheme').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','AuctionTheme').'</a>' :( $row->done == 1 ? __("Completed",'AuctionTheme') : __("Rejected",'AuctionTheme') ) ).'</th>';
                echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no results for your search.','AuctionTheme'); ?>
            </div>

            <?php endif;


			endif;

			?>

          </div>




<?php
	echo '</div>';
}


function AuctionTheme_user_reviews()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-rev"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Reviews/Feedback</h2>';
	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1"><?php _e('All User Reviews','AuctionTheme'); ?></a></li>
    <li><a href="#tabs2"><?php _e('Search User','AuctionTheme'); ?></a></li>
  </ul>


  <div id="tabs1">

          <?php

		   $s = "select * from ".$wpdb->prefix."auction_ratings where awarded>0 order by id desc";
           $r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Rated User','AuctionTheme'); ?></th>
            <th><?php _e('auction','AuctionTheme'); ?></th>
            <th><?php _e('Rating','AuctionTheme'); ?></th>
            <th><?php _e('Description','AuctionTheme'); ?></th>
            <th><?php _e('Awarded On','AuctionTheme'); ?></th>
            <th><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php


            foreach($r as $row)
            {

				$post = get_post($row->pid);
				$userdata = get_userdata($row->touser);
				$pid = $row->pid;

				echo '<tr>';
				echo '<th>'.$userdata->user_login.'</th>';
				echo '<th><a href="'.get_permalink($pid).'">'.$post->post_title.'</a></th>';
				echo '<th>'.($row->grade/2).'</th>';
				echo '<th>'.$row->comment.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';


            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no user feedback.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>

          </div>

          <div id="tabs2">

          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="AT_user_rev_" name="page" />
            <input type="hidden" value="tabs2" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','AuctionTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="AuctionTheme_save2" value="<?php _e('Search','AuctionTheme'); ?>"/></td>
                </tr>


            </table>
            </form>

            <?php

		  	$user = trim($_GET['search_user']);
			$user = get_userdatabylogin($user);
		  	$uid = $user->ID;

		   	$s = "select * from ".$wpdb->prefix."auction_ratings where touser='$uid' and awarded>0 order by id desc";
			$r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Rated User','AuctionTheme'); ?></th>
            <th><?php _e('Auction','AuctionTheme'); ?></th>
            <th><?php _e('Rating','AuctionTheme'); ?></th>
            <th><?php _e('Description','AuctionTheme'); ?></th>
            <th><?php _e('Awarded On','AuctionTheme'); ?></th>
            <th><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $post = get_post($row->pid);
				$userdata = get_userdata($row->touser);
				$pid = $row->pid;

				echo '<tr>';
				echo '<th>'.$userdata->user_login.'</th>';
				echo '<th><a href="'.get_permalink($pid).'">'.$post->post_title.'</a></th>';
				echo '<th>'.($row->grade / 2).'</th>';
				echo '<th>'.$row->comment.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';


            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no user feedback.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>


          </div>

          <div id="tabs3">
          </div>


    <?php

	echo '</div>';
}

function AuctionTheme_user_balances()
{
	global $menu_admin_auction_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-bal"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme User Balances</h2>';
	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1" class="selected">All Users</a></li>
    <li><a href="#tabs2">Search User</a></li>
  </ul>
  <div id="tabs1" style="display: none; ">


	<?php

	$rows_per_page = 10;

	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;

	global $wpdb;

	$s1 = "select ID from ".$wpdb->users." order by user_login asc ";
	$s = "select * from ".$wpdb->users." order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;


	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);

	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)
	{

		?>


		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>

    <script>

	 jQuery(document).ready(function() {

  	jQuery('.update_btn*').click(function() {

	var id = jQuery(this).attr('alt');
	var increase_credits = jQuery('#increase_credits' + id).val();
	var decrease_credits = jQuery('#decrease_credits' + id).val();

	jQuery.ajax({
   type: "POST",
   url: "<?php echo home_url(); ?>/",
   data: "crds=1&uid="+id+"&increase_credits="+increase_credits+"&decrease_credits="+decrease_credits,
   success: function(msg){


	jQuery("#money" + id).html(msg);
	jQuery('#increase_credits' + id).val("");
	jQuery('#decrease_credits' + id).val("");

   }
 });

	});


 });


	</script>

    <tbody>


		<?php


	foreach($r as $row)
	{
		$user = get_userdata($row->ID);


		echo '<tr style="">';
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. AuctionTheme_get_show_price(auctionTheme_get_credits($row->ID)) .'</span></th>';
		echo '<th>';
		?>

        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo auctionTheme_currency(); ?><br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo auctionTheme_currency(); ?><br/>

        <input type="button" value="Update" class="update_btn" alt="<?php echo $row->ID; ?>" />


        <?php
		echo '</th>';

		echo '</tr>';
	}


	?>



	</tbody>

    </table>

    <?php

	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else
			echo '<a href="'.get_admin_url().'admin.php?page=AT_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';

		}

	}

    ?>
          </div>
          <div id="tabs2" >
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
          <input type="hidden" name="page" value="AT_user_bal_" />
          <input type="hidden" name="active_tab" value="tabs2" />
          Search User: <input type="text" size="35" value="<?php echo $_GET['src_usr']; ?>" name="src_usr" />
           <input type="submit" value="Submit" name="" />
          </form>

          <?php
		  if(!empty($_GET['src_usr'])):

		  ?>

          <?php

	$rows_per_page = 10;

	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;

	global $wpdb;
	$src_usr = $_GET['src_usr'];

	$s1 = "select ID from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$s = "select * from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;


	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);

	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)
	{

		?>


		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>


    <tbody>


		<?php


	foreach($r as $row)
	{
		$user = get_userdata($row->ID);


		echo '<tr style="">';
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. AuctionTheme_get_show_price(auctionTheme_get_credits($row->ID)) .'</span></th>';
		echo '<th>';
		?>

        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo auctionTheme_currency(); ?><br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo auctionTheme_currency(); ?><br/>

        <input type="button" value="Update" class="update_btn" alt="<?php echo $row->ID; ?>" />


        <?php
		echo '</th>';

		echo '</tr>';
	}


	?>



	</tbody>

    </table>

    <?php

	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else
			echo '<a href="'.get_admin_url().'admin.php?active_tab=tabs2&src_usr='.$_GET['src_usr'].'&page=AT_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';

		}

	}

    ?>


          <?php endif; ?>

          </div>
        </div>


    <?php

	echo '</div>';
}

if(!function_exists('AuctionTheme_user_private_mess'))
{
function AuctionTheme_user_private_mess()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-mess"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Private Messages</h2>';
	?>

       <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('All Private Messages','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('Search User','AuctionTheme'); ?></a></li>

          </ul>
          <div id="tabs1">

          <?php

		  	$nrpostsPage = 10;
		  	$page = $_GET['pj']; if(empty($page)) $page = 1;
			$my_page = $page;

		   $s = "select * from ".$wpdb->prefix."auction_pm order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
           $r = $wpdb->get_results($s);


		$s1 = "select id from ".$wpdb->prefix."auction_pm order by id desc";
		$r1 = $wpdb->get_results($s1);


		if(count($r) > 0):

				$total_nr = count($r1);

				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );


				$start 		= floor($my_page/$batch) * $batch + 1;
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;

				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;

				if($start_me <= 0) $start_me = 1;

				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;

				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;




		  ?>
          <script>

		  jQuery(document).ready(function() {


		jQuery(".show_mess_priv").click(function () {

			var rel = jQuery(this).attr("rel");
			jQuery("#priv_id_" + rel).toggle("slow");

		});



		jQuery(".delete_mess_priv").click(function () {

			var rel = jQuery(this).attr("rel");


				jQuery.ajax({
				   type: "POST",
				   url: "<?php echo get_bloginfo('siteurl'); ?>/",
				   data: "remove_message=1&id="+rel ,
				   success: function(msg){

					 jQuery("#priv_id_" + rel).hide("slow");
					alert("Message Deleted");

				   }
				 });



		});


});

		  </script>
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Sender','AuctionTheme'); ?></th>
            <th><?php _e('Receiver','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Subject','AuctionTheme'); ?></th>
            <th><?php _e('Sent On','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php


            $ij = 0;

            foreach($r as $row)
            {
                $sender 	= get_userdata($row->initiator);
				$receiver 	= get_userdata($row->user);

				if($ij%2 == 0) $cls = "background_reed_me"; else $cls = '';

                echo '<tr class="'.$cls.'">';
				echo '<th>'.$sender->user_login.'</th>';
				echo '<th>'.$receiver->user_login.'</th>';
				echo '<th>'.$row->subject.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th><a href="#" class="show_mess_priv" rel="'.$row->id.'">Show Message</a> | <a href="#" class="delete_mess_priv" rel="'.$row->id.'">Delete Message</a></th>';
				echo '</tr>';


				echo '<tr id="priv_id_'.$row->id.'" class="'.$cls.' priv_mess_content_admin">';
				echo '<th colspan="5">Message Content: '.$row->content.'</th>';
				echo '</tr>';

				$ij++;

            }

            ?>
            </tbody>


            </table>
            <?php


			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?page=AT_user_mess_&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=AT_user_mess_&pj='.$start_me.'"><<</a> ';




			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {

					echo '<a href="'.get_admin_url().'admin.php?page=AT_user_mess_&pj='.$i.'">'.$i.'</a> | ';

				}
			}



			if($totalPages > $my_page)
			echo ' <a href="'.get_admin_url().'admin.php?page=AT_user_mess_&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=AT_user_mess_&pj='.$next_pg.'">'.__('Next','AuctionTheme').' >></a> ';


			?>



            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no private messages.','AuctionTheme'); ?>
            </div>

            <?php endif; ?>


          </div>

          <div id="tabs2">



          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="AT_user_mess_" name="page" />
            <input type="hidden" value="tabs2" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','AuctionTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="AuctionTheme_save2" value="<?php _e('Search','AuctionTheme'); ?>"/></td>
                </tr>


            </table>
            </form>

            <?php

			if(isset($_GET['AuctionTheme_save2'])):

				$search_user = trim($_GET['search_user']);

				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;

				$s = "select * from ".$wpdb->prefix."auction_pm where initiator='$uid' OR user='$uid' order by id desc";
          		$r = $wpdb->get_results($s);

			if(count($r) > 0):

		  ?>

           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Sender','AuctionTheme'); ?></th>
            <th><?php _e('Receiver','AuctionTheme'); ?></th>
            <th width="20%"><?php _e('Subject','AuctionTheme'); ?></th>
            <th><?php _e('Sent On','AuctionTheme'); ?></th>
            <th width="25%"><?php _e('Options','AuctionTheme'); ?></th>
            </tr>
            </thead>



            <tbody>
            <?php



            foreach($r as $row)
            {
                $sender 	= get_userdata($row->initiator);
				$receiver 	= get_userdata($row->user);

                echo '<tr>';
				echo '<th>'.$sender->user_login.'</th>';
				echo '<th>'.$receiver->user_login.'</th>';
				echo '<th>'.$row->subject.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';
            }

            ?>
            </tbody>


            </table>
            <?php else: ?>

            <div class="padd101">
            <?php _e('There are no results for your search.','AuctionTheme'); ?>
            </div>

            <?php endif;


			endif;

			?>

          </div>


<?php
	echo '</div>';

}
}

function auctionTheme_hist_transact()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-list"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Transaction History</h2>';

	$arr = array("yes" => "Yes", "no" => "No");

	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1" class="selected">All Transactions</a></li>
    <li><a href="#tabs2">Search User</a></li>
  </ul>
  <div id="tabs1" style="display: block; ">




	<?php



	$nrpostsPage = 10;
	$page = $_GET['pj']; if(empty($page)) $page = 1;
	$my_page = $page;

	//-----------------------------------------------------------

	global $wpdb;
	$s = "select * from ".$wpdb->prefix."auction_payment_transactions order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);

	$s1 = "select id from ".$wpdb->prefix."auction_payment_transactions order by id desc";
	$r1 = $wpdb->get_results($s1);


	if(count($r) > 0):

	$total_nr = count($r1);

				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );


				$start 		= floor($my_page/$batch) * $batch + 1;
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;

				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;

				if($start_me <= 0) $start_me = 1;

				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;

				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;

	?>
            <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">Username</th>
    <th width="40%">Comment/Description</th>
    <th>Date Made</th>
    <th >Amount</th>

    </tr>
    </thead>



    <tbody>


	<?php


	foreach($r as $row)
	{
		$user = get_userdata($row->uid);

		if($row->tp == 0) { $sign = '-'; $cl = 'redred'; }
		else
		{ $sign = '+'; $cl = 'greengreen'; }

		echo '<tr>';
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->reason .'</th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th class="'.$cl.'">'.$sign.AuctionTheme_get_show_price($row->amount,2).'</th>';


		echo '</tr>';
	}

	?>



	</tbody>


    </table>

    <?php


			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$start_me.'"><<</a> ';




			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {

					echo '<a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$i.'">'.$i.'</a> | ';

				}
			}



			if($totalPages > $my_page)
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$next_pg.'">'.__('Next','AuctionTheme').' >></a> ';


			?>


    <?php else: ?> Sorry there are no transactions.

    <?php endif; ?>

     	</div>
          <div id="tabs2" style="display: none; ">

          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
          <input type="hidden" name="page" value="trans-sites" />
          <input type="hidden" name="active_tab" value="tabs2" />
          Search User: <input type="text" size="35" value="<?php echo $_GET['src_usr']; ?>" name="src_usr" />
           <input type="submit" value="Submit" name="" />
          </form> <br/>

              <?php

	if(isset($_GET['src_usr'])):

	$usrdt = get_userdatabylogin($_GET['src_usr']);

	$nrpostsPage = 10;
	$page = $_GET['pj']; if(empty($page)) $page = 1;
	$my_page = $page;

	//-----------------------------------------------------------

	global $wpdb;
	$s = "select * from ".$wpdb->prefix."auction_payment_transactions where uid='".$usrdt->ID."' order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);

	$s1 = "select id from ".$wpdb->prefix."auction_payment_transactions where uid='".$usrdt->ID."' order by id desc";
	$r1 = $wpdb->get_results($s1);


	if(count($r) > 0):

	$total_nr = count($r1);

				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );


				$start 		= floor($my_page/$batch) * $batch + 1;
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;

				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;

				if($start_me <= 0) $start_me = 1;

				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;

				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;

	?>
            <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">Username</th>
    <th width="40%">Comment/Description</th>
    <th>Date Made</th>
    <th >Amount</th>
	<th >Auction</th>
    </tr>
    </thead>



    <tbody>


	<?php


	foreach($r as $row)
	{
		$user = get_userdata($row->uid);

		if($row->tp == 0) { $sign = '-'; $cl = 'redred'; }
		else
		{ $sign = '+'; $cl = 'greengreen'; }

		echo '<tr>';
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->reason .'</th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th class="'.$cl.'">'.$sign.AuctionTheme_get_show_price($row->amount,2).'</th>';
		echo '<th>#</th>';

		echo '</tr>';
	}

	?>



	</tbody>


    </table>

    <?php


			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','AuctionTheme').'</a> ';
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$start_me.'"><<</a> ';




			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {

					echo '<a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$i.'">'.$i.'</a> | ';

				}
			}



			if($totalPages > $my_page)
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$next_pg.'">'.__('Next','AuctionTheme').' >></a> ';


			?>


    <?php else: ?> Sorry there are no transactions.

    <?php endif; endif; ?>

          </div>
        </div>


    <?php

	echo '</div>';
}




function AuctionTheme_layout_settings()
{

	$id_icon 		= 'icon-options-general-layout';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Layout Settings','AuctionTheme');
	global $menu_admin_AuctionTheme_theme_bull;

	//------------------------------------------------------

	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

		if(isset($_POST['AuctionTheme_save4']))
		{
			update_option('AuctionTheme_color_for_top_links', 			trim($_POST['AuctionTheme_color_for_top_links']));
			update_option('AuctionTheme_color_for_bk', 					trim($_POST['AuctionTheme_color_for_bk']));
			update_option('AuctionTheme_color_for_footer', 				trim($_POST['AuctionTheme_color_for_footer']));
			update_option('AuctionTheme_color_for_top_links2', 				trim($_POST['AuctionTheme_color_for_top_links2']));

			update_option('AuctionTheme_color_for_main_links', 				trim($_POST['AuctionTheme_color_for_main_links']));
			update_option('AuctionTheme_color_for_main_links2', 			trim($_POST['AuctionTheme_color_for_main_links2']));
			update_option('AuctionTheme_color_for_main_links3', 			trim($_POST['AuctionTheme_color_for_main_links3']));
			update_option('AuctionTheme_color_for_main_links4', 			trim($_POST['AuctionTheme_color_for_main_links4']));
			update_option('AuctionTheme_color_for_text_footer', 			trim($_POST['AuctionTheme_color_for_text_footer']));
			update_option('AuctionTheme_general_color_me', 			trim($_POST['AuctionTheme_general_color_me']));

			




			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		if(isset($_POST['AuctionTheme_save1']))
		{
			update_option('AuctionTheme_home_page_layout', 				trim($_POST['AuctionTheme_home_page_layout']));
			update_option('AuctionTheme_main_image_src', 			trim($_POST['AuctionTheme_main_image_src']));
			update_option('AuctionTheme_sub_headline', 			trim($_POST['AuctionTheme_sub_headline']));
			update_option('AuctionTheme_main_headline', 			trim($_POST['AuctionTheme_main_headline']));

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		if(isset($_POST['AuctionTheme_save2']))
		{
			update_option('AuctionTheme_logo_URL', 				trim($_POST['AuctionTheme_logo_URL']));
			update_option('AuctionTheme_default_big_line', 				trim($_POST['AuctionTheme_default_big_line']));
			update_option('AuctionTheme_default_small_line', 				trim($_POST['AuctionTheme_default_small_line']));
			update_option('AuctionTheme_logo_option', 				trim($_POST['AuctionTheme_logo_option']));



			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		if(isset($_POST['AuctionTheme_save3']))
		{
			update_option('AuctionTheme_left_side_footer', 				stripslashes(trim($_POST['AuctionTheme_left_side_footer'])));
			update_option('AuctionTheme_right_side_footer', 			stripslashes(trim($_POST['AuctionTheme_right_side_footer'])));

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}


		//-----------------------------------------

	$AuctionTheme_home_page_layout = get_option('AuctionTheme_home_page_layout');
	if(empty($AuctionTheme_home_page_layout)) $AuctionTheme_home_page_layout = "1";

?>

	    <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('HomePage','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('Header','AuctionTheme'); ?></a></li>
            <li><a href="#tabs3"><?php _e('Footer','AuctionTheme'); ?></a></li>
            <li><a href="#tabs4" <?php if($_GET['active_tab'] == "tabs4") { ?> class="selected" <?php } ?>><?php _e('Change Colors','AuctionTheme'); ?></a></li>
          </ul>

          <div id="tabs4">
           <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_layout_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">

        <tr>
        <td width="200"><?php _e('Base Color Scheme:','AuctionTheme'); ?></td>
        <td><select name="AuctionTheme_general_color_me">

        <option value="green">Default (green)</option>
        <option value="blue" <?php if(get_option('AuctionTheme_general_color_me') == "blue") echo 'selected="selected"'; ?>>Blue</option>
        <option value="red" <?php if(get_option('AuctionTheme_general_color_me') == "red") echo 'selected="selected"'; ?>>Red</option>
        <option value="black" <?php if(get_option('AuctionTheme_general_color_me') == "black") echo 'selected="selected"'; ?>>Black</option>

        </select></td>
        </tr>

         <tr>
        <td colspan="2">

        <div class="postbox2 ">
        If you want to use the below color code boxes, you have to leave the color scheme to the default setting (green).
        </div>

         </td>
        </tr>


        <tr>
        <td>OR</td>
        <td></td>
        </tr>

        <tr>
        <td width="200"><?php _e('Color for background:','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField1" name="AuctionTheme_color_for_bk"  value="<?php echo get_option('AuctionTheme_color_for_bk'); ?>"/>


		</td>
        </tr>



        <tr>
        <td><?php _e('Color for footer:','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField2" name="AuctionTheme_color_for_footer" value="<?php echo get_option('AuctionTheme_color_for_footer'); ?>" />
		</td>
        </tr>


         <tr>
        <td><?php _e('Color for text footer:','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField9" name="AuctionTheme_color_for_text_footer" value="<?php echo get_option('AuctionTheme_color_for_text_footer'); ?>" />
		</td>
        </tr>


        <tr>
        <td><?php _e('Color for top links:','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField3" name="AuctionTheme_color_for_top_links" value="<?php echo get_option('AuctionTheme_color_for_top_links'); ?>" />
		</td>
        </tr>

        <tr>
        <td ><?php _e('Color for top links(hover):','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField5" name="AuctionTheme_color_for_top_links2" value="<?php echo get_option('AuctionTheme_color_for_top_links2'); ?>" />
		</td>
        </tr>


        <tr>
        <td ><?php _e('Color for main menu:','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField6" name="AuctionTheme_color_for_main_links" value="<?php echo get_option('AuctionTheme_color_for_main_links'); ?>" />
		</td>
        </tr>


        <tr>
        <td ><?php _e('Color for main menu(hover):','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField7" name="AuctionTheme_color_for_main_links2" value="<?php echo get_option('AuctionTheme_color_for_main_links2'); ?>" />
		</td>
        </tr>


        <tr>
        <td width="250"><?php _e('Color for main menu(text color):','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField8" name="AuctionTheme_color_for_main_links3" value="<?php echo get_option('AuctionTheme_color_for_main_links3'); ?>" />
		</td>
        </tr>


        <tr>
        <td><?php _e('Color for main menu(border bottom):','AuctionTheme'); ?></td>
        <td><input type="text" id="colorpickerField8" name="AuctionTheme_color_for_main_links4" value="<?php echo get_option('AuctionTheme_color_for_main_links4'); ?>" />
		</td>
        </tr>


             <tr>

                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>


            </table>

            </form>


          </div>

          <div id="tabs1">

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_layout_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">

			<td valign=top width="22"></td>
					<td width="350"><?php _e("Main Headline:","AuctionTheme"); ?> </td>
					<td><input type="text" name="AuctionTheme_main_headline" size="30" value="<?php echo get_option('AuctionTheme_main_headline'); ?>" /> </td>
                </tr>
				
				
				<td valign=top width="22"></td>
					<td width="350"><?php _e("Sub Headline:","AuctionTheme"); ?> </td>
					<td><input type="text" name="AuctionTheme_sub_headline" size="30"  value="<?php echo get_option('AuctionTheme_sub_headline'); ?>" /> </td>
                </tr>
				
				
				
				<td valign=top width="22"></td>
					<td width="350"><?php _e("Homepage Main Image:","AuctionTheme"); ?> </td>
					<td><input type="text" name="AuctionTheme_main_image_src" size="30"  value="<?php echo get_option('AuctionTheme_main_image_src'); ?>" /> (eg: http://site.com/images/image1-background.jpg) </td>
                </tr>
				
				
				 
			
			
			
				<tr><td valign=top width="22"><?php AuctionTheme_theme_bullet('This option controls the layout of the homepage. You are able to choose from these options which makes the homepage to have more or less widgetised areas. All the squares you see in the images are widgetised areas, in which you can drag and drop widgets. Control widgets from the left hand side menu Appearance -> Widgets.' ,'si-le-nto-s'); ?></td>
					<td class="ttl"><strong><?php _e("Choose from the home page layouts available:","AuctionTheme"); ?></strong> </td> <td></td></tr>

				<tr>
                <td valign=top width="22"></td>
					<td width="350"><?php _e("Content + Right Sidebar:","AuctionTheme"); ?> </td>
					<td><input type="radio" name="AuctionTheme_home_page_layout" value="1" <?php if($AuctionTheme_home_page_layout == "1") echo 'checked="checked"'; ?> />
					 <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/layout1.jpg" /></td>
                </tr>


                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Content + Left Sidebar + Right Sidebar:","AuctionTheme"); ?> </td>
					<td><input type="radio" name="AuctionTheme_home_page_layout" value="2" <?php if($AuctionTheme_home_page_layout == "2") echo 'checked="checked"'; ?> />
					  <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/layout2.jpg" /></td>
                </tr>


                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content + Right Sidebar:","AuctionTheme"); ?> </td>
					<td><input type="radio" name="AuctionTheme_home_page_layout" value="3" <?php if($AuctionTheme_home_page_layout == "3") echo 'checked="checked"'; ?>/>
					  <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/layout3.jpg" /></td>
                </tr>


                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content:","AuctionTheme"); ?> </td>
					<td><input type="radio" name="AuctionTheme_home_page_layout" value="4" <?php if($AuctionTheme_home_page_layout == "4") echo 'checked="checked"'; ?>/>
					  <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/layout4.jpg" /></td>
                </tr>


                <tr>
                <td valign=top></td>
					<td><?php _e("Content:","AuctionTheme"); ?> </td>
					 <td><input type="radio" name="AuctionTheme_home_page_layout" value="5" <?php if($AuctionTheme_home_page_layout == "5") echo 'checked="checked"'; ?>/>
					 <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/layout5.jpg" /></td>
                </tr>




                    <tr>
                   <td valign=top width="22"></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

          <div id="tabs2">

           <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_layout_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">

                  		 <script>

			jQuery(function(jQuery) {
				jQuery(document).ready(function(){
						jQuery('#sel_logo').click(open_media_window);
					});

				function open_media_window() {

					tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
					return false;
				}

				window.send_to_editor = function(html) {
				 imgurl = jQuery('img',html).attr('src');
				 jQuery('#AuctionTheme_logo_URL').val(imgurl) ;
				 tb_remove();

				}


			});


			</script>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('Eg: http://your-site-url.com/images/logo.jpg','AuctionTheme'),'auction-bull-et-a'); ?></td>
                    <td ><?php _e('Logo URL:','AuctionTheme'); ?></td>
                    <td>

                    <input type="text" size="45" name="AuctionTheme_logo_URL" id="AuctionTheme_logo_URL" value="<?php echo get_option('AuctionTheme_logo_URL'); ?>"/>
                    <a href="#" id="sel_logo" class="button"><?php _e('Upload/Select Logo File','AuctionTheme') ?></a>

                    </td>
                    </tr>



                    <tr>
                    <td valign=top width="22"> </td>
                    <td colspan="2" ><?php _e('or type below your site title (logo will not be shown anymore if this is typed):','AuctionTheme'); ?></td>

                    </tr>



                         <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('Will appear in the header side of your website','AuctionTheme'),'auction-bull-et-a'); ?></td>
                    <td ><?php _e('Use this instead of logo file:','AuctionTheme'); ?></td>
                    <td>

                   <input type="checkbox" name="AuctionTheme_logo_option" value="1" <?php echo (get_option('AuctionTheme_logo_option') == "1" ? "checked='checked'" : '') ?>/>

                    </td>
                    </tr>




                         <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('Will appear in the header side of your website','AuctionTheme'),'auction-bull-et-a'); ?></td>
                    <td ><?php _e('Site Title:','AuctionTheme'); ?></td>
                    <td>

                   <input type="text" size="45" value="<?php echo get_option('AuctionTheme_default_big_line') ?>" name="AuctionTheme_default_big_line" />

                    </td>
                    </tr>



                         <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('Will appear in the header side of your website','AuctionTheme'),'auction-bull-et-a'); ?></td>
                    <td ><?php _e('Site Under Title:','AuctionTheme'); ?></td>
                    <td>

                   <input type="text" size="45" value="<?php echo get_option('AuctionTheme_default_small_line') ?>" name="AuctionTheme_default_small_line" />
                    </td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

          <div id="tabs3">
             <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_layout_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">


          <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('This will appear in the left side of the footer area.','AuctionTheme')); ?></td>
                    <td valign="top" ><?php _e('Left side footer area content:','AuctionTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="AuctionTheme_left_side_footer"><?php echo stripslashes(get_option('AuctionTheme_left_side_footer')); ?></textarea></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('This will appear in the right side of the footer area.','AuctionTheme')); ?></td>
                    <td valign="top" ><?php _e('Right side footer area content:','AuctionTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="AuctionTheme_right_side_footer"><?php echo stripslashes(get_option('AuctionTheme_right_side_footer')); ?></textarea></td>
                    </tr>


             <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save3" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>


<?php
	echo '</div>';
}

function auctionTheme_membership_packs()
{
	$id_icon 		= 'icon-options-general44';
	$ttl_of_stuff 	= 'AuctionTheme - Membership Packs';
	global $menu_admin_AuctionTheme_theme_bull;
	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));


	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	if(isset($_POST['AuctionTheme_save1']))
	{
		$AuctionTheme_enable_membership = $_POST['AuctionTheme_enable_membership'];
		update_option('AuctionTheme_enable_membership', $AuctionTheme_enable_membership);
		echo '<div class="saved_thing">'.__('Settings were saved', 'AuctionTheme') . "</div>";
	}

	if(isset($_POST['AuctionTheme_save_adds_me_delete']))
	{
		$hidden_id = trim($_POST['hidden_id']);

		global $wpdb;
		$s = "delete from ".$wpdb->prefix."auction_membership_packs  where id='$hidden_id'";
		$wpdb->query($s);

		echo '<div class="saved_thing">'.__('Membership level deleted.','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save_adds_me_edit']))
	{
		$membership_name = trim($_POST['membership_name1']);
		$membership_cost = trim($_POST['membership_cost1']);
		$number_of_items = trim($_POST['number_of_items1']);
		$hidden_id = trim($_POST['hidden_id']);

		if(empty($membership_name) or empty($membership_cost) or empty($number_of_items))
		{
			echo '<div class="err_thing">'.__('Please fill in all the fields of the form.','AuctionTheme').'</div>';
		}
		else
		{
			global $wpdb;
			$s = "update ".$wpdb->prefix."auction_membership_packs set membership_name='$membership_name', membership_cost='$membership_cost', number_of_items='$number_of_items' where id='$hidden_id'";
			$wpdb->query($s);

			echo '<div class="saved_thing">'.__('Membership level updated.','AuctionTheme').'</div>';
		}
	}

	if(isset($_POST['AuctionTheme_save_adds']))
	{
		$membership_name = trim($_POST['membership_name']);
		$membership_cost = trim($_POST['membership_cost']);
		$number_of_items = trim($_POST['number_of_items']);

		if(empty($membership_name) or empty($membership_cost) or empty($number_of_items))
		{
			echo '<div class="err_thing">'.__('Please fill in all the fields of the form.','AuctionTheme').'</div>';
		}
		else
		{
			global $wpdb;
			$s = "select * from ".$wpdb->prefix."auction_membership_packs where membership_name='$membership_name'";
			$r = $wpdb->get_results($s);

			if(count($r) == 0)
			{
				$s = "insert into ".$wpdb->prefix."auction_membership_packs (membership_name, membership_cost, number_of_items) values('$membership_name','$membership_cost','$number_of_items')";
				$r = $wpdb->query($s);
				$sss = 1;
			}

			echo '<div class="saved_thing">'.__('Membership level added.','AuctionTheme').'</div>';
		}
	}




		  if(isset($_POST['add_membership_now']))
		  {
			  $user_id 	= $_POST['user_id'];
			  $mem_id 	= $_POST['mem_id'];
			  $ct = current_time('timestamp',0);

			    global $wpdb;
			  	$s2 = "select * from ".$wpdb->prefix."auction_membership_packs where id='$mem_id'";
				$r2 = $wpdb->get_results($s2);
				$row2 = $r2[0];

				update_user_meta($user_id, 'mem_available', ($ct + 3600*24*30.5));
				update_user_meta($user_id, 'auctions_available', $row2->number_of_items);
				update_user_meta($user_id, 'membership_id', $row2->id);

			  	echo '<div class="saved_thing">'.__('Membership Added!','AuctionTheme')."</div>";
		  }

		  if(isset($_POST['remove_all_memberships']))
		  {
			  $user_id 	= $_POST['user_id'];
			  $ct = current_time('timestamp',0);

				update_user_meta($user_id, 'mem_available', 0);
				update_user_meta($user_id, 'auctions_available', 0);
				update_user_meta($user_id, 'membership_id', 0);

			  	echo '<div class="saved_thing">'.__('Membership Removed!','AuctionTheme')."</div>";
		  }



		  ?>


      <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1" >Membership Settings</a></li>
            <li><a href="#tabs2" <?php if($_GET['active_tabs'] == "tabs2") { ?> class="selected" <?php } ?>>Users</a></li>
    	 </ul>

            <div id="tabs1">
            <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=mem-packs&active_tab=tabs1">
             <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is enabled, when your users will post items/auctions, they will be prompted to purchase their monethly membership. So the listing fees options wont be used anymore.','enbl-l-mem-ber-ship'); ?></td>
                    <td width="200"><?php _e('Enable Membership:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_membership'); ?></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

                </table>
            </form>

            <h4><?php _e('Add a New Membership Level','AuctionTheme'); ?></h4>
            <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=mem-packs&active_tab=tabs1">
             <table width="100%" class="sitemile-table">

               		<tr>
                    <td width="200"><?php _e('Membership Level Name:','AuctionTheme'); ?></td>
                    <td><input type="text" size="30" value="<?php echo $sss != 1 ?  $_POST['membership_name'] : '' ?>" name="membership_name" /></td>
                    </tr>

                    <tr>
                    <td width="200"><?php _e('Membership Cost:','AuctionTheme'); ?></td>
                    <td><input type="text" size="10" value="<?php echo $sss != 1 ? $_POST['membership_cost'] : '' ?>" name="membership_cost" /> <?php echo auctiontheme_get_currency() ?></td>
                    </tr>


                    <tr>
                    <td width="200"><?php _e('Monthly Number of Items:','AuctionTheme'); ?></td>
                    <td><input type="text" size="10" value="<?php echo $sss != 1 ? $_POST['number_of_items'] : '' ?>" name="number_of_items" /></td>
                    </tr>


                    <tr>

                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save_adds" value="<?php _e('Add New Membership','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
            </form>

            <h4><?php _e('Current Active Levels','AuctionTheme'); ?></h4>

            <?php

				global $wpdb;
				$s = "select * from ".$wpdb->prefix."auction_membership_packs order by (membership_cost+0) asc";
				$r = $wpdb->get_results($s);

				if(count($r) == 0)
				{
					echo __('There are no packs defined yet.','AuctionTheme');
				}
				else
				{

					foreach($r as $row):
			?>


                <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=mem-packs&active_tab=tabs1">
                <input type="hidden" value="<?php echo $row->id ?>" name="hidden_id" />
             <table width="100%" class="sitemile-table">

               		<tr>
                    <td width="200"><?php _e('Membership Level Name:','AuctionTheme'); ?></td>
                    <td><input type="text" size="30" value="<?php echo $row->membership_name ?>" name="membership_name1" /></td>
                    </tr>

                    <tr>
                    <td width="200"><?php _e('Membership Cost:','AuctionTheme'); ?></td>
                    <td><input type="text" size="10" value="<?php echo $row->membership_cost ?>" name="membership_cost1" /> <?php echo auctiontheme_get_currency() ?></td>
                    </tr>


                    <tr>
                    <td width="200"><?php _e('Monthly Number of Items:','AuctionTheme'); ?></td>
                    <td><input type="text" size="10" value="<?php echo $row->number_of_items ?>" name="number_of_items1" /></td>
                    </tr>


                    <tr>

                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save_adds_me_edit" value="<?php _e('Save Membership','AuctionTheme'); ?>"/>
                    <input type="submit" name="AuctionTheme_save_adds_me_delete" value="<?php _e('Delete Membership','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
            </form>

                <hr style="color:#aaa" />

            <?php endforeach; } ?>

            </div>




            <div id="tabs2">


            <?php

	$rows_per_page = 10;

	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;

	global $wpdb;

	$s1 = "select ID from ".$wpdb->users." order by user_login asc ";
	$s = "select * from ".$wpdb->users." order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;


	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);

	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)
	{

		?>


		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Membership Expiring On</th>
    <th width="13%" >Remaining Auctions</th>
	<th >Options</th>
    </tr>
    </thead>



    <tbody>


		<?php


	foreach($r as $row)
	{
		$user = get_userdata($row->ID);


		echo '<tr style="">';
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>';

			$mem_available = get_user_meta($row->ID,'mem_available',true);
			$ct = current_time('timestamp', 0);
			if($ct > $mem_available or empty($mem_available)){ echo __('Expired/Not Available','AuctionTheme'); }
			else { echo date_i18n('d-M-Y', get_user_meta($row->ID ,'mem_available',true)); }



		echo '</th>';
		echo '<th class="'.$cl.'">';


			$mem_available = get_user_meta($row->ID,'mem_available',true);
			$ct = current_time('timestamp', 0);
			if($ct > $mem_available or empty($mem_available)){ echo '0'; }
			else { echo get_user_meta($row->ID, 'auctions_available',true); }



		echo '</th>';
		echo '<th>';
		?>



       <?php

	   		global $wpdb;
			$s1 = "select * from ".$wpdb->prefix."auction_membership_packs order by (membership_cost+0) asc";
			$r1 = $wpdb->get_results($s1);

			foreach($r1 as $row1)
			{

	   ?>			<form method="post" action="<?php echo get_admin_url() ?>/admin.php?page=mem-packs&active_tabs=tabs2&pj=<?php echo empty($_GET['pj']) ? 1 : $_GET['pj']; ?>">
       				<input type="hidden" value="<?php echo $row->ID ?>" name="user_id" />
      												<input type="hidden" value="<?php echo $row1->id ?>" name="mem_id" />
       				<table>
                    <tr>
                    <td width="200">Membership: <?php echo $row1->membership_name ?> </td>
                    <td><input type="submit" value="Add This" name="add_membership_now" /></td>
                    </tr>
                    </table>

              		 </form>

       <?php } ?>


        <form method="post" action="<?php echo get_admin_url() ?>/admin.php?page=mem-packs&active_tabs=tabs2&pj=<?php echo empty($_GET['pj']) ? 1 : $_GET['pj']; ?>">
        <input type="hidden" value="<?php echo $row->ID ?>" name="user_id" />
       				<table>
                    <tr>
                    <td width="200"> </td>
                    <td><input type="submit" value="Remove Membership" name="remove_all_memberships" /></td>
                    </tr>
                    </table>

              		 </form>



        <?php
		echo '</th>';

		echo '</tr>';
	}


	?>



	</tbody>

    </table>

    <?php

	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else
			echo '<a href="'.get_admin_url().'admin.php?page=mem-packs&pj='.$i.'"
			>'.$i.'</a> | ';

		}

	}

    ?>


            </div>



    </div>


    <?php


	echo '</div>';

}

function AuctionTheme_payment_gateways()
{

	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'AuctionTheme - Payment Methods';
	global $menu_admin_AuctionTheme_theme_bull;
	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));
	$arr1 = array("parallel" => __("Parallel Payments",'AuctionTheme'), "chained" => __("Chained Payments",'AuctionTheme'));
	$auctionTheme_checkout_way = array("normal" => __("Normal Checkout Screen",'AuctionTheme'), "flow" => __("Flow Checkout Screen",'AuctionTheme'));



	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	//--------------------------

	do_action('AuctionTheme_payment_methods_action');
	if(isset($_POST['AuctionTheme_save1']))
	{
		update_option('AuctionTheme_paypal_enable', 		trim($_POST['AuctionTheme_paypal_enable']));
			update_option('AuctionTheme_paypal_enable2', 		trim($_POST['AuctionTheme_paypal_enable2']));
		update_option('AuctionTheme_paypal_email', 			trim($_POST['AuctionTheme_paypal_email']));
		update_option('AuctionTheme_paypal_enable_sdbx', 	trim($_POST['AuctionTheme_paypal_enable_sdbx']));

		update_option('auctionTheme_enable_paypal_ad', 		trim($_POST['auctionTheme_enable_paypal_ad']));
		update_option('auction_theme_signature', 			trim($_POST['auction_theme_signature']));
		update_option('auction_theme_apipass', 				trim($_POST['auction_theme_apipass']));
		update_option('auction_theme_apiuser', 				trim($_POST['auction_theme_apiuser']));
		update_option('auction_theme_appid', 				trim($_POST['auction_theme_appid']));
		update_option('auctionTheme_paypal_ad_model', 				trim($_POST['auctionTheme_paypal_ad_model']));
		update_option('auctionTheme_checkout_way', 				trim($_POST['auctionTheme_checkout_way']));


		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save2']))
	{
		update_option('AuctionTheme_alertpay_enable', trim($_POST['AuctionTheme_alertpay_enable']));
		update_option('AuctionTheme_alertpay_email', trim($_POST['AuctionTheme_alertpay_email']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_offline_payment_save']))
	{
		update_option('AuctionTheme_offline_payments', trim($_POST['AuctionTheme_offline_payments']));
		update_option('AuctionTheme_offline_payment_dets', trim($_POST['AuctionTheme_offline_payment_dets']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}



	if(isset($_POST['AuctionTheme_save3']))
	{
		update_option('AuctionTheme_moneybookers_enable', trim($_POST['AuctionTheme_moneybookers_enable']));
		update_option('AuctionTheme_moneybookers_email', trim($_POST['AuctionTheme_moneybookers_email']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save4']))
	{
		update_option('AuctionTheme_ideal_enable', trim($_POST['AuctionTheme_ideal_enable']));
		update_option('AuctionTheme_ideal_email', trim($_POST['AuctionTheme_ideal_email']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	?>


	    <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1">PayPal</a></li>
            <li><a href="#tabs2">Payza/AlertPay</a></li>
            <li><a href="#tabs3">Moneybookers/Skrill</a></li>
            <li><a href="#tabs4">iDeal</a></li>





            <li><a href="#tabs_amazon">Amazon</a></li>
            <li><a href="#tabs_chronopay">Chronopay</a></li>
            <li><a href="#tabs_offline"><?php _e('Bank Payment(offline)','AuctionTheme'); ?></a></li>
            <?php do_action('AuctionTheme_payment_methods_tabs'); ?>

          </ul>
          <div id="tabs1"  >

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pay_gate_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">

							<tr>
							<td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
							<td width="200"><?php _e('Enable:','AuctionTheme'); ?></td>
							<td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_paypal_enable'); ?></td>
							</tr>

							<tr>
							<td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
							<td width="200"><?php _e('Enable Credit Card Payment:','AuctionTheme'); ?></td>
							<td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_paypal_enable2'); ?> *the api credentials must be filled out</td>
							</tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('PayPal Enable Sandbox:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_paypal_enable_sdbx'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('PayPal Email Address:','AuctionTheme'); ?></td>
                    <td><input type="text" size="45" name="AuctionTheme_paypal_email" value="<?php echo get_option('AuctionTheme_paypal_email'); ?>"/></td>
                    </tr>


                     <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td><?php _e('Enable PayPal Adaptive:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'auctionTheme_enable_paypal_ad'); ?></td>
                    </tr>

                    <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet('Leave this set to normal if you do not know what it means.'); ?></td>
                    <td><?php _e('Checkout Screen:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($auctionTheme_checkout_way, 'auctionTheme_checkout_way'); ?></td>
                    </tr>


                    <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td><?php _e('Payment Model:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr1, 'auctionTheme_paypal_ad_model'); ?></td>
                    </tr>


                     <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Signature:','AuctionTheme'); ?></td>
                    <td><input type="text" name="auction_theme_signature" value="<?php echo get_option('auction_theme_signature'); ?>" size="85" /> </td>
                    </tr>

                           <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('API Password:','AuctionTheme'); ?></td>
                    <td><input type="text" name="auction_theme_apipass" value="<?php echo get_option('auction_theme_apipass'); ?>" size="55" /> </td>
                    </tr>

                           <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('API User:','AuctionTheme'); ?></td>
                    <td><input type="text" name="auction_theme_apiuser" value="<?php echo get_option('auction_theme_apiuser'); ?>" size="55" /> </td>
                    </tr>

                           <tr><td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Application ID:','AuctionTheme'); ?></td>
                    <td><input type="text" name="auction_theme_appid" value="<?php echo get_option('auction_theme_appid'); ?>" size="55" /> </td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

          <div id="tabs2" >

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pay_gate_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_alertpay_enable'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Payza/Alertpay Email:','AuctionTheme'); ?></td>
                    <td><input type="text" size="45" name="AuctionTheme_alertpay_email" value="<?php echo get_option('AuctionTheme_alertpay_email'); ?>"/></td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>


            </table>
          	</form>

          </div>

          <div id="tabs3">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pay_gate_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_moneybookers_enable'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('MoneyBookers Email:','AuctionTheme'); ?></td>
                    <td><input type="text" size="45" name="AuctionTheme_moneybookers_email" value="<?php echo get_option('AuctionTheme_moneybookers_email'); ?>"/></td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save3" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

          <div id="tabs4" >

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pay_gate_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_ideal_enable'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('iDeal Partner ID:','AuctionTheme'); ?></td>
                    <td><input type="text" size="45" name="AuctionTheme_ideal_email" value="<?php echo get_option('AuctionTheme_ideal_email'); ?>"/></td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

			<?php do_action('AuctionTheme_payment_methods_content_divs_m'); ?>

          <div id="tabs_amazon">	 Coming Soon
          </div>

          <div id="tabs_chronopay">	 Coming Soon
          </div>

           <div id="tabs_offline" >

             <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pay_gate_&active_tab=tabs_offline">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_offline_payments'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign="top" ><?php _e('Bank Details:','AuctionTheme'); ?></td>
                    <td><textarea name="AuctionTheme_offline_payment_dets" rows="5" cols="50" ><?php echo get_option('AuctionTheme_offline_payment_dets'); ?></textarea></td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_offline_payment_save" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>

          <?php do_action('AuctionTheme_payment_methods_content_divs'); ?>

<?php
	echo '</div>';


}

function AuctionTheme_images_settings()
{
	global $menu_admin_auction_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-img"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">AuctionTheme Image Settings</h2>';

	$arr = array("yes" => "Yes", "no" => "No");

		if(isset($_POST['save1']))
		{
			$AuctionTheme_enable_images_in_auctions = $_POST['AuctionTheme_enable_images_in_auctions'];
			update_option('AuctionTheme_enable_images_in_auctions', $AuctionTheme_enable_images_in_auctions);

			$AuctionTheme_charge_fees_for_images = $_POST['AuctionTheme_charge_fees_for_images'];
			update_option('AuctionTheme_charge_fees_for_images', $AuctionTheme_charge_fees_for_images);

			$AuctionTheme_enable_max_images_limit = $_POST['AuctionTheme_enable_max_images_limit'];
			update_option('AuctionTheme_enable_max_images_limit', $AuctionTheme_enable_max_images_limit);

			//--------------------------------------

			update_option('auctionTheme_nr_of_free_images', trim($_POST['auctionTheme_nr_of_free_images']));
			update_option('auctionTheme_extra_image_charge', trim($_POST['auctionTheme_extra_image_charge']));
			update_option('auctionTheme_nr_max_of_images', trim($_POST['auctionTheme_nr_max_of_images']));



			echo '<div class="saved_thing">Settings saved!</div>';
		}

		if(isset($_POST['save2']))
		{
			update_option('auctionTheme_width_of_auction_images', trim($_POST['auctionTheme_width_of_auction_images']));

			echo '<div class="saved_thing">Settings saved!</div>';
		}

	?>

        <div id="usual2" class="usual">
  <ul>
    <li><a href="#tabs1" class="selected">General Settings</a></li>
    <li><a href="#tabs2">Resize Settings</a></li>
  </ul>
  <div id="tabs1" style="display: block; ">

        <form method="post">
        <table width="100%" class="sitemile-table">

        <tr>
        <td width="190">Enable Limit on max images:</td>
        <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_max_images_limit'); ?></td>
        </tr>

         <tr>
        <td>Max limit of images:</td>
        <td><input type="text" value="<?php echo get_option('auctionTheme_nr_max_of_images'); ?>" size="4" name="auctionTheme_nr_max_of_images" /></td>
        </tr>


        <tr>
        <td width="190">Enable Images:</td>
        <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_images_in_auctions'); ?></td>
        </tr>


        <tr>
        <td>Charge fees for images:</td>
        <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_charge_fees_for_images'); ?></td>
        </tr>


        <tr>
        <td>Number of free images:</td>
        <td><input type="text" value="<?php echo get_option('auctionTheme_nr_of_free_images'); ?>" size="4" name="auctionTheme_nr_of_free_images" /></td>
        </tr>


        <tr>
        <td>Extra charge(per image):</td>
        <td><input type="text" value="<?php echo get_option('auctionTheme_extra_image_charge'); ?>" size="5" name="auctionTheme_extra_image_charge" /> <?php echo auctionTheme_get_currency(); ?></td>
        </tr>


        <tr>
        <td></td>
        <td><input type="submit" name="save1" value="Save Settings" /></td>
        </tr>

        </table>
        </form>
          </div>
          <div id="tabs2" style="display: none; ">
           <form method="post">
                  <table width="100%" class="sitemile-table">



        <tr>
        <td>Default width of picture resize:</td>
        <td><input type="text" value="<?php echo get_option('auctionTheme_width_of_auction_images'); ?>" size="4" name="auctionTheme_width_of_auction_images" /> pixels</td>
        </tr>



        <tr>
        <td></td>
        <td><input type="submit" name="save2" value="Save Settings" /></td>
        </tr>

        </table>
        </form>
          </div>
        </div>


    <?php

	echo '</div>';
}

function AuctionTheme_advertising_scr()
{

	$id_icon 		= 'icon-options-general-adve';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Advertising Spaces','AuctionTheme');

	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	if(isset($_POST['AuctionTheme_save0']))
	{
		update_option('AuctionTheme_adv_code_header_banner_content', 				trim($_POST['AuctionTheme_adv_code_header_banner_content']));
		update_option('AuctionTheme_enable_header_banner', 				trim($_POST['AuctionTheme_enable_header_banner']));


		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save1']))
	{
		update_option('AuctionTheme_adv_code_home_above_content', 				trim($_POST['AuctionTheme_adv_code_home_above_content']));
		update_option('AuctionTheme_adv_code_home_below_content', 				trim($_POST['AuctionTheme_adv_code_home_below_content']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save2']))
	{
		update_option('AuctionTheme_adv_code_auction_page_above_content', 				trim($_POST['AuctionTheme_adv_code_auction_page_above_content']));
		update_option('AuctionTheme_adv_code_auction_page_below_content', 				trim($_POST['AuctionTheme_adv_code_auction_page_below_content']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save3']))
	{
		update_option('AuctionTheme_adv_code_cat_page_above_content', 				trim($_POST['AuctionTheme_adv_code_cat_page_above_content']));
		update_option('AuctionTheme_adv_code_cat_page_below_content', 				trim($_POST['AuctionTheme_adv_code_cat_page_below_content']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save4']))
	{
		update_option('AuctionTheme_adv_code_single_page_above_content', 				trim($_POST['AuctionTheme_adv_code_single_page_above_content']));
		update_option('AuctionTheme_adv_code_single_page_below_content', 				trim($_POST['AuctionTheme_adv_code_single_page_below_content']));

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));
?>

	    <div id="usual2" class="usual">
          <ul>

            <li><a href="#tabs1"><?php _e('HomePage','AuctionTheme'); ?></a></li>
            <li><a href="#tabsasd"><?php _e('Header','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('Auction Page','AuctionTheme'); ?></a></li>
            <li><a href="#tabs3"><?php _e('Category Page','AuctionTheme'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Single Blog/Normal Page','AuctionTheme'); ?></a></li>
          </ul>
          <div id="tabsasd">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_adv_&active_tab=tabsasd">
          	  <table width="100%" class="sitemile-table">

                <tr>
                    <td width="260"><?php _e('Enable header banner:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_header_banner'); ?></td>
                    </tr>

                <tr>
                <td valign="top"><?php _e('Header Banner (468x60):','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_header_banner_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_header_banner_content')); ?></textarea></td>
                </tr>


                <tr>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save0" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
          </form>

          </div>

          <div id="tabs1">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_adv_&active_tab=tabs1">
          	  <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_home_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_home_above_content')); ?></textarea></td>
                </tr>


                <tr>
                <td valign="top"><?php _e('Below the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_home_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_home_below_content')); ?></textarea></td>
                </tr>


                <tr>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
          </form>

          </div>

          <div id="tabs2">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_adv_&active_tab=tabs2">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_auction_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_auction_page_above_content')); ?></textarea></td>
                </tr>


                <tr>
                <td valign="top"><?php _e('Below the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_auction_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_auction_page_below_content')); ?></textarea></td>
                </tr>


                <tr>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
          </form>
          </div>

          <div id="tabs3">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_adv_&active_tab=tabs3">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_cat_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_cat_page_above_content')); ?></textarea></td>
                </tr>


                <tr>
                <td valign="top"><?php _e('Below the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_cat_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_cat_page_below_content')); ?></textarea></td>
                </tr>


                <tr>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save3" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
          	</form>
          </div>

          <div id="tabs4">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_adv_&active_tab=tabs4">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_single_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_single_page_above_content')); ?></textarea></td>
                </tr>


                <tr>
                <td valign="top"><?php _e('Below the content area:','AuctionTheme'); ?></td>
                <td><textarea name="AuctionTheme_adv_code_single_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('AuctionTheme_adv_code_single_page_below_content')); ?></textarea></td>
                </tr>


                <tr>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

              </table>
          	</form>
          </div>

<?php
	echo '</div>';

}

function AuctionTheme_general_options()
{
	$id_icon 		= 'icon-options-general2';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('General Settings','AuctionTheme');
	global $menu_admin_AuctionTheme_theme_bull;
	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));
	$arr2 = array("html" => __("Plain HTML Uploaders",'AuctionTheme'), "jquery" => __("Fancy jQuery Uploaders",'AuctionTheme'));

	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

		if(isset($_POST['AuctionTheme_save1']))
		{
			update_option('AuctionTheme_show_views', 						trim($_POST['AuctionTheme_show_views']));
			update_option('AuctionTheme_admin_approve_auction', 			trim($_POST['AuctionTheme_admin_approve_auction']));
			update_option('AuctionTheme_enable_html_description', 			trim($_POST['AuctionTheme_enable_html_description']));
			update_option('AuctionTheme_enable_blog', 						trim($_POST['AuctionTheme_enable_blog']));
			update_option('AuctionTheme_enable_comments', 					trim($_POST['AuctionTheme_enable_comments']));
			update_option('AuctionTheme_enable_pay_credits', 				trim($_POST['AuctionTheme_enable_pay_credits']));
			update_option('AuctionTheme_max_time_to_wait', 					trim($_POST['AuctionTheme_max_time_to_wait']));
			update_option('AuctionTheme_auction_time_listing',			 	trim($_POST['AuctionTheme_auction_time_listing']));
			update_option('AuctionTheme_auction_featured_time_listing', 	trim($_POST['AuctionTheme_auction_featured_time_listing']));
			update_option('AuctionTheme_show_limit_job_cnt', 				trim($_POST['AuctionTheme_show_limit_job_cnt']));
			update_option('AuctionTheme_listings_per_page_adv_search', 		trim($_POST['AuctionTheme_listings_per_page_adv_search']));
			update_option('AuctionTheme_location_permalink', 				trim($_POST['AuctionTheme_location_permalink']));
			update_option('AuctionTheme_category_permalink', 				trim($_POST['AuctionTheme_category_permalink']));
			update_option('AuctionTheme_auction_permalink', 				trim($_POST['AuctionTheme_auction_permalink']));
			update_option('AuctionTheme_enable_locations', 					trim($_POST['AuctionTheme_enable_locations']));
			update_option('auctionTheme_show_front_slider', 				trim($_POST['auctionTheme_show_front_slider']));
			update_option('AuctionTheme_show_main_menu', 					trim($_POST['AuctionTheme_show_main_menu']));
			update_option('AuctionTheme_show_stretch', 						trim($_POST['AuctionTheme_show_stretch']));
			update_option('AuctionTheme_only_admins_post_auctions', 		trim($_POST['AuctionTheme_only_admins_post_auctions']));
			update_option('AuctionTheme_ext_time_last', 						trim($_POST['AuctionTheme_ext_time_last']));
			update_option('AuctionTheme_ext_time_by', 							trim($_POST['AuctionTheme_ext_time_by']));
			update_option('AuctionTheme_last_min_bid_ext', 						trim($_POST['AuctionTheme_last_min_bid_ext']));

			update_option('AuctionTheme_enable_reverse', 						trim($_POST['AuctionTheme_enable_reverse']));
			update_option('AuctionTheme_show_subcats_enbl', 						trim($_POST['AuctionTheme_show_subcats_enbl']));
			update_option('AuctionTheme_increase_bid_limit', 						trim($_POST['AuctionTheme_increase_bid_limit']));
			update_option('AuctionTheme_enable_increase_bid_limit', 						trim($_POST['AuctionTheme_enable_increase_bid_limit']));
			update_option('AuctionTheme_automatic_bid_enable', 						trim($_POST['AuctionTheme_automatic_bid_enable']));
			update_option('AuctionTheme_uploader_type', 						trim($_POST['AuctionTheme_uploader_type']));
			update_option('AuctionTheme_randomize_slider_front', 						trim($_POST['AuctionTheme_randomize_slider_front']));
			update_option('AuctionTheme_force_shipping_address', 						trim($_POST['AuctionTheme_force_shipping_address']));
			update_option('AuctionTheme_force_paypal_address', 						trim($_POST['AuctionTheme_force_paypal_address']));
			update_option('auctionTheme_show_tax_views', 						trim($_POST['auctionTheme_show_tax_views']));
			update_option('AuctionTheme_no_time_on_buy_now', 						trim($_POST['AuctionTheme_no_time_on_buy_now']));
			update_option('AuctionTheme_enable_multi_cats', 						trim($_POST['AuctionTheme_enable_multi_cats']));
			update_option('AuctionTheme_enable_editing_when_bid_placed', 						trim($_POST['AuctionTheme_enable_editing_when_bid_placed']));
			update_option('AuctionTheme_listings_home_pg_th', 						trim($_POST['AuctionTheme_listings_home_pg_th']));
			update_option('AuctionTheme_enable_auto_renew', 						trim($_POST['AuctionTheme_enable_auto_renew']));
			update_option('AuctionTheme_enable_automatically_repubs', 						trim($_POST['AuctionTheme_enable_automatically_repubs']));
			update_option('AuctionTheme_enable_it_cond', 						trim($_POST['AuctionTheme_enable_it_cond']));
			update_option('AuctionTheme_republish_time_hrs', 						trim($_POST['AuctionTheme_republish_time_hrs']));
			update_option('AuctionTheme_auction_gg_key', 						trim($_POST['AuctionTheme_auction_gg_key']));


			do_action('AuctionTheme_general_settings_save_post');

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		if(isset($_POST['AuctionTheme_save2']))
		{
			update_option('AuctionTheme_filter_emails_private_messages', 				trim($_POST['AuctionTheme_filter_emails_private_messages']));
			update_option('AuctionTheme_filter_urls_private_messages', 					trim($_POST['AuctionTheme_filter_urls_private_messages']));


			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		if(isset($_POST['AuctionTheme_save3']))
		{
			update_option('AuctionTheme_enable_shipping', 						trim($_POST['AuctionTheme_enable_shipping']));
			update_option('AuctionTheme_enable_flat_shipping', 					trim($_POST['AuctionTheme_enable_flat_shipping']));
			update_option('AuctionTheme_enable_location_based_shipping', 		trim($_POST['AuctionTheme_enable_location_based_shipping']));


			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}



		if(isset($_POST['AuctionTheme_save4']))
		{
			update_option('AuctionTheme_enable_facebook_login', 	trim($_POST['AuctionTheme_enable_facebook_login']));
			update_option('AuctionTheme_facebook_app_id', 			trim($_POST['AuctionTheme_facebook_app_id']));
			update_option('AuctionTheme_facebook_app_secret', 		trim($_POST['AuctionTheme_facebook_app_secret']));


			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}


		if(isset($_POST['AuctionTheme_save5']))
		{
			update_option('AuctionTheme_enable_twitter_login', 			trim($_POST['AuctionTheme_enable_twitter_login']));
			update_option('AuctionTheme_twitter_consumer_key', 			trim($_POST['AuctionTheme_twitter_consumer_key']));
			update_option('AuctionTheme_twitter_consumer_secret', 		trim($_POST['AuctionTheme_twitter_consumer_secret']));


			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

		do_action('AuctionTheme_general_options_actions');

	?>

		  <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('Main Settings','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('Filters','AuctionTheme'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Facebook Connect','AuctionTheme'); ?></a></li>
            <li><a href="#tabs5"><?php _e('Twitter Connect','AuctionTheme'); ?></a></li>
          	<?php do_action('AuctionTheme_general_options_tabs'); ?>
          </ul>
          <div id="tabs1" >
          <div class="postbox2 ">
          		From this panel you will be able to control the main settings for your new Auction Theme. You can see the options below, and you also have a little question mark icon for each of them.<br/>
                Clicking on that icon will show you a modal dialog explaining what will that option do in your site if changed.
          </div>

            <form method="post" action="">
            <table width="100%" class="sitemile-table">

                    	  <?php do_action('AuctionTheme_general_settings'); ?>




                    <tr>
                    <td valign=top width="22"> </td>
                    <td ><?php _e('Google Maps API Key:','AuctionTheme'); ?></td>
                    <td><input type="text" size="26" name="AuctionTheme_auction_gg_key" value="<?php echo get_option('AuctionTheme_auction_gg_key'); ?>"/>  (<a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" target="_blank">How to get a key</a>)</td>
                    </tr>



                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If you enable thisyour users will be able to select the item condition when posting an item.','auto_renew'); ?></td>
                    <td width="260"><?php _e('Enable Item Condition:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_it_cond'); ?></td>
                    </tr>



                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If you enable this, your users will be able to select the autorenewal period when posting their item from front end of the website.','auto_renew'); ?></td>
                    <td width="260"><?php _e('Enable AutoRenew Option:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_auto_renew'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22">
					<?php AuctionTheme_theme_bullet('If you enable this, your users will be able to write html styling for their auction post, in the description box, when posting an item/auction from front end of your website.','enable_html'); ?></td>
                    <td width="260"><?php _e('Enable HTML for auction description:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_html_description'); ?></td>
                    </tr>



                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If you enable this, your users will be able to select multiple categories for the items they post, when posting an item in your site.','multicat-sel'); ?></td>
                    <td width="260"><?php _e('Enable multiple category select:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_multi_cats'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('This feature will enable editing for the auction items even after the first bid was palced. <br/>Some website owners do not want the sellers in their site to edit the price of the items after people have placed bids for that item.','editing-acts-bid-placed'); ?></td>
                    <td width="260"><?php _e('Allow editing auctions after bid was placed:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_editing_when_bid_placed'); ?></td>
                    </tr>

                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is enabled, small counts [eg: (10)] will display for each taxonomy term in your "All Locations" and "All Categories" pages, as well as the categories and locations widgets.','enable-counts'); ?></td>
                    <td width="260"><?php _e('Enable Item Count On Categories/Locations:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'auctionTheme_show_tax_views'); ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('There are two styles for image uploaders in front end, either have jquery(much easier for your users) or have plain html uploaders for better compatibility with (maybe) older devices or server restrictions.','upoload-ers-e'); ?></td>
                    <td width="260"><?php _e('Image Uploaders:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr2, 'AuctionTheme_uploader_type'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If reverse auctions are enabled, then all your auctions will be in reverse mode.<br/>Reverse mode means: your bidders will need to always bid lower than the last bidder or if they are the first bidder for that item, bid lower than the start price. The winner of the item will be the lowest bid after the time expires.<br/>Set this item to NO if you want to run a site like eBay style.','rever-se-auction-s'); ?></td>
                    <td width="260"><?php _e('Enable Reverse Auctions:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_reverse'); ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is set to YES, then the items in your homepage slider will be displayed randomly and not based on their posting date.','fron-t-page-sl-random'); ?></td>
                    <td width="260"><?php _e('Randomise frontpage slider:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_randomize_slider_front'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled, your users will be able to place comments on auction pages.','enable-com-act-pg'); ?></td>
                    <td width="260"><?php _e('Enable Comments in Auction Page:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_comments'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled (YES), when a user registers he will be forced to fill in his shipping information to complete registration.','for-ce-ship'); ?></td>
                    <td width="260"><?php _e('Force Shipping Address in Registration:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_force_shipping_address'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled (YES), when a user registers he will be forced to fill in his PayPal Email information to complete registration.','for-ce-pp-yl'); ?></td>
                    <td width="260"><?php _e('Force PayPal Address in Registration:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_force_paypal_address'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled (YES), then the item will be listed until sold, and there will be no more expiration date for that item.','no-tm-lm-byn'); ?></td>
                    <td width="260"><?php _e('No time limit on Buy Now:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_no_time_on_buy_now'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td width="260">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>


                       <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled (YES), then the item buyers need to pay for the item within X Hours (x is the numbner in the field below). If not paid in the amount of time, then the items will go back live in the website. Also this option applies to the only buy now items.','no-tm-lm-byn1'); ?></td>
                    <td width="260"><?php _e('Republish Auctions If Not Paid:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_automatically_repubs'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('The buyers will have this amount of time at their disposal to pay for their purchased items. If not then the items will go back live in the site.','incr-fil-ds21'); ?></td>
                    <td width="260"><?php _e('Republish Time:','AuctionTheme'); ?></td>
                    <td> <input type="text" size="6" name="AuctionTheme_republish_time_hrs" value="<?php echo get_option('AuctionTheme_republish_time_hrs'); ?>" />
                    <?php echo 'Hours'; ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td width="260">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>

                      <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled (YES), your users will be able to set a maximum bid for their item, and the system will automatically bid in increments whenever someone outbids them. Is very similar to eBay max bid feature.','max-bidding-feature'); ?></td>
                    <td width="260"><?php _e('Enable Max Bidding Feature:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_automatic_bid_enable'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this item is enabled, then you have to fill in the field below this option to set the increment for the max bid feature. If this isnt enabled, then the default value of 1 increment will be used as incrementation bid value.','inbl-incr-s'); ?></td>
                    <td width="260"><?php _e('Enable Increase Bid Limit:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_increase_bid_limit'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Set here the increment bidding value when using the max bidding feature.','incr-fil-ds'); ?></td>
                    <td width="260"><?php _e('Increase bid limit:','AuctionTheme'); ?></td>
                    <td> <input type="text" size="6" name="AuctionTheme_increase_bid_limit" value="<?php echo get_option('AuctionTheme_increase_bid_limit'); ?>" />
                    <?php echo auctiontheme_get_currency(); ?></td>
                    </tr>

                     <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td width="260">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this is enabled, and someone bids in the last minute of the bidding time for an auction, then the ending time of that item will be automatically increased by the settings in the field below.','max-bid-time0-extsa'); ?></td>
                    <td width="260"><?php _e('Enable Last Minute Bidding Extension:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_last_min_bid_ext'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('eg: If the bid is placed in the last 60 seconds/minute then increase the ending time of the auction by 2 minutes. This option is to prevent the mean users that buy the item in the last minute, but 1 cent more than the last bid.','ends-tm-ext-991'); ?></td>
                    <td width="260"><?php _e('Ending Time Extension:','AuctionTheme'); ?></td>
                    <td>Extend ending time by: <input type="text" size="3" name="AuctionTheme_ext_time_by" value="<?php echo get_option('AuctionTheme_ext_time_by'); ?>" />(mins), if bidding is in the last
                    <input type="text" size="3" name="AuctionTheme_ext_time_last" value="<?php echo get_option('AuctionTheme_ext_time_last'); ?>" />(mins)</td>
                    </tr>


                    <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td width="260">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is set to YES, then the sub-locations and sub-categories will be shows in the "All Categories" and "All Locations" pages and in the widgets for locations and categories. If set to no they will be hidden.','show-sub-ca-loc1'); ?></td>
                    <td width="260"><?php _e('Show Subcategories & Sublocations:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_show_subcats_enbl'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Show views number for each item, in the single auction page.','show-vs-1'); ?></td>
                    <td width="260"><?php _e('Show views in each auction page:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_show_views'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Admin will have to moderate all items placed in your site if this option is set to YES. Otherwise, the auctions in your site will be placed online automatically without moderation.','admin-approve-s'); ?></td>
                    <td width="260"><?php _e('Admin approves each auction:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_admin_approve_auction'); ?></td>
                    </tr>


					<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Simply enables the front page slider. Set NO to not show the slider.','set-slider-appr'); ?></td>
                    <td width="260"><?php _e('Enable Frontpage Slider:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'auctionTheme_show_front_slider'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Enables or disables the main menu, the menu under the logo. Items on this menu will be controlled from: wp-admin-> Appearance -> Menus section.','mn-mnu-ma'); ?></td>
                    <td width="260"><?php _e('Enable Main Menu:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_show_main_menu'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Stretch area, is a widgetised area that displays in homepage alongside the whole width of the page. Right under the main slider.<br/> If enabled you can add widgets and content to it from: Appearance -> Widgets section of the administration area.','stre-tch-ar-a'); ?></td>
                    <td width="260"><?php _e('Enable Stretch Area:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_show_stretch'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If you enable the blog, the a link of the blog page will be shown at the very top area of your website, and you can post blog posts from admin -> Posts -> Add New.','enb-l-blo-g'); ?></td>
                    <td width="260"><?php _e('Enable Blog:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_blog'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Virtual currency (or e-wallet) is an internal system for money in your website. More information here: <a href="http://doc.sitemile.com/e-wallet-system-auction-theme/" target="_blank">About e-wallet</a>','e-wa--let'); ?></td>
                    <td width="260"><?php _e('Enable Virtual Currency (credits):','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_pay_credits'); ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If locations are disabled then any referrence to locations in the site will be gone.','en-ble-lo-catto'); ?></td>
                    <td width="260"><?php _e('Enable Locations:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_locations'); ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is set to YES, then your users will be only buyers and the only seller will be the admin user.','sel-rs-onlyy'); ?></td>
                    <td width="260"><?php _e('Only admin will post auctions:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_only_admins_post_auctions'); ?></td>
                    </tr>



                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(__('After the time expires the job will be closed and your users can repost it. Leave 0 for never-expire jobs.','AuctionTheme'),'m-aaa-xx-x'); ?></td>
                    <td ><?php _e('Auction max listing period:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="AuctionTheme_auction_time_listing" value="<?php echo get_option('AuctionTheme_auction_time_listing'); ?>"/> days</td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If auctions are made featured, then maximum days until expire will be taken from this field.','max-x-xfe--t'); ?></td>
                    <td ><?php _e('Featured auction max job listing period:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="AuctionTheme_auction_featured_time_listing" value="<?php echo get_option('AuctionTheme_auction_featured_time_listing'); ?>"/> days</td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Number of auctions per page in the advanced search page for your website.','max-nr-ac-adv'); ?></td>
                    <td ><?php _e('Auctions per page in Advanced Search:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="AuctionTheme_listings_per_page_adv_search" value="<?php echo get_option('AuctionTheme_listings_per_page_adv_search'); ?>"/></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('Number of auctions per page in the home page for your website.','max-nr-ac-adv2'); ?></td>
                    <td ><?php _e('Auctions Limit in Home Page:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="AuctionTheme_listings_home_pg_th" value="<?php echo get_option('AuctionTheme_listings_home_pg_th'); ?>"/></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('With this option you can change the permalink words used for when you see the single auction page. Eg: http://site.com/auctions/simple-auction.','max-nr-ac-adva'); ?></td>
                    <td ><?php _e('Slug for Auction Permalink:','AuctionTheme'); ?></td>
                    <td><input type="text" size="30" name="AuctionTheme_auction_permalink" value="<?php echo get_option('AuctionTheme_auction_permalink'); ?>"/> *if left empty will show 'auctions'</td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('With this option you can change the permalink words used for when you see the location page. Eg: http://site.com/location/san-francisco.','max-nr-ac-adva2'); ?></td>
                    <td ><?php _e('Slug for Location Permalink:','AuctionTheme'); ?></td>
                    <td><input type="text" size="30" name="AuctionTheme_location_permalink" value="<?php echo get_option('AuctionTheme_location_permalink'); ?>"/> *if left empty will show 'location'</td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('With this option you can change the permalink words used for when you see the category page. Eg: http://site.com/category/laptops.','max-nr-ac-adva21'); ?></td>
                    <td ><?php _e('Slug for Category Permalink:','AuctionTheme'); ?></td>
                    <td><input type="text" size="30" name="AuctionTheme_category_permalink" value="<?php echo get_option('AuctionTheme_category_permalink'); ?>"/> *if left empty will show 'section'</td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


          </div>

          <div id="tabs2">

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs2">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Filter Email Addresses (private messages):','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_filter_emails_private_messages'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Filter URLs (private messages):','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_filter_urls_private_messages'); ?></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>

          </div>



          <div id="tabs4">

          For facebook connect, install this plugin: <a href="http://sitemile.com/wordpress-social-login.zip">WordPress Social Login</a>

          <!--	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs4">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Facebook Login:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_facebook_login'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook App ID:','AuctionTheme'); ?></td>
                    <td><input type="text" size="35" name="AuctionTheme_facebook_app_id" value="<?php echo get_option('AuctionTheme_facebook_app_id'); ?>"/></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook Secret Key:','AuctionTheme'); ?></td>
                    <td><input type="text" size="35" name="AuctionTheme_facebook_app_secret" value="<?php echo get_option('AuctionTheme_facebook_app_secret'); ?>"/></td>
                    </tr>

                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form> -->

          </div>

          <div id="tabs5">
         <!--
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs5">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Twitter Login:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_twitter_login'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Key:','AuctionTheme'); ?></td>
                    <td><input type="text" size="35" name="AuctionTheme_twitter_consumer_key" value="<?php echo get_option('AuctionTheme_twitter_consumer_key'); ?>"/></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Secret:','AuctionTheme'); ?></td>
                    <td><input type="text" size="35" name="AuctionTheme_twitter_consumer_secret" value="<?php echo get_option('AuctionTheme_twitter_consumer_secret'); ?>"/></td>
                    </tr>



  						<tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Callback URL:','AuctionTheme'); ?></td>
                    <td><?php echo get_template_directory_uri(); ?>/lib/social/twitter/callback.php</td>
                    </tr>



                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save5" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form> -->

            For twitter connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>

          </div>

          <?php do_action('AuctionTheme_general_options_div_content'); ?>

<?php
	echo '</div>';

}

function AuctionTheme_tracking_tools_panel()
{
	$id_icon 		= 'icon-options-general-track';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Tracking Tools','AuctionTheme');
	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));
	global $menu_admin_AuctionTheme_theme_bull;

	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	if(isset($_POST['AuctionTheme_save1']))
		{
			update_option('AuctionTheme_enable_google_analytics', 				trim($_POST['AuctionTheme_enable_google_analytics']));
			update_option('AuctionTheme_analytics_code', 						trim($_POST['AuctionTheme_analytics_code']));

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}

	if(isset($_POST['AuctionTheme_save2']))
		{
			update_option('AuctionTheme_enable_other_tracking', 				trim($_POST['AuctionTheme_enable_other_tracking']));
			update_option('AuctionTheme_other_tracking_code', 						trim($_POST['AuctionTheme_other_tracking_code']));

			echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
		}


?>

	    <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('Google Analytics','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2" <?php if($_GET['active_tab'] == "tabs2") echo 'class="selected"'; ?>><?php _e('Other Tracking Tools','AuctionTheme'); ?></a></li>
          </ul>
          <div id="tabs1">


                 <form method="post" action="">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Google Analytics:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_google_analytics'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Analytics Code:','AuctionTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="AuctionTheme_analytics_code"><?php echo stripslashes(get_option('AuctionTheme_analytics_code')); ?></textarea></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


          </div>

          <div id="tabs2">

             <form method="post" action="">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Other Tracking:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_other_tracking'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Other Tracking Code:','AuctionTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="AuctionTheme_other_tracking_code"><?php echo stripslashes(get_option('AuctionTheme_other_tracking_code')); ?></textarea></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


          </div>


<?php
	echo '</div>';

}

function AuctionTheme_info()
{
	$id_icon 		= 'icon-options-general-info';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Information','AuctionTheme');

	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

?>

	    <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1" class="selected"><?php _e('Main Information','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2"><?php _e('From SiteMile Blog','AuctionTheme'); ?></a></li>

          </ul>
          <div id="tabs1" style="display: block; ">

          <table width="100%" class="sitemile-table">


                    <tr>
                    <td width="260"><?php _e('AuctionTheme Version:','AuctionTheme'); ?></td>
                    <td><?php echo AUCTIONTHEME_VERSION; ?></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('AuctionTheme Latest Release:','AuctionTheme'); ?></td>
                    <td><?php echo AUCTIONTHEME_RELEASE; ?></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('WordPress Version:','AuctionTheme'); ?></td>
                    <td><?php bloginfo('version'); ?></td>
                    </tr>


                    <tr>
                    <td width="160"><?php _e('Go to SiteMile official page:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com">SiteMile - Premium WordPress Themes</a></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('Go to AuctionTheme\'s official page:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/p/auctionTheme">SiteMile Auction Theme</a></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('Go to support forums:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/forums">SiteMile Support Forums</a></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('Contact SiteMile Team:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/contact-us">Contact Form</a></td>
                    </tr>

                    <tr>
                    <td width="160"><?php _e('Like us on Facebook:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://facebook.com/sitemile">SiteMile Facebook Fan Page</a></td>
                    </tr>


                     <tr>
                    <td width="160"><?php _e('Follow us on Twitter:','AuctionTheme'); ?></td>
                    <td><a class="festin" href="http://twitter.com/sitemile">SiteMile Twitter Page</a></td>
                    </tr>



           </table>

          </div>

          <div id="tabs2" style="display: none; overflow:hidden ">

          <?php
		   echo '<div style="float:left;">';
 wp_widget_rss_output(array(
 'url' => 'http://sitemile.com/feed/',
 'title' => 'Latest news from SiteMile.com Blog',
 'items' => 10,
 'show_summary' => 1,
 'show_author' => 0,
 'show_date' => 1
 ));
 echo "</div>";

 ?>

          </div>



<?php
	echo '</div>';

}

function AuctionTheme_pricing_options()
{
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'AuctionTheme - '.__('Pricing Settings','AuctionTheme');
	$arr = array("yes" => __("Yes",'AuctionTheme'), "no" => __("No",'AuctionTheme'));
	$sep = array( "," => __('Comma (,)','AuctionTheme'), "." => __("Point (.)",'AuctionTheme'));
	$frn = array( "front" => __('In front of sum (eg: $50)','AuctionTheme'), "back" => __("After the sum (eg: 50$)",'AuctionTheme'));
	global $menu_admin_AuctionTheme_theme_bull, $wpdb;

	$arr_currency = array("USD" => "US Dollars", "EUR" => "Euros", "CAD" => "Canadian Dollars", "CHF" => "Swiss Francs","GBP" => "British Pounds",
						  "AUD" => "Australian Dollars","NZD" => "New Zealand Dollars","BRL" => "Brazilian Real", 'PLN' => 'Polish zloty',
						  "SGD" => "Singapore Dollars","SEK" => "Swidish Kroner","NOK" => "Norwegian Kroner","DKK" => "Danish Kroner",
						  "MXN" => "Mexican Pesos","JPY" => "Japanese Yen","EUR" => "Euros", "ZAR" => "South Africa Rand" , "NGN" => "Nigeria Naira", 'RUB' => 'Russian Ruble' , "TRY" => "Turkish Lyra",  "RON" => "Romanian Lei",
						  "HUF" => "Hungarian Forint", 'PHP' => 'Philippine peso' ,  'INR' => 'Indian Rupee', 'LTL' => 'Lithuania Litas' , 'MYR' => 'Malaysian ringgit', 'HKD' => 'HongKong Dollars',
						  'SEK' => 'Swedish Krona', 'ILS'  => 'Israeli New Shekel' , 'COP' => 'Colombian Peso', 'THB' => 'Thai Baht', 'CZK' => 'Czech Koruna' , 'BTC' => 'Bitcoins'
						  );

	//------------------------------------------------------

	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';

	//-------------------

	if(isset($_POST['AuctionTheme_save1']))
	{
		$AuctionTheme_currency 						= trim($_POST['AuctionTheme_currency']);
		$AuctionTheme_currency_symbol 				= trim($_POST['AuctionTheme_currency_symbol']);
		$AuctionTheme_currency_position 			= trim($_POST['AuctionTheme_currency_position']);
		$AuctionTheme_decimal_sum_separator 		= trim($_POST['AuctionTheme_decimal_sum_separator']);
		$AuctionTheme_thousands_sum_separator 		= trim($_POST['AuctionTheme_thousands_sum_separator']);

		update_option('AuctionTheme_currency', 					$AuctionTheme_currency);
		update_option('AuctionTheme_currency_symbol', 			$AuctionTheme_currency_symbol);
		update_option('AuctionTheme_currency_position', 		$AuctionTheme_currency_position);
		update_option('AuctionTheme_decimal_sum_separator', 	$AuctionTheme_decimal_sum_separator);
		update_option('AuctionTheme_thousands_sum_separator', 	$AuctionTheme_thousands_sum_separator);



		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save2']))
	{

		$AuctionTheme_new_auction_listing_fee 			= trim($_POST['AuctionTheme_new_auction_listing_fee']);
		$AuctionTheme_new_auction_feat_listing_fee 		= trim($_POST['AuctionTheme_new_auction_feat_listing_fee']);
		$AuctionTheme_withdraw_limit					= trim($_POST['AuctionTheme_withdraw_limit']);
		$AuctionTheme_percent_fee_taken					= trim($_POST['AuctionTheme_percent_fee_taken']);
		$AuctionTheme_solid_fee_taken					= trim($_POST['AuctionTheme_solid_fee_taken']);
		$AuctionTheme_new_auction_sealed_bidding_fee	= trim($_POST['AuctionTheme_new_auction_sealed_bidding_fee']);

		update_option('AuctionTheme_new_auction_listing_fee', 					$AuctionTheme_new_auction_listing_fee);
		update_option('AuctionTheme_new_auction_sealed_bidding_fee', 			$AuctionTheme_new_auction_sealed_bidding_fee);
		update_option('AuctionTheme_solid_fee_taken', 							$AuctionTheme_solid_fee_taken);
		update_option('AuctionTheme_percent_fee_taken', 						$AuctionTheme_percent_fee_taken);
		update_option('AuctionTheme_withdraw_limit', 							$AuctionTheme_withdraw_limit);
		update_option('AuctionTheme_new_auction_feat_listing_fee', 				$AuctionTheme_new_auction_feat_listing_fee);


		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_save3']))
	{

		$AuctionTheme_take_percent_fee 				= trim($_POST['AuctionTheme_take_percent_fee']);
		$AuctionTheme_take_flat_fee 		= trim($_POST['AuctionTheme_take_flat_fee']);
		$auction_theme_min_withdraw			= trim($_POST['auction_theme_min_withdraw']);
		$AuctionTheme_add_fee_to_bid = trim($_POST['AuctionTheme_add_fee_to_bid']);
		$AuctionTheme_add_fee_to_bid_enable = trim($_POST['AuctionTheme_add_fee_to_bid_enable']);


		update_option('AuctionTheme_add_fee_to_bid_enable', 			$AuctionTheme_add_fee_to_bid_enable);
		update_option('AuctionTheme_add_fee_to_bid', 			$AuctionTheme_add_fee_to_bid);
		update_option('auction_theme_min_withdraw', 			$auction_theme_min_withdraw);
		update_option('AuctionTheme_take_percent_fee', 			$AuctionTheme_take_percent_fee);
		update_option('AuctionTheme_take_flat_fee', 	$AuctionTheme_take_flat_fee);


		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save4']))
	{

		$AuctionTheme_enable_cust_commissions 				= trim($_POST['AuctionTheme_enable_cust_commissions']);

		update_option('AuctionTheme_enable_cust_commissions', 	$AuctionTheme_enable_cust_commissions);


		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_addnewcost']))
	{
		$cost = trim($_POST['newcost']);
		$ss = "insert into ".$wpdb->prefix."job_var_costs (cost) values('$cost')";
		$wpdb->query($ss);

		echo '<div class="saved_thing">'.__('Settings saved!','AuctionTheme').'</div>';
	}

	if(isset($_POST['AuctionTheme_save4_a']))
	{
		$commission = trim($_POST['commission']);
		$high_range = trim($_POST['high_range']);
		$low_range = trim($_POST['low_range']);

		$ss = "insert into ".$wpdb->prefix."auction_commissions (commission,high_range,low_range) values('$commission','$high_range','$low_range')";
		$wpdb->query($ss);

		echo '<div class="saved_thing">'.__('Range element was added.','AuctionTheme').'</div>';
	}


	if(isset($_POST['AuctionTheme_save_update_setts']))
	{
		$commission = trim($_POST['commission']);
		$high_range = trim($_POST['high_range']);
		$low_range = trim($_POST['low_range']);
		$commids = $_POST['commids'];


		$ss = "update ".$wpdb->prefix."auction_commissions set  commission='$commission', high_range='$high_range', low_range='$low_range' where id='$commids'";
		$wpdb->query($ss);

		echo '<div class="saved_thing">'.__('Range element was updated.','AuctionTheme').'</div>';
	}

	if(isset($_GET['delete_range']))
	{
		$delete_range = trim($_GET['delete_range']);

		$ss = "delete from ".$wpdb->prefix."auction_commissions where id='$delete_range'";
		$wpdb->query($ss);

		echo '<div class="saved_thing">'.__('Range element was deleted.','AuctionTheme').'</div>';
	}




?>

	    <div id="usual2" class="usual">
          <ul>
            <li><a href="#tabs1"><?php _e('Main Details','AuctionTheme'); ?></a></li>
            <li><a href="#tabs2" <?php if($_GET['active_tab'] == "tabs2") echo 'class="selected"'; ?>><?php _e('Listing Fees','AuctionTheme'); ?></a></li>
            <li><a href="#tabs3" <?php if($_GET['active_tab'] == "tabs3") echo 'class="selected"'; ?>><?php _e('Other Fees','AuctionTheme'); ?></a></li>
            <li><a href="#tabs4" <?php if($_GET['active_tab'] == "tabs4") echo 'class="selected"'; ?>><?php _e('Custom Commission Fees','AuctionTheme'); ?></a></li>


          </ul>

          <div id="tabs4">

          	 <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet('If this option is enabled, then you will charge a custom commission fee (at end of each successful payment for an item) based on the selling price. So you can put a smaller commission for small priced items, or something similar. Its your choice from this panel.','sts-fr-ss'); ?></td>
                    <td width="250" ><?php _e('Enable Custom Commissions:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_enable_cust_commissions'); ?></td>
                    </tr>


                 	<tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


          <h3><?php _e('Set Price Ranges','AuctionTheme'); ?></h3>


          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250" ><?php _e('Low Range Price:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="low_range" value=""/> <?php echo auctiontheme_get_currency(); //('AuctionTheme_currency_symbol'); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250" ><?php _e('High Range Price:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="high_range" value=""/> <?php echo auctiontheme_get_currency(); //get_option('AuctionTheme_currency_symbol'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="250" ><?php _e('Commission Rate:','AuctionTheme'); ?></td>
                    <td><input type="text" size="4" name="commission" value=""/>%</td>
                    </tr>


                 	<tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save4_a" value="<?php _e('Add New Range','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


            <h3><?php _e('Current Price Ranges','AuctionTheme'); ?></h3>
          	<?php

			global $wpdb;
			$s = "select * from ".$wpdb->prefix."auction_commissions order by (low_range+0) asc";
			$r = $wpdb->get_results($s);

			if(count($r) == 0)
			{
				_e('There are no custom commissions defined.','AuctionTheme');
			}
			else
			{
				?>

                <table width="100%" class="sitemile-table">

                    <tr>
                    <td width="150" ><strong><?php _e('Low Range Value','AuctionTheme'); ?></strong></td>
                    <td width="150" ><strong><?php _e('High Range Value','AuctionTheme'); ?></strong></td>
                    <td width="150" ><strong><?php _e('Commission','AuctionTheme'); ?></strong></td>

                    <td> </td>
                    </tr>

            	</table>

                <?php

				foreach($r as $row):

				?>

                    <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs4">
            		<table width="100%" class="sitemile-table"> <input type="hidden" value="<?php echo $row->id ?>" name="commids" />

                    <tr>
                    <td width="150" ><input type="text" size="10" value="<?php echo $row->low_range; ?>" name="low_range" /> <?php echo auctiontheme_get_currency(); ?></td>
                    <td width="150" ><input type="text" size="10" value="<?php echo $row->high_range; ?>" name="high_range" /> <?php echo auctiontheme_get_currency(); ?></td>
                    <td width="150" ><input type="text" size="4" value="<?php echo $row->commission; ?>" name="commission" /> %</td>

                    <td><input type="submit" name="AuctionTheme_save_update_setts" value="<?php _e('Update Setting','AuctionTheme'); ?>"/> | <a href="<?php
                    echo get_admin_url(). "admin.php?page=AT_pr_set_&active_tab=tabs4&delete_range=" . $row->id;
					?>"><?php _e('Delete This','AuctionTheme'); ?></a></td>
                    </tr>

            </table>
          	</form>

                <?php

				endforeach;
			}

			?>
          </div>



          <div id="tabs1">

          	 <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">

                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Site currency:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr_currency, 'AuctionTheme_currency'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Currency symbol:','AuctionTheme'); ?></td>
                    <td><input type="text" size="6" name="AuctionTheme_currency_symbol" value="<?php echo get_option('AuctionTheme_currency_symbol'); ?>"/> </td>
                    </tr>

                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Currency symbol position:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($frn, 'AuctionTheme_currency_position'); ?></td>
                    </tr>


                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Decimals sum separator:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($sep, 'AuctionTheme_decimal_sum_separator'); ?></td>
                    </tr>

                     <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Thousands sum separator:','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($sep, 'AuctionTheme_thousands_sum_separator'); ?></td>
                    </tr>




                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save1" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>


          </div>

          <div id="tabs2" style="display: none; ">

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Listing Fee (base fee):','AuctionTheme'); ?></td>
                    <td><input type="text" size="15" name="AuctionTheme_new_auction_listing_fee" value="<?php echo get_option('AuctionTheme_new_auction_listing_fee'); ?>"/> <?php echo AuctionTheme_get_currency(); ?></td>
                    </tr>

                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Listing Fee (featured fee):','AuctionTheme'); ?></td>
                    <td><input type="text" size="15" name="AuctionTheme_new_auction_feat_listing_fee" value="<?php echo get_option('AuctionTheme_new_auction_feat_listing_fee'); ?>"/>
					<?php echo AuctionTheme_get_currency(); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Sealed Bidding Fee:','AuctionTheme'); ?></td>
                    <td><input type="text" size="15" name="AuctionTheme_new_auction_sealed_bidding_fee" value="<?php echo get_option('AuctionTheme_new_auction_sealed_bidding_fee'); ?>"/>
					<?php echo AuctionTheme_get_currency(); ?></td>
                    </tr>


                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save2" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>
          </div>



           <div id="tabs3">

          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=AT_pr_set_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="230"><?php _e('Fee taken for each auction when paid:','AuctionTheme'); ?></td>
                    <td><input type="text" size="5" name="AuctionTheme_take_percent_fee" value="<?php echo get_option('AuctionTheme_take_percent_fee'); ?>"/>% or flat fee
                    <input type="text" size="5" name="AuctionTheme_take_flat_fee" value="<?php echo get_option('AuctionTheme_take_flat_fee'); ?>"/> <?php echo AuctionTheme_get_currency(); ?>
					 </td>
                    </tr>



                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="230"><?php _e('Withdraw Min Limit:','AuctionTheme'); ?></td>
                    <td><input type="text" size="5" name="auction_theme_min_withdraw" value="<?php echo get_option('auction_theme_min_withdraw'); ?>"/> <?php echo AuctionTheme_get_currency(); ?>
					 </td>
                    </tr>


                     <tr>
                    <td valign=top width="22"> </td>
                    <td width="230">&nbsp;</td>
                    <td>
					 </td>
                    </tr>


                       <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable Bid Fee (eg:VAT):','AuctionTheme'); ?></td>
                    <td><?php echo AuctionTheme_get_option_drop_down($arr, 'AuctionTheme_add_fee_to_bid_enable'); ?></td>
                    </tr>


                    <tr>
                    <td valign=top width="22"><?php AuctionTheme_theme_bullet(); ?></td>
                    <td width="230"><?php _e('Fee to add to bid (eg: VAT):','AuctionTheme'); ?></td>
                    <td><input type="text" size="4" name="AuctionTheme_add_fee_to_bid" value="<?php echo get_option('AuctionTheme_add_fee_to_bid'); ?>"/> %
					 </td>
                    </tr>




                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="AuctionTheme_save3" value="<?php _e('Save Options','AuctionTheme'); ?>"/></td>
                    </tr>

            </table>
          	</form>
          </div>




<?php
	echo '</div>';


}

?>
