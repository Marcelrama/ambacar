$(function() {
	$("#element").introLoader({
        animation: {
            name: 'gifLoader',
            options: {
                ease: "easeInOutCirc",
                style: 'light',
                delayBefore: 500,
                delayAfter: 0,
                exitTime: 300
            }
        }
    });
	
	$dd = true;
	$pos_top = true;
	$w_autol = $( '.auto-left' ).width();

	if( $( window ).width() < 992 ){
		$( '.btn-map' ).click();
		setTimeout(function(){ $( '.btn-first' ).click(); }, 1000);
		
	}

	if( $( window ).width() > 576 ){
		$( '.auto-left' ).css('left', -$w_autol);
		$( '.auto-right' ).css('right', -$w_autol);
	}	
		$( document ).scroll(function() {
		  	$trigger = $('#t-home').offset().top;
			$t_autos = $('#t-autos').offset().top;

			if( $trigger >= $t_autos){
				$val = $( window ).scrollTop() - $('#t-autos').offset().top/2;
				$vl_mov = ($w_autol - $val)-200;
				if( $vl_mov >= 0){
					$( '.auto-left' ).css('left', -$vl_mov);
					$( '.auto-right' ).css('right', -$vl_mov);
				}
			}

			if( $( window ).scrollTop() > 0 ){
				$( '#navtop' ).addClass('bg-red');
			}else{
				$( '#navtop' ).removeClass('bg-red');
			}

		});
	

    
    $('.goto').click(function(event){
	    	$div = $(this).attr('href');
    	$('html, body').animate({scrollTop:$($div).position().top}, 'slow');
    });

    if( $( window ).width() < 768 ){
    	$('a.nav-link').click(function(event){
    		setTimeout(function(){ $(".slider-stick").slick(); }, 1000);
    	});

 		$(".slider-stick").slick({
		  	autoplay: true,
		  	autoplaySpeed: 2500,
		    dots: true,
		    infinite: true,
		    slidesToScroll: 1,
		    responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        arrows: false,
			        slidesToShow: 1
			      }
			    }
			]
		});
    }

});
