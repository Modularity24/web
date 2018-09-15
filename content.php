<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-thumb">
		<?php if ( is_single() ) : ?>
			<?php the_post_thumbnail('post-thumb', array('class' => 'entry-thumb')); ?>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('post-thumb', array('class' => 'entry-thumb')); ?>
				<span class="entry-thumb-overlay"><?php _e('Read Article','themejunkie'); ?></span>		                            
			</a>
		<?php endif; ?>
	</div><!-- .post-thumb -->
	
	<div class="published">
		<span><?php the_time('m/d'); ?></span>
		<span><?php the_time('Y'); ?></span>
	</div><!-- .published -->
	
	<div class="loop-content">		
	
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; // is_single() ?>
			
		<div class="entry-meta entry-header">
			<?php _e('by','junkie') ?> <?php the_author_posts_link(); ?> / 
				<span class="comment-count"><?php comments_popup_link(__('No Comments', 'themejunkie'), __('1 Comment', 'themejunkie'), __('% Comments', 'themejunkie')); ?></span>
				<span class="meta-sep"> / </span>
				<span class="entry-categories"><?php _e('Posted in: ', 'themejunkie') ?> <?php the_category(', ') ?></span>
			<?php edit_post_link( __('Edit', 'themejunkie'), ' / <span class="edit-post">', '</span>' ); ?>
		</div><!-- .entry-meta .entry-header -->
			
		<?php if ( is_single() ) { ?>

			<?php if(get_option('estudio_integrate_singletop_enable') == 'on') echo (get_option('estudio_integration_single_top')); ?>
		
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'themejunkie' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'themejunkie' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div><!-- .entry-content -->
			
			<?php if(get_option('estudio_integrate_singlebottom_enable') == 'on') echo (get_option('estudio_integration_single_bottom')); ?>			
		<?php } else { ?>

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div><!-- .entry-excerpt -->		

		<?php } ?>
	
	</div><!-- .loop-content -->
	
	<div class="clear"></div>

</article><!-- #post -->
								