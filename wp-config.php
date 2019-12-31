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
define( 'DB_NAME', 'treesite' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '<0.jwx x`YKoye;u,7Rn}dU:W?VvnO}xp<cOUd*t3uWoQJhI0CvF2,N9J<Jo*620' );
define( 'SECURE_AUTH_KEY',  'L/5_/{COzlw`JDI1^Sg:Mp_nXY%MeHu;6T*zh[i7A[2F|*Fk_sTJ-5AAni/{w_Dz' );
define( 'LOGGED_IN_KEY',    'Tj2Cr?z:0L:Z<G7mEO`bc5}&~Kn*43R8(z<D2)lpTle)a)uJV`IHT9wh{x[Ak&tu' );
define( 'NONCE_KEY',        'lX$J6N9.i:>/X0G209k62MS3+nA1#yAOo&6i-l*TsnchLKhr@~P<8 E[trVyyV_c' );
define( 'AUTH_SALT',        '|k&B [2JsG6Q$!EX0XL#84&Sg|GJB[fL;(c!w-/)JS9Qe]2O?Yx PipPK^@RX3SE' );
define( 'SECURE_AUTH_SALT', '1p}YL--Gst[.Xz6L{vv8>&pX,`xqm@e2eBrKCD{*dtdYY(2DKar}F[ka86lZd_4*' );
define( 'LOGGED_IN_SALT',   '#>%Crc*h9]I+oU86vr](hE0t?BX7rw)>P=%cJA+s>!xtDyUg{(W-4tEl}*sy)LwJ' );
define( 'NONCE_SALT',       'FDqT0j<Jou(r^z,iD+r`(mWw,E,0YUi.2I^W<d;D}C O9q|t:}]I_*%46o4V@$HV' );

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
