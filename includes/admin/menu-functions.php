<?php
/**
 * Manage wpum menu functionalities.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Load new metabox for nav menu ui.
 *
 * @since 1.1.0
 * @return void
 */
function wpum_admin_menu_metabox() {
	add_meta_box( 'add-wpum-nav-menu', esc_html__( 'WP User Manager' ), 'wpum_admin_do_wp_nav_menu_metabox', 'nav-menus', 'side', 'default' );
	//add_action( 'admin_print_footer_scripts', 'wpum_admin_wp_nav_menu_restrict_items' );
}
add_action( 'load-nav-menus.php', 'wpum_admin_menu_metabox' );

/**
 * Build and populate the wpum metabox into the menu manager ui.
 *
 * @since 1.1.0
 * @return void
 */
function wpum_admin_do_wp_nav_menu_metabox() {

	global $nav_menu_selected_id;

	$walker = new WPUM_Walker_Nav_Menu_Checklist( false );
	$args   = array( 'walker' => $walker );

	$post_type_name = 'wp_user_manager';

	$tabs = array();

	$tabs['loggedin']['label']  = __( 'Logged-In' );
	$tabs['loggedin']['pages']  = wpum_nav_menu_get_loggedin_pages();

	$tabs['loggedout']['label'] = __( 'Logged-Out' );
	$tabs['loggedout']['pages'] = wpum_nav_menu_get_loggedout_pages();

	?>

	<div id="wpum-menu" class="posttypediv">
		<h4><?php _e( 'Logged-In' ) ?></h4>
		<p><?php _e( '<em>Logged-In</em> links are not visible to visitors who are not logged in.' ) ?></p>

		<div id="tabs-panel-posttype-<?php echo $post_type_name; ?>-loggedin" class="tabs-panel tabs-panel-active">
		  <ul id="wpum-menu-checklist-loggedin" class="categorychecklist form-no-clear">
		    <?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $tabs['loggedin']['pages'] ), 0, (object) $args );?>
		  </ul>
		</div>

		<h4><?php _e( 'Logged-Out' ) ?></h4>
		<p><?php _e( '<em>Logged-Out</em> links are not visible to users who are logged in.' ) ?></p>

		<div id="tabs-panel-posttype-<?php echo $post_type_name; ?>-loggedout" class="tabs-panel tabs-panel-active">
			<ul id="wpum-menu-checklist-loggedout" class="categorychecklist form-no-clear">
				<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $tabs['loggedout']['pages'] ), 0, (object) $args );?>
			</ul>
		</div>

		<p class="button-controls">
			<span class="add-to-menu">
				<input type="submit"<?php if ( function_exists( 'wp_nav_menu_disabled_check' ) ) : wp_nav_menu_disabled_check( $nav_menu_selected_id ); endif; ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-custom-menu-item" id="submit-wpum-menu" />
				<span class="spinner"></span>
			</span>
		</p>
	</div><!-- /#wpum-menu -->

	<?php

}

/**
 * Create a fake post object for the wp menu manager.
 *
 * @since 1.1.0
 * @return void
 */
function wpum_nav_menu_get_loggedout_pages() {

	$wpum_menu_items = array();

	$wpum_menu_items[] = array(
		'name' => __( 'Log In' ),
		'slug' => 'login',
		'link' => wp_login_url(),
	);

	// If there's nothing to show, we're done
	if ( count( $wpum_menu_items ) < 1 ) {
		return false;
	}

	$page_args = array();

	foreach ( $wpum_menu_items as $wpum_item ) {
		$page_args[ $wpum_item['slug'] ] = (object) array(
			'ID'             => -1,
			'post_title'     => $wpum_item['name'],
			'post_author'    => 0,
			'post_date'      => 0,
			'post_excerpt'   => $wpum_item['slug'],
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'guid'           => $wpum_item['link']
		);
	}

	return $page_args;

}

/**
 * Create a fake post object for the wp menu manager.
 *
 * @since 1.1.0
 * @return void
 */
function wpum_nav_menu_get_loggedin_pages() {

	$wpum_menu_items = array();

	$wpum_menu_items[] = array(
		'name' => __( 'Log out' ),
		'slug' => 'logout',
		'link' => wpum_logout_url(),
	);

	// If there's nothing to show, we're done
	if ( count( $wpum_menu_items ) < 1 ) {
		return false;
	}

	$page_args = array();

	foreach ( $wpum_menu_items as $wpum_item ) {
		$page_args[ $wpum_item['slug'] ] = (object) array(
			'ID'             => -1,
			'post_title'     => $wpum_item['name'],
			'post_author'    => 0,
			'post_date'      => 0,
			'post_excerpt'   => $wpum_item['slug'],
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'guid'           => $wpum_item['link']
		);
	}

	return $page_args;

}
