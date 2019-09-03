<?php
require_once "BaseController.php";
require_once "application/models/dao/Articles.php";
require_once "application/models/dao/Drafts.php";
require_once "application/models/ArticleUpload.php";


/*
* Single article page
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/0a58ee82-5e30-4ccc-8684-773ff1f88604/screen/0fa51af0-9cf7-43ed-be2e-2504294c4190/Single-Article
* @pathParameter name string article name
*/

class ArticleController extends BaseController
{
    protected function service()
    {
        $articles_ctrl = new Articles($this->application->attributes('parent_schema'));
        $article_name = $this->request->getValidator()->parameters('name');
        $category = $this->request->getValidator()->parameters('category');
        $article = $articles_ctrl->getInfoByName($article_name);
        $tmsArticles = $articles_ctrl->getInfoByRoute($this->denormalize($article_name));
        $tmsArticle = array_shift($tmsArticles);
        $related_articles = $articles_ctrl->getList(['id_not_in' => [$article->id],'type'=> $category], 0, 3);
        $upload = new ArticleUpload($related_articles,$article,$tmsArticle,'live');
        
        
        $this->response->attributes("article", $article);
        $this->response->attributes("tms_article", $tmsArticle);
        var_dump($tmsArticle);
        $this->response->attributes("related", $related_articles['results']);
        $this->response->attributes("uploadsFolders", $upload->getUploadsFolders());
        $this->response->attributes('title_image_thumbnail', $upload->getTitleImageThumbnail());
        $this->response->attributes('title_image_desktop', $upload->getTitleImageDesktop());
        $this->response->attributes('title_image_mobile', $upload->getTitleImageMobile());
        $this->website_info['article_name'] = $article->title;
    }

    private function denormalize($text)
    {
        $ret = preg_replace('/[- #]/', ' ', $text);
        return $ret;
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), str_replace('-', ' ', $this->request->getValidator()->parameters('name')), $total_casinos));
    }
}
