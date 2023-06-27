<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 * 
 *
 * @link       https://merka20.com
 * @since      1.0.0 
 */

// Verificar que el archivo se acceda correctamente desde WordPress
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}

// Eliminar las variables de opciones guardadas

delete_option('end_date');
delete_option('ini_enero');
delete_option('ini_febrero');
delete_option('ini_marzo');
delete_option('ini_abril');
delete_option('ini_mayo');
delete_option('ini_junio');
delete_option('ini_septiembre');
delete_option('ini_octubre');
delete_option('ini_noviembre');
delete_option('ini_diciembre');

// ... Eliminar otras variables de opciones si las tienes
