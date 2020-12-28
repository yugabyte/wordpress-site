<?php

// Output the options page
function drift_options_page()
{
  // Get options
  $options = get_option('Drift_settings');

  // Check to see if Drift is enabled
  $drift_activated = false;
  if ( esc_attr( $options['drift_enabled'] ) == "on" ) {
    $drift_activated = true;
    wp_cache_flush();
  }

  // Check to see if Drift identify is checked
  $drift_identify = false;
  if ( esc_attr( $options['drift_identify'] ) == "on" ) {
    $drift_identify = true;
    wp_cache_flush();
  }

?>
        <div class="wrap">
        <form name="Drift-form" action="options.php" method="post" enctype="multipart/form-data">
          <?php settings_fields( 'Drift_settings_group' ); ?>

            <h1>Drift</h1>
            <h3>Basic Options</h3>
            <?php if ( ! $drift_activated ) { ?>
                <div style="margin:10px auto; border:3px #f00 solid; background-color:#fdd; color:#000; padding:10px; text-align:center;">
                Drift Live Chat is currently <strong>DISABLED</strong>.
                </div>
            <?php } ?>
            <?php do_settings_sections( 'Drift_settings_group' ); ?>

            <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
                <tr>
                    <th width="30%" valign="top" style="padding-top: 10px;">
                        <label for="drift_enabled">Drift (Live Chat) is:</label>
                    </th>
                    <td>
                      <?php
                          echo "<select name=\"Drift_settings[drift_enabled]\"  id=\"drift_enabled\">\n";

                          echo "<option value=\"on\"";
                          if ( $drift_activated ) { echo " selected='selected'"; }
                          echo ">Enabled</option>\n";

                          echo "<option value=\"off\"";
                          if ( ! $drift_activated ) { echo" selected='selected'"; }
                          echo ">Disabled</option>\n";
                          echo "</select>\n";
                        ?>
                    </td>
                </tr>
            </table>
            <label for="drift_identify">Drift Identify: &nbsp;</label>
            <input type="checkbox" name="Drift_settings[drift_identify]" <?php if($drift_identify) { echo " checked='checked'"; } ?> />
                <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
                <tr>
                    <th valign="top" style="padding-top: 10px;">
                        <label for="Drift_widget_code">Drift JS code snippet:</label>
                    </th>
                    <td>
                      <textarea rows="15" cols="100" placeholder="<!-- Insert the Drift tag here -->" name="Drift_settings[drift_widget_code]"><?php echo esc_attr( $options['drift_widget_code'] ); ?></textarea>
                        <p style="margin: 5px 10px;">Enter your Drift JS code snippet.  You can find your <a href="https://app.drift.com/customize" target="_blank" title="Open Drift Settings">Drift JS code snippet here</a>. A Free Drift account is required to use this plugin.</p>
                    </td>
                </tr>
                </table>
            <p class="submit">
                <?php echo submit_button('Save Changes'); ?>
            </p>
        </div>
        </form>

<?php
}
?>
