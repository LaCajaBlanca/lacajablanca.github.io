<?php
/**
 * Nemosintesis LaCajaBlanca - Registro TemaWebRegistro
 *
 * @package LaCajaBlanca
 */

namespace Registro;

/**
 * Clase TemaWebRegistro
 */
class TemaWebRegistro extends \Base2\TemaWeb {

    // public $sistema;
    // public $titulo;
    // public $descripcion;
    // public $autor;
    // public $css;
    // public $css_comun;
    // public $favicon;
    // public $menu_principal_logo;
    // public $icono;
    // public $contenido;
    // public $javascript;
    // public $javascript_comun;
    // public $pie;
    // public $menu;

    /**
     * Constructor
     */
    public function __construct() {
        $this->css = '  <link href="css/pagina-inicial.css" rel="stylesheet" type="text/css">';
    } // constructor

    /**
     * Cabecera HTML
     *
     * @return string Código HTML
     */
    protected function cabecera_html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        // Acumular
        $a[] = '<head>';
        $a[] = '  <meta charset="utf-8">';
        $a[] = '  <meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $a[] = '  <meta name="viewport" content="width=device-width, initial-scale=1">';
        if (is_string($this->descripcion) && ($this->descripcion != '')) {
            $a[] = sprintf('  <meta name="description" content="%s">', $this->descripcion);
        }
        if (is_string($this->autor) && ($this->autor != '')) {
            $a[] = sprintf('  <meta name="author" content="%s">', $this->autor);
        }
        if (is_string($this->titulo) && ($this->titulo != '')) {
            $a[] = sprintf('  <title>%s</title>', $this->titulo);
        }
        // Acumular CSS común definido en /Configuracion/PlantillaWebConfig
        if (is_array($this->css_comun) && (count($this->css_comun) > 0)) {
            $a[] = implode("\n", $this->css_comun);
        }
        // Acumular CSS de esta página
        if (is_string($this->css) && ($this->css != '')) {
            $a[] = $this->css;
        }
        // Compatibilidad con IE9
        $a[] = '  <!--[if lt IE 9]>';
        $a[] = '    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>';
        $a[] = '    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>';
        $a[] = '  <![endif]-->';
        $a[] = '</head>';
        // Entregar
        return implode("\n", $a);
    } // cabecera_html

    /**
     * Navegación HTML
     *
     * @return string Código HTML
     */
    protected function navegacion_html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        //
        $a[] = '  <!-- Navegacion inicia -->';
        $a[] = '    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">';
        $a[] = '      <div class="container-fluid">';
        $a[] = '        <div class="navbar-header">';
        $a[] = '          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">';
        $a[] = '            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>';
        $a[] = '          </button>';
        $a[] = '          <a class="navbar-brand page-scroll" href="#page-top">La Caja Blanca</a>';
        $a[] = '        </div>';
        $a[] = '        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
        $a[] = '          <ul class="nav navbar-nav navbar-right">';
        $a[] = '            <li>';
        $a[] = '              <a class="page-scroll" href="#services">¿Cómo funciona?</a>';
        $a[] = '            </li>';
        $a[] = '            <li>';
        $a[] = '              <a class="page-scroll" href="registro.php">Registro</a>';
        $a[] = '            </li>';
        $a[] = '          </ul>';
        $a[] = '        </div>';
        $a[] = '      </div>';
        $a[] = '    </nav>';
        $a[] = '  <!-- Navegacion termina -->';
        // Entregar
        return implode("\n", $a);
    } // navegacion_html

    /**
     * Encabezado HTML
     *
     * @return string Código HTML
     */
    protected function encabezado_html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        //
        $a[] = '  <!-- Cabecera inicia -->';
        $a[] = '    <header>';
        $a[] = '      <div class="header-content">';
        $a[] = '        <div class="header-content-inner">';
        $a[] = '          <h1 id="homeHeading">La Caja Blanca</h1>';
        $a[] = '          <hr>';
        $a[] = '          <p>Les hace llegar a los recién casados -sin costo- y a las puertas de su hogar, productos selectos de excelente calidad para ayudarles a iniciar la nueva etapa de sus vidas juntos.</p>';
        $a[] = '          <a href="#services" class="btn btn-primary btn-xl page-scroll">¿Cómo funciona?</a>';
        $a[] = '        </div>';
        $a[] = '      </div>';
        $a[] = '    </header>';
        $a[] = '  <!-- Cabecera termina -->';
        // Entregar
        return implode("\n", $a);
    } // encabezado_html

    /**
     * Contenido HTML
     *
     * @return string Código HTML
     */
    protected function contenido_html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        //
        $a[] = '  <!-- Contenido inicia -->';
        $a[] = '    <section id="contenido" class="fondo-gris1">';
        $a[] = '      <div class="container">';
    //~ $a[] = '        <div class="row">';
    //~ $a[] = '          <div class="col-lg-12">';
        $a[] = $this->contenido;
    //~ $a[] = '          </div>';
    //~ $a[] = '        </div>';
        $a[] = '      </div>';
        $a[] = '    </section>';
        $a[] = '  <!-- Contenido termina -->';
        // Entregar
        return implode("\n", $a);
    } // contenido_html

    /**
     * Final HTML
     *
     * @return string Código HTML
     */
    protected function final_html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        //
        $a[] = '  <!-- Pie inicia -->';
        $a[] = '  <section id="contact" class="fondo-plata">';
        $a[] = '    <div class="container">';
        $a[] = '      <div class="row">';
        $a[] = '        <div class="col-lg-8 col-lg-offset-2 text-center">';
        $a[] = '          <h2 class="section-heading">Registro</h2>';
        $a[] = '          <hr class="primary">';
        $a[] = '          <p>Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>';
        $a[] = '        </div>';
        $a[] = '        <div class="col-lg-4 col-lg-offset-2 text-center">';
        $a[] = '          <i class="fa fa-phone fa-3x sr-contact"></i>';
        $a[] = '          <p>123-456-6789</p>';
        $a[] = '        </div>';
        $a[] = '        <div class="col-lg-4 text-center">';
        $a[] = '          <i class="fa fa-envelope-o fa-3x sr-contact"></i>';
        $a[] = '          <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>';
        $a[] = '        </div>';
        $a[] = '      </div>';
        $a[] = '    </div>';
        $a[] = '  </section>';
        $a[] = '  <!-- Pie termina -->';
        // Acumular pie
        if (is_string($this->pie) && ($this->pie != '')) {
            $a[] = "  <footer>{$this->pie}</footer>";
        }
        // Acumular Javascript común definido en /Configuracion/PlantillaWebConfig
        if (is_array($this->javascript_comun) && (count($this->javascript_comun) > 0)) {
            $a[] = implode("\n", $this->javascript_comun);
        }
        // Acumular Javascript de esta página
        if (is_string($this->javascript) && ($this->javascript != '')) {
            $a[] = '  <script>';
            $a[] = $this->javascript;
            $a[] = '  </script>';
        }
        // Entregar
        return implode("\n", $a);
    } // final_html

    /**
     * HTML
     *
     * @return string Código HTML
     */
    public function html() {
        // En este arreglo acumularemos la entrega
        $a = array();
        // Acumular
        $a[] = '<!DOCTYPE html>';
        $a[] = '<html lang="en">';
        $a[] = $this->cabecera_html();
        $a[] = '<!-- TemaWebRegistro -->';
        $a[] = '<body id="page-top">';
        $a[] = $this->navegacion_html();
    //~ $a[] = $this->encabezado_html();
        $a[] = $this->contenido_html();
        $a[] = $this->final_html();
        $a[] = '</body>';
        $a[] = '</html>';
        // Entregar
        return implode("\n", $a)."\n";
    } // html

} // Clase TemaWebRegistro

?>
