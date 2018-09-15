jQuery(document).ready(function(){

/*-----------------------------------------------------------------------------------*/
/*	jQuery Superfish Menu
/*-----------------------------------------------------------------------------------*/

    function init_nav(){
        jQuery('ul.nav').superfish({ 
	        delay:       1000,                             // one second delay on mouse out 
	        animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
	        speed:       'fast'                           // faster animation speed 
    	});
    }
    init_nav();

/*-----------------------------------------------------------------------------------*/
/*	Responsive Menu
/*-----------------------------------------------------------------------------------*/
	$(window).resize(function(){
		if($("#primary-nav").width() >768){
			$("#responsive-menu").hide();
		} 

	});
	
	$(".btn-nav-right").click(function(){
			$("#responsive-menu").slideToggle(300);
	});

// Quick Sand
    function control_quicksand(){
	    
        jQuery('#sort-by').children('li').each(function(){
            $text = jQuery(this).find('a').text();
            $class = jQuery(this).attr('class');
            $class = $class.replace('cat-item','');
            jQuery(this).find('a').attr('href','');
            jQuery(this).find('a').attr('class',$class);
            jQuery(this).attr('class','');
        });
        
        jQuery('#sort-by').append('<li class="active" ><a class="all">All</a></li>');

        var $filterType = jQuery('#sort-by li.active a').attr('class');

        var $holder = jQuery('ul.ourHolder');

        var $data = $holder.clone();

        jQuery('#sort-by>li a').click(function(e) {
            jQuery('#sort-by li').removeClass('active');
            var $filterType = jQuery(this).attr('class');

            jQuery(this).parent().addClass('active');

            
            if ($filterType == 'all') {

                var $filteredData = $data.children('li');

            }else {

                var $filteredData = $data.find('li[data-type*=' + $filterType + ']');

            }

            $holder.quicksand($filteredData,{
                duration: 500,
                easing: 'easeInOutQuad'
            }, function() {
                //tj_prettyPhoto();
	            tj_overlay();
                        
            });
           
            return false;

        });

    }
    control_quicksand();
    
     /* Fix IE quirks ------------------------------*/
    if( jQuery('body').hasClass('ie8') || jQuery('body').hasClass('ie7') ) {
        var portfolioImages = jQuery('.post-thumb-overlay').siblings('img');
        
        portfolioImages.hover(
            function() {
                jQuery(this).animate({
                    opacity: .4
                }, 300);
            },
            function() {
                jQuery(this).animate({
                    opacity: 1
                }, 300);
            }
        );
    }
       
        
})
  

// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider1').flexslider({
    animation: "slide",
    animationLoop: false,
    directionNav: false,
    itemWidth: 300,
    itemMargin: 20,
    minItems: 3,
    maxItems: 3,
    move: 3,
    slideshow: false,
    smoothHeight: false       
  });
  $('.flexslider2').flexslider({
    animation: "fade",
  }); 
  $('.flexslider3').flexslider({
    animation: "fade",
    directionNav: true,
    smoothHeight: false,
    controlNav: false 
  });     
});
