<?php
global $emsm_admin;

class EMSocialMediaAdmin {

	public $option_name='em_social_media_options';

	function __construct() {
		add_action('admin_menu', array($this, 'add_plugin_page'));
		
		
		
		add_action('wp_enqueue_scripts',array($this,'scripts_styles'));
		add_action('admin_enqueue_scripts',array($this,'admin_scripts_styles'));

		$this->default_options=$this->setup_default_options();


	}

	function scripts_styles() {
		wp_enqueue_style('font-awesome-css','//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',array(),'4.2.0');
	}

	function admin_scripts_styles() {
		wp_enqueue_style('font-awesome-css','//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',array(),'4.2.0');
		wp_enqueue_style('social-media-admin-style', plugin_dir_url(dirname(__FILE__)).'/admin/css/social-media.css');

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-modal-script',plugin_dir_url(dirname(__FILE__)).'js/jquery.modal.min.js',array('jquery'),'0.5.5',true);
		wp_enqueue_script('social-media-script',plugin_dir_url(dirname(__FILE__)).'js/social-media.js',array('jquery'),'1.0.0',true);
	}

	/**
	 * add_plugin_page function.
	 * 
	 * @access public
	 * @return void
	 */
	public function add_plugin_page() {
    	add_options_page('Social Media','Social Media','manage_options','em-social-media', array($this, 'admin_page'));
	}

	function setup_default_options() {
		$options=array(
			'facebook' => array(
				'name' => 'Facebook',
				'url' => 'https://www.facebook.com/WordPress',
				'icon' => 'fa-facebook-square'
			),
			'twitter' => array(
				'name' => 'Twitter',
				'url' => 'https://twitter.com/wordpress',
				'icon' =>	'fa-twitter-square'
			)
		);

		return $options;
	}

	/**
	 * admin_page function.
	 * 
	 * @access public
	 * @return void
	 */
	public function admin_page() {
		echo $this->get_admin_page('settings');
	}

	function get_fa_arr() {
		$fa_css_prefix='fa';
		$css = file_get_contents($this->fontawesome_file_path);
		$pattern='/\.('.$fa_css_prefix.'-(?:\w+(?:-)?)+):/';
		$icons=array();

		preg_match_all($pattern, $css, $matches, PREG_SET_ORDER);

		foreach($matches as $match) :
			$clean_match=preg_replace('/(fa-)/','',$match[1]);
			$clean_match=preg_replace('/(-)/',' ',$clean_match);

			$icons[]=array(
				'name' => ucwords($clean_match),
				'class' => $match[1]
			);
		endforeach;

		usort($icons, function ($a, $b) {
    	return strcmp($a['class'], $b['class']);
		});

		return $icons;
	}
	
	/**
	 * get_admin_page function.
	 * 
	 * @access public
	 * @param bool $template_name (default: false)
	 * @return void
	 */
	public function get_admin_page($template_name=false) {
		if (!$template_name)
			return false;
	
		ob_start();
	
		do_action('emsm_before_admin_'.$template_name);
	
		include(EMSM_PATH.'admin/pages/'.$template_name.'.php');
	
		do_action('emsm_after_admin_'.$template_name);
	
		$html=ob_get_contents();
	
		ob_end_clean();
	
		return $html;
	}

}

$emsm_admin=new EMSocialMediaAdmin();
?>