<?php get_header(); ?>

    <div class="page-header">

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
			<h1 class="page-title"><?php printf(__('All posts in %s', 'themejunkie'), single_cat_title('',false)); ?></h1>
 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h1 class="page-title"><?php printf(__('All posts tagged %s', 'themejunkie'), single_tag_title('',false)); ?></h1>
 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1 class="page-title"><?php _e('Archive for', 'themejunkie') ?> <?php the_time('F jS, Y'); ?></h1>
 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1 class="page-title"><?php _e('Archive for', 'themejunkie') ?> <?php the_time('F, Y'); ?></h1>
 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="page-title"><?php _e('Archive for', 'themejunkie') ?> <?php the_time('Y'); ?></h1>
	  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h1 class="page-title"><?php _e('All posts by', 'themejunkie') ?> <?php echo $curauth->display_name; ?></h1>
 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="page-title"><?php _e('Blog Archives', 'themejunkie') ?></h1>
 	  	<?php } ?>
	  	
    </div><!-- .page-header -->
            
	<div id="content">
	
	<?php if ( have_posts() ) : ?>
	
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('content','loop'); ?>
		<?php endwhile; ?>
	
	    <div class="junkie-pagination">
	    	<?php junkie_pagination(); ?>
	    </div><!-- .junkie-pagination -->
	    	
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
	
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>            