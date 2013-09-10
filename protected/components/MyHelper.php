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
class MyHelper
{

    public static function getRusMonth($month)
    {
        if ($month > 12 || $month < 1)
            return FALSE;
        $aMonth = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        return $aMonth[$month - 1];
    }

    public static function getRusMonth2($month)
    {
        if ($month > 12 || $month < 1)
            return FALSE;
        $aMonth = array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
        return $aMonth[$month - 1];
    }

    public static function getNumEnding($number, $endingArray)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1):
                    $ending = $endingArray[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $endingArray[1];
                    break;
                default:
                    $ending = $endingArray[2];
            }
        }
        return $ending;
    }

    public static function PrepearGraf($predmas = array(), $polka, $group_name)
    {
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

    public static function render($el, $url, $data, $title)
    {
        if (isset($_POST['async'])) {

            echo '<div id="page_title">' . $title . '</div>';

            echo $el->renderPartial($url, $data, true, false);
            //, 'title' => $title;
        } else {
            $el->pageTitle = $title;
            $el->render($url, $data);
        }
    }

    public static function getUsername($user_id = FALSE, $shot = FALSE, $model = false, $profile = false)
    {
        if ($model == FALSE) {
            if ($user_id === FALSE) {
                if (Yii::app()->user->isGuest) {
                    return 'авторизуйтесь';
                }
                $user_id = Yii::app()->user->id;
            }

            $model = User::model()->findByPk($user_id);
            $model = $model->prof;

            if (empty($model)) {
                return 'Нет такого пользователя';
            }
        } else {
            if (!$profile)
                $model = $model->prof;
        }


        switch ($model->status) {
            case Profile::PREPOD:
                if ($shot) {
                    if (isset($model->patronymic) && $model->patronymic != '') {
                        $username = $model->surname . ' ' . mb_substr($model->name, 0, 1, 'UTF-8') . '. ' . mb_substr($model->patronymic, 0, 1, 'UTF-8') . '. ';
                    } else {
                        $username = $model->surname . ' ' . $model->name;
                    }
                } else {
                    if (isset($model->patronymic) && $model->patronymic != '') {
                        $username = $model->surname . ' ' . $model->name . ' ' . $model->patronymic;
                    } else {
                        $username = $model->surname . ' ' . $model->name;
                    }
                }
                break;
            case Profile::STUDENT:
                $username = $model->name . ' ' . $model->surname;
                break;
            default:
                $username = 'ошибка';
                break;
        }


        return $username;
    }

    public static function makeClickableLinks($text)
    {

        $reg_exUrl = "/(?<!href=\")(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/[a-zA-Z0-9\-\/]*)?/";
        preg_match_all($reg_exUrl, $text, $matches);
        $usedPatterns = array();
        foreach ($matches[0] as $pattern) {
            if (!array_key_exists($pattern, $usedPatterns)) {
                $usedPatterns[$pattern] = true;
                $text = str_replace($pattern, '<a href="' . $pattern . '" class="classic">' . $pattern . '</a>', $text);
            }
        }


        return $text;
    }

    public static function linkFaker($profile, $link_name = FALSE)
    {

        if ($profile->fake == 2) {
            $url = '/user/ViewFake/';
        } else {
            $url = '/user/ViewProfile/';
        }

        if (!$link_name)
            $link_name = self::getUsername(FALSE, FALSE, $profile, TRUE);


        return CHtml::link($link_name, Yii::app()->urlManager->createUrl($url, array('id' => $profile->id)), array('class' => 'classic', 'async' => 'async'));
    }

    public static function forumTag($forum_id)
    {
        $tags = ForumTag::model()->findAllByAttributes(array('forum_id' => $forum_id));
        return $tags;
    }

}

?>
