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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hb+glz|7|x36=.=F=7oi/AvhjT5l:B6!r1}2Qv-l&&ZR;Uey-(3%9S?z?7t`ovq9');
define('SECURE_AUTH_KEY',  '`ybX!?h/2) $<~UyT<|v9}?y_SB8kI`m16==}=9TI[U&{8ut3>-JJ?%lYkV5frR;');
define('LOGGED_IN_KEY',    '6kX2{<DOd@t=;s:MW4qQP}KAl?3z!DLkelkvh$8ra%VHwRJ*uy)qCC%SE<XwI!O|');
define('NONCE_KEY',        ' lU#nRpgwUP HP)TY4B*`3P^0X}4Pe/BTNEj)p-GY$zZ?lg}f$$i~e<7v$8y[=VD');
define('AUTH_SALT',        '(lBk(9a6v^Ot_>r5^y@Q3G(rtfF6TOovrG=^XEAm$}7%&w.*jtJI=eBQy,LY?f<4');
define('SECURE_AUTH_SALT', 'qbjYn[T1=&vg@.fzvEXm*`#_=9<z^6}JD^~VSDdH+:#PH=:QZae%V7Y<q&Vgl&YQ');
define('LOGGED_IN_SALT',   'pT@r9W5g`VowIy@nVk=cR>h@F`a^$0xiu%]Zz88NT>#29v3DJ[RieB6#A7LUe2J;');
define('NONCE_SALT',       'X^(T/I/~+rFaa,~C(,heA:_3&Lm[L_.bpol?Q0DB]{2O*li[}GUR3Ln/SZ7jg&Jp');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
