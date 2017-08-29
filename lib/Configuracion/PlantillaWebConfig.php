<?php
/**
 * Nemosintesis LaCajaBlanca - Configuracion PlantillaWebConfig
 *
 * @package LaCajaBlanca
 */

namespace Configuracion;

/**
 * Clase abstracta PlantillaWebConfig
 */
abstract class PlantillaWebConfig {

    protected $sistema              = 'La Caja Blanca';
    protected $titulo               = 'La Caja Blanca';
    protected $descripcion          = 'Registro de Consumidores';
    protected $autor                = 'DataCat';
    protected $css                  = '';
    protected $favicon              = 'imagenes/favicon.png';
    protected $modelo               = 'sbadmin2';
    protected $menu_principal_logo  = '';
    protected $modelo_ingreso_logos = array(
        array('url' => 'imagenes/generic_company.png', 'class' => 'img-responsive', 'style' => 'margin:10px;', 'pos' => 'izquierda'),
        array('url' => 'imagenes/generic_company.png', 'class' => 'img-responsive', 'style' => 'margin:10px;', 'pos' => 'derecha'));
    protected $modelo_fluido_logos  = array();
    protected $pie                  = '';

    /**
     * CSS común SIN internet
     */
    protected $css_comun            = array(
        '  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">',
        '  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">',
        '  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">',
        '  <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700" rel="stylesheet" type="text/css">',
        '  <link href="css/creative.min.css" rel="stylesheet">',
        '  <link href="css/pagina-inicial.css" rel="stylesheet">');

    /**
     * Javascript común con vínculos remotos, ideal para sistemas en internet
     */
    protected $javascript_comun     = array(
        '  <script src="vendor/jquery/jquery.min.js"></script>',
        '  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>',
        '  <script src="js/creative.min.js"></script>');

} // Clase abstracta PlantillaWebConfig

?>
