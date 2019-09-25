<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 10:30 AM
 */

require_once 'application/models/page_info/ArrayPageInfo.php';
require_once 'application/models/page_info/InterfaceInfo.php';
require_once 'application/models/page_info/Head.php';
require_once 'application/models/page_info/Body.php';
require_once 'application/models/page_info/IPageInfo.php';

class ArrayPageInfo implements InterfaceInfo, IPageInfo
{
    protected $head = null;
    protected $body = null;

    public function __construct()
    {
        $this->head = new Head();
        $this->body = new Body();
    }

    /**
     * @return Head|null
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @return Body|null
     */
    public function getBody()
    {
        return $this->body;
    }

    public function getInfo()
    {
        return [
            'head' => [
                'title' => $this->getHead()->getAttribute('title'),
                'description' => $this->getHead()->getAttribute('description')
            ],
            'body' => [
                'title' => $this->getBody()->getAttribute('title'),
                'subtitle' => $this->getBody()->getAttribute('subtitle'),
                'description' => $this->getBody()->getAttribute('description'),
            ]
        ];
    }
}
