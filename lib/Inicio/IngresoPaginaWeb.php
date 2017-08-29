<?php
/**
 * Nemosintesis LaCajaBlanca - Inicio PaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Inicio;

/**
 * Clase IngresoPaginaWeb
 */
class IngresoPaginaWeb extends \Base2\PlantillaWeb {

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
    // public $menu;
    // public $contenido;
    // public $javascript;

    /**
     * Constructor
     */
    public function __construct($clave) {
        $this->clave = $clave;
    } // constructor

    /**
     * HTML
     *
     * @return string HTML con la pagina web
     */
    public function html() {
        // Definir plantilla de ingreso
        $plantilla = new \Base2\TemaWebIngreso();
        $plantilla->modelo_ingreso_logos = $this->modelo_ingreso_logos;
        // Pasar parámetros comunes a todas las plantillas
        $plantilla->sistema          = $this->sistema;
        $plantilla->descripcion      = $this->descripcion;
        $plantilla->autor            = $this->autor;
        $plantilla->css_comun        = $this->css_comun;
        $plantilla->favicon          = $this->favicon;
        $plantilla->pie              = $this->pie;
        $plantilla->javascript_comun = $this->javascript_comun;
        // Procesar CSS
        if (is_array($this->css) && (count($this->css) > 0)) {
            $a = array();
            foreach ($this->css as $c) {
                if ($c != '') {
                    $a[] = $c;
                }
            }
            $plantilla->css = implode("\n", $a);
        } elseif (is_string($this->css) && ($this->css != '')) {
            $plantilla->css = "  <link href=\"{$this->css}\" rel=\"stylesheet\" type=\"text/css\">";
        } else {
            $plantilla->css = "  <!-- Pagina sin CSS adicional. -->";
        }
        // Procesar contenido
        if (is_array($this->contenido) && (count($this->contenido) > 0)) {
            $a = array();
            foreach ($this->contenido as $c) {
                if ($c != '') {
                    $a[] = $c;
                }
            }
            $plantilla->contenido = implode("\n", $a);
        } elseif (is_string($this->contenido) && ($this->contenido != '')) {
            $plantilla->contenido = $this->contenido;
        } else {
            $plantilla->contenido = '';
        }
        // Procesar Javascript
        if (is_array($this->javascript) && (count($this->javascript) > 0)) {
            $a = array();
            foreach ($this->javascript as $js) {
                if ($js != '') {
                    $a[] = "  <script>$js</script>";
                }
            }
            $plantilla->javascript = implode("\n", $a);
        } elseif (is_string($this->javascript) && ($this->javascript != '')) {
            $plantilla->javascript = $this->javascript;
        } else {
            $plantilla->javascript = '  <!-- Pagina sin Javascipt adicional. -->';
        }
        // Evitar que se guarde en el cache del navegador
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // Entregar
        return $plantilla->html();
    } // html

} // Clase IngresoPaginaWeb

?>
