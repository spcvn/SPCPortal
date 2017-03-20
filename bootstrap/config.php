<?php
define( 'SCRIPT_PATH', 'D:/htdocs/Crypty/' );
define( 'SCRIPT_URL', 'crypty.local' );

define( 'FILE_SUFFIX', '.shi' );
define( 'CR_FILE_VERSION', '1.0.0/0' );

define( 'SESSION_EXPIRE', 1800 );

define( 'SESSION_DIR_A', 'sess/' );
define( 'SESSION_DIR', SCRIPT_PATH . SESSION_DIR_A );

define( 'EXPRESS_DEFAULT_CIPHER', 12 );
define( 'EXPRESS_DEFAULT_MODE', 'ctr' );

define( 'CHECK_CIPHER', 12 ); // DNE
define( 'CHECK_MODE', 'ctr' ); // DNE

define( 'PHP_LANGUAGE_DIR', SCRIPT_PATH . 'inc/lang/' );
define( 'PHP_TEMPLATE_DIR', SCRIPT_PATH . 'inc/tmpl/' );
define( 'PHP_FALLBACK_LANG', 'EN' );

define( 'DECR_PATH_A', 'ddwn/' );
define( 'ENCR_PATH_A', 'edwn/' );
define( 'DECR_PATH', SCRIPT_PATH . DECR_PATH_A );
define( 'ENCR_PATH', SCRIPT_PATH . ENCR_PATH_A );

define( 'DECR_FILE_EXPIRE', 900 );
define( 'ENCR_FILE_EXPIRE', 1800 );
define( 'SESS_FILE_EXPIRE', 'sess/' );

define( 'MCR_DEFAULT_MODE', 'ctr' );

define( 'SERVER_KEY', 'I9RDJRjjawYtX8vVHSwiMY90tzckd2iv' ); // DNE
define( 'SERVER_CIPHER', 12 ); // DNE
define( 'SERVER_MODE', 'ctr' ); // DNE

define( 'SCRIPT_PROTOCOL', 'http://' );

define( 'TIME_FORMAT_DATE', 'm/d/Y' );
define( 'TIME_FORMAT_HOURS', 'H.i' );

define( 'SCRIPT_CIPHER_EXCLUDE', serialize(array('wake','enigma','arcfour')) );
define( 'SCRIPT_MODE_EXCLUDE', serialize(array('stream')) );

if (!isset($_SERVER['REQUEST_URI']))
{
//    define( 'SCRIPT_RELPATH', str_replace('install', null, dirname($_SERVER['HTTP_X_REWRITE_URL'] . '&r=null')=='/' ? null : dirname($_SERVER['HTTP_X_REWRITE_URL'] . '&r=null')) );
}else{
    define( 'SCRIPT_RELPATH', str_replace('install', null, dirname($_SERVER['REQUEST_URI'] . '&r=null')=='/' ? null : dirname($_SERVER['REQUEST_URI'] . '&r=null')) );
}

define( 'NUMBER_CHARACTER_RANDOM', 11 );
define( 'SCRIPT_UPLOAD_LIMIT', 134217728 );
