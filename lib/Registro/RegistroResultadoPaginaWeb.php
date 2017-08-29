<?php
/**
 * Nemosintesis LaCajaBlanca - Registro RegistroResultadoPaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase RegistroResultadoPaginaWeb
 */
class RegistroResultadoPaginaWeb extends PaginaWeb {

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
    protected $detalle;
    protected $mensaje;
    protected $nombres;
    protected $apellido_paterno;
    protected $apellido_materno;
    protected $calle;
    protected $num_int;
    protected $num_ext;
    protected $colonia;
    protected $cp;
    protected $modo_entrega;
    protected $comentarios;
    protected $regresar_al_formulario;

    /**
     * Constructor
     */
    public function __construct() {
        $this->clave   = 'registro-opciones';
        $this->detalle = new \Base2\DetalleWeb();
        $this->mensaje = new \Base2\MensajeWeb();
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
        $this->modo_entrega     = $_POST['modo_entrega'];
        $this->comentarios      = $_POST['comentarios'];
        // Validar
        $es_correcto_nombre    = ($this->nombres != '') && ($this->apellido_paterno != '') && ($this->apellido_materno != '');
        $es_correcto_numero    = ($this->num_int != '') || ($this->num_ext != '');
        $es_correcto_direccion = ($this->calle != '') && ($this->colonia != '') && ($this->cp != '');
        $es_correcto_modo      = ($this->modo_entrega != '');
        // Si falla la validación, determinar el formulario a regresar
        if (!$es_correcto_nombre) {
            $this->regresar_al_formulario = 'registro.php';
        } elseif (!($es_correcto_numero && $es_correcto_direccion)) {
            $this->regresar_al_formulario = 'registro-domicilio.php';
        } elseif (!$es_correcto_modo) {
            $this->regresar_al_formulario = 'registro-opciones.php';
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
        $this->titulo = 'Registro final - La Caja Blanca';
        // Si cumple los requierimientos para mostrar el formulario
        if ($this->recibir_formulario()) {
            // Mostrar detalle
            $this->detalle->seccion('Nombre completo');
            $this->detalle->dato('Nombre',           $this->nombres);
            $this->detalle->dato('Apellido paterno', $this->apellido_paterno);
            $this->detalle->dato('Apellido materno', $this->apellido_materno);
            $this->detalle->seccion('Domicilio');
            $this->detalle->dato('Calle',            $this->calle);
            $this->detalle->dato('No. interior',     $this->num_int);
            $this->detalle->dato('No. exterior',     $this->num_ext);
            $this->detalle->dato('Colonia',          $this->colonia);
            $this->detalle->dato('C.P.',             $this->cp);
            $this->detalle->seccion('Opciones');
            $this->detalle->dato('Modo de entrega',  $this->modo_entrega);
            $this->detalle->dato('Comentarios',      $this->comentarios);
            $this->contenido[] = $this->detalle->html();
            // Mostrar mensaje de agradecimiento
            $this->mensaje->tipo      = 'info';
            $this->mensaje->contenido = "Gracias. Confirmaremos en poco tiempo su registro.";
            $this->mensaje->boton_url('ir_a_pagina_inicial', 'Terminar registro', 'index.html');
            $this->contenido[] = $this->mensaje->html();
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
        return array($this->mensaje->javascript(), $this->detalle->javascript());
    } // javascript

} // Clase RegistroResultadoPaginaWeb

?>
