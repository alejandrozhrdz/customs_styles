<?php
function bitdevelopertech_guardar() {

    global $wpdb;   // Esto para tener acceso a todas las opciones del framework
    $tabla = $wpdb->prefix . "reservaciones";
    if(isset($_POST['enviar']) && $_POST['oculto'] == "1" ):

        $nombre = sanitize_text_field($_POST['nombre'] );
        $fecha = sanitize_text_field($_POST['fecha'] );
        $correo = sanitize_text_field($_POST['correo'] );
        $telefono = sanitize_text_field($_POST['telefono'] );
        $mensaje = sanitize_text_field($_POST['mensaje'] );
        

    endif;

// Arreglo de datos ya sanitizados

    $datos = array(
        'nombre' => $nombre,
        'fecha' => $fecha,
        'correo' => $correo,
        'telefono' => $telefono,
        'mensaje' => $mensaje
    );

    // Con este arreglo se le especifica a wordpress el tipo de dato que tiene que procesar
    $formato = array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
    );

    $wpdb ->insert($tabla, $datos, $formato);
}

add_action('init', 'bitdevelopertech_guardar');
