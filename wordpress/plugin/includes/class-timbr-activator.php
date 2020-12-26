<?php

/**
 * Fired during plugin activation
 *
 * @link       app.timbr.io/demo
 * @since      1.0.0
 *
 * @package    Timbr
 * @subpackage Timbr/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Timbr
 * @subpackage Timbr/includes
 * @author     Zmago <zmago_devetak@yahoo.com>
 */
class Timbr_Activator
{

  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    1.0.0
   */
  public static function activate()
  {
    add_option('timbr_app_id');
  }
}
