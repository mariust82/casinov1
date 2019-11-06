<?php
require_once "BaseController.php";
require_once "application/models/dao/Articles.php";
require_once "application/models/dao/Drafts.php";
require_once "application/models/SingleArticle.php";


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
        $articles = new Articles($this->application->attributes('parent_schema'));
        $article_name = $this->request->getValidator()->parameters('name');
        $category = $this->request->getValidator()->parameters('category');
        $results = $articles->getList(['name'=>$article_name],0,1);
        $article = $results["results"][0];
        $related_articles = $articles->getList(['id_not_in' => [$article->id],'type'=> $category], 0, 3);
        $tags = $articles->getArticleTags($article->id);
        $singleArticle = new SingleArticle($results);
        
        $this->response->attributes("article", $article);
        $this->response->attributes("tags", $tags);
        $this->response->attributes("tms_article", $articles->getInfoByRoute($singleArticle->denormalize($article_name)));
        $this->response->attributes("related", $related_articles['results']);
        $this->response->attributes("uploadsFolders", $singleArticle->getUploadsFolders($results));
        $this->response->attributes("relateduploadsFolders", $singleArticle->getUploadsFolders($related_articles));
        $this->response->attributes('title_image_thumbnail', $singleArticle->getTitleImageThumbnail());
        $this->response->attributes('title_image_desktop', $singleArticle->getTitleImageDesktop());
        $this->response->attributes('title_image_mobile', $singleArticle->getTitleImageMobile());
        $this->website_info['article_name'] = $article->title;
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("article")->title, $total_casinos));
    }
}
