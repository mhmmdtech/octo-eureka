<?php

function sidebarActive($url, $contain = true)
{
    if ($contain)
        return (strpos(currentUrl(), $url) === 0) ? 'active' : '';
    else
        return  $url === currentUrl() ? 'active' : '';
}

function errorClass($name)
{
    return errorExists($name) ? '' : 'hide';
}

function errorText($name)
{
    return errorExists($name) ? error($name)  : '&nbsp; ';
}
function flashClass($name)
{
    return flashExists($name) ? '' : 'hide';
}

function flashText($name)
{
    return flashExists($name) ? flash($name)  : '&nbsp; ';
}

function oldOrValue($name, $value)
{
    return empty(old($name)) ? $value : old($name);
}

function paginate($data, $perPage)
{
    $totalRows = count($data);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalPages = ceil($totalRows / $perPage);
    $currentPage = min($currentPage, $totalPages);
    $currentPage = max($currentPage, 1);
    $currentRow = ($currentPage - 1) * $perPage;
    $data = array_slice($data, $currentRow, $perPage);
    return $data;
}

function paginateView($data, $perPage)
{
    $totalRows = count($data);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalPages = ceil($totalRows / $perPage);
    $currentPage = min($currentPage, $totalPages);
    $currentPage = max($currentPage, 1);

    $paginateView = '';
    $paginateView .= ($currentPage != 1) ? '<li><a href="' . paginateUrl(1) . '">&lt;</a></li>' : '';
    $paginateView .= (($currentPage - 2) >= 1) ? '<li><a href="' . paginateUrl($currentPage - 2) . '">' . ($currentPage - 2) . '</a></li>' : '';
    $paginateView .= (($currentPage - 1) >= 1) ? '<li><a href="' . paginateUrl($currentPage - 1) . '">' . ($currentPage - 1) . '</a></li>' : '';
    $paginateView .= '<li class="active"><a href="' . paginateUrl($currentPage) . '">' . ($currentPage) . '</a></li>';
    $paginateView .= (($currentPage + 1) <= $totalPages) ? '<li><a href="' . paginateUrl($currentPage + 1) . '">' . ($currentPage + 1) . '</a></li>' : '';
    $paginateView .= (($currentPage + 2) <= $totalPages) ? '<li><a href="' . paginateUrl($currentPage + 2) . '">' . ($currentPage + 2) . '</a></li>' : '';
    $paginateView .= ($currentPage != $totalPages) ? '<li><a href="' . paginateUrl($totalPages) . '">&gt;</a></li>' : '';


    return '
    <div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            <ul>
               ' . $paginateView . '
            </ul>
        </div>
    </div>
</div>
    ';
}

function paginateUrl($page)
{
    $urlArray = explode('?', currentUrl());
    if (isset($urlArray[1])) {

        $_GET['page'] = $page;
        $getVariables = array_map(function ($value, $key) {
            return $key . '=' . $value;
        }, $_GET, array_keys($_GET));
        return $urlArray[0] . '?' . implode('&', $getVariables);
    } else {
        return currentUrl() . '?page=' . $page;
    }
}
function getMacAddress()
{
    // https://stackoverflow.com/questions/5074139/how-to-get-mac-address-of-client-using-php
    // https://phpcoder.tech/php-get-client-mac-or-physical-and-ip-address/#Get_Client_MAC_or_Physical_Address_Using_PHP
    ob_start();
    system('getmac');
    $content = ob_get_contents();
    ob_clean();
    return substr($content, strpos($content, '\\') - 20, 17);
}
