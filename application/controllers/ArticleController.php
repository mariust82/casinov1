<?php
require_once "BaseController.php";
require_once "application/models/dao/Articles.php";
require_once "application/models/dao/Drafts.php";

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
        // TODO: add the uploads folder to the configuration.xml
        $uploadsFolder = $articles_ctrl->getUploadsFolder($tmsArticle, 'live');

        if ($uploadsFolder) {
            $titleImageThumbnail = '/upload' . $uploadsFolder . '/' . str_replace(" ", "_", $article->title). "_thumbnail.jpg?".strtotime("now");;
            $titleImageDesktop = '/upload' . $uploadsFolder . '/' . str_replace(" ", "_", $article->title). "_image_desktop.jpg?".strtotime("now");;
            $titleImageMobile = '/upload' . $uploadsFolder . '/' . str_replace(" ", "_", $article->title). "_image_mobile.jpg?".strtotime("now");;
        } else {
            $titleImageThumbnail = null;
            $titleImageDesktop = null;
            $titleImageMobile = null;
        }

        $related_articles = $articles_ctrl->getList(['id_not_in' => [$article->id],'type'=> $category], 0, 3);
        foreach($related_articles['results'] as $item) {
            $uploadsFolders[$item->id] = "/upload". $articles_ctrl->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] .= "/" . str_replace(" ", "_", $item->title). "_thumbnail.jpg?".strtotime("now");
        }

        $this->response->attributes("article", $article);
        $this->response->attributes("tms_article", $tmsArticle);
        $this->response->attributes("related", $related_articles['results']);
        $this->response->attributes("uploadsFolders", $uploadsFolders);
        $this->response->attributes('title_image_thumbnail', $titleImageThumbnail);
        $this->response->attributes('title_image_desktop', $titleImageDesktop);
        $this->response->attributes('title_image_mobile', $titleImageMobile);
        $this->website_info['article_name'] = $article->title;
        
    }

    private function denormalize($text)
    {
        $ret = preg_replace('/[- #]/', ' ', $text);
        return $ret;
    }

    protected function pageInfo() {
         // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), str_replace('-', ' ', $this->request->getValidator()->parameters('name')), $total_casinos));
    }

}
