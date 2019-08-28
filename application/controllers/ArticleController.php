<?php
require_once "PageController.php";
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

class ArticleController extends PageController
{

    protected $page_info = [
        'head' => [
            'title' => ':website_name - :article_name',
            'description' => 'Main page description :website_name'
        ],
        'body' => [
            'title' => '',
            'subtitle' => '',
            'description' => '',
        ]
    ];

    public function run()
    {
        $articles_ctrl = new Articles($this->application->attributes('parent_schema'));
        $article_name = $this->request->getValidator()->parameters('name');
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

        $related_articles = $articles_ctrl->getList(['id_not_in' => [$article->id]], 0, 3);
        foreach($related_articles['results'] as $item) {
            $uploadsFolders[$item->id] = "/upload". $articles_ctrl->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] .= "/" . str_replace(" ", "_", $item->title). "_thumbnail.jpg?".strtotime("now");;
        }

        $this->response->attributes("article", $article);
        $this->response->attributes("tms_article", $tmsArticle);
        $this->response->attributes("related", $related_articles['results']);
        $this->response->attributes("uploadsFolders", $uploadsFolders);
        $this->response->attributes('title_image_thumbnail', $titleImageThumbnail);
        $this->response->attributes('title_image_desktop', $titleImageDesktop);
        $this->response->attributes('title_image_mobile', $titleImageMobile);
        $this->website_info['article_name'] = $article->title;

        parent::run();
    }

    private function denormalize($text)
    {
        $ret = preg_replace('/[- #]/', ' ', $text);
        return $ret;
    }
}
