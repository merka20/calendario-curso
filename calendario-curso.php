<?php
/*
Plugin Name: Calendario Curso prueba y Merka20
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


// Crea la página de ajustes
function MK20_Calendar_myplugin_create_settings_page() {
  add_options_page(
      'Ajustes de Mi Plugin',
      'Calendario Curso',
      'manage_options',
      'myplugin-settings',
      'MK20_Calendar_myplugin_render_settings_page'
  );
}
add_action('admin_menu', 'MK20_Calendar_myplugin_create_settings_page');

// Renderiza la página de ajustes
function MK20_Calendar_myplugin_render_settings_page() {
  ?>
  <div class="wrap">
      <h1>Ajustes de Calendario Curso</h1>
      <form method="post" action="options.php">
          <?php
          settings_fields('myplugin-settings-group');
          do_settings_sections('myplugin-settings');
          submit_button('Guardar ajustes');
          ?>
      </form>
  </div>
  <?php
}

// Registra los campos de fecha y campos adicionales
function MK20_Calendar_myplugin_register_settings() {
  register_setting(
      'myplugin-settings-group',
      'myplugin_start_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_end_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_holidays',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_textarea_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_non_working_days',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_textarea_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_infant_start_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_infant_end_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_secundary_start_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  register_setting(
      'myplugin-settings-group',
      'myplugin_secundary_end_date',
      array(
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

  add_settings_section(
      'myplugin-settings-section',
      'Configuración de fecha',
      'MK20_Calendar_myplugin_render_settings_section',
      'myplugin-settings'
  );

  add_settings_field(
      'myplugin-start-date',
      'Fecha de inicio del curso',
      'MK20_Calendar_myplugin_render_start_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-end-date',
      'Fecha de fin del curso',
      'MK20_Calendar_myplugin_render_end_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-holidays',
      'Días festivos',
      'MK20_Calendar_myplugin_render_holidays_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-non-working-days',
      'Días no lectivos',
      'MK20_Calendar_myplugin_render_non_working_days_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-infant-start-date',
      'Fecha de inicio de Infantil',
      'MK20_Calendar_myplugin_render_infant_start_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-infant-end-date',
      'Fecha de fin de Infantil',
      'MK20_Calendar_myplugin_render_infant_end_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-secundary-start-date',
      'Fecha de inicio de Secundaria',
      'MK20_Calendar_myplugin_render_secundary_start_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );

  add_settings_field(
      'myplugin-secundary-end-date',
      'Fecha de fin de Secundaria',
      'MK20_Calendar_myplugin_render_secundary_end_date_field',
      'myplugin-settings',
      'myplugin-settings-section'
  );
}
add_action('admin_init', 'MK20_Calendar_myplugin_register_settings');

// Renderiza la sección de ajustes
function MK20_Calendar_myplugin_render_settings_section() {
  echo '<p>Seleccione los campos necesarios en ajustes para crear el calendario:</p>';
  echo '<p>' . esc_html_e("Una vez incluidos los campos de ajustes debes de colocar este shortcode [calendario] en la página donde quieras que se muestre el calendario.", "MK20-Calendario") . '</p>';

}

// Renderiza el campo de fecha de inicio
function MK20_Calendar_myplugin_render_start_date_field() {
  $start_date = get_option('myplugin_start_date');
  ?>
  <input type="date" name="myplugin_start_date" value="<?php echo esc_attr($start_date); ?>">
  <?php
}

// Renderiza el campo de fecha de fin
function MK20_Calendar_myplugin_render_end_date_field() {
  $end_date = get_option('myplugin_end_date');
  ?>
  <input type="date" name="myplugin_end_date" value="<?php echo esc_attr($end_date); ?>">
  <?php
}

// Renderiza el campo de días festivos
function MK20_Calendar_myplugin_render_holidays_field() {
  $holidays = get_option('myplugin_holidays');
  ?>
  <textarea name="myplugin_holidays" rows="4" cols="50"><?php echo esc_textarea($holidays); ?></textarea>
  <p class="description">Ingrese los días festivos, separados por coma o salto de línea.</p>
  <?php
}

// Renderiza el campo de días no lectivos
function MK20_Calendar_myplugin_render_non_working_days_field() {
  $non_working_days = get_option('myplugin_non_working_days');
  ?>
  <textarea name="myplugin_non_working_days" rows="4" cols="50"><?php echo esc_textarea($non_working_days); ?></textarea>
  <p class="description">Ingrese los días no lectivos, separados por coma o salto de línea.</p>
  <?php
}

// Renderiza el campo de fecha de inicio de infantil
function MK20_Calendar_myplugin_render_infant_start_date_field() {
  $infant_start_date = get_option('myplugin_infant_start_date');
  ?>
  <input type="date" name="myplugin_infant_start_date" value="<?php echo esc_attr($infant_start_date); ?>">
  <?php
}

// Renderiza el campo de fecha de fin de infantil
function MK20_Calendar_myplugin_render_infant_end_date_field() {
  $infant_end_date = get_option('myplugin_infant_end_date');
  ?>
  <input type="date" name="myplugin_infant_end_date" value="<?php echo esc_attr($infant_end_date); ?>">
  <?php
}

// Renderiza el campo de fecha de inicio de secundaria
function MK20_Calendar_myplugin_render_secundary_start_date_field() {
  $secundary_start_date = get_option('myplugin_secundary_start_date');
  ?>
  <input type="date" name="myplugin_secundary_start_date" value="<?php echo esc_attr($secundary_start_date); ?>">
  <?php
}

// Renderiza el campo de fecha de fin de secundaria
function MK20_Calendar_myplugin_render_secundary_end_date_field() {
  $secundary_end_date = get_option('myplugin_secundary_end_date');
  ?>
  <input type="date" name="myplugin_secundary_end_date" value="<?php echo esc_attr($secundary_end_date); ?>">
  <?php
}


// Función para obtener los días de la semana de inicio de cada mes
function MK20_Calendar_obtener_dias_semana_inicio_mes($start_month, $start_year, $end_month, $end_year) {
  $dias_semana = array();
  
  $fecha_inicio = new DateTime("{$start_year}-{$start_month}-01");
  $fecha_fin = new DateTime("{$end_year}-{$end_month}-01");
  
  while ($fecha_inicio <= $fecha_fin) {
      $anio = $fecha_inicio->format('Y');
      $mes = $fecha_inicio->format('n');

      $primer_dia = strtotime("{$anio}-{$mes}-01");
      $dia_semana = date('N', $primer_dia);

      $dias_semana[$mes] = $dia_semana;

      $fecha_inicio->modify('+1 month');
  }
  
  return $dias_semana;
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
 
    $start_date = get_option('myplugin_start_date');
    $end_date = get_option('myplugin_end_date');
    $start_month = date('m', strtotime($start_date));
    $start_year = date('Y', strtotime($start_date));
    $end_month = date('m', strtotime($end_date));
    $end_year = date('Y', strtotime($end_date));
    
    $dias_semana = MK20_Calendar_obtener_dias_semana_inicio_mes($start_month, $start_year, $end_month, $end_year);
    

$enero = $dias_semana[1];
$febrero = $dias_semana[2];
$marzo = $dias_semana[3];
$abril = $dias_semana[4];
$mayo = $dias_semana[5];
$junio = $dias_semana[6];
$septiembre = $dias_semana[9];
$octubre = $dias_semana[10];
$noviembre = $dias_semana[11];
$diciembre = $dias_semana[12];

// Obtener el valor de la fecha guardada en la variable $infant_end_date
/*$infant_end_date = get_option('myplugin_infant_end_date');
   // Convertir la fecha en un objeto de fecha de JavaScript
   $infant_end_date_js = date('Y/m/d', strtotime($infant_end_date));*/

