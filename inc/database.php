<?php

                    // <!-- Crear funcion  -->
// Inicializa la creacion de las tablas nuevas
                    function bitdevelopertech_database(){
// WPDB nos da los métodos para trabajar con tablas                    
                        global $wpdb;
                        global $bitdevelopertech_dbversion;
                        $bitdevelopertech_dbversion = '1.0';    // Se debe cambiar cada vez que se agregue o elimine un campo
// Obtenemos el prefijo                      
                        $tabla = $wpdb->prefix . 'reservaciones';
// Obtenemos el collation de la instalación
                        $charset_collate = $wpdb->get_charset_collate();
// Agregamos la estructura de la BD
                        $sql = "CREATE TABLE $tabla (
                                id mediumint(9) NOT NULL AUTO_INCREMENT,
                                nombre varchar(50) NOT NULL,
                                fecha datetime NOT NULL,
                                correo varchar(50) DEFAULT '' NOT NULL,
                                telefono varchar(10) NOT NULL,
                                mensaje longtext NOT NULL,
                                PRIMARY KEY (id)
                        ) $charset_collate; ";

                        // Imprimir la ruta absoluta
                        // Con esto se pueden integrar tablas de cualquier otro proyecto para integrarlo a wordpress
// Se necesita dbDelta para ejecutar el SQL y está en la siguiente dirección
                        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                        // Llamada a db delta, funcion que examina la estructura de las tablas, agrega y modifica la tabla 
                        dbDelta($sql);
// Agregamos la versión de la BD para compararla con futuras actualizaciones
                        add_option('bitdevelopertech_dbversion', $bitdevelopertech_dbversion);

                        // Cómo agregar una tabla nueva habiendo ya una existente 

                        //------------------------------------------------------------------------------------------------------------------------------------------>>> Todo el código anterior solo se ejecuta una vez 

                        // ACTUALIZAR EN CASO DE SER NECESARIO

                        $version_actual = get_option('bitdevelopertech_dbversion');
// Comparamos las dos versiones
                            // Para esto solo necesitamos la tabla y el SQL
                        if($bitdevelopertech_dbversion != $version_actual) {
                            $tabla = $wpdb->prefix . 'reservaciones';
// AQUÍ SE REALIZAN LAS ACTUALIZACIONES
                        $sql = "CREATE TABLE $tabla (
                                id mediumint(9) NOT NULL AUTO_INCREMENT,
                                nombre varchar(50) NOT NULL,
                                fecha datetime NOT NULL,
                                correo varchar(50) DEFAULT '' NOT NULL,
                                telefono varchar(10) NOT NULL,
                                mensaje longtext NOT NULL,
                                PRIMARY KEY (id)
                        ) $charset_collate; ";

                        require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); 
                        dbDelta($sql);
// Actualizamos a la version actual en caso de que así sea
                        update_option('bitdevelopertech_dbversion', $bitdevelopertech_dbversion);

                        }
                        
                    }
                    add_action('after_setup_theme', 'bitdevelopertech_database');

// Funcion para comprobar que la versión instalada es igual a la base de datos nueva
                    // Se encarga de actualizar las tablas solo en caso de que la version sea modificada
                    function bitdevelopertech_revisar() {
                        global $bitdevelopertech_dbversion;
                        if(get_site_option('bitdevelopertech_dbversion') != $bitdevelopertech_dbversion){
                            bitdevelopertech_database();
                        }
                    }
                    
                    add_action('plugins_loaded', 'bitdevelopertech_revisar');
                    
                    
?>