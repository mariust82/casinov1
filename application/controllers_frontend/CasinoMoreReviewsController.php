<?php
class CasinoMoreReviewsController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
            'id' => '34',
            'code' => 'US',
            'name' => 'United States',
        ));
        $this->response->setAttribute("reviews", array (
            0 =>
                array (
                    'id' => '1',
                    'name' => 'Tester',
                    'email' => 'a@a.com',
                    'body' => 'I\'m testing this functionality!',
                    'likes' => '6',
                    'ip' => NULL,
                    'country' => 'United States',
                    'rating' => 7,
                    'date' => '2018-01-26 12:35:52',
                    'parent' => NULL,
                    'children' =>
                        array (
                            0 =>
                                array (
                                    'id' => '8',
                                    'name' => 'Tester',
                                    'email' => 'a@a.com',
                                    'body' => 'I\'m testing this functionality!',
                                    'likes' => '0',
                                    'ip' => NULL,
                                    'country' => 'United States',
                                    'rating' => 6,
                                    'date' => '2018-01-26 12:36:41',
                                    'parent' => NULL,
                                    'children' =>
                                        array (
                                        ),
                                    'total_children' => 0,
                                ),
                            1 =>
                                array (
                                    'id' => '7',
                                    'name' => 'Tester',
                                    'email' => 'a@a.com',
                                    'body' => 'I\'m testing this functionality!',
                                    'likes' => '0',
                                    'ip' => NULL,
                                    'country' => 'United States',
                                    'rating' => 6,
                                    'date' => '2018-01-26 12:36:40',
                                    'parent' => NULL,
                                    'children' =>
                                        array (
                                        ),
                                    'total_children' => 0,
                                ),
                        ),
                    'total_children' => '2',
                ),
        ));

    }
}
