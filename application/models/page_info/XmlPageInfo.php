<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/8/2018
 * Time: 4:08 PM
 */

require_once "application/models/page_info/IPageInfo.php";
require_once "application/models/page_info/InterfaceInfo.php";
require_once "application/models/page_info/ArrayPageInfo.php";
require_once "application/models/page_info/Head.php";
require_once "application/models/page_info/Body.php";

class XmlPageInfo extends ArrayPageInfo implements InterfaceInfo, IPageInfo
{
    /**
     * @var Head
     */
    protected $head = null;

    /**
     * @var Body
     */
    protected $body = null;

    public function __construct(\Lucinda\MVC\STDOUT\Application $application, \Lucinda\MVC\STDOUT\Request $request)
    {
        $this->head = new Head();
        $this->body = new Body();

        $url = $request->getValidator()->getPage();
        $pt = $application->getTag("routes")->xpath("//routes/route[@url='{$url}']");

        $this->getHead()->setAttribute("title", (string)$pt[0]['page_title']);
        $this->getHead()->setAttribute("description", (string)$pt[0]['page_description']);

        $this->getBody()->setAttribute('title', (string)$pt[0]['view_title']);
        $this->getBody()->setAttribute('subtitle', (string)$pt[0]['view_subtitle']);
    }


    /**
     * @return Head
     */
    public function getHead()
    {
        // TODO: Implement getHead() method.
        return $this->head;
    }

    /**
     * @return Body
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
        return $this->body;
    }
}
