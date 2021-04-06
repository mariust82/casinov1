<?php
require_once "application/models/page_info/IPageInfo.php";
require_once "application/models/page_info/InterfaceInfo.php";
require_once "application/models/page_info/ArrayPageInfo.php";
require_once "application/models/page_info/Head.php";
require_once "application/models/page_info/Body.php";

class ModelPageInfo extends ArrayPageInfo implements InterfaceInfo, IPageInfo
{

    /**
     * @var Application
     */
    protected $application = null;

    /**
     * @var Request
     */
    protected $request = null;

    protected $routes = [];

    public function __construct(\Lucinda\MVC\STDOUT\Application $application, \Lucinda\MVC\STDOUT\Request $request)
    {
        parent::__construct();

        $this->request = $request;
        $this->application = $application;
        $this->init();
    }

    public function getInfo()
    {
        $info = parent::getInfo();
        $info['hinfo'] = $this->getHInfo();
        return $info;
    }

    private function init()
    {
        $this->routes = array(
            array(
                'url' => 'index',
                'title' => ':website_name - The Most Authentic and Accurate Casino Rating Site!',
                'description' => 'Browse Through the Top Rated Online Casinos by Country, Software, Payment Methods and more! Chosen by Authentic Player-Generated Votes on :website_name',
                'view_title' => 'Main page body title',
                'view_subtitle' => 'Main page body subtitle',
            ), array(
                'url' => 'other/top-10-live-dealer-online-casinos',
                'title' => 'Top 10 Live Dealer Casinos in :year - :website_name',
                'description' => 'Top 10 Live Dealer Casinos for :date | Best Online Live Casinos Ranked by Real Players, with up-to-date information and welcome bonuses.',
                'view_title' => 'Top 10 Live Dealer Casinos',
                'view_subtitle' => 'Best Live Dealer Casinos in :date'
            ), array(
                'url' => 'other/top-10-mobile-online-casinos',
                'title' => 'Top 10 Online Mobile Casinos in :year - :website_name',
                'description' => 'Top 10 Online Mobile Casinos in :year | Check out the Best Mobile-Friendly Casinos, including Android & iPhone Casino Apps and Mobile Compatible Sites.',
                'view_title' => 'Top 10 Mobile Casinos',
                'view_subtitle' => 'Best Online Mobile Casinos in :date'
            ),
            array(
                'url' => 'banking/top-10-(name)-casinos',
                'title' => 'Top 10 :software Online Casinos in :year - :website_name',
                'description' => 'Top 10 :software Online Casinos | Discover the best Casinos that accept :software deposits sorted by Top Rated. Read the casino details & player reviews',
                'view_title' => 'Top 10 :software Casinos',
                'view_subtitle' => 'Best :software Online Casinos in :date'
            ),
            array(
                'url' => 'top-10-online-casinos',
                'title' => 'Top 10 Online Casinos :year - Best Casinos Chosen by Real Players',
                'description' => 'Top 10 Online Casinos in :date! The Best Casinos sorted by Score | Detailed Reviews & Authentic Ratings by Real Casino Players - :website_name',
                'view_title' => 'Top 10 Online Casinos',
                'view_subtitle' => 'The best online casino sites in :date',
            ), array(
                'url' => 'country/top-10-(name)-online-casinos',
                'title' => 'Top 10 Online Casinos for :country Players - :website_name',
                'description' => 'Top 10 Online Casinos for :country Players in :year | All you need to know about the Top :country Casino Sites with real players\' votes & reviews',
                'view_title' => 'Top 10 :country Casinos',
                'view_subtitle' => 'Best Online Casinos for :country in :date',
            ), array(
                'url' => 'software/top-10-(name)-casinos',
                'title' => 'Top 10 :software Online Casinos in :year - :website_name',
                'description' => 'Top 10 :software Online Casinos in :year | Browse through the Best :software Casino Sites listed by :website_name according to Real Players\' Votings',
                'view_title' => 'Top 10 :software Casinos',
                'view_subtitle' => 'Best :software Online Casinos in :date',
            ), array(
                'url' => 'contact-us',
                'title' => 'Contact us - :website_name',
                'description' => 'Leave us a message at support@casinoslists.com. Contact :website_name representatives and we will be happy to get back to you shortly.',
                'view_title' => '',
                'view_subtitle' => '',
            ), array(
                'url' => 'privacy-policy',
                'title' => 'Privacy Policy - :website_name',
                'description' => 'Read our Privacy Policy to learn how we handle our visitors\' personal information for a safe online browsing experience - :website_name',
                'view_title' => '',
                'view_subtitle' => '',
            ), array(
                'url' => 'terms-and-conditions',
                'title' => 'Terms and Conditions - :website_name',
                'description' => 'By continuing to browse through and use our website, you agree to be bound by our Terms and Conditions.',
                'view_title' => '',
                'view_subtitle' => '',
            ), array(
                'url' => 'reviews/(name)-review',
                'title' => ':casino_name Review, Score & Ranking on :website_name',
                'description' => ':casino_name Review - Authentic Reviews & Rankings according to real players\' votes. Unbiased feedback on :casino_name Bonuses, Games, Banking info & more!',
                'view_title' => '',
                'view_subtitle' => '',
            ), array(
                'url' => 'warning/(name)',
                'title' => ':website_name - Warning - :casino_name Casino',
                'description' => 'Please read carfully, :casino_name is on the :website_name Warning list!',
                'view_title' => '',
                'view_subtitle' => '',
            ), array(
                'url' => 'blog',
                'title' => ':website_name Blog | Online Casino News, Guides & Fun Articles',
                'description' => ':website_name\'s Gambling Blog takes on iGaming industry subjects including Casino, Bingo & more! We bring you tips & tricks, game strategies and other unique topics.',
                'view_title' => ':website_name Blog',
                'view_subtitle' => "News, Guides & Fun Articles!",
            ), array(
                'url' => 'blog/(name)',
                'title' => ':article_name - :website_name',
                'description' => ':article_name - Read our special coverage on :website_name! Best online casino source on the Internet!',
                'view_title' => 'Articles',
                'view_subtitle' => 'Subarticles',
            ),
        );

        // @TODO: move this to a method
        $this->getHead()->setAttribute("title", $this->getAttribute('title'));
        $this->getHead()->setAttribute("description", $this->getAttribute('description'));

        $this->getBody()->setAttribute("title", $this->getAttribute('view_title'));
        $this->getBody()->setAttribute("subtitle", $this->getAttribute('view_subtitle'));
        $this->getBody()->setAttribute("description", $this->getAttribute('page_description'));
    }

    private function getAttribute($attribute_name)
    {
        $url = $this->request->getValidator()->getPage();
        $key = array_search($url, array_column($this->routes, 'url'));
        return !empty($this->routes[$key][$attribute_name]) ? $this->routes[$key][$attribute_name] : '';
    }

    private function getHInfo()
    {
        return array('info' => $this->getAttribute('view_subtitle'), 'page' => 'page');
    }
}
