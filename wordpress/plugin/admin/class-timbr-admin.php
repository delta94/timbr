<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       app.timbr.io/demo
 * @since      1.0.0
 *
 * @package    Timbr
 * @subpackage Timbr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Timbr
 * @subpackage Timbr/admin
 * @author     Zmago <zmago_devetak@yahoo.com>
 */
class Timbr_Admin
{

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
  public function __construct($plugin_name, $version)
  {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/timbr-admin.css', array(), $this->version, 'all');
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {
    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/timbr-admin.js', array('jquery', 'wp-color-picker'), $this->version, false);
  }

  function init_settings()
  {
    $this->register_settings();

    settings_fields('timbr_widget_setting');
    do_settings_fields('timbr_account_id', 'timbr_widget_setting');
    add_settings_section(
      'timbr_settings_section',
      'Timbr Settings',
      array($this, 'settings_section_cb'),
      'general'
    );

    $this->add_settings_fields();
  }

  private function register_settings()
  {
    register_setting('general', 'timbr_account_id');
    register_setting('general', 'timbr_widget_title', array('default' => 'Welcome!'));
    register_setting('general', 'timbr_widget_subtitle', array('default' => 'How can we help you?'));
    register_setting('general', 'timbr_new_message_placeholder', array('default' => 'Start typing...'));
    register_setting('general', 'timbr_greeting');
    register_setting('general', 'timbr_primary_color', array('default' => '#1890ff'));
    register_setting('general', 'timbr_require_email_upfront');
    register_setting('general', 'timbr_base_url', array('default' => 'https://app.timbr.io'));
  }

  private function add_settings_fields()
  {
    add_settings_field(
      'timbr_account_id',
      __('Timbr account ID', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_account_id'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_account_id',
        'tip'       => __('You can get your account ID in the Timbr dashboard', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_base_url',
      __('Timbr app base URL', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_base_url'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_base_url',
        'tip'       => __('Change this if you have your own instance', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_widget_title',
      __('Widget title', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_widget_title'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_widget_title',
        'tip'       => __('The title at the top of the chat widget', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_widget_subtitle',
      __('Widget subtitle', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_widget_subtitle'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_widget_subtitle',
        'tip'       => __('The message below the title in the chat widget', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_new_message_placeholder',
      __('New message placeholder', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_new_message_placeholder'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_new_message_placeholder',
        'tip'       => __('The placeholder text for the message input', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_greeting',
      __('Greeting', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_greeting'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_greeting',
        'tip'       => __('Set the greeting message (optional)', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_primary_color',
      __('Widget primary color', $this->plugin_name),
      array($this, 'text_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'text',
        'value'     => get_option('timbr_primary_color'),
        'class'     => 'timbr-color-picker',
        'label_for' => 'timbr_primary_color',
        'tip'       => __('Choose the theme color', $this->plugin_name)
      ),
    );

    add_settings_field(
      'timbr_require_email_upfront',
      __('Require email upfront', $this->plugin_name),
      array($this, 'checkbox_input_callback'),
      'general',
      'timbr_settings_section',
      array(
        'type'      => 'checkbox',
        'value'     => get_option('timbr_require_email_upfront'),
        'class'     => 'regular-text ltr',
        'label_for' => 'timbr_require_email_upfront',
        'tip'       => __('Check if you want to require the email upfront', $this->plugin_name)
      ),
    );
  }

  function settings_section_cb($arg)
  {
    echo __('Add the configuration settings for your Timbr widget here.', $this->plugin_name);
  }

  function text_input_callback($args)
  {
    $html = '<input id="' . esc_attr($args['label_for']) . '" type="' . esc_attr($args['type']) . '"';
    $html .= ' value="' . esc_attr($args['value']) . '" class="' . $args['class'] . '" name="' . $args['label_for']  . '"/>';
    $html .= '<p class="description">' . esc_attr($args['tip']) . '</p>';

    echo $html;
  }

  function checkbox_input_callback($args)
  {
    echo '<input type="' . $args['type']  . '" id="' . $args['label_for'] . '" value="1" name="' . $args['label_for']  . '"';
    if ($args['value'] == '1') {
      echo ' checked';
    }
    echo '/>';
  }
}
