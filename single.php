<?php get_header(); ?>

	<div id="content">
	
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php get_template_part( 'content', get_post_format() ); ?>
			
			<?php if(get_option('estudio_show_post_comments') == 'on') { ?>
		  		<?php comments_template('', true);  ?> 	
		  	<?php } ?>
		  		
		<?php endwhile; ?>
	
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>