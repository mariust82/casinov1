<?php
require_once 'application/models/dao/ListsSearch.php';

class SearchSuggestionsController extends Lucinda\MVC\STDOUT\Controller{
    public function run(){
        $this->response->attributes("suggestions", (new ListsSearch())->getSearchSuggestions());

    }
}