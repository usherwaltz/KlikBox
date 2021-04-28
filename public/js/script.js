$(document).ready(function() {
 
    /* Navigation scroll */

    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {

        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
            if (target.length) {
                
                event.preventDefault();
                $('html, body').animate({scrollTop: target.offset().top}, 1000, function() {
                var $target = $(target);
                $target.focus();
              
                    if ($target.is/*(":focus")*/) {
                        return false;
                    } else {
                        $target.attr('tabindex','-1');
                        $target.focus();
                    };    
                });
            }
        }
    });
   
 /* ...... wp ... */ 
    
    
    
    
    /* ... NAV */
    
    $('.js--wp-1').waypoint(function(direction) {
        $('.js--wp-1').addClass('animated bounceInRight');        
    }, {
        offset: '100%'
    });
    
    
    $('.js--wp-2').waypoint(function(direction) {
        $('.js--wp-2').addClass('animated bounceInRight');        
    }, {
        offset: '100%'
    });   
    
    
    $('.js--wp-3').waypoint(function(direction) {
        $('.js--wp-3').addClass('animated bounceInLeft');        
    }, {
        offset: '100%'
    });
    
    
    $('.js--wp-4').waypoint(function(direction) {
        $('.js--wp-4').addClass('animated bounceInUp');        
    }, {
        offset: '100%'
    });    
    
    
    $('.js--wp-5').waypoint(function(direction) {
        $('.js--wp-5').addClass('animated bounceInDown');        
    }, {
        offset: '100%'
    });
    
    $('.js--wp-0').waypoint(function(direction) {
        $('.js--wp-0').addClass('animated bounceInUp');        
    }, {
        offset: '100%'
    });
    
     
    /*  ...SECTION */
    
    
    $('.js--wp-6').waypoint(function(direction) {
        $('.js--wp-6').addClass('animated fadeInUp');        
    }, {
        offset: '90%'
    });    
    
    
    $('.js--wp-7').waypoint(function(direction) {
        $('.js--wp-7').addClass('animated fadeInUp');        
    }, {
        offset: '90%'
    }); 
            
    
    $('.js--wp-8').waypoint(function(direction) {
        $('.js--wp-8').addClass('animated fadeInUp');        
    }, {
        offset: '90%'
    });  
    
 
    $('.js--wp-9').waypoint(function(direction) {
        $('.js--wp-9').addClass('animated fadeInUp');        
    }, {
        offset: '90%'
    }); 
    
    
    $('.js--wp-10').waypoint(function(direction) {
        $('.js--wp-10').addClass('animated fadeInUp');        
    }, {
        offset: '90%'
    });
    
    
 
    
    
    
    
    
    
   
    
    
});

/* ...... ... ...... */






