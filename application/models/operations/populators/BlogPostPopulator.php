<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 07-Jul-18
 * Time: 5:17 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/factories/PayloadPopulatorFactory.php';
require_once 'hlis/tms_server/src/dao/Routes.php';
require_once 'hlis/tms_server/src/dao/RoutePatterns.php';

use function basename;
use TMS\Route;
use TMS\RoutePatterns;
use TMS\Routes;

class BlogPostPopulator implements PopulatorInterface
{
    private $request;
    private $routes;

    public function populate(SavableInterface &$savableObject)
    {
        $route = "article/" . $this->request->parameters('search');
        $savableObject->attributes('id', $this->request->parameters('entity_id'));
        $savableObject->attributes('name', $this->request->parameters('search'));
        $savableObject->attributes('readingTime', $this->request->parameters('reading_time'));
        $savableObject->attributes('content', $this->request->parameters('content'));
        $savableObject->attributes('thumbnail', !empty($_FILES['thumbnail']['name']) ? $_FILES['thumbnail']['name'] : basename($_POST['current_thumbnail']));
        $savableObject->attributes('titleImageDesktop', !empty($_FILES['image_desktop']['name']) ? $_FILES['image_desktop']['name'] : basename($_POST['current_image_desktop']));
        $savableObject->attributes('titleImageMobile', !empty($_FILES['image_mobile']['name']) ? $_FILES['image_mobile']['name'] : basename($_POST['current_image_mobile']));
        $savableObject->attributes('postDate', date('Y-m-d H:i:s'));
        $savableObject->attributes('route_id', $this->getRouteId($route));
    }

    public function __construct(\Lucinda\MVC\STDOUT\Request $request)
    {
        $this->request = $request;
        $this->routes = new Routes();
    }

    private function getRouteId($route)
    {
        $routeId = null;
        $routePatterns = new RoutePatterns();
        $routes = new Routes();

        $routePatternInfo = $routePatterns->getInfo($route);
        $routeInfo = $routes->getInfo($route);

        if (!$routeInfo) {
            // add route
            $routeId = $this->addRoute($route, $routePatternInfo->id);
        } else {
            $routeId = $routeInfo->id;
        }

        return $routeId;
    }

    private function addRoute($route, $routePatternId)
    {
        // TODO: this is not this object's business to add a route.
        $newRoute = new Route();

        $newRoute->value = $route;
        $newRoute->pattern = $routePatternId;
        return $this->routes->add($newRoute);
    }
}
