<?php
/**
 * Nemosintesis LaCajaBlanca - Registro RegistroOpcionesPaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase RegistroOpcionesPaginaWeb
 */
class RegistroOpcionesPaginaWeb extends PaginaWeb {

    // protected $sistema;
    // protected $titulo;
    // protected $descripcion;
    // protected $autor;
    // protected $css;
    // protected $css_comun;
    // protected $favicon;
    // protected $modelo;
    // protected $menu_principal_logo;
    // protected $modelo_ingreso_logos;
    // protected $modelo_fluido_logos;
    // protected $pie;
    // protected $css_comun;
    // protected $javascript_comun;
    // public $clave;
    // public $contenido;
    // public $javascript;
    protected $formulario;
    protected $mensaje;
    protected $nombres;
    protected $apellido_paterno;
    protected $apellido_materno;
    protected $calle;
    protected $num_int;
    protected $num_ext;
    protected $colonia;
    protected $cp;
    protected $regresar_al_formulario;

    /**
     * Constructor
     */
    public function __construct() {
        $this->clave              = 'registro-opciones';
        $this->formulario         = new \Base2\FormularioWeb('registro-crear');
        $this->formulario->action = 'registro-resultado.php';
        $this->mensaje            = new \Base2\MensajeWeb();
    } // constructor

    /**
     * Recibir formulario
     */
    protected function recibir_formulario() {
        // Tomar campos
        $this->nombres          = $_POST['nombres'];
        $this->apellido_paterno = $_POST['apellido_paterno'];
        $this->apellido_materno = $_POST['apellido_materno'];
        $this->calle            = $_POST['calle'];
        $this->num_int          = $_POST['num_int'];
        $this->num_ext          = $_POST['num_ext'];
        $this->colonia          = $_POST['colonia'];
        $this->cp               = $_POST['cp'];
        // Validar
        $es_correcto_nombre    = ($this->nombres != '') && ($this->apellido_paterno != '') && ($this->apellido_materno != '');
        $es_correcto_numero    = ($this->num_int != '') || ($this->num_ext != '');
        $es_correcto_direccion = ($this->calle != '') && ($this->colonia != '') && ($this->cp != '');
        // Si falla la validación, determinar el formulario a regresar
        if (!$es_correcto_nombre) {
            $this->regresar_al_formulario = 'registro.php';
        } elseif (!($es_correcto_numero && $es_correcto_direccion)) {
            $this->regresar_al_formulario = 'registro-domicilio.php';
        } else {
            $this->regresar_al_formulario = FALSE;
        }
        // Entregar validación
        return ($this->regresar_al_formulario == FALSE);
    } // recibir_formulario

    /**
     * HTML
     *
     * @return string HTML con la pagina web
     */
    public function html() {
        // Definir propiedades de esta página
        $this->titulo = 'Registro opciones - La Caja Blanca';
        // Si cumple los requierimientos para mostrar el formulario
        if ($this->recibir_formulario()) {
            // Mostrar formulario de opciones
            $this->formulario->encabezado = 'Paso 3 de 3 - Opciones';
            $this->formulario->seccion('opciones', 'Opciones');
            $this->formulario->oculto('nombres',            $this->nombres);
            $this->formulario->oculto('apellido_paterno',   $this->apellido_paterno);
            $this->formulario->oculto('apellido_materno',   $this->apellido_materno);
            $this->formulario->oculto('calle',              $this->calle);
            $this->formulario->oculto('num_int',            $this->num_int);
            $this->formulario->oculto('num_ext',            $this->num_ext);
            $this->formulario->oculto('colonia',            $this->colonia);
            $this->formulario->oculto('cp',                 $this->cp);
            $this->formulario->texto_nombre('modo_entrega', 'Elija el modo de entrega');
            $this->formulario->texto_nombre('comentarios',  'Escriba algún comentario');
            $this->formulario->boton_submit('siguiente',    'Siguiente', 'success');
            $this->contenido[] = $this->formulario->html();
        } else {
            // Mostrar mensaje de que no viene completo el formulario anterior
            $this->mensaje->tipo      = 'aviso';
            $this->mensaje->contenido = "El formulario viene incompleto; por favor intente de nuevo.";
            $this->mensaje->boton_url('regresar', 'Reintentar', $this->regresar_al_formulario);
            $this->contenido[] = $this->mensaje->html();
        }
        // Ejectuar método en el padre
        return parent::html();
    } // html

    /**
     * Javascript
     *
     * @return string Código javascript
     */
    public function javascript() {
        return array($this->formulario->javascript(), $this->mensaje->javascript());
    } // javascript

} // Clase RegistroOpcionesPaginaWeb

?>
