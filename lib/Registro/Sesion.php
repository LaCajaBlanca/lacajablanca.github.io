<?php
/**
 * Nemosintesis LaCajaBlanca - Registro Sesion
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase Sesion
 */
class Sesion extends Cookie {

    // protected $nom_cookie;
    // protected $version_actual;
    // protected $tiempo_expirar;
    // protected $tiempo_renovar;
    // protected $key;
    // public $usuario;
    // public $ingreso;
    public $nombre;            // Texto
    public $nom_corto;         // Texto
    public $tipo;              // Caracter, tipo de usuario
    public $pagina;            // Clave de la página
    public $pagina_permiso;    // Permiso de la página en uso
    public $permisos;          // Arreglo asociativo con todos los permisos
    public $listado_renglones; // Cantidad de renglones en los listados
    public $menu;              // Instancia de Menu

} // Clase Sesion

?>
