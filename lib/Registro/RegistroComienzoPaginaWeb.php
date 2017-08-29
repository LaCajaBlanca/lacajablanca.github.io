<?php
/**
 * Nemosintesis LaCajaBlanca - Registro RegistroComienzoPaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase RegistroComienzoPaginaWeb
 */
class RegistroComienzoPaginaWeb extends PaginaWeb {

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

    /**
     * Constructor
     */
    public function __construct() {
        $this->clave              = 'registro-comienzo';
        $this->formulario         = new \Base2\FormularioWeb('registro-comienzo');
        $this->formulario->action = 'registro-domicilio.php';
        $this->mensaje            = new \Base2\MensajeWeb();
    } // constructor

    /**
     * HTML
     *
     * @return string HTML con la pagina web
     */
    public function html() {
        // Definir propiedades de esta página
        $this->titulo = 'Registro - La Caja Blanca';
        // Si cumple los requierimientos para mostrar el formulario
        if (TRUE) {
            // Mostrar formulario de comienzo
            $this->formulario->encabezado = 'Paso 1 de 3 - Cuenta';
            $this->formulario->seccion('cuenta', 'Cuenta');
            $this->formulario->texto_nombre('nombres',          'Nombre');
            $this->formulario->texto_nombre('apellido_paterno', 'Apellido paterno');
            $this->formulario->texto_nombre('apellido_materno', 'Apellido materno');
            $this->formulario->boton_submit('siguiente',        'Siguiente', 'success');
            $this->contenido[] = $this->formulario->html();
        } else {
            // Mostrar mensaje de que no viene completo el formulario anterior
            $this->mensaje->tipo      = 'aviso';
            $this->mensaje->contenido = "El formulario viene incompleto; por favor intente de nuevo.";
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

} // Clase RegistroComienzoPaginaWeb

?>
