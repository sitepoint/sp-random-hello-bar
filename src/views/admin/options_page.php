<div class="wrap">
  <h2>Random Hello Bar by <p><img src="http://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2014/09/1411300874SitePoint.png" title="SitePoint"/></p></h2>
  <p>Randomly (with weighting) shows a hello bar message on page scroll.</p>
  <p>You can read all about how it was put together on <a href="http://www.sitepoint.com/sitepoint-random-hello-bar-wordpress-plugin/" target="_blank">SitePoint</a>.</p>
  <form action="options.php" method="POST">
    <?php settings_fields(self::PLUGIN_NAME.'-settings-group'); ?>
    <?php do_settings_sections(self::PLUGIN_NAME); ?>
    <?php submit_button('Save Changes', 'primary', self::PLUGIN_NAME.'-submit-button'); ?>
  </form>
</div>
