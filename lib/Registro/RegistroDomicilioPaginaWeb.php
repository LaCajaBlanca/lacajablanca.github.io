<?php
/**
 * Nemosintesis LaCajaBlanca - Registro RegistroDomicilioPaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase RegistroDomicilioPaginaWeb
 */
class RegistroDomicilioPaginaWeb extends PaginaWeb {

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
    protected $regresar_al_formulario;

    /**
     * Constructor
     */
    public function __construct() {
        $this->clave              = 'registro-domicilio';
        $this->formulario         = new \Base2\FormularioWeb('registro-domicilio');
        $this->formulario->action = 'registro-opciones.php';
        $this->mensaje            = new \Base2\MensajeWeb();
    } // constructor

    /**
     * Recibir formulario
     *
     * @return boolean Verdadero si el formulario es correcto
     */
    protected function recibir_formulario() {
        // Tomar campos
        $this->nombres          = $_POST['nombres'];
        $this->apellido_paterno = $_POST['apellido_paterno'];
        $this->apellido_materno = $_POST['apellido_materno'];
        // Validar
        $es_correcto_nombre = ($this->nombres != '') && ($this->apellido_paterno != '') && ($this->apellido_materno != '');
        // Si falla la validación, determinar el formulario a regresar
        if (!$es_correcto_nombre) {
            $this->regresar_al_formulario = 'registro.php';
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
        $this->titulo = 'Registro domicilio - La Caja Blanca';
        // Si cumple los requierimientos para mostrar el formulario
        if ($this->recibir_formulario()) {
            // Mostrar formulario de domicilio
            $this->formulario->encabezado = 'Paso 2 de 3 - Domicilio';
            $this->formulario->seccion('domicilio', 'Domicilio');
            $this->formulario->oculto('nombres',          $this->nombres);
            $this->formulario->oculto('apellido_paterno', $this->apellido_paterno);
            $this->formulario->oculto('apellido_materno', $this->apellido_materno);
            $this->formulario->texto_nombre('calle',   'Calle');
            $this->formulario->texto_nombre('num_int', 'Número interior');
            $this->formulario->texto_nombre('num_ext', 'Número exterior');
            $this->formulario->texto_nombre('colonia', 'Colonia');
            $this->formulario->texto_nombre('cp',      'C.P.');
            $this->formulario->boton_submit('siguiente',        'Siguiente', 'success');
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

} // Clase RegistroDomicilioPaginaWeb

?>
