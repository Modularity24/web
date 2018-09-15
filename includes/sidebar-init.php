<?php

function junkie_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'themejunkie' ),
		'id'            => 'sidebar',
		'description'   => __( 'Appears in the sidebar section of the site.', 'themejunkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column1)', 'themejunkie' ),
		'id'            => 'footer-col-1',
		'description'   => __( 'Appears in the footer section of the site.', 'themejunkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column2)', 'themejunkie' ),
		'id'            => 'footer-col-2',
		'description'   => __( 'Appears in the footer section of the site.', 'themejunkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column3)', 'themejunkie' ),
		'id'            => 'footer-col-3',
		'description'   => __( 'Appears in the footer section of the site.', 'themejunkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column4)', 'themejunkie' ),
		'id'            => 'footer-col-4',
		'description'   => __( 'Appears in the footer section of the site.', 'themejunkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
					
}
add_action( 'widgets_init', 'junkie_widgets_init' );
	
?>