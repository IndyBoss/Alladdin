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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'alladdin' );

/** MySQL database username */
define( 'DB_USER', 'Alladdin' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'K1vLwx?~~[2]?:*qM 0}SK5cVg,=s?wb17kQWW}wxKo@#S2K/Wiwi;pLHv9Rq8$m' );
define( 'SECURE_AUTH_KEY',  '2=GsAw^NM4L0gjC2V&&6m.Q|6y2q {.&!%^@2s,YDN)fks@p`eyo80v%Rg9 Lwr9' );
define( 'LOGGED_IN_KEY',    'B~fd8&m=-&d@l=_&MYwI@XMPL~He<qW%li%,b<zfpF?ZhTzs/C,&?k~Au4-WI-Rk' );
define( 'NONCE_KEY',        '.?eYE],1n^#lX$>x(y[5F1}t`AAne7Du`_5No6=`])ljRYw~&_rZ!p!17HY%)^zM' );
define( 'AUTH_SALT',        'cN>,*{dKYkRR}QMIfjgY62twS{v/:(^NbP.C[{l[Y_K+-S(UW>yaB%gBC(R@0b,s' );
define( 'SECURE_AUTH_SALT', 'anXb.#VGDBCyLj$1s<NYtr@/.E|n^)ruz36c_>k26ZWN4vuE3>KT076-0T_i#<fC' );
define( 'LOGGED_IN_SALT',   '3sxhAdR4QLj(L>m@5Y50[O/`w#HxzC.a{>cAI3}?p{Oi~`5,yqbKg[]<_mHDl9y0' );
define( 'NONCE_SALT',       ' {vP;uXS#esw~nDf?*IBaK2}>joRD?y,[G!7:U6>b``~6Y*ZQKGOB=O8Zwj+_%Cv' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
