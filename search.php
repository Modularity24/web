<?php get_header(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __('Search Results for: &ldquo;%s&rdquo;', 'themejunkie'), get_search_query()); ?></h1>
	</header>
		
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