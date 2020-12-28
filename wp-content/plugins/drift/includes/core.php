<?php

// Register settings
function Drift_register_settings()
{
  register_setting( 'Drift_settings_group', 'Drift_settings' );
}
add_action( 'admin_init', 'Drift_register_settings' );

// Delete options on uninstall
function Drift_uninstall()
{
  delete_option( 'Drift_settings' );
}
register_uninstall_hook( __FILE__, 'Drift_uninstall' );


?>
