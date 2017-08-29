<?php
/**
 * Nemosintesis LaCajaBlanca - Inicio Menu
 *
 * @package LaCajaBlanca
 */

namespace Inicio;

/**
 *  Clase Menu
 */
class Menu extends \Base2\Menu {

    // public $clave;
    // public $permisos;
    // protected $principal_actual;
    // protected $estructura;
    // protected $datos;
    protected $sesion;  // Instancia con la Sesion
    public $usuario;    // Entero, ID del usuario

    /*
     * Permisos
     *
     * 0) Nada
     * 1) Ver
     * 2) Ver, Modificar
     * 3) Ver, Modificar, Agregar
     * 4) Ver, Modificar, Agregar, Eliminar
     * 5) Ver, Modificar, Agregar, Eliminar, Recuperar
     */
    static public $permiso_ver       = 1;
    static public $permiso_modificar = 2;
    static public $permiso_agregar   = 3;
    static public $permiso_eliminar  = 4;
    static public $permiso_recuperar = 5;

    /**
     * Constructor
     *
     * @param mixed Instancia con la Sesion
     */
    public function __construct($in_sesion) {
        $this->sesion  = $in_sesion;
        $this->usuario = $this->sesion->usuario;
    } // constructor

    /**
     * Consultar
     *
     * @param integer Opcional, ID del usuario, use 1 para el sistema
     */
    public function consultar($in_usuario='') {
        // Parametro id del usuario
        if ($in_usuario != '') {
            $this->usuario = $in_usuario;
        }
        if (!\Base2\UtileriasParaValidar::validar_entero($this->usuario)) {
            throw new \Exception("Error en Menu: ID de usuario incorrecto.");
        }
        // Consultar
        $base_datos = new \Base2\BaseDatosMotor();
        try {
            $consulta = $base_datos->comando(sprintf("
                SELECT
                    m.id,
                    i.poder,
                    m.padre,
                    m.clave,
                    m.nombre,
                    m.icono,
                    m.pagina,
                    m.permiso_maximo AS modulo_permiso_maximo,
                    m.poder_minimo,
                    r.departamento,
                    r.permiso_maximo AS rol_permiso_maximo
                FROM
                    adm_integrantes i,
                    adm_roles r,
                    adm_modulos m
                WHERE
                    i.departamento = r.departamento
                    AND r.modulo = m.id
                    AND i.usuario = %d
                    AND i.poder >= m.poder_minimo
                    AND m.estatus = 'A'
                    AND r.estatus = 'A'
                    AND i.estatus = 'A'
                ORDER BY
                    m.orden ASC",
                $this->usuario));
        } catch (\Exception $e) {
            throw new \Exception('Error en Menú: En el comando SQL para hacer la consulta.');
        }
        // Si no hay registros
        if ($consulta->cantidad_registros() == 0) {
            throw new \Exception('Error en Menú: La consulta no entregó registros para crear el menú.');
        }
        // Agregar opciones inicio, personalizar y salir
        $this->agregar_principal(        'inicio',        'Inicio',                 'index.php',              'glyphicon glyphicon-home', 1);
        $this->agregar_principal_derecha('personalizar',  $this->sesion->nom_corto, 'personalizar.php',       'glyphicon glyphicon-cog',  1);
        $this->agregar_principal_derecha('salir',        '',                        'index.php?accion=salir', 'glyphicon glyphicon-off',  1);
        // Primer bucle, porque un usuario puede pertenecer a varios departamento y tener dos permisos en la misma clave
        $antesala = array();
        foreach ($consulta->obtener_todos_los_registros() as $a) {
            // Por compatibilidad con la version anterior nos saltamos estas claves
            if (($a['clave'] == 'inicio') || ($a['clave'] == 'personalizar') || ($a['clave'] == 'personalizar_permisos')) {
                continue;
            }
            // Permiso, inicia tomando el maximo del modulo
            $permiso = $a['modulo_permiso_maximo'];
            // Permiso, se compara con el maximo del rol, queda el menor
            if ($permiso > $a['rol_permiso_maximo']) {
                $permiso = $a['rol_permiso_maximo'];
            }
            // Permiso, se compara con el poder del integrante, queda el menor
            if ($permiso > $a['poder']) {
                $permiso = $a['poder'];
            }
            // Si ya se definio esa clave
            if (isset($antesala[$a['clave']])) {
                // Si el permiso actual es mayor que el anterior, se cambia, de lo contrario no hace nada
                if ($permiso > $antesala[$a['clave']]['permiso']) {
                    $antesala[$a['clave']]['permiso'] = $permiso;
                }
            } else {
                // Es una clave nueva y se agrega a la antesala
                $antesala[$a['clave']] = array('nombre' => $a['nombre'], 'pagina' => $a['pagina'], 'icono' => $a['icono'], 'permiso' => $permiso, 'padre' => $a['padre']);
            }
        }
        // Segundo bucle, alimentar el menu
        foreach ($antesala as $clave => $b) {
            // Si el padre es nulo
            if ($b['padre'] == '') {
                // Entonces es principal
                $this->agregar_principal($clave, $b['nombre'], $b['pagina'], $b['icono'], $b['permiso']);
            } else {
                // Tiene padre, entonces es secundario
                $this->agregar($clave, $b['nombre'], $b['pagina'], $b['icono'], $b['permiso']);
            }
        }
    } // consultar

} // Clase Menu

?>
