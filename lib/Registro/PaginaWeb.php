<?php
/**
 * Nemosintesis LaCajaBlanca - Registro PaginaWeb
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase PaginaWeb
 */
class PaginaWeb extends \Configuracion\PlantillaWebConfig {

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
    public $clave;                // Clave única de la página
    public $contenido  = array(); // Arreglo o texto con el contenido HTML
    public $javascript = array(); // Arreglo o texto con el código Javascript

    /**
     * HTML
     *
     * @return string HTML con la pagina web
     */
    public function html() {
        // Definir plantilla
        $tema_web = new TemaWebRegistro();
        $tema_web->sistema             = $this->sistema;
        $tema_web->titulo              = $this->titulo;
        $tema_web->descripcion         = $this->descripcion;
        $tema_web->autor               = $this->autor;
        $tema_web->css                 = $this->css;
        $tema_web->css_comun           = $this->css_comun;
        $tema_web->favicon             = $this->favicon;
        $tema_web->menu_principal_logo = $this->menu_principal_logo;
        $tema_web->javascript_comun    = $this->javascript_comun;
        $tema_web->pie                 = $this->pie;
        // Procesar contenido
        if (is_array($this->contenido) && (count($this->contenido) > 0)) {
            $a = array();
            foreach ($this->contenido as $c) {
                if ($c != '') {
                    $a[] = $c;
                }
            }
            $tema_web->contenido = implode("\n", $a);
        } elseif (is_string($this->contenido) && ($this->contenido != '')) {
            $tema_web->contenido = $this->contenido;
        } else {
            $tema_web->contenido = "  <b>Pagina sin contenido.</b>";
        }
        // Procesar javascript
        if (is_array($this->javascript) && (count($this->javascript) > 0)) {
            $a = array();
            foreach ($this->javascript as $js) {
                if (is_string($js) && !empty(trim($js))) {
                    $a[] = "  <script>\n$js\n</script>";
                }
            }
            $tema_web->javascript = implode("\n", $a);
        } elseif (is_string($this->javascript) && ($this->javascript != '')) {
            $tema_web->javascript = $this->javascript;
        } else {
            $tema_web->javascript = '  <!-- Pagina sin Javascipt adicional. -->';
        }
        // Evitar que se guarde en el cache del navegador
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // Entregar
        return $tema_web->html();
    } // html

} // Clase PaginaWeb

?>
