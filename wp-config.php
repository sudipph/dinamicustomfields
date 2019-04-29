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
define('DB_NAME', 'abhijitda');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sudip');

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
define('AUTH_KEY',         't[GA;vz*M8HrZ*8ne Nc ~+<Q]Gb)ny<iz0BKa$Gt#/!obr1%i_C.[VfKQ:U!_-5');
define('SECURE_AUTH_KEY',  'k~?!)a;_@(UA5]RjRRk|hCeE;%MkpfQ/Ai4lOIn$yJ8tBk~r,-[2bYRxb6#XIVMJ');
define('LOGGED_IN_KEY',    '4psk[c}KE(ojO-${,e9AW:N|w;>Yk^c{Ko{Q]$&88Zk[;#b8,23Zus$WI@DJz.Hg');
define('NONCE_KEY',        '8|2+@-|}le+#n:IQpAnDGBz?p<Y=H=v6T^,)W[o}&b`w(U)C;lp%//>&$sm+bf5V');
define('AUTH_SALT',        'm{*<=MK[L<r:x<%jBZOPY/;c6%?%::^{H%jd!d%}jz1//Cf8/{122QU`VW`%mPV]');
define('SECURE_AUTH_SALT', 'S(%DN*+7|wxSI.bHP^JtFbj][c`AS&w}E*-%6,?}hIh}Un13g}>2`XMyuH@cV)_*');
define('LOGGED_IN_SALT',   'L(+Rx;:H`!TGGv$R:*>5Mu<7-%o:eW#Hz5!DoJTFF72)e^*?aF;P<=A(<TcuZpq3');
define('NONCE_SALT',       'Y0$^L!Tt`00.Z(S;VHt2;x15tz`gOC?fn,*E(<_cH$5iCN$nxmJMh+!xol(BHJvz');

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
define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');