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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '30Y9+hole/e1Gw7NQE2ltjpgeqzfgDHGrP8S0y31ZXoF1/NHs5/Zqh4kg0xSuVd9gPGYmYIOWkcrLER6MFQN3Q==');
define('SECURE_AUTH_KEY',  'SF9PJhJmXeew0RIo6qgeaLWH6CD4LAdFuJs1+tfUaJtBrsbuqmFsPwYSbHBlIO5VkvganjWEGw4OlMK0FA9Z4g==');
define('LOGGED_IN_KEY',    'C1YURSZdgFCgLrzoYBB4oJR5qHQMpNasLYL/rWYbcWNGx91qnFqRCyW7uQ/F5fwYKZbd+GzOXYP6i+8kZfwaGA==');
define('NONCE_KEY',        'xfCxKVusfj207ZlzMc8v8Ba5LXjOZN9At3GJ/a6sTP7Jbit5mWZvrz9uifSMrA1tYScPDx03fEAvxgu1P08v3g==');
define('AUTH_SALT',        '3f9thBWA6Gtrq7Bjjn5RIEyRk/7q+0ACFqhr9zVf4UJyFjmBRCLZEu1AHLTkrVltZUG2ibJW9H5xfOIZywxsog==');
define('SECURE_AUTH_SALT', '0RP4ibgjVzuWDzKcVjpJU6mQEs380wshp3j17wtJ3w6sFAPeFHR9W0ZaOBWHxjUw0jPN7hwmQRi41hkQ0SYXNg==');
define('LOGGED_IN_SALT',   'xappI5ccGC2Iac9EwYBlezzJY3NSxfD55k0xd80E4WakVFxxeqW3IeGMBakQ3yOrjjp6yE9Hw69cQvyu9cVX7g==');
define('NONCE_SALT',       'dWJ1Xid48uFAyKmtfeyt8grp3JxRVDPvJQnHazKZOZ8KVrCpB0L+Ek8qmNHIDPSAMnNRQXmEgR7ls33utLtdOQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
