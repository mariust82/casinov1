<?php
class CasinoScore
{
    public function __construct()
    {
        $scores = [
            'Excellent' => [
                'min' => 9,
                'max' => 10
            ],
            'Very good' => [
                'min' => 7,
                'max' => 8
            ],
            'Good' => [
                'min' => 5,
                'max' => 6
            ],
            'Poor' => [
                'min' => 3,
                'max' => 4
            ],
            'Terrible' => [
                'min' => 1,
                'max' => 2
            ]];
    }

    public function setVotesByType($votes_array){
        $output = ['Excellent' => 0, 'Very good' => 0, 'Good' => 0, 'Poor' => 0, 'Terrible' => 0];
        $scores = [
            'Excellent' => [
                'min' => 9,
                'max' => 10
            ],
            'Very good' => [
                'min' => 7,
                'max' => 8
            ],
            'Good' => [
                'min' => 5,
                'max' => 6
            ],
            'Poor' => [
                'min' => 3,
                'max' => 4
            ],
            'Terrible' => [
                'min' => 1,
                'max' => 2
            ]
        ];

        while($row = $votes_array->toRow()){
            foreach ($scores as $type => $scoreArr) {
                if ($row['value'] >= $scoreArr['min'] && $row['value'] <= $scoreArr['max']) {
                    $output[$type]++;
                }
            }
        }

        return $output;
    }
}