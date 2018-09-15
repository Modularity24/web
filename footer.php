<div class="clear"></div>
</div><!-- #main -->

	<footer id="footer">
	
		<?php if ( is_active_sidebar( 'footer-col-1' ) || is_active_sidebar( 'footer-col-2' ) || is_active_sidebar( 'footer-col-3' ) || is_active_sidebar( 'footer-col-4' )) { ?>
		
			<div id="footer-columns">
				<div class="container">
			
					<div class="footer-column-1">
						<?php if ( is_active_sidebar( 'footer-col-1' ) ) :  dynamic_sidebar( 'footer-col-1'); endif; ?>
					</div><!-- .footer-column-1 -->
					
					<div class="footer-column-2">
						<?php if ( is_active_sidebar( 'footer-col-2' ) ) :  dynamic_sidebar( 'footer-col-2'); endif; ?>
					</div><!-- .footer-column-2 -->
	
					<div class="footer-column-3">
						<?php if ( is_active_sidebar( 'footer-col-3' ) ) :  dynamic_sidebar( 'footer-col-3'); endif; ?>
					</div><!-- .footer-column-3 -->
	
					<div class="footer-column-4">
						<?php if ( is_active_sidebar( 'footer-col-4' ) ) :  dynamic_sidebar( 'footer-col-4'); endif; ?>
					</div><!-- .footer-column-4 -->								
								
					<div class="clear"></div>
					
				</div><!-- .container -->
					
			</div><!-- #footer-columns -->
		
		<?php } ?>
				
		<div id="copyright">
			<div class="container">
				<p>&copy; <?php echo mysql2date('Y',current_time('timestamp')); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved','themejunkie');?>. <?php echo get_option('estudio_footer_credit'); ?></p>
			</div>
		</div><!-- .copyright -->
		
	</footer><!-- #footer -->
	
<?php wp_footer(); ?>

</body>
</html>