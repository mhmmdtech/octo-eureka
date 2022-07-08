<?php

function dd($value, $die = true)
{
    var_dump($value);
    if ($die)
        exit();
}

function view($dir, $vars = [])
{
    $viewBuilder = new \System\View\ViewBuilder();
    $viewBuilder->run($dir);
    $viewVars = $viewBuilder->vars;
    $content = $viewBuilder->content;
    empty($viewVars) ?: extract($viewVars);
    empty($vars) ?: extract($vars);

    eval(" ?> " . html_entity_decode($content));
}

function html($text)
{
    return html_entity_decode($text);
}

function old($name)
{
    if (isset($_SESSION["temporary_old"][$name])) {
        return $_SESSION["temporary_old"][$name];
    } else {
        return null;
    }
}

function flash($name, $message = null)
{
    if (empty($message)) {
        if (isset($_SESSION["temporary_flash"][$name])) {
            $temporary = $_SESSION["temporary_flash"][$name];
            unset($_SESSION["temporary_flash"][$name]);
            return $temporary;
        } else {
            return false;
        }
    } else {
        $_SESSION["flash"][$name] = $message;
    }
}

function flashExists($name)
{
    return isset($_SESSION["temporary_flash"][$name]) === true ? true : false;
}

function allFlashes()
{
    if (isset($_SESSION["temporary_flash"])) {
        $temporary = $_SESSION["temporary_flash"];
        unset($_SESSION["temporary_flash"]);
        return $temporary;
    } else {
        return false;
    }
}


function error($name, $message = null)
{
    if (empty($message)) {
        if (isset($_SESSION["temporary_errorFlash"][$name])) {
            $temporary = $_SESSION["temporary_errorFlash"][$name];
            unset($_SESSION["temporary_errorFlash"][$name]);
            return $temporary;
        } else {
            return false;
        }
    } else {
        $_SESSION["errorFlash"][$name] = $message;
    }
}

function errorExists($name = null)
{
    if ($name === null) {
        return isset($_SESSION['temporary_errorFlash']) === true ? count($_SESSION['temporary_errorFlash']) : false;
    } else {
        return isset($_SESSION['temporary_errorFlash'][$name]) === true ? true : false;
    }
}

function allErrors()
{
    if (isset($_SESSION["temporary_errorFlash"])) {
        $temporary = $_SESSION["temporary_errorFlash"];
        unset($_SESSION["temporary_errorFlash"]);
        return $temporary;
    } else {
        return false;
    }
}


function currentDomain()
{
    $httpProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? "https://" : "http://";
    $currentUrl = $_SERVER['HTTP_HOST'];
    return $httpProtocol . $currentUrl;
}

function redirect($url)
{
    $url = trim($url, '/ ');
    $url = strpos($url, currentDomain()) === 0 ?  $url : currentDomain() . '/' . $url;
    header("Location: " . $url);
    exit;
}

function back()
{
    $http_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_referer);
}

function asset($src)
{
    return currentDomain() . ("/" . trim($src, "/ "));
}

function url($url)
{
    return currentDomain() . ("/" . trim($url, "/ "));
}

function findRouteByName($name)
{
    global $routes;
    $allRoutes = array_merge($routes['get'], $routes['post'], $routes['put'], $routes['delete']);
    $route = null;
    foreach ($allRoutes as $element) {
        if ($element['name'] == $name && $element['name'] !== null) {
            $route = $element['url'];
            break;
        }
    }
    return $route;
}

function route($name, $params = [])
{
    if (!is_array($params)) {
        throw new Exception('route params must be array!');
    }

    $route = findRouteByName($name);
    if ($route === null) {
        throw new Exception('route not found');
    }
    $params = array_reverse($params);
    $routeParamsMatch = [];
    preg_match_all("/{[^}.]*}/", $route, $routeParamsMatch);
    if (count($routeParamsMatch[0]) > count($params)) {
        throw new Exception('route params not enough!!');
    }
    foreach ($routeParamsMatch[0] as $key => $routeMatch) {
        $route = str_replace($routeMatch, array_pop($params), $route);
    }
    return currentDomain() . "/" . trim($route, " /");
}

function generateToken()
{
    return bin2hex(openssl_random_pseudo_bytes(32));
}

function methodField()
{
    $method_field = strtolower($_SERVER['REQUEST_METHOD']);
    if ($method_field == 'post') {
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] == 'put') {
                $method_field = 'put';
            } elseif ($_POST['_method'] == 'delete') {
                $method_field = 'delete';
            }
        }
    }
    return $method_field;
}


function array_dot($array, $return_array = array(), $return_key = '')
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return_array = array_merge($return_array, array_dot($value, $return_array, $return_key . $key . '.'));
        } else {
            $return_array[$return_key . $key] = $value;
        }
    }
    return $return_array;
}


function currentUrl()
{
    return currentDomain() . $_SERVER['REQUEST_URI'];
}

// http://www.seanbehan.com/how-to-slugify-a-string-in-php/
function slugify($title, $separator = '-')
{

    // Convert all dashes/underscores into separator
    $flip = $separator === '-' ? '_' : '-';

    $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);

    // Replace @ with the word 'at'
    $title = str_replace('@', $separator . 'at' . $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', strtolower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

    return trim($title, $separator);
}

function estimateReadingTime($content = '', $wpm = 200)
{
    // https://gist.github.com/mynameispj/3170442
    // https://blog.medium.com/read-time-and-you-bc2048ab620c => How Medium Estimate Reading Time
    // https://coderwall.com/p/y1yhwg/estimate-reading-time
    $totalWords = str_word_count(strip_tags($content));
    $minutes = floor($totalWords / $wpm);
    $seconds = floor($totalWords % $wpm / ($wpm / 60));

    $str_minutes = ($minutes == 1) ? "minute" : "minutes";
    $str_seconds = ($seconds == 1) ? "second" : "seconds";

    if ($minutes == 0) {
        return "{$seconds} {$str_seconds}";
    } else {
        return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
    }
}
function reArrayFiles(&$file_post)
{
    // https://www.php.net/manual/en/features.file-upload.multiple.php
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
