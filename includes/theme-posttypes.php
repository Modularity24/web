<?php

//Add Slider Post Type

function tj_create_post_type_slide()
{
	$labels = array(
		'name' => __( 'Featured Slider','themejunkie'),
		'singular_name' => __( 'Slide','themejunkie' ),
		'add_new' => __('Add New','themejunkie'),
		'add_new_item' => __('Add New Slide','themejunkie'),
		'edit_item' => __('Edit Slide','themejunkie'),
		'new_item' => __('New Slide','themejunkie'),
		'view_item' => __('View Slide','themejunkie'),
		'search_items' => __('Search Slide','themejunkie'),
		'not_found' =>  __('No slide found','themejunkie'),
		'not_found_in_trash' => __('No slide found in Trash','themejunkie'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields','excerpt','')
	  );

	  register_post_type(__( 'slide', 'junkie' ),$args);
}

//Add Testimonial Post Type

function tj_create_post_type_testimonial()
{
	$labels = array(
		'name' => __( 'Testimonials','themejunkie'),
		'singular_name' => __( 'Testimonial','themejunkie' ),
		'add_new' => __('Add New','themejunkie'),
		'add_new_item' => __('Add New Testimonial','themejunkie'),
		'edit_item' => __('Edit Testimonial','themejunkie'),
		'new_item' => __('New Testimonial','themejunkie'),
		'view_item' => __('View Testimonial','themejunkie'),
		'search_items' => __('Search Testimonial','themejunkie'),
		'not_found' =>  __('No testimonial found','themejunkie'),
		'not_found_in_trash' => __('No testimonial found in Trash','themejunkie'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','','custom-fields','excerpt','')
	  );

	  register_post_type(__( 'testimonial', 'junkie' ),$args);
}


//Add Portfolio Post Type

function tj_create_post_type_portfolio()
{
	$labels = array(
		'name' => __( 'Portfolio Items','themejunkie'),
		'singular_name' => __( 'Portfolio','themejunkie' ),
		'add_new' => __('Add New','themejunkie'),
		'add_new_item' => __('Add New Portfolio','themejunkie'),
		'edit_item' => __('Edit Portfolio','themejunkie'),
		'new_item' => __('New Portfolio','themejunkie'),
		'view_item' => __('View Portfolio','themejunkie'),
		'search_items' => __('Search Portfolio','themejunkie'),
		'not_found' =>  __('No portfolio found','themejunkie'),
		'not_found_in_trash' => __('No portfolio found in Trash','themejunkie'),
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields','excerpt','comments')
	  ); 
	  
	  register_post_type(__( 'portfolio', 'junkie' ),$args);
}

function tj_build_taxonomies(){
    
	$args = array(
		"hierarchical" => true, 
		"label" => __( "Portfolio Types", 'themejunkie' ), 
		"singular_label" => __( "Portfolio Type", 'themejunkie' ), 
		"rewrite" => array('slug' => 'portfolio-type', 'hierarchical' => true), 
		"public" => true
	);
    
	register_taxonomy(__( "portfolio-type", 'junkie' ), array(__( "portfolio", 'junkie' )), $args); 
}


function tj_portfolio_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Portfolio Item Title', 'themejunkie' ),
            "type" => __( 'Type', 'themejunkie' ),
            'date' => __( 'Date' )
        );  
  
        return $columns;  
}

function tj_portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case __( 'type', 'themejunkie' ):  
                echo get_the_term_list($post->ID, __( 'portfolio-type', 'junkie' ), '', ', ','');  
                break;
        }  
}

add_action( 'init', 'tj_create_post_type_slide' );
add_action( 'init', 'tj_create_post_type_portfolio' );
add_action( 'init', 'tj_create_post_type_testimonial' );


add_action( 'init', 'tj_build_taxonomies', 0 );

add_filter("manage_edit-portfolio_columns", "tj_portfolio_edit_columns");

add_action("manage_posts_custom_column",  "tj_portfolio_custom_columns");

?>