<div class="wrap">
  <h2>SitePoint Random Hello Bar</h2>
  <p>Randomly (with weighting) shows a hello bar message on page scroll.</p>
  <form action="options.php" method="POST">
    <?php settings_fields(self::PLUGIN_NAME.'-settings-group'); ?>
    <?php do_settings_sections(self::PLUGIN_NAME); ?>
    <?php submit_button('Save Changes', 'primary', self::PLUGIN_NAME.'-submit-button'); ?>
  </form>
</div>
