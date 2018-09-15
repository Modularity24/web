<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('post-thumb', array('class' => 'entry-thumb')); ?>
				<span class="entry-thumb-overlay"><?php _e('Read Article','themejunkie'); ?></span>		                            
			</a>
	</div><!-- .post-thumb -->
	
	<div class="published">
		<span><?php the_time('m/d'); ?></span>
		<span><?php the_time('Y'); ?></span>
	</div><!-- .published -->
	
	<div class="loop-content">		
	
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
		<div class="entry-meta entry-header">
			<?php _e('by','junkie') ?> <?php the_author_posts_link(); ?> / 
				<span class="comment-count"><?php comments_popup_link(__('No Comments', 'themejunkie'), __('1 Comment', 'themejunkie'), __('% Comments', 'themejunkie')); ?></span>
			<?php if( !is_home() ) { ?>
				<span class="meta-sep"> / </span>
				<span class="entry-categories"><?php _e('Posted in: ', 'themejunkie') ?> <?php the_category(', ') ?></span>
			<?php } ?>			
			<?php edit_post_link( __('Edit', 'themejunkie'), ' / <span class="edit-post">', '</span>' ); ?>
		</div><!-- .entry-meta .entry-header -->
			
		<div class="entry-excerpt">
			<?php tj_content_limit('100'); ?>
		</div><!-- .entry-excerpt -->
	
	</div><!-- .loop-content -->
	
	<div class="clear"></div>

</article><!-- #post -->
								