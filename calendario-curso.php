<?php
/*
Plugin Name: Calendario Curso by Merka20
Plugin URI: https://merka20.com
Description: Plugin que muestra un calendario con datos personalizados.
Author: Oscar Domingo
Version: 1.0.0
Author URI: https://merka20.com
Requires at least: 5.0
Tested up to: 5.9.1
Requires PHP: 7.4

Text Domain: MK20-Calendario
Domain Path: /languages
*/
if (!defined('ABSPATH')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
} // Salir si acceden directamente

function MK20_Calendar_activate()
{
}

function MK20_Calendar_deactivate()
{ }
register_activation_hook(__FILE__, 'MK20_Calendar_activate');
register_deactivation_hook(__FILE__, 'MK20_Calendar_deactivate');


// Hook para agregar una página de ajustes en el menú de administración
add_action('admin_menu', 'my_calendar_plugin_add_admin_page');

// Función para agregar la página de ajustes en el menú de administración
function my_calendar_plugin_add_admin_page() {
  add_options_page(
    'Ajustes del Calendario',
    'Calendario Plugin',
    'manage_options',
    'my-calendar-plugin',
    'my_calendar_plugin_settings_page'
  );
}

function my_calendar_plugin_register_settings() {
    // Registra los campos de ajustes utilizando la función register_setting()
   
    register_setting('my-calendar-plugin-settings', 'end_date');
    register_setting('my-calendar-plugin-settings', 'ini_enero');
    register_setting('my-calendar-plugin-settings', 'ini_febrero');
    register_setting('my-calendar-plugin-settings', 'ini_marzo');
    register_setting('my-calendar-plugin-settings', 'ini_abril');
    register_setting('my-calendar-plugin-settings', 'ini_mayo');
    register_setting('my-calendar-plugin-settings', 'ini_junio');
    register_setting('my-calendar-plugin-settings', 'ini_septiembre');
    register_setting('my-calendar-plugin-settings', 'ini_octubre');
    register_setting('my-calendar-plugin-settings', 'ini_noviembre');
    register_setting('my-calendar-plugin-settings', 'ini_diciembre');
  }
  
  // Hook para registrar los campos de ajustes
  add_action('admin_init', 'my_calendar_plugin_register_settings');
  
  // Función para renderizar la página de ajustes de administración
  function my_calendar_plugin_settings_page() {
    ?>
    <div class="wrap">
      <h1>Ajustes del Calendario</h1>
      <form method="post" action="options.php">
        <?php settings_fields('my-calendar-plugin-settings'); ?>
        <?php do_settings_sections('my-calendar-plugin-settings'); ?>
        
        <h2>Configuración del Calendario</h2>
        <table class="form-table">          
          <tr>
            <th scope="row">Año fin:</th>
            <td><input type="text" name="end_date" value="<?php echo esc_attr(get_option('end_date')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio enero:</th>
            <td><input type="text" name="ini_enero" value="<?php echo esc_attr(get_option('ini_enero')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio febrero:</th>
            <td><input type="text" name="ini_febrero" value="<?php echo esc_attr(get_option('ini_febrero')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio marzo:</th>
            <td><input type="text" name="ini_marzo" value="<?php echo esc_attr(get_option('ini_marzo')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio abril:</th>
            <td><input type="text" name="ini_abril" value="<?php echo esc_attr(get_option('ini_abril')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio mayo:</th>
            <td><input type="text" name="ini_mayo" value="<?php echo esc_attr(get_option('ini_mayo')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio junio:</th>
            <td><input type="text" name="ini_junio" value="<?php echo esc_attr(get_option('ini_junio')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio septiembre:</th>
            <td><input type="text" name="ini_septiembre" value="<?php echo esc_attr(get_option('ini_septiembre')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio octubre:</th>
            <td><input type="text" name="ini_octubre" value="<?php echo esc_attr(get_option('ini_octubre')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio noviembre:</th>
            <td><input type="text" name="ini_noviembre" value="<?php echo esc_attr(get_option('ini_noviembre')); ?>"></td>
          </tr>
          <tr>
            <th scope="row">Día de inicio diciembre:</th>
            <td><input type="text" name="ini_diciembre" value="<?php echo esc_attr(get_option('ini_diciembre')); ?>"></td>
          </tr>
        </table>
        
        <?php submit_button(); ?>
      </form>
    </div>
    <?php
  }

