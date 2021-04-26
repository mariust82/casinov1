<?php

class CasinoHelper
{

    public function formatDate($date)
    {
        if ($date != NULL) {
            $date_arr = explode('-', $date);
            $month_name = date('M', strtotime($date));
            return $month_name.' '.$date_arr[2].', '.$date_arr[0];
        } return "None";
    }

    public function getCasinoLogo($name, $resolution)
    {
        $logoDirPath = "/public/sync/casino_logo_light/".$resolution;
        $logoFile = strtolower(str_replace(" ", "_", $name)).".png";
        $logo = $logoDirPath.'/'.$logoFile;

        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$logo)) {
            $logo =$logoDirPath."/no-logo-{$resolution}.png";
        }
        return $logo;
    }

    public function isCasinoNew($date)
    {
        $date_old = new DateTime($date);
        $today = new DateTime(date('Y-m-d'));

        if ($today->getTimestamp()-$date_old->getTimestamp()<=31536000) {
            return true;
        } else {
            return false;
        }
    }

    public function getScoreClass($score)
    {
        if (!$score || $score < 1) {
            return 'No score';
        } elseif ($score >= 1 && $score < 5) {
            return 'Poor';
        } elseif ($score >= 5 && $score < 8) {
            return 'Good';
        } elseif ($score >= 8) {
            return 'Excellent';
        }
        return '';
    }

    public function get_string($items)
    {
        array_shift($items);

        return implode(", ", $items);
    }

    public function getAbbreviation($name)
    {
        $words = explode(" ", $name);
        $abbr = "";

        foreach ($words as $word) {
            $abbr .= $word[0];
        }
        return $abbr;
    }

    public function checkForAbbr($amount) {
        if (strpos($amount, 'FS') !== false) {
            return str_replace("FS",'<abbr title="Free Spins"> FS',$amount);
        }
        if (strpos($amount, 'NDB') !== false) {
            return str_replace("NDB",'<abbr title="No Deposit Bonus"> NDB',$amount);
        }
        if (strpos($amount, 'CB') !== false) {
            return str_replace("CB",'<abbr title="Cashback "> CB',$amount);
        }
        if (strpos($amount, 'FDB') !== false) {
            return str_replace("FDB",'<abbr title="First Deposit Bonus"> FDB',$amount);
        }
        return $amount;
    }

}