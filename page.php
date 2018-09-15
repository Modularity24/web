<?php get_header(); ?>

	<div id="content">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<h1 class="page-title"><?php the_title(); ?></h1>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'themejunkie' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'themejunkie' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post -->

			<?php if(get_option('estudio_show_page_comments') == 'on') { ?>
		  		<?php comments_template('', true);  ?> 	
		  	<?php } ?>
		  	
		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>