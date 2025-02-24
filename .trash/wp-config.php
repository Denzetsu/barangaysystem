<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u664069117_3TtWO' );

/** Database username */
define( 'DB_USER', 'u664069117_LIp6b' );

/** Database password */
define( 'DB_PASSWORD', 'zYQs19Ahaa' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '+J<=*[36A:;.>;8eFfbc$3w3~V?/5$#oUZDE}p3KG6@=30DOH5iH^,oAzD/} &@s' );
define( 'SECURE_AUTH_KEY',   '|-zmnQAU%a.Wh&G7<${i&vM<)G}<lUf4&`]EKRUdtFDv3bY][r9_T!_8} tnUVd*' );
define( 'LOGGED_IN_KEY',     'z9we.6p0*TNptRTw6Oy>!*P!/%{3,ampYdFp*W^hB4jf Dl(mPX0.G9+]*/(m98w' );
define( 'NONCE_KEY',         'o9byUUPmhi=&{?=}HH!2~E`A?&Xx+htq$J/o~EW[L 33X*^i#T]pu;@!b/}K:2*R' );
define( 'AUTH_SALT',         'L)oyay!<p=iG.:Weo[PI~%l8aZ*pZ=.Zi=s,motuXR<Mh2?&{((jd/8`q`F.Y{Z8' );
define( 'SECURE_AUTH_SALT',  'rd^~F>X^K3N]um+>i5b%)7A%KH^BX4u!N3( /1-4Gj($FGrCZZf6Se7JU3/Kf 7!' );
define( 'LOGGED_IN_SALT',    '.-Ow2fr-nAZVi6M1?g __]87C8IGfD:DuW;y0GREj0 LI3x]/O<;E/xa&vTWcI9&' );
define( 'NONCE_SALT',        '*ut PLZ*e!-SWNggafpwTRd1tBik]0&<EW3e3/KJjTeX>gqR0VX&ZC8S8OmjWARM' );
define( 'WP_CACHE_KEY_SALT', 'E|6r@^TMjTuf;LJ|&11`wjv7W+Ca=m&J.]gF80,j)D6Abz8njJ[@|M:5Du9|y2?K' );


/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
