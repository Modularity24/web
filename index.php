<?php get_header(); ?>

	<div id="featured-content">
	
		<?php //Slogan
			if (get_option('estudio_slogan_enable') == 'on') { 		
				echo "<div class=\"slogan\">".get_option('estudio_slogan_content')."</div><!-- .slogan -->";
			} 
		?>
	
		<?php //Featured Slider
			if(get_option('estudio_featured_slider_enable') == 'on') { 
		?>
		
			<div id="content-slider-1" class="royalSlider contentSlider rsDefault">
			<?php
				$i = 1;
				query_posts( array(
					'post_type' => 'slide',
					'posts_per_page' => '4'
				));
				if ( have_posts() ) : while ( have_posts() ) : the_post();			
			    $has_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );		
			    $has_img = get_post_meta(get_the_ID(), 'tj_slide_image', TRUE);
			    $has_desc = get_post_meta(get_the_ID(), 'tj_slide_desc', TRUE);
			    $has_url = get_post_meta(get_the_ID(), 'tj_slide_url', TRUE);
			 ?>
				<div>
					<?php
						if ($has_url) {
					    	echo '<a href="'.$has_url.'">';
						}
					    if (is_array($has_thumb)) {
					        the_post_thumbnail('home-slide-thumb', array('class' => 'rsImg entry-thumb'));
					    } elseif ($has_img) {
					    	echo '<img class="rsImg entry-thumb" src="'.$has_img.'" alt="';the_title();echo '" data-rsw="940" data-rsh="350" />';
					    }
						if ($has_url) {
					    	echo '</a>';
						}				        
					?>			
					<span class="rsTmb">
					    <span><?php echo $i; ?></span>    
						<h3><?php the_title(); ?></h3>
						<p><?php echo $has_desc; ?></p>
					</span><!-- .rsTmb -->
					</div><!-- .rsSlide -->
				<?php $i++; endwhile; else: ?>
				<?php endif; wp_reset_postdata(); wp_reset_query(); ?>
			</div><!-- #content-slider-1 -->
			
		<?php } ?>
		
	</div><!-- #featured-content -->
		
	<?php //Portfolio
		if(get_option('estudio_home_portfolio_enable') == 'on') { 
	?>		
		
		<div id="latest-works">
			<h3 class="section-title"><?php echo (get_option('estudio_home_portfolio_heading')); ?></h3>
			<div class="section-content">
				<div class="flexslider1 carousel">
					<ul class="slides">		
						<?php
							query_posts( array(
								'post_type' => 'portfolio',
								'posts_per_page' => get_option('estudio_home_portfolio_num')
								));
							if ( have_posts() ) : while ( have_posts() ) : the_post();
							$short_desc = get_post_meta(get_the_ID(), 'tj_portfolio_short_desc', TRUE);
						?>
							<li class="portfolio-item">
		                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
		                            <?php the_post_thumbnail('portfolio-thumb', array('class' => 'entry-thumb')); ?>
		                            <span class="entry-thumb-overlay"><?php _e('View Project','themejunkie'); ?></span>		                            
		                        </a>
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="entry-desc">
									<?php echo $short_desc; ?>
								</p><!-- .entry-desc -->				
							</li><!-- .portfolio-item -->
						<?php endwhile; else: ?>
						<?php endif; wp_reset_postdata(); wp_reset_query(); ?>
					  </ul><!-- .slides -->
				  </div><!-- .flexslider1 .carousel -->	
			</div><!-- .section-content -->
			<div class="clear"></div>
		</div><!-- #latest-works -->
	
	<?php } ?>	

	<?php //Posts
		if(get_option('estudio_home_posts_enable') == 'on') { 
	?>		

		<div id="latest-posts">
			<h3 class="section-title"><?php echo (get_option('estudio_home_posts_heading')); ?></h3>
			<div class="section-content">
				<div class="flexslider1 carousel">
					<ul class="slides">		
						<?php
						    query_posts( array(
								'posts_per_page' => get_option('estudio_home_posts_num')
							));
							if (have_posts()) : while (have_posts()) : the_post(); 
						?>
							<li>
								<?php get_template_part('content','home'); ?>	
							</li><!-- .hentry -->
						<?php endwhile; else: ?>
						<?php endif; wp_reset_postdata(); wp_reset_query(); ?>	
					</ul><!-- .slides -->
				</div><!-- .flexslider1 .carousel -->				
			</div><!-- .section-content -->
			<div class="clear"></div>
		</div><!-- #latest-posts -->

	<?php } ?>	

	<?php //Testimonials
		if(get_option('estudio_home_testimonials_enable') == 'on') { 
	?>		
	
		<div id="testimonials">
			<h3 class="section-title"><?php echo (get_option('estudio_home_testimonials_heading')); ?></h3>
			<div class="flexslider2">
				<ul class="slides">				
					<?php
						query_posts( array(
						    'post_type' => 'testimonial',
						    'posts_per_page' => get_option('estudio_home_testimonials_num')
						));
						if (have_posts()) : while (have_posts()) : the_post();
					    $author_name = get_post_meta(get_the_ID(), 'tj_testimonial_author_name', TRUE);
					    $site_name = get_post_meta(get_the_ID(), 'tj_testimonial_site_name', TRUE);
					    $site_url = get_post_meta(get_the_ID(), 'tj_testimonial_site_url', TRUE);				
					?>
						<li class="testimonial">
							<div class="testimonial-content">
								<blockquote><?php the_content(); ?></blockquote>
							</div><!-- .testimonial-content -->
							<div class="testimonial-author">
								<span class="author-name"><?php echo $author_name; ?></span>, <span class="site-url"><a href="<?php echo $site_url; ?>"><?php echo $site_name; ?></a></span>
							</div><!-- .testimonial-author -->
							<div class="clear"></div>
						</li><!-- .testimonial -->
					<?php endwhile; else: ?>
					<?php endif; wp_reset_postdata(); wp_reset_query(); ?>
				  </ul><!-- .slides -->
			</div><!-- .flexslider2 -->
		</div><!-- #testimonials -->

	<?php } ?>

<?php get_footer(); ?>