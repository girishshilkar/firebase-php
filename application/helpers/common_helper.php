<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/11/2018
 * Time: 5:38 PM
 */

function postCURL($_url, $_param, $_type)
{
    $postData = '';
    //create name value pairs seperated by &
    foreach($_param as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }
    rtrim($postData, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
//    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output=curl_exec($ch);

    curl_close($ch);

    return json_decode($output);
}

//epoch to standard time

function get_date($epoch)
{
    return date("Y-m-d", substr($epoch, 0, 10));
}

function get_date_time($epoch)
{
    return date("Y-m-d H:i:s", substr($epoch, 0, 10));
}