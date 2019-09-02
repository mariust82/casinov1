<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 11:43 AM
 */

class JsonPageInfo implements IPageInfo, InterfaceInfo
{
    /**
     * @var Head
     */
    protected $head = null;

    /**
     * @var Body
     */
    protected $body = null;

    public function __construct()
    {
        $this->head = new Head();
        $this->body = new Body();
    }

    public function getHead()
    {
        return $this->head;
    }

    public function getBody()
    {
        return $this->head;
    }

    public function getInfo()
    {
        return json_encode([
            'head' => [
                'title' => $this->getHead()->getAttribute('title'),
                'description' => $this->getHead()->getAttribute('description')
            ],
            'body' => [
                'title' => $this->getBody()->getAttribute('title'),
                'subtitle' => $this->getBody()->getAttribute('subtitle'),
                'description' => $this->getBody()->getAttribute('description'),
            ]
        ]);
    }
}
