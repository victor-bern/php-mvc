<?php


function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
      
    }
}

function url(string $path = null)
{
    if ($path) {
        return CONF_BASE_URL . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_BASE_URL;
}

function theme(string $path = null)
{
    if ($path) {
        return CONF_BASE_URL . "/" . CONF_BASE_THEME_ASSETS . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_BASE_URL . CONF_BASE_THEME_ASSETS;

}

function storage(string $path = null)
{
    if ($path) {
        return CONF_BASE_URL . "/" . CONF_UPLOAD_DIR . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_BASE_URL . "/" . CONF_UPLOAD_DIR;

}
