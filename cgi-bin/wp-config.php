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
define( 'DB_NAME', 'theshvgc_theshoedog' );

/** MySQL database username */
define( 'DB_USER', 'theshvgc_theshoedog' );

/** MySQL database password */
define( 'DB_PASSWORD', '=7jr)[pta1O{' );

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
define( 'AUTH_KEY',         'i)-Io1R(gX*`-y^o+2%!&.pg8/_Lev73K87?j]^BRl6-} KN-_jfp4T7BHv[uC|g' );
define( 'SECURE_AUTH_KEY',  'z? >tE+htGL0[Z|)i[< c7U.73BEUAzBn)#T WhN<*fQ2G.F:8KAN6xWWfc/B1OR' );
define( 'LOGGED_IN_KEY',    '_5P/s.&Lk(euj[PP9z,e_q<nz8%E1Y.u*(to#n~*}?@hh&t~fXd%rRp051NKjxAu' );
define( 'NONCE_KEY',        '>l8oYyR,fn[g{aj0~8eV)?sK_vHb^Y5q]T 3;N*-7mb<3@qG+wG:TnQn+>lQuF1c' );
define( 'AUTH_SALT',        'ZXAUJdwfLMFv+q`I3Y`A6i{1]<<`i`cHw_DuDL[$hR]M)b&G*x<46}Yfc]WEF=wN' );
define( 'SECURE_AUTH_SALT', ';7mNf>R(o=U21LspgU)Wx$8CGFOx-t}K28VZSD^71Bi(`H>(Tc|p>36;6NFxM;oB' );
define( 'LOGGED_IN_SALT',   'Zahh?eT0$y+m@mJu~|I3gT[p+s(BOD [x+M97fF?FAAI|C :9:d0PyolDBPVA7/F' );
define( 'NONCE_SALT',       'c1RK<C[m5Cc=5,QzhL&>%aB%n@0QxDOtXSF2D/{ zw(@&!VTSHjn{ Xeb|F*rd|)' );

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
