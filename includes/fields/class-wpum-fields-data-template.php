<?php
/**
 * This class is responsible for loading the profile, groups and data and displaying it.
 *
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.2.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * WPUM_Fields_Data_Template Class.
 *
 * The profile fields loop class.
 *
 * @since 1.2.0
 */
class WPUM_Fields_Data_Template {

  /**
   * The loop iterator.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $current_group = -1;

  /**
   * The number of groups returned by the query.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $group_count;

  /**
   * List of groups found by the query.
   *
   * @since 1.2.0
   * @access public
   * @var array
   */
	public $groups;

  /**
   * The current group object being iterated on.
   *
   * @since 1.2.0
   * @access public
   * @var object
   */
	public $group;

  /**
   * The current field.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $current_field = -1;

  /**
   * The field count.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $field_count;

  /**
   * Whether the field has data.
   *
   * @since 1.2.0
   * @access public
   * @var bool
   */
	public $field_has_data;

  /**
   * The field.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $field;

  /**
   * Flag to check whether the loop is currently being iterated.
   *
   * @since 1.2.0
   * @access public
   * @var bool
   */
	public $in_the_loop;

  /**
   * The user id.
   *
   * @since 1.2.0
   * @access public
   * @var int
   */
	public $user_id;

  /**
	 * Get things going.
	 *
	 * @since 1.2.0
	 */
	public function __construct( $args = '' ) {

	}

}