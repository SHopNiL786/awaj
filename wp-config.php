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
define('DB_NAME', 'awaj');

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
define('AUTH_KEY',         'jh,@0_]Ql{Y7[kr|RZuEDH.$OtwK8PI*6{asN*j8^(+k2@1_yCMTjRxhILB~}+XT');
define('SECURE_AUTH_KEY',  'f_o15sg`QJ_e%$c:Du%c0]Mm*n7h7G.i.-m&3QEEP. H_y19s<JXj+&qGBJ.XiYr');
define('LOGGED_IN_KEY',    'sWJ:l87{JA$7;b,!/.YFe6] Y!2pU5DOj:{$8UkHcrcG;qRX4(sH~(cCs^!B[Olq');
define('NONCE_KEY',        '?PklNIrDyVC3z|Ee$1^CSXcW7#l-.in5$Sz4XoYz3)/H}3,,1wpI^:qdqe/OO6A2');
define('AUTH_SALT',        ':i9`x.A>88|));C-<<9g7Da;aK,-g|TKPnD^Q$2!*VC1[rD55mL&%,9]6wLS@XoS');
define('SECURE_AUTH_SALT', '` l[-S$T,8vK3NRvYQlo;xga?8]kz#d,$zqn*8jG*CF1V_|F?9M=i,(!~y>338X)');
define('LOGGED_IN_SALT',   'pi%W +3|;WsKOOjZaObhy-c@=h#E@YX+.IHA%u:OvKe:1XlbBhma&],iic!]{!8!');
define('NONCE_SALT',       'D534vd]?/Qxyt`QgdDY|`W[2T] p5LiT@70W({91Q#7!K:r>k<s:pAALW5[[<Zlk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'af_';

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
define('WP_POST_REVISIONS', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
