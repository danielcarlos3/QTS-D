<?php


namespace Controller;


class Common
{
    public static function redir($url)
    {
        header('Location: ' . URL_BASE . $url);
    }

}