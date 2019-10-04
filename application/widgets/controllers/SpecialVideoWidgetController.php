<?php
namespace CMS\Widgets;

require_once("hlis/cms/src/widgets/controllers/VideoController.php");

class SpecialVideoWidgetController extends Controller
{
    protected function compile()
    {
        if (empty($this->widgetParameters["url"])) {
            throw new \CMS\Exception("Parameter is mandatory: ".$this->parameters["url"]);
        }
        $url = str_replace("youtu.be", "youtube.com/embed", trim(strip_tags($this->widgetParameters["url"])));
        return '<iframe width="500" height="300" src="'.$url.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}