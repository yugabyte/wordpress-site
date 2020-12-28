<?php

// Add the Drift Javascript
add_action('wp_head', 'add_drift');

// If we can indentify the current user output
function get_drift_identify()
{
  $current_user = wp_get_current_user();
  //print_r($current_user->roles[0]);
  //print_r(sanitize_text_field($current_user->roles[0]));

  if ($current_user->user_email) {
    $sanitized_email = sanitize_email($current_user->user_email);
    echo "<!-- Start Identify call for Drift -->\n";
    echo "<script>\n";
    echo "drift.identify(\"".md5($sanitized_email)."\", { email: \"".$sanitized_email."\", name: \"".sanitize_text_field($current_user->user_login)."\", userRole: \"".sanitize_text_field($current_user->roles[0])."\" });\n";
    echo "</script>\n";
    echo "<!-- End Identify call for Drift -->\n";
  } else {
    // See if current user is a commenter
    $commenter = wp_get_current_commenter();
    if ($commenter['comment_author_email']) {
      echo "<!-- Start Identify call for Drift -->\n";
      echo "<script>\n";
      echo "drift.identify(\"".md5(sanitize_email($commenter['comment_author_email']))."\", { email: \"".sanitize_email($commenter['comment_author_email'])."\", name: \"".sanitize_text_field($commenter['comment_author'])."\" });\n";
      echo "</script>\n";
      echo "<!-- End Identify call for Drift -->\n";
    }
  }
}

// The guts of the Drift script
function add_drift()
{
  // Ignore admin, feed, robots or trackbacks
  if ( is_feed() || is_robots() || is_trackback() )
  {
    return;
  }

  $options = get_option('Drift_settings');

  // If options is empty then exit
  if( empty( $options ) )
  {
    return;
  }

  // Check to see if Drift is enabled
  if ( esc_attr( $options['drift_enabled'] ) == "on" )
  {
    $drift_tag = $options['drift_widget_code'];

    // Insert tracker code
    if ( '' != $drift_tag )
    {
      echo "<!-- Start Drift By WP-Plugin: Drift -->\n";
      echo $drift_tag;
      echo"<!-- end: Drift Code. -->\n";

      // Optional
      if ( ! empty ( $options['drift_identify'] ) && esc_attr( $options['drift_identify'] ) == "on" ){
        get_drift_identify();
      }
    }
  }
}
?>