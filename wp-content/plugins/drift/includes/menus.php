<?php

// Create a option page for settings
add_action('admin_menu', 'add_drift_option_page');

// Add top-level admin bar link
add_action('admin_bar_menu', 'add_drift_link_to_admin_bar', 999);

// Adds Drift link to top-level admin bar
function add_drift_link_to_admin_bar()
{
  global $wp_version;
  global $wp_admin_bar;

  $drift_icon = '<img src="' . DRIFT_4f050d29b8BB9_PATH . '/assets/drift-icon-16x16-white.png' . '">';

  $args = array(
    'id' => 'drift-admin-menu',
    'title' => '<span class="ab-icon" ' . ($wp_version < 3.8 && !is_plugin_active('mp6/mp6.php') ? ' style="margin-top: 3px;"' : '') . '>' . $drift_icon . '</span><span class="ab-label">Drift</span>', // alter the title of existing node
    'parent' => FALSE,   // set parent to false to make it a top level (parent) node
    'href' => get_bloginfo('wpurl') . '/wp-admin/admin.php?page=menus.php',
    'meta' => array('title' => 'Drift')
  );

  $wp_admin_bar->add_node($args);
}

// Hook in the options page functionå
function add_drift_option_page()
{
  add_options_page('Drift Options', 'Drift', 'activate_plugins', basename(__FILE__), 'drift_options_page');
}

?>
