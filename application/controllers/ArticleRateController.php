<?php
require_once("application/models/DB.php");
require_once("application/models/ArticleRatingPost.php");
require_once("application/models/dao/Articles.php");
/*
* Ajax called to register a rating per article
* 
* @requestMethod POST
* @responseFormat JSON
* @source https://xd.adobe.com/view/0a58ee82-5e30-4ccc-8684-773ff1f88604/screen/0fa51af0-9cf7-43ed-be2e-2504294c4190/Single-Article
* @requestParameter id integer Article ID
* @requestParameter success boolean Like or dislike
*/

class ArticleRateController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $rating_ctrl = new ArticleRatingPost();
        if (!$rating_ctrl->post()) {
            var_dump($rating_ctrl->getErrors());
            throw new UserPostException(json_encode($rating_ctrl->getErrors()));
        }
        $ctrl = new Articles($this->application->attributes('parent_schema'));
         
        $item = $ctrl->getItemFromId($_POST['id']);
     
        $this->response->attributes('likes', $item->rating->likes);
        $this->response->attributes('dislikes', $item->rating->dislikes);
    }
}
