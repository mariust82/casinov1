<?php

Class InvisionAppEndPoints{


    const DEV_CASINOLIST_BLOG_ID = 1;
    const API_KEY = 'e0aff7134b11f730418086ea2a5daf1b';
    const API_URL = 'https://c284076.tryinvision.com/';


    public static $endpoints = [

      /*  'mesages' => [
            'add' => 'api/core/messages',
            'reply' => 'api/core/messages/{$id}',
            'delete' => 'api/core/messages/{id}'
        ],*/

        'blog' => [
            'get_all_blogs' => [
                'url' => 'api/blog/blogs',
                'verb' => 'GET'

            ],
            'get_blog_entryies' => 'api/blog/entries',
             'get_comments' => 'api/blog/entries/{casinoId}/comments',
        ],

        'entries' => [
            'add_entry' => [
                'url' => 'api/blog/entries',
                'verb' => 'POST'
            ],
            'get_entry' => [
               'url' => 'api/blog/entries/{#id}',
                'verb' => 'GET'
                ],

            'get_entry_comments' => [
                'url' => 'api/blog/entries/{#id}/comments',
                'verb' => 'GET'
            ],

            'comments' => [
                'add_comment' => [
                    'url' => 'api/blog/comments',
                    'verb' => 'POST'
                ]
            ]
        ],
    ];

}