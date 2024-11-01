jQuery(document).ready(function($){
	// add stylesheet
	$('head').prepend($('<link>').attr({
		rel: 'stylesheet',
		type: 'text/css',
		media: 'screen',
		href: abtSponsorFlipwall.stylesheet
	}));
	
	// click handler
	$('div.flipwall-tile div.flip').live('click',function(e){
		
		// check if handler or link was clicked
		if( 'a' == e.target.tagName.toLowerCase() ) return;
		
		// $(this) point to the clicked .sponsorFlip element (caching it in elem for speed):
		
		var elem = $(this);
		
		// data('flipped') is a flag we set when we flip the element:
		
		if(elem.data('flipped'))
		{
			// If the element has already been flipped, use the revertFlip method
			// defined by the plug-in to revert to the default state automatically:
			
			elem.revertFlip();
			
			// Unsetting the flag:
			elem.data('flipped',false);
		}
		else
		{
			// Using the flip method defined by the plugin:
			
			elem.flip({
				direction: abtSponsorFlipwall.direction /*'lr'*/,
				speed: abtSponsorFlipwall.speed /*350*/,
				onBefore: function(){
					// Insert the contents of the .sponsorData div (hidden from view with display:none)
					// into the clicked .sponsorFlip div before the flipping animation starts:
					
					elem.html(elem.siblings('div.entry-meta').html());
				}
			});
			
			// Setting the flag:
			elem.data('flipped',true);
		}
	});
	
});