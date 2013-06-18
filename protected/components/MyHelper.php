<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author Maks
 */
class MyHelper {

    public static function getRusMonth($month) {
        if ($month > 12 || $month < 1)
            return FALSE;
        $aMonth = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        return $aMonth[$month - 1];
    }

    public static function getRusMonth2($month) {
        if ($month > 12 || $month < 1)
            return FALSE;
        $aMonth = array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
        return $aMonth[$month - 1];
    }

    public static function getNumEnding($number, $endingArray) {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1): $ending = $endingArray[0];
                    break;
                case (2):
                case (3):
                case (4): $ending = $endingArray[1];
                    break;
                default: $ending = $endingArray[2];
            }
        }
        return $ending;
    }

    public static function PrepearGraf($predmas = array(), $polka, $group_name) {
        $co = '0';
        $j = 1;
        for ($i = 0; $i <= 9; $i++) {
            $mib = $j;
            if ($co == '0') {
                $co = '1';
                if ($i != 0) {
                    $j++;
                    $mib = $j;
                }
            } else {
                $co = '0';
                $mib = '';
            }
            if (isset($polka[$i])) {
                $predmas[$i]['point'] = $mib;
                $predmas[$i]['группа' . $group_name] = $polka[$i];
            }
        }


        return $predmas;
    }

    public static function render($el, $url, $data, $title) {
        if (isset($_POST['async'])) {
            echo json_encode(array('status' => 'success', 'data' => $el->renderPartial($url, $data, true), 'title' => $title));
        } else {
            $el->pageTitle = $title;
            $el->render($url, $data);
        }
    }

}

?>
