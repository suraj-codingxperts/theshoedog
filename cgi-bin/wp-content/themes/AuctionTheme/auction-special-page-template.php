<?php
/*
Template Name: AuctionTheme_Special_Page
*/
?>

<?php
/********************************************************
*	
*	JobMiner v1.0 - sitemile.com
*	coder: andreisaioc@gmail.com
*	http://sitemile.com/p/auctionTheme
*
********************************************************/

	get_header();


?>
<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3  breadcrumb-wrap col-xs-12 col-sm-12 col-lg-12"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>						
<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>