//Crear shortcode


if (!function_exists('MK20_registrar_shortcode')) {
  function MK20_registrar_shortcode(){
  add_shortcode('calendario','MK20_my_shortcode');
}
add_action('init','MK20_registrar_shortcode');
}

if (!function_exists('MK20_my_shortcode')) {
  function MK20_my_shortcode($atts) {
 
   // archivo1.php
$año = get_option('end_date');
$enero = get_option('ini_enero');
$febrero = get_option('ini_febrero');
$marzo = get_option('ini_marzo');
$abril = get_option('ini_abril');
$mayo = get_option('ini_mayo');
$junio = get_option('ini_junio');
$septiembre = get_option('ini_septiembre');
$octubre = get_option('ini_octubre');
$noviembre = get_option('ini_noviembre');
$diciembre = get_option('ini_diciembre');

// Generar el contenido CSS
$css_content = "        
    .hoja.enero li.first-day {
      grid-column-start: ". $enero .";/*colocamos el numero desde donde queremos que empiece el mes 7 es domingo*/
    }.hoja.enero li.dia:nth-child(7n+" . (7 - $enero) . ")  {	
      background-color: var(--finde);
      color: white;
    }.hoja.enero li.dia:nth-child(7n+" . (1 + (7 - $enero)) . ")  {	
      background-color: var(--finde);
      color: white;
    }     
    .hoja.febrero li.first-day {
      grid-column-start: ". $febrero .";
    }
    .hoja.febrero li.dia:nth-child(7n+" . (7 - $febrero) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.febrero li.dia:nth-child(7n+" . (1 + (7 - $febrero)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.marzo li.first-day {
      grid-column-start: ". $marzo .";
    }
    .hoja.marzo li.dia:nth-child(7n+" . (7 - $marzo) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.marzo li.dia:nth-child(7n+" . (1 + (7 - $marzo)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.abril li.first-day {
      grid-column-start: ". $abril .";
    }
    .hoja.abril li.dia:nth-child(7n+" . (7 - $abril) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.abril li.dia:nth-child(7n+" . (1 + (7 - $abril)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.mayo li.first-day {
      grid-column-start: ". $mayo .";
    }
    .hoja.mayo li.dia:nth-child(7n+" . (7 - $mayo) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.mayo li.dia:nth-child(7n+" . (1 + (7 - $mayo)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.junio li.first-day {
      grid-column-start: ". $junio .";
    }
    .hoja.junio li.dia:nth-child(7n+" . (7 - $junio) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.junio li.dia:nth-child(7n+" . (1 + (7 - $junio)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.julio li.first-day {
      grid-column-start: 1;
    }
    /*.hoja.julio li.dia:nth-child(7n+7) {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.julio li.dia:nth-child(7n+0) {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.agosto li.first-day {
      grid-column-start: 3;
    }
    .hoja.agosto li.dia:nth-child(7n+2) {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.agosto li.dia:nth-child(7n+3) {	
      background-color: var(--finde);
      color: white;
    }*/
    
    .hoja.septiembre li.first-day {
      grid-column-start: ". $septiembre .";
    }
    .hoja.septiembre li.dia:nth-child(7n+" . (7 - $septiembre) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.septiembre li.dia:nth-child(7n+" . (1 + (7 - $septiembre)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.octubre li.first-day {
      grid-column-start: ". $octubre .";
    }
    .hoja.octubre li.dia:nth-child(7n+" . (7 - $octubre) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.octubre li.dia:nth-child(7n+" . (1 + (7 - $octubre)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.noviembre li.first-day {
      grid-column-start: ". $noviembre .";
    }
    .hoja.noviembre li.dia:nth-child(7n+" . (7 - $noviembre) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.noviembre li.dia:nth-child(7n+" . (1 + (7 - $noviembre)) . ") {	
      background-color: var(--finde);
      color: white;
    }
    
    .hoja.diciembre li.first-day {
      grid-column-start: ". $diciembre .";
    }
    .hoja.diciembre li.dia:nth-child(7n+" . (7 - $diciembre) . ") {	
      background-color: var(--finde);
      color: white;
    }
    .hoja.diciembre li.dia:nth-child(7n+" . (1 + (7 - $diciembre)) . ") {	
      background-color: var(--finde);
      color: white;
    }";   
    
// Obtener la ruta absoluta de la carpeta del plugin
$plugin_dir = plugin_dir_path(__FILE__);

// Construir la ruta completa del archivo CSS
$css_file = $plugin_dir . 'admin/css/estilo_meses.css';

// Guardar el contenido CSS en el archivo
file_put_contents($css_file, $css_content); 

   ob_start();
   ?>
<div class="calendar-wrapper">
<div class="hoja septiembre">
      <h2>Septiembre</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="inicioi dia"><span class="numero">7</span><div class="ventana"><h4>Inicio clases</h4><p class="nota">Fecha de comienzo de las clases de Secundaria: JUEVES 7 SEPT.</p></div></li>
          <li class="inicios dia"><span class="numero">8</span><div class="ventana"><h4>Inicio clases</h4><p class="nota">Fecha de comienzo de las clases de Infantil y primaria: VIERNES 8 SEPT.</p></div></li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>    
        </ul>
      </div>
      <div class="hoja octubre">
      <h2>Octubre</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="fiesta dia">12</li>
          <li class="no-lectivo dia"><span class="numero">13</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="no-lectivo dia"><span class="numero">21</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>
          <li class="dia">31</li>
        </ul>
      </div>
      <div class="hoja noviembre">
      <h2>Noviembre</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day fiesta dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="no-lectivo dia"><span class="numero">29</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota">Fecha Patrón Localidad: Lunes 29 NOVIEMBRE</p></div></li>
          <li class="dia">30</li>    
        </ul>
      </div>
      <div class="hoja diciembre">
      <h2>Diciembre</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="fiesta dia">4</li>
          <li class="no-lectivo dia"><span class="numero">5</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="fiesta dia">6</li>
          <li class="dia">7</li>
          <li class="fiesta dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="fiesta dia ">23</li>
          <li class="fiesta dia">24</li>
          <li class="fiesta dia">25</li>
          <li class="fiesta dia">26</li>
          <li class="fiesta dia">27</li>
          <li class="fiesta dia">28</li>
          <li class="fiesta dia">29</li>
          <li class="fiesta dia">30</li>
          <li class="fiesta dia">31</li>
        </ul>
      </div>
      <div class="hoja enero">
      <h2>Enero</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day fiesta dia">1</li>
          <li class="fiesta dia">2</li>
          <li class="fiesta dia">3</li>
          <li class="fiesta dia">4</li>
          <li class="fiesta dia">5</li>
          <li class="fiesta dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>
          <li class="dia">31</li>
        </ul>
      </div>
      <div class="hoja febrero">
      <h2>Febrero</h2>
        <ul id="año" class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="no-lectivo dia"><span class="numero">9</span><div class="ventana"><h4>Fechas no lectivas</h4></div></li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="no-lectivo dia"><span class="numero">12</span><div class="ventana"><h4>Fechas no lectivas</h4></div></li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <?php

          if (!function_exists('esBisiesto')) {
            function esBisiesto($year) {
                if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
                    return true;
                } else {
                    return false;
                }
            }
          }

          // Ejemplo de uso
          if (esBisiesto($year)) {
            echo '<li class="bisiesto dia">29</li>';
          }
        ?>    
         </ul>
      </div>
      <div class="hoja marzo">
      <h2>Marzo</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="no-lectivo dia"><span class="numero">17</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="fiesta dia">28</li>  
          <li class="fiesta dia">29</li>
          <li class="dia">30</li>
          <li class="dia">31</li>  
        </ul>
      </div>
      <div class="hoja abril">
      <h2>Abril</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day fiesta dia">1</li>
          <li class="fiesta dia">2</li>
          <li class="fiesta dia">3</li>
          <li class="fiesta dia">4</li>
          <li class="fiesta dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>    
        </ul>
      </div>
      <div class="hoja mayo">
      <h2>Mayo</h2>
        <ul class="calendar">
         <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day fiesta dia">1</li>
          <li class="no-lectivo dia"><span class="numero">2</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="no-lectivo dia"><span class="numero">3</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li class="dia">19</li>
          <li class="dia">20</li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>
          <li class="dia">31</li>
        </ul>
      </div>
      <div class="hoja junio">
      <h2>Junio</h2>
        <ul class="calendar">
          <li class="weekday">L</li>
          <li class="weekday">M</li>
          <li class="weekday">X</li>
          <li class="weekday">J</li>
          <li class="weekday">V</li>
          <li class="weekday">S</li>
          <li class="weekday">D</li>
          
          <li class="first-day dia">1</li>
          <li class="dia">2</li>
          <li class="dia">3</li>
          <li class="dia">4</li>
          <li class="dia">5</li>
          <li class="dia">6</li>
          <li class="dia">7</li>
          <li class="dia">8</li>
          <li class="dia">9</li>
          <li class="dia">10</li>
          <li class="dia">11</li>
          <li class="dia">12</li>
          <li class="dia">13</li>
          <li class="dia">14</li>
          <li class="dia">15</li>
          <li class="dia">16</li>
          <li class="dia">17</li>
          <li class="dia">18</li>
          <li id="final" class="fini dia"><span class="numero">19</span><div class="ventana"><h4>Fin de curso</h4><p class="nota">Fecha de finalización de las clases de Secundaria MIÉRCOLES 19 JUNIO</p></div></li>
          <li class="fins dia"><span class="numero">20</span><div class="ventana"><h4>Fin de curso</h4><p class="nota">Fecha de finalización de las clases de Infantil y primaria JUEVES 20 JUNIO</p></div></li>
          <li class="dia">21</li>
          <li class="dia">22</li>
          <li class="dia">23</li>
          <li class="dia">24</li>
          <li class="dia">25</li>
          <li class="dia">26</li>
          <li class="dia">27</li>
          <li class="dia">28</li>
          <li class="dia">29</li>
          <li class="dia">30</li>    
        </ul>
      </div>
      </div>    
<?php 
$html= ob_get_clean();
// Devolver el texto almacenado
  return $html;
}
}
/*if (!function_exists('MK20_encolar_estilos_propios_calendar')) {

	function MK20_encolar_estilos_propios_calendar()
	{
    global $post;
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'calendario' ) ) {
      wp_register_style( 'plugin-shortcode-css', plugin_dir_url( __FILE__ ) . 'admin/css/estilo_meses.css' );
      wp_register_style('csspropio', plugin_dir_url( __FILE__ ) . 'admin/css/style.css');       
    }
}
add_action( 'wp_enqueue_scripts', 'MK20_encolar_estilos_propios_calendar' );	
}*/

function MK20_encolar_estilos_propios_calendar() {
  global $post;

  if ( is_a( $post, 'WP_Post' ) ) {
      $has_shortcode = has_shortcode( $post->post_content, 'calendario' );

      if ( $has_shortcode ) {
          wp_register_style( 'plugin-shortcode-css', plugin_dir_url( __FILE__ ) . 'admin/css/estilo_meses.css' );
          wp_register_style( 'csspropio', plugin_dir_url( __FILE__ ) . 'admin/css/style.css' );

          wp_enqueue_style( 'plugin-shortcode-css' );
          wp_enqueue_style( 'csspropio' );          
      } 
  }
}
add_action( 'wp_enqueue_scripts', 'MK20_encolar_estilos_propios_calendar' );


//Load texdomain

if (!function_exists('MK20_load_plugin_textdomain_calendar')) {

	function MK20_load_plugin_textdomain_calendar()
	{
		load_plugin_textdomain('MK20-Calendario', FALSE, plugin_basename(dirname(__FILE__)) . '/languages/');
	}
	add_action('plugins_loaded', 'Mk20_load_plugin_textdomain_calendar');
} 