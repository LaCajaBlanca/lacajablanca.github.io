<?php
/**
 * Nemosintesis LaCajaBlanca - Configuracion RegistroCookieConfig
 *
 * @package LaCajaBlanca
 */

namespace Configuracion;

/**
 * Clase abstracta RegistroCookieConfig
 */
abstract class RegistroCookieConfig {

    protected $nom_cookie     = 'lacajablanca_registro';   // Nombre con el que se guardara la cookie en el navegador.
    protected $version_actual = 1;                         // Número entero que sirve para obligar a renover las cookies anteriores
    protected $tiempo_expirar = 86400;                     // Tiempo en segundos para que expire la cookie, 60 x 60 x 60 x 24 = 86400 seg = 1 dia
    protected $tiempo_renovar = 3600;                      // Tiempo en segundos para que se renueve la cookie, 60 x 60 = 3600 seg = 1 hora
    protected $key            = '1234123412341234';        // 16 caracteres o más que sean muy difíciles de adivinar para llave de cifrado

} // Clase abstracta RegistroCookieConfig

?>