// Generar el contenido CSS
$css_content = "        
    .hoja.enero li.first-day {
      grid-column-start:". esc_html($enero) .";/*colocamos el numero desde donde queremos que empiece el mes 7 es domingo*/
    }.hoja.enero li.dia:nth-child(7n+" . (7 - $enero) . ")  {	
      background-color: var(--finde);
      color: white;
    }.hoja.enero li.dia:nth-child(7n+" . (1 + (7 - $enero)) . ")  {	
      background-color: var(--finde);
      color: white;
    }     
    .hoja.febrero li.first-day {
      grid-column-start: ". esc_html($febrero) .";
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
      grid-column-start: ". esc_html($marzo) .";
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
      grid-column-start: ". esc_html($abril) .";
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
      grid-column-start: ". esc_html($mayo) .";
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
      grid-column-start: ". esc_html($junio) .";
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
      grid-column-start: ". esc_html($septiembre) .";
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
      grid-column-start: ". esc_html($octubre) .";
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
      grid-column-start: ". esc_html($noviembre) .";
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
      grid-column-start: ". esc_html($diciembre) .";
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

// Definir array de nombres de los meses en español
$meses = array(
  9 => 'septiembre',
  10 => 'octubre',
  11 => 'noviembre',
  12 => 'diciembre',
  1 => 'enero',
  2 => 'febrero',
  3 => 'marzo',
  4 => 'abril',
  5 => 'mayo',
  6 => 'junio'
);

$posicion = array_search('septiembre', $meses);


// Obtener las fechas almacenadas en get_option
$fecha_inicio_primaria = get_option('myplugin_infant_start_date');
$fecha_fin_primaria = get_option('myplugin_infant_end_date');
$fecha_inicio_secundaria = get_option('myplugin_secundary_start_date');
$fecha_fin_secundaria = get_option('myplugin_secundary_end_date');
$dias_festivos = get_option('myplugin_holidays');


// Convertir las fechas en objetos de tipo DateTime
$fecha_inicio_primaria_objeto = new DateTime($fecha_inicio_primaria);
$fecha_fin_primaria_objeto = new DateTime($fecha_fin_primaria);
$fecha_inicio_secundaria_objeto = new DateTime($fecha_inicio_secundaria);
$fecha_fin_secundaria_objeto = new DateTime($fecha_fin_secundaria);


// Obtener los números de mes y días utilizando la función date()
$mes_numero_inicio_primaria = $fecha_inicio_primaria_objeto->format('m');
$dia_inicio_primaria = $fecha_inicio_primaria_objeto->format('d');
$mes_numero_fin_primaria = $fecha_fin_primaria_objeto->format('m');
$dia_fin_primaria = $fecha_fin_primaria_objeto->format('d');
$mes_numero_inicio_secundaria = $fecha_inicio_secundaria_objeto->format('m');
$dia_inicio_secundaria = $fecha_inicio_secundaria_objeto->format('d');
$mes_numero_fin_secundaria = $fecha_fin_secundaria_objeto->format('m');
$dia_fin_secundaria = $fecha_fin_secundaria_objeto->format('d');



// Obtener los nombres de los meses en español desde el array
$mes_nombre_inicio_primaria = $meses[(int)$mes_numero_inicio_primaria];
$mes_nombre_fin_primaria = $meses[(int)$mes_numero_fin_primaria];
$mes_nombre_inicio_secundaria = $meses[(int)$mes_numero_inicio_secundaria];
$mes_nombre_fin_secundaria = $meses[(int)$mes_numero_fin_secundaria];


// Formatear los valores de los días
$dia_formateado_inicio_primaria = ltrim($dia_inicio_primaria, '0');
$dia_formateado_fin_primaria = ltrim($dia_fin_primaria, '0');
$dia_formateado_inicio_secundaria = ltrim($dia_inicio_secundaria, '0');
$dia_formateado_fin_secundaria = ltrim($dia_fin_secundaria, '0');


$datos_fechas = explode('/', $dias_festivos);
$dia_fecha = intval($datos_fechas[0]);
$mes_fecha = intval($datos_fechas[1]);
$anio_fecha = intval($datos_fechas[2]);

$mes_nombre = $meses[$mes_fecha];

function obtenerNombreDiaSemana($fecha) {
  // Verificar si la fecha no es null y es una cadena no vacía
  if ($fecha && is_string($fecha)) {
    // Convertir la fecha en un objeto DateTime
    $fecha_objeto = new DateTime($fecha);
    
    // Obtener el nombre del día de la semana en español
    $nombre_dia_semana = $fecha_objeto->format('l'); // 'l' devuelve el nombre completo del día
    
    // Puedes personalizar los nombres de los días en español si es necesario
    $nombres_dias_espanol = array(
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    );
    
    return $nombres_dias_espanol[$nombre_dia_semana];
  } else {
    return 'Fecha no válida';
  }
}

// Obtener el día de la semana para las fechas de inicio y fin de primaria y secundaria
$diaSemana_inicio_primaria = obtenerNombreDiaSemana($fecha_inicio_primaria);
$diaSemana_fin_primaria = obtenerNombreDiaSemana($fecha_fin_primaria);
$diaSemana_inicio_secundaria = obtenerNombreDiaSemana($fecha_inicio_secundaria);
$diaSemana_fin_secundaria = obtenerNombreDiaSemana($fecha_fin_secundaria);

//echo $dia_fecha . '/' . $mes_nombre . '/' . $anio_fecha; // Imprime la fecha en formato "día/mes/año"

echo '<div class="calendar-wrapper">';

$start_date = get_option('myplugin_start_date'); // Obtener la fecha de inicio desde la opción de WordPress
$mesNumero = date('n', strtotime($start_date)); // Obtener el número de mes de la fecha de inicio

// Encontrar la posición del mes de inicio en el array $meses
$posicion = array_search($meses[$mesNumero], $meses);

// Recorrer los meses a partir de la posición encontrada
for ($i = $posicion; $i < $posicion + 10; $i++) {
  $mesNumero = ($i > 12) ? $i - 12 : $i;
  $mesNombre = $meses[$mesNumero];
  $anio = ($i > 12) ? intval(date('Y', strtotime($start_date))) + 1 : intval(date('Y', strtotime($start_date)));

  // Obtener el número de días del mes
  $diasMes = cal_days_in_month(CAL_GREGORIAN, $mesNumero, $anio);

    
  echo '<div class="hoja ' . $mesNombre . '"><h2>' . $mesNombre . '</h2>';
  echo '<ul class="calendar">';
  echo '<li class="weekday">L</li>
  <li class="weekday">M</li>
  <li class="weekday">X</li>
  <li class="weekday">J</li>
  <li class="weekday">V</li>
  <li class="weekday">S</li>
  <li class="weekday">D</li>';


  for ($dia = 1; $dia <= $diasMes; $dia++) {   
    $dias_festivos = get_option('myplugin_holidays');
    $festivos_array = preg_split('/\s*,\s*/', $dias_festivos);    
    $dias_no_lectivos = get_option('myplugin_non_working_days');
    $no_lectivos_array = preg_split('/\s*,\s*/', $dias_no_lectivos);  
           
    
    $festivos = array(); // Array para almacenar los días festivos
    $no_lectivos = array(); // Array para almacenar los días festivos

     // Calcula el día de la semana
    $diaSemana = date('N', strtotime($anio . '-' . $mesNombre . '-' . $dia));  
               
    $meses = array(
      9 => 'septiembre',
      10 => 'octubre',
      11 => 'noviembre',
      12 => 'diciembre',
      1 => 'enero',
      2 => 'febrero',
      3 => 'marzo',
      4 => 'abril',
      5 => 'mayo',
      6 => 'junio'
    );
    
    foreach ($festivos_array as $festivo) {
        $fechas = explode("\n", $festivo); // Dividir las fechas por saltos de línea (si es necesario)
    
        foreach ($fechas as $fecha) {
            $datos_fecha = explode('/', $fecha);
            if (count($datos_fecha) === 3) {
                $dia_festivo = intval($datos_fecha[0]);
                $mes_festivo = intval($datos_fecha[1]);
                $anio_festivo = intval($datos_fecha[2]);
                
                // Verificar si la clave del mes existe en el array $meses
            if (array_key_exists($mes_festivo, $meses)) {
              // Obtener el nombre del mes desde el array $meses
              $nombre_mes = $meses[$mes_festivo];

              // Formatear la fecha en el formato "día/mes" y agregarla al array de días festivos
              $festivos[] = $dia_festivo . '/' . $nombre_mes;
          }
            }
        }
    }

      $fechas_no_lectivas = array(); // Array para almacenar las fechas no lectivas formateadas  


      foreach ($no_lectivos_array as $fechas_no_lectivas) {
          $fechas_no_lectivas = explode("\n", $fechas_no_lectivas); // Dividir las fechas por saltos de línea (si es necesario)

          foreach ($fechas_no_lectivas as $fecha_no_lectiva) {
              $datos_fecha_no_lectiva = explode('/', $fecha_no_lectiva);
              if (count($datos_fecha_no_lectiva) === 3) {
                  $dia_nl = intval($datos_fecha_no_lectiva[0]);
                  $mes_nl = intval($datos_fecha_no_lectiva[1]);
                  $anio_nl = intval($datos_fecha_no_lectiva[2]);                  

                  // Obtener el nombre del mes desde el array $meses (opcional)
                  $nombre_mes_nl = $meses[$mes_nl] ?? '';                  

                  // Formatear la fecha en el formato "día/mes" y agregarla al array de fechas no lectivas
                  $fechas_no_lectivas[] = $dia_nl . '/' . $nombre_mes_nl;
              }             
          }
      }

    $fechaBuscada = null; // Variable para almacenar la fecha correspondiente al 29 de noviembre

      foreach ($fechas_no_lectivas as $fecha_no_lectiva) {
          // Limpia la fecha de espacios en blanco y otros caracteres no deseados
          $fecha_no_lectiva = trim($fecha_no_lectiva);
      
          // Divide la fecha en día, mes y año
          $datos_fecha_no_lectiva = explode('/', $fecha_no_lectiva);
      
          // Verifica si la fecha es el 29 de noviembre
          if (count($datos_fecha_no_lectiva) === 3 &&
              intval($datos_fecha_no_lectiva[0]) === 29 &&
              intval($datos_fecha_no_lectiva[1]) === 11) {
              // Reformatea la fecha al formato "Y-m-d"
              $fechaReformateada = $datos_fecha_no_lectiva[2] . '-' . $datos_fecha_no_lectiva[1] . '-' . $datos_fecha_no_lectiva[0];
              $fechaBuscada = $fechaReformateada;
              break; // Si encontramos la fecha, salimos del bucle
          }
      }
      
      $nombreDiaSemanapatron = obtenerNombreDiaSemana($fechaBuscada); 
     

    // Verificar si el valor actual es igual a 20
    if ($dia == $dia_formateado_inicio_primaria && $mesNombre == 'septiembre') {         
      echo '<li class="dia inicios"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Inicio clases</h4><p class=\"nota\">Fecha de comienzo de las clases de infantil y primaria: ' . esc_html($diaSemana_inicio_primaria) . ' '. esc_html($dia) .' ' . esc_html($mesNombre) .'.</p></div></li>';
    } elseif ($dia == 1 && in_array($dia . '/' . $mesNombre, $fechas_no_lectivas)){
      echo '<li class="no-lectivo dia"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>';
    } elseif ($dia == 1 && in_array($dia . '/' . $mesNombre, $festivos)){
      echo '<li class="first-day fiesta dia">' . esc_html($dia) . '</li>';
    } elseif ($dia == 1){
      echo '<li class="first-day dia">' . esc_html($dia) . '</li>';
    } elseif ($dia == $dia_formateado_fin_primaria && $mesNombre == 'junio'){
      echo '<li class="dia fins"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Fin de curso</h4><p class=\"nota\">Fecha de finalización de las clases de infantil y primaria ' . esc_html($diaSemana_fin_primaria) . ' ' . esc_html($dia) . ' ' . esc_html($mesNombre) .'.</p></div></li>';
    } elseif ($dia == $dia_formateado_inicio_secundaria && $mesNombre == 'septiembre'){
      echo '<li class="dia inicioi"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Inicio clases</h4><p class=\"nota\">Fecha de comienzo de las clases de secundaria: ' . esc_html($diaSemana_inicio_secundaria) . ' ' . esc_html($dia) . ' ' . esc_html($mesNombre) .'.</p></div></li>';
    } elseif ($dia == $dia_formateado_fin_secundaria && $mesNombre == 'junio'){
      echo '<li id="final" class="fini dia"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Fin de curso</h4><p class=\"nota\">Fecha de finalización de las clases de secundaria ' . esc_html($diaSemana_fin_secundaria) . ' ' . esc_html($dia) . ' ' . esc_html($mesNombre) .'.</p></div></li>';                  
    } elseif (in_array($dia . '/' . $mesNombre, $festivos)) {
      echo '<li class="fiesta dia">' . esc_html($dia) . '</li>';
    } elseif ($dia == 29 && in_array($dia . '/' . $mesNombre, $fechas_no_lectivas)){
      echo '<li class="no-lectivo dia"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota">Fecha Patrón Localidad: ' . esc_html($nombreDiaSemanapatron) . ' ' . esc_html($dia) . ' ' . esc_html($mesNombre) .'.</p></div></li>';
    } elseif (in_array($dia . '/' . $mesNombre, $fechas_no_lectivas)){
      echo '<li class="no-lectivo dia"><span class="numero">' . esc_html($dia) . '</span><div class="ventana"><h4>Fechas no lectivas</h4><p class="nota"></p></div></li>';
    }
    else {
      echo '<li class="dia">' . esc_html($dia) . '</li>';
    } 

  }
  echo '</ul>';
  echo '</div>';   
  
}
echo '</div>';

$html = ob_get_clean();
return $html;          
}
}
 
