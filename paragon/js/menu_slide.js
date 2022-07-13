$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("fast");
            $(this).toggleClass('open');   
            //$(this).find('.dropdown-menu').slideDown('fast');
            //$(this).addClass('open');
            
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("fast");
            $(this).toggleClass('open'); 
            //$(this).find('.dropdown-menu').slideUp('fast');    
            //$(this).removeClass('open');
             
        }
        );
	
			
			$("body").on("contextmenu",function(e){
				return false;
			});

			$('body').bind('cut copy paste', function (e) {
				e.preventDefault();
			});

			//Disable cut copy paste
			$('body').bind('cut copy paste', function (e) {
				e.preventDefault();
			});

			//Disable mouse right click
			$("body").on("contextmenu",function(e){
				return false;
			});
			
    });