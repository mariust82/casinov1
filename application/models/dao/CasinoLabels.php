<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class CasinoLabels implements CasinoCounter
{

    private static $orderLabels = [
        'Best',
        'Live Dealer',
        'Mobile',
        'eCOGRA',
        'Stay away',
        'Popular',

    ];

    public function getCasinosCount() {

        $labels =  SQL("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM casino_labels AS t1
        INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id != 8 AND t1.id != 3 AND  t1.id != 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");



        //remove NEW casino label from all casinos page
        /*$new_casinos_nr = SQL("
          SELECT DISTINCT COUNT(t1.id) AS counter
           FROM casinos AS t1 
            WHERE t1.is_open = 1 AND t1.date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
        ")->toValue();

        $new_casinos['New'] = $new_casinos_nr;
        $array = array_merge($labels, $new_casinos);*/

        $mobile =  SQL("
        SELECT DISTINCT 
        t1.name AS unit, count(*) as counter
       
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND (t1.id = 4 OR t1.id = 2)
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");

        $array = array_merge($labels, $mobile );

        $features =  SQL("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id = 6 
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");

        $labels = array_merge($array,$features);
        $orderLabels =  $this->orderLabels($labels);

        return $orderLabels;
    }

    /*public function validate($name) {
        return SQL("SELECT name FROM casino_labels WHERE name=:name",array(":name"=>$name))->toValue();
    }*/

    private function orderLabels(array $labels){

        if(empty($labels)){
            throw new Exception('Labels should not be emtpy');
        }

        $orderedLabels = [];
        foreach(self::$orderLabels as $key => $label){

            if(isset($labels[$label]))
                $orderedLabels[$label] = $labels[$label];
        }

        return $orderedLabels;
    }
}