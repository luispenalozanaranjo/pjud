<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');



   

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...wer
     */
    $routes->connect('/', ['controller' => 'Content', 'action' => 'index', 'plugin' => 'Frontend']);
    $routes->connect('/frontend', ['controller' => 'Content', 'action' => 'index', 'plugin' => 'Frontend']);
    $routes->connect('/backend', ['controller' => 'Dashboard', 'action' => 'index', 'plugin' => 'Backend']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login', 'plugin' => false]);

    //Institucional
    //$routes->connect('/web/institucional/:action/*', ['controller' => 'Institutional', 'plugin' => 'Frontend']);

    //Tribunales del pais
    /*
    $routes->connect('/web/tribunales-del-pais/:action/*', ['controller' => 'Courts', 'plugin' => 'Frontend']);
    $routes->connect('/web/tribunales-del-pais/inicio', ['controller' => 'Courts', 'action' => 'index', 'plugin' => 'Frontend']);
    $routes->connect('/web/tribunales-del-pais/corte-suprema/permisos', ['controller' => 'Courts', 'action' => 'permisos', 'plugin' => 'Frontend']);    
    $routes->connect('/web/tribunales-del-pais/corte-suprema/causas-en-acuerdo', ['controller' => 'Courts', 'action' => 'causas_en_acuerdo', 'plugin' => 'Frontend']);    
    $routes->connect('/web/tribunales-del-pais/corte-suprema/causas-falladas', ['controller' => 'Courts', 'action' => 'causas_falladas', 'plugin' => 'Frontend']);    
    $routes->connect('/web/tribunales-del-pais/corte-suprema/visitadores', ['controller' => 'Courts', 'action' => 'visitadores', 'plugin' => 'Frontend']);    
        */

    //Transparencia
    /*
    $routes->connect('/web/transparencia/:action/*', ['controller' => 'Transparency', 'plugin' => 'Frontend']);
    $routes->connect('/web/transparencia/inicio', ['controller' => 'Transparency', 'action' => 'index', 'plugin' => 'Frontend']);
    */

    //Prensa y comunicaciones
    /*
    $routes->connect('/web/prensa-y-comunicaciones/:action/*', ['controller' => 'PressAndCommunications', 'plugin' => 'Frontend']);
    $routes->connect('/web/prensa-y-comunicaciones/inicio', ['controller' => 'PressAndCommunications', 'action' => 'index', 'plugin' => 'Frontend']);
    */
    
    //Estadisticas
    /*
    $routes->connect('/web/estadisticas/:action/*', ['controller' => 'Stadistics', 'plugin' => 'Frontend']);
    $routes->connect('/web/estadisticas/inicio', ['controller' => 'Stadistics', 'action' => 'index', 'plugin' => 'Frontend']);
    */

    //Corporación
    /*
    $routes->connect('/web/corporacion/:action/*', ['controller' => 'Corporation', 'plugin' => 'Frontend']);
    $routes->connect('/web/corporacion/inicio', ['controller' => 'Corporation', 'action' => 'index', 'plugin' => 'Frontend']);
        */
        
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /* Agregado con el nuevo menú de navegación 28-01-2020 */
    //$routes->connect('/paginas/*', ['controller' => 'Paginas', 'action' => 'index', 'plugin' => 'Frontend']);
    $routes->connect('/paginas/*', ['controller' => 'Paginas', 'action' => 'index']);
    //$routes->connect('/post/*', ['controller' => 'Post', 'action' => 'index', 'plugin' => 'Frontend']);
    $routes->connect('/post/download/*', ['controller' => 'Post', 'action' => 'download']);
    $routes->connect('/post/*', ['controller' => 'Post', 'action' => 'index']);

    //$routes->connect('/backend/front-menus/*', ['controller' => 'FrontMenus', 'action' => 'index', 'plugin' => 'Backend']);
    //$routes->connect('/institucional/base-historica-de-autos-acordados', ['controller' => 'Institucional', 'action' => 'BaseHistoricaDeAutosAcordados', 'plugin' => 'Frontend']);    
    /*
    $routes->connect('/tribunales/corte-suprema', ['controller' => 'Tribunales', 'action' => 'CorteSuprema', 'plugin' => 'Frontend']);    
    $routes->connect('/tribunales/fiscalia-judicial', ['controller' => 'Tribunales', 'action' => 'FiscaliaJudicial', 'plugin' => 'Frontend']);    
    $routes->connect('/tribunales/corte-de-apelaciones', ['controller' => 'Tribunales', 'action' => 'CorteDeApelaciones', 'plugin' => 'Frontend']);    
    $routes->connect('/tribunales/tribunales-de-primera-instancia', ['controller' => 'Tribunales', 'action' => 'TribunalesDePrimeraInstancia', 'plugin' => 'Frontend']);    
    $routes->connect('/tribunales/tribunales-militares', ['controller' => 'Tribunales', 'action' => 'TribunalesMilitares', 'plugin' => 'Frontend']);    
    $routes->connect('/tribunales/tribunales-ambientales', ['controller' => 'Tribunales', 'action' => 'TribunalesAmbientales', 'plugin' => 'Frontend']);    
    $routes->connect('/transparencia/busqueda-de-abogados', ['controller' => 'Transparencia', 'action' => 'BusquedaDeAbogados', 'plugin' => 'Frontend']);    
    $routes->connect('/transparencia/consulta-ciudadana', ['controller' => 'Transparencia', 'action' => 'ConsultaCiudadana', 'plugin' => 'Frontend']);    
    $routes->connect('/prensa-y-comunicaciones/noticias-del-poder-judicial', ['controller' => 'PrensaYComunicaciones', 'action' => 'NoticiasDelPoderJudicial', 'plugin' => 'Frontend']);    
    $routes->connect('/prensa-y-comunicaciones/agenda-del-presidente', ['controller' => 'PrensaYComunicaciones', 'action' => 'AgendaDelPresidente', 'plugin' => 'Frontend']);    
    $routes->connect('/prensa-y-comunicaciones/agenda-presidentes-cortes-de-apelaciones/*', ['controller' => 'PrensaYComunicaciones', 'action' => 'AgendaPresidentesCortesDeApelaciones', 'plugin' => 'Frontend']);    
    $routes->connect('/prensa-y-comunicaciones/discursos-del-presidente', ['controller' => 'PrensaYComunicaciones', 'action' => 'DiscursosDelPresidente', 'plugin' => 'Frontend']);    
        */
    
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */

Router::prefix('ajax', function ($routes) {
    $routes->connect('/:plugin/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);

    $routes->fallbacks('InflectedRoute');
});
