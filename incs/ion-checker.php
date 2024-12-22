<?php
defined('ABSPATH') || exit ("no access");

$wupp_min_loader_version="12.0";
$wupp_min_php_version="7.4";
$wupp_ioncube_error_checker=[];

if (!extension_loaded('ionCube Loader')){
    $wupp_ioncube_error_checker[]=sprintf('We detect you do not have ionCube loader , please call to your host service to install ionCube loader version to upper than %s',$wupp_min_loader_version);
}elseif (!function_exists('ioncube_loader_version') || version_compare(ioncube_loader_version(),$wupp_min_loader_version,'<')){
    $wupp_ioncube_error_checker[]=sprintf('We detect your ionCube loader is too old , please call to your host service to update ionCube loader version to upper than %s',$wupp_min_loader_version);
}
if(!version_compare(phpversion(),$wupp_min_php_version,'>=')) {
    $wupp_ioncube_error_checker[] = sprintf(
        'We detect your server php version is to old, this plugin need php version %s to up.  please call to your host service to update php',
        $wupp_min_php_version
    );
}


