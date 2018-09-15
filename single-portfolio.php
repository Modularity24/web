<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php
	        $image = array();
	        $video_embed = get_post_meta(get_the_ID(), 'tj_video_embed_portfolio', TRUE);
	        $m4v_url = get_post_meta(get_the_ID(), 'tj_video_m4v', TRUE);
	        $ogv_url = get_post_meta(get_the_ID(), 'tj_video_ogv', TRUE);
            $have_embed = FALSE;
	        $have_img = FALSE;

            if($video_embed != ''){
                $have_embed = TRUE;
            }
			$image[0] = get_post_meta(get_the_ID(), 'tj_portfolio_image1', TRUE);
			$image[1] = get_post_meta(get_the_ID(), 'tj_portfolio_image2', TRUE);
			$image[2] = get_post_meta(get_the_ID(), 'tj_portfolio_image3', TRUE);
			$image[3] = get_post_meta(get_the_ID(), 'tj_portfolio_image4', TRUE);
			$image[4] = get_post_meta(get_the_ID(), 'tj_portfolio_image5', TRUE);
	        $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );
	        for($i=0;$i<5;$i++){
	                if($image[$i]!=''){
	                    $have_img = TRUE;
	                }
	        }
			$short_desc = get_post_meta(get_the_ID(), 'tj_portfolio_short_desc', TRUE);
			$client = get_post_meta(get_the_ID(), 'tj_portfolio_client', TRUE);				     
			$link = get_post_meta(get_the_ID(), 'tj_portfolio_link', TRUE);	
		?>

	        <div id="content" class="one-col">
	        
			    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    
			    	<div class="entry-header">
		    			<h1 class="widget-title"><?php the_title(); ?></h1>
						<p class="entry-desc">
							<?php echo $short_desc; ?>
						</p><!-- .entry-desc -->
			    	</div><!-- .entry-header -->
					
					<?php if(($have_img) && ($video_embed == null)):?>
						<div class="flexslider3">
							<ul class="slides">
								<?php   for($i=0;$i<5;$i++):?>
									<?php if($image[$i]): ?>
										<li><img src="<?php echo $image[$i];?>" alt="<?php the_title(); ?>"/></li>
									<?php endif; endfor;?>
							</ul><!-- .sldes -->
						</div><!-- .flexslider3 -->
					<?php endif; ?>
					
					<?php if($video_embed!=''):?>
						<div class="video-portfolio">
							<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
						</div><!-- .video-portfolio -->
					<?php endif; ?>
	
			    </div><!-- #post-<?php the_ID(); ?> -->
			    
			</div><!-- #content -->
		
		<?php endwhile; else: ?>
	
		<?php endif; ?>
	
		<div class="clear"></div>

	        <div class="entry-meta">
	        <span class="date">
				<strong><?php _e('Date', 'themejunkie'); ?>: </strong>			
	        	<?php the_time('M Y'); ?>
	        </span><!-- .date -->
	        <?php if($client != null) : ?>
		        <span class="client">
					<strong><?php _e('Client', 'themejunkie'); ?>: </strong>			
		        	<?php echo $client; ?>
		        </span><!-- .client -->
	        <?php endif; ?>      
	        <span class="skills"> 					
			<?php $terms = get_the_terms( get_the_ID(), 'portfolio-type' ); ?>
			<?php if(is_array($terms)){ ?>
					<strong><?php _e('Skills', 'themejunkie'); ?>: </strong>			
						<?php foreach ($terms as $term) :  ?>
							<?php echo $term->name; ?><br/>
						<?php endforeach; ?>
					<div class="clear"></div>
			<?php } ?>
	        </span><!-- .skills -->
	        <span class="link">	        
				<?php if($link != null) : ?>
					<a target="_blank" href="<?php echo $link; ?>"><?php _e('Launch Project', 'themejunkie'); ?></a>
				<?php endif; ?>
	        </span><!-- .link -->	
								
			</div><!-- .entry-meta -->
			
			<div class="entry-content">
				<?php the_content(''); ?>				
				<?php edit_post_link( __('Edit', 'themejunkie'), '<span class="edit-post">', '</span>' ); ?>
	        </div><!-- .entry-content -->
			
	        <div class="clear"></div>
	
		<div id="latest-works">
			<h3 class="section-title"><?php _e('Related Work','themejunkie'); ?></h3>
				<div class="flexslider1 carousel">
				<ul class="slides">	
				<?php 
				
				//Set the starter count
				$start = 4;
				//Set the finish count
				$finish = 1;
				
				$postId = get_the_ID();						
				
                $related = get_posts_related_by_taxonomy($postId, 'portfolio-type', get_the_ID());
				
				//Get the total amount of posts
				$post_count = $related->post_count;
				
                while ($related->have_posts()) : $related->the_post(); 
				
                ?>
                
					<?php if(is_multiple($start, 3)) : /* if the start count is a multiple of 3 */ ?>

                    <?php endif; ?>
                    
                    <?php
                   		$video_embed = get_post_meta(get_the_ID(), 'tj_video_embed_portfolio', TRUE);
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

                    <?php if(is_multiple($finish, 4) || $post_count == $finish) : /* if the finish count is a multiple of 4 or equals the total posts */  ?>
                    <?php endif; ?>
                
                <?php
				$start++;
				$finish++;
				?>
                <?php endwhile; wp_reset_query(); ?>
				  </ul><!-- .slides -->
			  </div><!-- .flexslider1 .carousel -->	
       </div><!-- #latest-works -->
                	
<?php get_footer(); ?>