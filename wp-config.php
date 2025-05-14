<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'social_network_v3' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd:sUC6}%=C% GzGs&B6L-iD6F=Q{{yySwpfAE+D$9|&Oi)sf@b^kw^W0R+,FO/mo' );
define( 'SECURE_AUTH_KEY',  '@|P~^5SVC&ri;k4}9[d]dOIIESYhr(ZfJxwU1cPvZHe|YIvKd:tT)6Yrd3&wXup*' );
define( 'LOGGED_IN_KEY',    'c]uBfgm)|R>G?c5m7me&~})OVGQc+uZ<D*B8`fEw$CUSEofmhx.]TXLyknU1`2z*' );
define( 'NONCE_KEY',        '5XbB$f >FPgy,!jTj!P5kx`bwd_1*a&{]xrJn/$i`1t^ep9~#h3*s*b[#>, L1-$' );
define( 'AUTH_SALT',        'V14MP-&>+<NP0)[1)J%>~ceW5u4_./r.$!M0pEimb5lTP^ Huj5j$&JIIai22j5B' );
define( 'SECURE_AUTH_SALT', 'w-(cZ^UD! 4e:o%_n5H>+C/)ts]+Wsq{nkR:E@!d)d6m q?@SVx*f<YFdqY t.wC' );
define( 'LOGGED_IN_SALT',   'CY|PK/95=bkcYful#z+4|L(%A zsvP-(qp47n,o,o-^VoLU))sGx&*udf $v$bX+' );
define( 'NONCE_SALT',       'S3y{!VRoBy~<#h:-6&.7[|}z4=GPS>u~COGc 9l+$i!#pkHjUCCkcs<>57#M,-(J' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
