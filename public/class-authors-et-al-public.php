<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://huanyichuang.com/
 * @since      1.0.0
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/public
 * @author     Eric Chuang <huanyi.chuang@gmail.com>
 */
class Authors_Et_Al_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->run();

	}

	/**
	 * Add the `authors-et-al` class to the post author list.
	 */
	public function run() {
		add_filter( 'the_content', array( $this, 'append_authors_et_al' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Authors_Et_Al_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Authors_Et_Al_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/authors-et-al-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Authors_Et_Al_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Authors_Et_Al_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/authors-et-al-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * If the post has the meta value of `authors-et-al-meta-box`, then append the authors-et-al to the post author list when rendering the post.
	 * 
	 * @param string $authors The post author list.
	 * 
	 * @return string The post author list with the authors-et-al appended.
	 * 
	 * @hook the_author
	 */
	public function append_authors_et_al( $content ) {
		$options = get_option( 'authors-et-al-settings' );
		$et_al   = false;

		$authors_global = $options['authors-et-al-global-authors'];
		// Explode the global authors list into an array.
		$authors_global = explode( ', ', $authors_global );

		$authors_et_al = get_post_meta( get_the_ID(), 'authors-et-al-meta-box', true );
		// Explode the post author list into an array.
		$authors_et_al = explode( ', ', $authors_et_al );

		$authors[] = get_the_author();
		// Append the authors-et-al to the post author list.
		$authors = array_merge( $authors, $authors_global );
		$authors = array_merge( $authors, $authors_et_al );

		// If $options['authors-et-al-max-authors'] is set, then remove the authors after the max number.
		if ( 0 !== $options['authors-et-al-max-authors'] ) {
			$et_al   = true;
			$authors = array_slice( $authors, 0, $options['authors-et-al-max-authors'] );
		}

		// Use the plugin option to determine which template to use.
		
		$authors_et_al = $options['authors-et-al-template'];
		// If the plugin option is not set, then use the default template.
		if ( ! $authors_et_al ) {
			$authors_et_al = 'authors-et-al-public-display';
		}
		
		// Render the template.
		$authors_et_al = plugin_dir_path( __FILE__ ) . 'partials/' . $authors_et_al . '.php';
		ob_start();
		include_once $authors_et_al;

		return ob_get_clean() . $content;
	}

}
