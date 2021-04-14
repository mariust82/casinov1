<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 10-Jul-18
 * Time: 5:48 PM
 */

namespace gtm\operations;

use function array_shift;
use TMS\Exception;

use TMS\Content;
use TMS\Contents;
use TMS\Route;
use TMS\RoutePatterns;
use TMS\Routes;

require_once 'application/models/operations/interfaces/OperationsInterface.php';
require_once 'hlis/tms_server/src/dao/RoutePatterns.php';
require_once 'hlis/tms_server/src/dao/Contents.php';
require_once 'application/models/dao/TmsContent.php';

class TmsOperation implements OperationsInterface
{

    /**
     * @var SavableInterface
     */
    private $savableObject;
    private $contents;
    private $routes;

    public function __construct()
    {
        $this->contents = new Contents();
        $this->routes = new Routes();
    }

    public function execute()
    {
        $routePatterns = new RoutePatterns();
        $routes = new Routes();
        $contents = new Contents();

        $payload = $this->savableObject->attributes('payload');
        $route = "article/{$payload->name}";

        $routePatternInfo = $routePatterns->getInfo($route);

        if (empty($routePatternInfo->positions)) {
            throw new Exception('No route pattern positions found.');
        }

        $routeInfo = $routes->getInfo($route);

        if (!$routeInfo) {
            // add route
            $routeId = $this->addRoute($route, $routePatternInfo->id);
        } else {
            $routeId = $routeInfo->id;
        }

        $content = $this->getContent($routeId);

        if (!$content) {
            $this->addContent($payload, $routeId, $routePatternInfo->positions[0]->id);
        } else {
            $this->editContent($content);
        }
    }

    public function addObject(SavableInterface $savableObject)
    {
        $this->savableObject = $savableObject;
    }

    public function getObject()
    {
        return $this->savableObject;
    }

    /**
     * @param $route
     * @param $routePatternId
     * @return mixed
     */
    private function addRoute($route, $routePatternId)
    {
        $newRoute = new Route();

        $newRoute->value = $route;
        $newRoute->pattern = $routePatternId;
        return $this->routes->add($newRoute);
    }

    /**
     * @param $contents
     * @param $routeId
     * @return mixed
     */
    private function getContent($routeId)
    {
        $content = $this->contents->getAll($routeId);
        if ($content) {
            $content = array_shift($content);
        }

        return $content;
    }

    /**
     * @param $payload
     * @param $routeId
     * @param $routePatternInfo
     * @param $contents
     */
    private function addContent($payload, $routeId, $positionId)
    {
        $newContent = new Content();
        $newContent->id = null;
        $newContent->value = $payload->content;
        $newContent->route = $routeId;
        $newContent->user = 2;
        $newContent->position = $positionId;
        $this->contents->add($newContent);
    }

    /**
     * @param $content
     * @param $contents
     */
    private function editContent($content)
    {
        $newContent = new Content();
        $newContent->id = $content->id;
        $newContent->value = $_POST['content'];
        $newContent->route = $content->route;
        $newContent->position = $content->position;
        $newContent->user = $content->user->id;
        $this->contents->edit($newContent);
    }
}
