<?php
/**
 * Nemosintesis LaCajaBlanca - Registro Menu
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 *  Clase Menu
 */
class Menu extends \Base2\Menu {

    // public $clave;
    // public $permisos;
    // protected $principal_actual;
    // protected $estructura;
    // protected $datos;

    /**
     * Consultar
     */
    public function consultar() {
        // Opciones para el menú de pruebas de Tierra
        $this->agregar_principal('registro', '-Registro', 'registro.php',           'preferences-desktop.png');
        $this->agregar('registro-crear',     'Crear',     'registro.php',           'supertux.png');
        $this->agregar('registro-domicilio', 'Domicilio', 'registro-domicilio.php', 'user-info.png');
        $this->agregar('registro-opciones',  'Opciones',  'registro-opciones.php',  'accessories-dictionary.png');
    } // consultar

} // Clase Menu

?>
