<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>
	
	<div id="content">
		<?php
			wp_reset_query();
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query('paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post();
		?>
		
			<?php get_template_part('content'); ?>
			
	    <?php endwhile; ?>
	    	    
	    <div class="junkie-pagination">
	    	<?php junkie_pagination(); ?>
	    </div><!-- .junkie-pagination -->
	    
		<?php $wp_query = null; $wp_query = $temp; ?>
	</div><!-- #content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>