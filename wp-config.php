<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'yugabyte_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:8889' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'W}e8{%_bsat,IsDU?~HhAPQp`K4+`.`nteHAUg_MHR]2?J~{OV elgpnMDfn%Wu$' );
define( 'SECURE_AUTH_KEY',  'uK*%d:KTh)P[[ue`o0D&?:LRpd9n9e;|;qaojX}pm_;>k$s4icKkjp`]USp9)Gp)' );
define( 'LOGGED_IN_KEY',    'e{0Vbfil~T4,/07]K746pgME^:-p9yGHav/3aU~T?g8TX4L:6C`z[S<_}&/bT6w)' );
define( 'NONCE_KEY',        '@3mJt5(IvJ*xxaD8M&`;D[m#LdH4{qS?)[f=%Lt:US2(,d|]50zF>v6gn660wQ*B' );
define( 'AUTH_SALT',        'enPvbc-[~kkYIbKD@=1F+d$6, =3JxF`I?%dZjchT>t%ujoi[w_It_Z-[KlGzbti' );
define( 'SECURE_AUTH_SALT', 'IAy*cS^c&]BaX+!XfMFOrrsoB,TR={<,kP=:0#LP|][(iQE@E~my;g.a[V+l7O9T' );
define( 'LOGGED_IN_SALT',   '$aDY>QA0q61]W+k4DW?y(:z:NZ)/lZpB.F6NDr1-{d&>tY0Zqs7RqrJJIf9v:4&z' );
define( 'NONCE_SALT',       'P81Ymmu,(LSt=g4sW/N2]D<YB!JU]B{HOS[z{,g/vz+9~]JlFF9#=y<&#/#YaYa|' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
