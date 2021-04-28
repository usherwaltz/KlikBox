<?php
define('WP_AUTO_UPDATE_CORE', 'minor');
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_dip6g' );

/** MySQL database username */
define( 'DB_USER', 'wp_s2thw' );

/** MySQL database password */
define( 'DB_PASSWORD', 'U@Njlj0n6l~Nle@9' );

/** MySQL hostname */
define( 'DB_HOST', 'plesk-db1.teleklik.net:3306' );

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
define('AUTH_KEY', '6f#1N&2B#H4_d]5B|N7/dE-02gp+l67r0;C0Ymk:h5j)sTG9)*7-g&5Mpm46*z)M');
define('SECURE_AUTH_KEY', 'K53Gm0rkn+0u(iN1O#-&3_%86qj-_Hz(oBXNYp6NfCzr2(cUr]1Wmx:86%x@9C!Z');
define('LOGGED_IN_KEY', '3o2j9(8;I7NQOED8Rfg0f3l):91TYFC)+IaR#H8YF64dGNXyl!nZ7#e~t3b)I:BU');
define('NONCE_KEY', '0-5pl+me%7a~+9yMlv3c9!5I)2*g+mI0LL!nyH:*e#31|23U48HJ*4cckn8Y6;Rn');
define('AUTH_SALT', '|X7sz6!z~8NZ)2:Qk6Q3tOb7!LHNo7rO4Qaa]45+!e-/t~bdt80z@2u2i*56r03Y');
define('SECURE_AUTH_SALT', '0Ha%l_I77*#)lSb_PmP]uO59gwytZ6266d!60TbeiId20ca4RMAT-mV+dgr0*STV');
define('LOGGED_IN_SALT', 'PKLTv3#|XqZZcUpP7sX~(g6|PGcc8QZ97/z55cwfue!%5&6ADxO1qR5BG99W]kX9');
define('NONCE_SALT', 'YUEcw%gi]~Ae(pj1i)37l77TA/1q)#F/[-P2WSzTM9&68r)SfKo(O6OJ#8@vh8rh');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Xm6IROo_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
