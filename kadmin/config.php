<?php
define('JB_VERSION', '2.5.1.1');
//--MySQL SETTING--//////////////
define('DB_HOST_SITE', 'localhost'); // хост
session_start();
$test = 'test';
$href = explode("/", $_SERVER['REQUEST_URI']);
if ($href[1] !== 'kadmin') {
    if ($href[1] == 'ru' || $href[1] != 'ua' && $href[1] != 'ru' && $href[1] != 'en') {
        $_SESSION['lang'] = 'ru';
        if ($href[1] != 'ua' && $href[1] != 'ru' && $href[1] != 'en' && $href[1] != 'kadmin') {
            header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER["SERVER_NAME"] . '/ru' . $_SERVER["REDIRECT_URL"]);
        }
    } elseif ($href[1] == 'ua') {
        $_SESSION['lang'] = 'ua';
    } elseif ($href[1] == 'en') {
        $_SESSION['lang'] = 'en';
    }
}



include_once('db_connect.php');


define('ADMIN_LANG', 'ru');
define('ADMIN_EMAIL', 'xUnikalx@gmail.com');
define('CLIENT_EMAIL', '');

define('SITE_URL', 'http://ax.korzun.pp.ua/');

define('SITE_NAME', 'AXSIOMA');

//define('LANG', ['ru','en']);

//--SECTIONS--//

define('SECTIONS', 1);

define('SET_URL_TEMPLATE_SECTIONS', '{1}');

//--SUBSECTIONS--//

define('SUBSECTIONS', 1);

define('SET_URL_TEMPLATE_SUBSECTIONS', '{1}/{2}');


//--Products--//

define('PRODUCTS', 'Продукты');


define('SET_URL_TEMPLATE_PRODUCTS', 'category/{1}/{2}');


//--Categories--//

define('PRODUCT_CATS', 'Категории');


define('SET_URL_TEMPLATE_PRODUCT_CATS', 'category/{1}');


//--ORDERS--//

define('ORDERS', 0);


//--Customers--//

define('CUSTOMERS', 0);


//--Gallery--//

define('GALLERIES', 0);


define('SET_URL_TEMPLATE_GALLERIES', 'gallery/{2}');


//--Gallery Category--//

define('GALLERY_CATS', 0);


define('SET_URL_TEMPLATE_GALLERY_CATS', 'galleries-{1}');


//--Blog--//

define('ARTICLES', 0);


define('SET_URL_TEMPLATE_ARTICLES', '{1}/article-{2}');


//--Blog Category--//

define('ARTICLE_CATS', 0);


define('SET_URL_TEMPLATE_ARTICLE_CATS', 'articles-{1}');


//--Blog Comments--//

define('ARTICLE_COMMENTS', 0);


//--Blog Tags//

define('ARTICLE_TAGS', 1);


//--Testimonials--//

define('TESTIMONIALS', 0);


define('SET_URL_TEMPLATE_TESTIMONIALS', 'testimonials-{1}');


//--News--//

define('NEWS', 1);


define('SET_URL_TEMPLATE_NEWS', 'news-{1}');


//--Media--//

define('MEDIA', 0);


define('SET_URL_TEMPLATE_MEDIA', 'media-{1}');


//--Slider_1--//

define('SLIDER_1', 1);

//--Slider_2--//

define('SLIDER_2', 0);

//--Slider_3--//

define('SLIDER_3', 0);


//--Banner_1--//

define('BANNER_1', 0);

//--Banner_2--//

define('BANNER_2', 0);

//--Banner_3--//

define('BANNER_3', 0);


//--Subscribers--//

define('SUBSCRIBERS', 0);


//--FAQ--//

define('FAQ', 0);
?>
