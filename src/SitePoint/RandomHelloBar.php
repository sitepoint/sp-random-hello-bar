<?php
namespace SitePoint;

class RandomHelloBar {

  const PLUGIN_NAME = 'sp-random-hello-bar';

  private static function get_option($option) {
    return get_option(self::PLUGIN_NAME.'-'.$option);
  }

  private static function update_option($option, $value) {
    return update_option(self::PLUGIN_NAME.'-'.$option, $value);
  }

  private static function delete_option($option) {
    return delete_option(self::PLUGIN_NAME.'-'.$option);
  }

  /**
   * setup the admin hooks
   */
  public static function admin_actions() {
    add_action('admin_init', '\Sitepoint\RandomHelloBar::admin_init');

    add_action('admin_menu', function() {
      add_options_page('SP Random Hello Bar', 'SP Random Hello Bar', 'manage_options', self::PLUGIN_NAME, '\SitePoint\RandomHelloBar::options_page');
    });
  }

  public static function admin_init() {
    register_setting(self::PLUGIN_NAME.'-settings-group', self::PLUGIN_NAME.'-enabled');
    register_setting(self::PLUGIN_NAME.'-settings-group', self::PLUGIN_NAME.'-basic-js');
    register_setting(self::PLUGIN_NAME.'-settings-group', self::PLUGIN_NAME.'-load-css');
    register_setting(self::PLUGIN_NAME.'-settings-group', self::PLUGIN_NAME.'-ads', '\SitePoint\RandomHelloBar::sanitize_ads');

    add_settings_section(self::PLUGIN_NAME.'-section-one', 'Settings', '\SitePoint\RandomHelloBar::section_one_help', self::PLUGIN_NAME);

    add_settings_field(self::PLUGIN_NAME.'-enabled', 'Enabled', function() {
        $setting = esc_attr(self::get_option('enabled'));
        include dirname( __FILE__ ).'/../views/admin/enabled-fields.php';
    }, self::PLUGIN_NAME, self::PLUGIN_NAME.'-section-one');

    add_settings_field(self::PLUGIN_NAME.'-basic-js', 'Enqueue Basic JS', function() {
        $setting = esc_attr(self::get_option('basic-js'));
        include dirname( __FILE__ ).'/../views/admin/basic-js-fields.php';
    }, self::PLUGIN_NAME, self::PLUGIN_NAME.'-section-one');

    add_settings_field(self::PLUGIN_NAME.'-load-css', 'Enqueue Basic CSS', function() {
        $setting = esc_attr(self::get_option('load-css'));
        include dirname( __FILE__ ).'/../views/admin/load-css-fields.php';
    }, self::PLUGIN_NAME, self::PLUGIN_NAME.'-section-one');

    add_settings_section(self::PLUGIN_NAME.'-section-two', 'Hello Bar Ads', '\SitePoint\RandomHelloBar::section_two_help', self::PLUGIN_NAME);

    add_settings_section(self::PLUGIN_NAME.'-field-two', null, '\SitePoint\RandomHelloBar::ad_fields', self::PLUGIN_NAME);
  }

  public static function  options_page() {
    include dirname( __FILE__ ).'/../views/admin/options_page.php';
  }

  public static function section_one_help() {
    echo 'full documentation available <a href="https://github.com/sitepoint/sp-random-hello-bar" target="_blank">here.</a>';
  }

  public static function section_two_help() {
    include dirname( __FILE__ ).'/../views/admin/section_two_help.php';
  }

  public static function ad_fields() {
    $ads = self::get_option('ads') ?: array();
    include dirname( __FILE__ ).'/../views/admin/ad_fields.php';
  }

  public static function sanitize_ads($input) {

    foreach($input as $key => $ad) {
      if(!$ad['html'] || !is_numeric($ad['weight']) || isset($ad['delete'])) {
        unset($input[$key]);
      }
    }

    self::save_weighted_ads($input);

    return $input;
  }

  public static function save_weighted_ads($ads) {
    $weighted_array = array();
    $total_weight   = 0;

    foreach($ads as $key => $val){
      $total_weight += $val['weight'];
      for($i=0; $i<$val['weight']; $i++) {
        $weighted_array[] = $key;
      }
    }

    self::update_option('weighted-keys', $weighted_array);
    self::update_option('total-weight', $total_weight);
  }

  /**
   * setup the public hooks
   */
  public  static function public_actions() {
    if (!\SitePoint\RandomHelloBar::get_option('enabled')) return;

    add_action('wp_enqueue_scripts', '\SitePoint\RandomHelloBar::enqueuePublicAssets');

    add_action('wp_ajax_nopriv_get_random_hello_bar', '\SitePoint\RandomHelloBar::get_random_bar');
    add_action('wp_ajax_get_random_hello_bar', '\SitePoint\RandomHelloBar::get_random_bar');
  }

  public static function enqueuePublicAssets() {
    $basic_js = \SitePoint\RandomHelloBar::get_option('basic-js');
    if (in_array($basic_js, array('basic', 'basicStorge'))) {
      wp_enqueue_script(
        self::PLUGIN_NAME.'-basic-script',
        plugins_url('../../public/js/'.$basic_js.'.js' , __FILE__),
        array('jquery', 'underscore')
      );
      wp_localize_script(
        self::PLUGIN_NAME.'-basic-script',
        'ajax_object',
        array('ajax_url' => admin_url( 'admin-ajax.php' ))
      );
    }

    if(\SitePoint\RandomHelloBar::get_option('load-css')) {
      wp_enqueue_style(
        self::PLUGIN_NAME.'-basic-css',
        plugins_url( '../../public/css/basic.css' , __FILE__ )
      );
    }
  }

  public static function get_random_bar() {
    $weighted_keys = self::get_option('weighted-keys');
    $total_weight  = self::get_option('total-weight');
    $rand          = floor($_POST['rand'] * $total_weight);

    if(!$weighted_keys || !$total_weight || !$_POST['rand']) die();

    $ads = self::get_option('ads');

    if(!$ads) die();

    if(!isset($weighted_keys[$rand])) die();

    echo wp_kses_post($ads[$weighted_keys[$rand]]['html']);

    die();
  }

  /**
   * on plugin uninstall
   */
  public static function uninstall() {
    self::delete_option('enabled');
    self::delete_option('basic-js');
    self::delete_option('load-css');
    self::delete_option('ads');
    self::delete_option('weighted-keys');
    self::delete_option('total-weight');
  }

}

