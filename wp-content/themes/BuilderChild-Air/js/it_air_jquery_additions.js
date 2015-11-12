jQuery(document).ready(function() {

	jQuery(".mobile-nav .menu").addClass("hidden");
	jQuery(".mobile-nav").addClass("mobile");
	
	jQuery(".hidden").before('<div id="it-mobile-menu">☰ Menu</div>');
	
	jQuery("#it-mobile-menu").click(function(){
		jQuery(".mobile-nav .menu").slideToggle();
		jQuery(".builder-module-navigation.mobile").toggleClass("borderless");
	});
	
	jQuery(window).resize(function(){
		if(window.innerWidth > 500) {
			jQuery(".menu").removeAttr("style");
			jQuery(".builder-module-navigation.mobile").removeAttr("style");
		}
	});

});
