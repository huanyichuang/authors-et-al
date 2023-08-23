<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://huanyichuang.com/
 * @since      1.0.0
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/admin
 * @author     Eric Chuang <huanyi.chuang@gmail.com>
 */
class Authors_Et_Al_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->run();

	}

	/**
	 * Hook the settings page into the admin menu.
	 * 
	 * @since    1.0.0
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'add_plugin_settings' ) );
		add_filter( 'plugin_action_links_' . $this->plugin_name, array( $this, 'add_action_links' ) );
		// Render the meta box
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		// Save the meta box data
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/authors-et-al-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/authors-et-al-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the settings page to the admin menu.
	 */
	public function add_plugin_admin_menu() {
		add_options_page(
			'Authors Et Al Settings',
			'Authors Et Al',
			'manage_options',
			'authors-et-al',
			array( $this, 'display_plugin_setup_page' )
		);
	}

	/**
	 * Register the settings for the plugin
	 */
	public function add_plugin_settings() {
		register_setting(
			'authors-et-al-settings-group',
			'authors-et-al-settings'
		);
		add_settings_section(
			'authors-et-al-settings-section',
			'',
			array( $this, 'display_settings_section' ),
			'authors-et-al'
		);

		add_settings_field(
			'authors-et-al-global-authors',
			'Default authors: ',
			array( $this, 'display_global_authors_field' ),
			'authors-et-al',
			'authors-et-al-settings-section'
		);

		/**
		 * Checkboxes to select which post types to apply the plugin to
		 */
		add_settings_field(
			'authors-et-al-post-types',
			'Apply to post types: ',
			array( $this, 'display_post_types_field' ),
			'authors-et-al',
			'authors-et-al-settings-section'
		);

		/**
		 * Dropdown to select the value of authors_et_al_template.
		 */
		add_settings_field(
			'authors-et-al-template',
			'Template to use: ',
			array( $this, 'display_template_field' ),
			'authors-et-al',
			'authors-et-al-settings-section'
		);

		/**
		 * Maximum number of authors to display.
		 */
		add_settings_field(
			'authors-et-al-max-authors',
			'Maximum number of authors to display: ',
			array( $this, 'display_max_authors_field' ),
			'authors-et-al',
			'authors-et-al-settings-section'
		);
	}

	/**
	 * Render the settings section
	 */
	public function display_settings_section() {
		echo '<h1>Authors Et Al Settings</h1>';
	}

	/**
	 * Render the settings field
	 */
	public function display_global_authors_field() {
		$options = get_option( 'authors-et-al-settings' );
		$authors_et_al = isset( $options['authors-et-al-global-authors'] ) ? $options['authors-et-al-global-authors'] : '';
		echo '<textarea id="authors-et-al-global-authors" name="authors-et-al-settings[authors-et-al-global-authors]" rows="5" cols="50">' . $authors_et_al . '</textarea>';
	}

	/**
	 * If the post type is selected in the settings, display the meta box `Other authors` at the sidebar in the post editor
	 */
	public function display_post_types_field() {
		$options = get_option( 'authors-et-al-settings' );
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		$authors_et_al_post_types = isset( $options['authors-et-al-post-types'] ) ? $options['authors-et-al-post-types'] : array();

		foreach ( $post_types as $post_type ) {
			$checked = in_array( $post_type->name, $authors_et_al_post_types ) ? 'checked' : '';
			echo '<input type="checkbox" name="authors-et-al-settings[authors-et-al-post-types][]" value="' . $post_type->name . '" ' . $checked . ' /> ' . $post_type->label . '<br />';
		}
	}

	/**
	 * Render the template field in dropdown, with the default template `template-stacking` selected.
	 */
	public function display_template_field() {
		$options = get_option( 'authors-et-al-settings' );
		$authors_et_al_template = isset( $options['authors-et-al-template'] ) ? $options['authors-et-al-template'] : 'template-stacking';
		echo '<select id="authors-et-al-template" name="authors-et-al-settings[authors-et-al-template]">';
		echo '<option value="template-stacking" ' . selected( $authors_et_al_template, 'template-stacking', false ) . '>Stacking</option>';
		echo '<option value="template-circle" ' . selected( $authors_et_al_template, 'template-circle', false ) . '>Circle</option>';
		echo '</select>';
	}

	/**
	 * Render the max authors field in number input, with the default value 3 selected.
	 */
	public function display_max_authors_field() {
		$options = get_option( 'authors-et-al-settings' );
		$authors_et_al_max_authors = isset( $options['authors-et-al-max-authors'] ) ? $options['authors-et-al-max-authors'] : 3;
		echo '<input id="authors-et-al-max-authors" name="authors-et-al-settings[authors-et-al-max-authors]" type="number" value="' . $authors_et_al_max_authors . '" min="1" max="99" />';
		echo '<p class="description">Set to 0 to display all authors.</p>';
	}

	/**
	 * If the post type is selected in the settings, display the meta box `Other authors` at the sidebar in the post editor
	 */
	public function add_meta_box() {
		$options = get_option( 'authors-et-al-settings' );
		$authors_et_al_post_types = isset( $options['authors-et-al-post-types'] ) ? $options['authors-et-al-post-types'] : array();

		$post_type = get_post_type();
		if ( in_array( $post_type, $authors_et_al_post_types ) ) {
			add_meta_box(
				'authors-et-al-meta-box',
				'Other authors',
				array( $this, 'display_meta_box' ),
				$post_type,
				'side',
				'high'
			);
		}
	}

	/**
	 * Render the meta box. This is where the user can enter the other authors in a comma separated list.
	 * The UI should be similar with the tags UI, on which the user can select from a list of existing authors with text but store the data as a comma separated ids.
	 */
	public function display_meta_box() {
		// Nonce for security
		wp_nonce_field( 'authors-et-al-save_meta_box', 'authors-et-al-meta-box-nonce' );
		$options = get_option( 'authors-et-al-settings' );
		$authors_list = get_post_meta( get_the_ID(), 'authors-et-al-meta-box', true );
		echo '<input id="authors-et-al-meta-box" name="authors-et-al-meta-box" type="text" value="' . $authors_list . '" size="25" />';
		
	}

	/**
	 * Save the meta box data. Must have nonce verification for security.
	 */
	public function save_meta_box( $post_id ) {
		error_log(print_r($_POST, true));
		if ( ! isset( $_POST['authors-et-al-meta-box-nonce'] ) ) {
			error_log( 'Nonce not set' );
			return;
		}
		if ( ! wp_verify_nonce( $_POST['authors-et-al-meta-box-nonce'], 'authors-et-al-save_meta_box' ) ) {
			error_log( 'Nonce not verified' );
			return;
		}		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			error_log( 'Doing autosave' );
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$authors_et_al = sanitize_text_field( $_POST['authors-et-al-meta-box'] );
		update_post_meta( $post_id, 'authors-et-al-meta-box', $authors_et_al );
	}

	/**
	 * Render the settings page
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/authors-et-al-admin-display.php' );
	}

	/**
	 * Add the settings link to the plugins page
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=authors-et-al' ) . '">Settings</a>',
		);
		return array_merge( $settings_link, $links );
	}
	
}
