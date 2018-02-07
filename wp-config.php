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
define('DB_NAME', 'teddy');

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
define('AUTH_KEY',         '7rAp+,*jqY9n~:8S^mW[z[d)mIGy~sbJvSZDq| &4pLG:%BLU:?hM3.J4XbWPN=q');
define('SECURE_AUTH_KEY',  'H/vy<+5oJoc_m!AA#=X#;*d<Edjx%*|#$aYfI.4^hEI06!d.1!c];B&z60Gm`S#q');
define('LOGGED_IN_KEY',    'FCGK?xlb<<CZ/Ok;iQ+T~o}l@;(yS|MVBjxE%k0tuaB~`9vl[g*5t5X.UOa/vf9`');
define('NONCE_KEY',        '[_;V(iFAEm#C/k6Lo}K<C1t0IHYg3aZ^_S#,<%k>xw%=:3e:56t#LZ7jASiaFtbJ');
define('AUTH_SALT',        '#PSuB}(RcJ gqji;2mzRlJ t!z6E8_ik>S5Or-ms6a*s;_/]NRT$ jIEp<BjKo;f');
define('SECURE_AUTH_SALT', '#J1xtNzFb,e^]g,z<V;[kye?(MmteAs]nIBEap1n=[.JCM`ErhOGxP1;j>J0ivGf');
define('LOGGED_IN_SALT',   '5wkK3>BGXgcyd)r.+!O]n^)nu! d#;i{MXg-7O{OdIzRNK($Jme2WS!kR#:HCpz4');
define('NONCE_SALT',       '28tMA^2b IJDOob$bD-0n[E4&)}/F7USO )-%X<q_=.zWq%O-}/hFwk%0.%~}Z#:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'td_';

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
