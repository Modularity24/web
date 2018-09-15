<?php

add_theme_support( 'automatic-feed-links' );
add_editor_style();
//add_custom_image_header();

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 735;

/*-----------------------------------------------------------------------------------*/
/*	Custom Menus
/*-----------------------------------------------------------------------------------*/
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Nav','themejunkie' ),
		)
	);
}

if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

/*-----------------------------------------------------------------------------------*/
/*	Register and deregister Scripts files	
/*-----------------------------------------------------------------------------------*/
if(!is_admin()) {
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 8 );
}

function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script('jquery-ui', get_template_directory_uri().'/js/jquery-ui-1.8.5.custom.min.js', false, '1.8.5');
		wp_enqueue_script('jquery-royalslider', get_template_directory_uri().'/js/royalslider/jquery.royalslider.min.js', false, '9.4.92');		
		wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', false, '2.2.0');		
		wp_enqueue_script('jquery-superfish', get_template_directory_uri().'/js/superfish.js', false, '1.4.2');
		wp_enqueue_script('jquery-quicksand', get_template_directory_uri().'/js/jquery.quicksand.js', false, '1.3');				
		wp_enqueue_script('html5', get_template_directory_uri().'/js/html5.js', false, '1.0');
		wp_enqueue_script('jquery-custom', get_template_directory_uri().'/js/custom.js', false, '1.0');		

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
		
}

function my_scripts_styles() {

	wp_enqueue_style( 'theme', get_stylesheet_uri() );
	wp_enqueue_style( 'royalslider', get_template_directory_uri().'/js/royalslider/royalslider.css' );
	wp_enqueue_style( 'royalslider-default', get_template_directory_uri().'/js/royalslider/skins/default/rs-default.css' );
	wp_enqueue_style( 'color', get_template_directory_uri().'/css/color-'.get_option('estudio_theme_stylesheet'));
	wp_enqueue_style( 'responsive', get_template_directory_uri().'/css/responsive.css');	
	wp_enqueue_style( 'custom', get_template_directory_uri().'/custom.css');	
		
}

add_action( 'wp_enqueue_scripts', 'my_scripts_styles' );

/*-----------------------------------------------------------------------------------*/
/*	Get Limit Excerpt
/*-----------------------------------------------------------------------------------*/
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function junkie_pagination($prev = '&laquo;', $next = '&raquo;') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
);
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo paginate_links( $pagination );
};

/*-----------------------------------------------------------------------------------*/
/*	Remove Image Caption from home/archive/search thumbnails
/*-----------------------------------------------------------------------------------*/
if (is_home() || is_archive() || is_search() ) {
	add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3);
} 


/*-----------------------------------------------------------------------------------*/
/*	Exclude Pages from Search Results
/*-----------------------------------------------------------------------------------*/
function tj_exclude_pages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','tj_exclude_pages');

/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/
function get_posts_related_by_taxonomy($post_id, $taxonomy, $notin, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    // Assumes only one term for per post in this taxonomy
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $args = wp_parse_args($args,array(
      'post_type' => $post->post_type, // The assumes the post types match
      //'post__in' => $post_ids,
	  'post__not_in' => array($notin),
      'taxonomy' => $taxonomy,
      'term' => $terms[0]->slug,
	  'posts_per_page' => get_option('businessplus_related_portfolio_num')
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
} 


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_comment' ) ) {
	function tj_comment($comment, $args, $depth) {
	
	    $isByAuthor = false;
	
	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }
	
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(($isByAuthor ? 'author-comment' : '')); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <div class="line"></div>
                
                <?php echo get_avatar($comment,$size='36'); ?>
                
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>', 'themejunkie'), get_comment_author_link()) ?>
                </div>

                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'themejunkie'),'  ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'themejunkie') ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-body">
                    <?php comment_text() ?>
                </div><!-- .comment-body -->

            </div><!-- #comment-<?php comment_ID(); ?> -->
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_list_pings' ) ) {
	function tj_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}



	
?>