//Encolar estilos propios
function MK20_Calendar_encolar_estilos_propios_calendar() {
  global $post;

  if ( is_a( $post, 'WP_Post' ) ) {
    $has_shortcode = has_shortcode( $post->post_content, 'calendario' );

    if ( $has_shortcode ) {
      wp_register_style( 'plugin-shortcode-css', plugin_dir_url( __FILE__ ) . 'admin/css/estilo_meses.css' );
      wp_register_style( 'csspropio', plugin_dir_url( __FILE__ ) . 'admin/css/style.css' );

      wp_enqueue_style( 'plugin-shortcode-css' );
      wp_enqueue_style( 'csspropio' );

      // Enqueue del archivo JavaScript "cambio-clase.js"
      //wp_enqueue_script( 'cambio-clase', plugin_dir_url( __FILE__ ) . 'inc/js/cambio-clase.js', array( 'jquery' ), '1.0', true );
    }
  }
}
add_action( 'wp_enqueue_scripts', 'MK20_Calendar_encolar_estilos_propios_calendar' );



//Load texdomain

if (!function_exists('MK20_Calendar_load_plugin_textdomain_calendar')) {

	function MK20_Calendar_load_plugin_textdomain_calendar()
	{
		load_plugin_textdomain('MK20-Calendario', FALSE, plugin_basename(dirname(__FILE__)) . '/languages/');
	}
	add_action('plugins_loaded', 'Mk20_Calendar_load_plugin_textdomain_calendar');  
}  