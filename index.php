<?
ini_set("display_errors",1);
error_reporting(E_ALL);

if(!empty($_GET['q'])) $url = $_GET['q']; else $url = '';
$url = rtrim($url, '/');


if(isset($url)){
    $path = explode('/',$url);
} else $path =('');

require 'phpmailer/PHPMailerAutoload.php';

if ($path[0]=='') {require 'html/index.html';}
else if($path[0]=='service-envelop-set') {
    require 'html/service-envelop-set.html';}
else if($path[0]=='service-exterior-antirain') {
    require 'html/service-exterior-antirain.html';}
else if($path[0]=='service-exterior-ceramics') {
    require 'html/service-exterior-ceramics.html';}
else if($path[0]=='service-exterior-glass') {
    require 'html/service-exterior-glass.html';}
else if($path[0]=='service-exterior-rims') {
    require 'html/service-exterior-rims.html';}
else if($path[0]=='service-hood-save-dry') {
    require 'html/service-hood-save-dry.html';}
else if($path[0]=='service-hood-dry-wash') {
    require 'html/service-hood-dry-wash.html';}
else if($path[0]=='service-interior-cleaning') {
    require 'html/service-interior-cleaning.html';}
else if($path[0]=='service-interior-polish') {
    require 'html/service-interior-polish.html';}
else if($path[0]=='service-interior-skin-care') {
    require 'html/service-interior-skin-care.html';}
else if($path[0]=='service-interior-skin-save') {
    require 'html/service-interior-skin-save.html';}
else require 'html/404.html';
?>
