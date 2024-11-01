<?php
/*
Plugin Name: Sponsor Flipwall Shortcode
Plugin URI: wordpress-plugin-sponsor-flipwall-shortcode
Description: Creates a cool sponsor wall with flip effect; include tiles with shortcode
Author: atlanticbt, zaus
Version: 1.2.1
Author URI: http://atlanticbt.com
Credits: based on article Martin Angelov http://tutorialzine.com/2010/03/sponsor-wall-flip-jquery-css/
Changelog:
	1.0	sponsor flipwall
	1.1	cleaned up a little, "jedi" script inclusion
	1.2	target attribute, changed click handler to ignore links
	1.2.1	just a version change to notify ppl of readme "flipwallgroup" correction
*/

class abtSponsorFlipwall { 
	const VERSION = '1.2.1';

	/**
	 * Jedi Master way - conditionally include scripts
	 * @see http://scribu.net/wordpress/optimal-script-loading.html
	 */
	static $add_script;
	
	static $tile_counter = 0;
	

	function abtSponsorFlipwall() {
		$this->__construct();
	} // function

	function __construct()
	{
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'init', array( &$this, 'init' ) );
		
		add_action('wp_footer', array(&$this, 'print_scripts'));
	} // function

	function admin_init() {
		# perform your code here
		///TODO: any admin stuff...maybe a button?
	} // function

	/**
	 * Add scripts and styles
	 * but save the enqueue for when the shortcode actually called?
	 */
	function init(){
		wp_register_script('jquery-flip', plugins_url('jquery.flip.min.js', __FILE__), array('jquery'), self::VERSION, true);
		wp_register_script('sponsor-flip-init', plugins_url('script.js', __FILE__), array('jquery', 'jquery-flip'), self::VERSION, true);
		###wp_register_style('sponsor-flip', plugins_url('styles.css', __FILE__), array(), self::VERSION, 'all');
		
		add_shortcode('flipwall', array(&$this, 'shortcode_tile'));
		add_shortcode('flipwallgroup', array(&$this, 'shortcode_wrapper'));
	}

	/**
	 * Hook to footer to print scripts, only if shortcode called
	 * @link http://scribu.net/wordpress/optimal-script-loading.html
	 */
	function print_scripts(){
		if( ! self::$add_script ) return;	// only if included once
		
		#plugins_url('styles.css', __FILE__)
		
		wp_enqueue_scripts('jquery-flip');
		// use localize to pass arbitrary data (stylesheet path)
		$flipwall_js_data = apply_filters(__CLASS__.'_localize', array(
			'stylesheet' => plugins_url('styles.css', __FILE__)
			, 'speed' => 350
			, 'direction' => 'lr'
		));
		wp_localize_script('jquery-flip', __CLASS__, $flipwall_js_data);
		wp_print_scripts('sponsor-flip-init');	// need to print at least one?
	}
	
	/*-----------------------------------*/
	function shortcode_tile($atts, $content = null) {
		self::$add_script = true;	// only include scripts if shortcode is called
		
		extract(shortcode_atts(array(
			'id' => false
			,'title' => 'Sponsor'
			,'url' => false
			,'linktext' => false
			,'image' => false
			,'text' => null
			,'class' => null
			,'target' => false		// false means don't use
		), $atts));
		
		//random id if not given
		if(!$id){
			$id = 'flipwall-'.++self::$tile_counter;
		}
		/* 	/// don't really need a default image...no purpose
		//default image if not given - look in stylesheet directory
		if($image === false){
			$image = get_stylesheet_directory_uri() . "/flipwall/$id.jpg";
		}
		*/
		
		//shorthand - specify just text
		if($content == null){ $content = $text; }
		
		// cheat!
		/* catch the echo output, so we can control where it appears in the text  */
		ob_start();
		?>
		<div title="Click to flip" class="flipwall-tile<?php if($class != null){ echo ' ', esc_attr($class); } ?>" id="<?php echo esc_attr($id); ?>">
			<div class="flip">
				<?php if( false === $image ) {
					echo 'More about ', $title; 
				} else {
					?><img alt="More about <?php echo $title?>" src="<?php echo $image?>"><?php
				} ?>
			</div>
		
			<?php if( $content !== null || $url !== false ) { ?>
			<div class="entry-meta">
				<span class="title"><?php echo $title; ?></span>
				
				<?php if( $content !== null ): ?>
				<div class="description">
					<?php echo $content?>
				</div>
				<?php endif; //has content ?>
				<?php if( $url !== false ): ?>
				<div class="url">
					<a href="<?php echo esc_attr($url); if($target) echo '" target="', esc_attr($target); ?>"><?php if($linktext === false){ echo $url; } else { echo $linktext; }?></a>
				</div>
				<?php endif; //has url ?>
			</div>
			<?php } // if has text and url ?>
		</div><!-- //tile -->
		<?php
		
		return ob_get_clean();
	}//--	fn	shortcode_tile
	
	
	function shortcode_wrapper($atts, $content = null){
		extract(shortcode_atts(array(
			'class' => 'flipwallListHolder'
			, 'id' => 'flipwall-group-' . ++self::$tile_counter
		), $atts));
		
		// cheat!
		/* catch the echo output, so we can control where it appears in the text  */
		ob_start();
		?>
		<div id="<?php
			echo $id;
			if($class != null) echo '" class="', $class; ?>">
			<?php echo do_shortcode( strip_tags($content) ); ?>
		</div>
		<?php
		return ob_get_clean();
	}//--	fn	shortcode_wrapper
	/*-----------------------------------*/

}///---	class	abtSponsorFlipwall


// engage!
new abtSponsorFlipwall;

?>