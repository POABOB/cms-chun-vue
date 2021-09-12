<?php
if ( ! defined('PPP')) exit('非法入口');
use core\common\auth;
//DOCS: https://github.com/bramus/router

if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = false;
}

//views
//fronted OK
$router->get('/', 'viewsController@index');
$router->get('/projects', 'viewsController@projects');
$router->get('/projects/type/(\d+)', 'viewsController@projects_type');
$router->get('/projects/detail/(\d+)', 'viewsController@projects_detail');
$router->get('/service', 'viewsController@service');
$router->get('/contactus', 'viewsController@contact');
$router->get('/aboutus', 'viewsController@aboutus');
//admin
$router->get('/admin', 'viewsController@admin');

//img etag
$router->before('GET', '/app/views/store.*', function() {
    $lastModified=filemtime(__FILE__);
    //get a unique hash of this file (etag)
    $etagFile = md5_file(__FILE__);
    //get the HTTP_IF_MODIFIED_SINCE header if set
    $ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
    //get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
    $etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);
    
    //set last-modified header
    header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
    //set etag-header
    header("Etag: $etagFile");
    //make sure caching is turned on
    header('Cache-Control: public');
    
    //check if page has changed. If not, send 304 and exit
    if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile) {
           header("HTTP/1.1 304 Not Modified");
           exit;
    }
});

//api
$router->before('GET|POST', '/api/admin.*', function() {
    auth::factory()->user('Session 過期，請重新再登入');
});
$router->mount('/api', function() use ($router) {
    //不用token
    $router->get('/scan', 'apiController@scan');
    $router->get('/twig', 'apiController@twig');
    //email OK
    $router->post('/email/send', 'apiController@contact');
    //登入 OK
    $router->post('/login', 'apiController@login');
    $router->post('/logout', 'apiController@logout');
    

    //info OK
    $router->get('/info', function() {
        auth::factory()->user_info('Session 過期，請重新再登入');
    });

    //密碼更新 OK
    $router->post('/admin/password/update', 'apiController@update_password');
    
    //檔案上傳 OK
    $router->post('/admin/file/upload', 'apiController@uploadFile');

    //首頁管理 OK
    $router->get('/admin/index/list', 'apiController@index');
    $router->post('/admin/index/add', 'apiController@add_index');
    $router->patch('/admin/index/update', 'apiController@update_index');
    $router->delete('/admin/index/delete', 'apiController@delete_index');
    $router->delete('/admin/index/file/remove', 'apiController@removeFile');

    //專案類別管理 OK
    $router->get('/admin/projects/type/list', 'apiController@projects_type');
    $router->post('/admin/projects/type/add', 'apiController@add_projects_type');
    $router->patch('/admin/projects/type/update', 'apiController@update_projects_type');
    $router->delete('/admin/projects/type/delete', 'apiController@delete_projects_type');
    $router->delete('/admin/projects/type/file/remove', 'apiController@removeFile');

    //專案詳細管理 OK
    $router->get('/admin/projects/detail/list', 'apiController@projects_detail');
    $router->post('/admin/projects/detail/add', 'apiController@add_projects_detail');
    $router->patch('/admin/projects/detail/update', 'apiController@update_projects_detail');
    $router->delete('/admin/projects/detail/delete', 'apiController@delete_projects_detail');
    $router->delete('/admin/projects/detail/file/remove', 'apiController@removeFile');

    //關於管理 OK
    $router->get('/admin/aboutus/intro/list', 'apiController@aboutus_intro');
    $router->patch('/admin/aboutus/intro/update', 'apiController@update_aboutus_intro');
    
    //成員管理 OK
    $router->get('/admin/aboutus/member/list', 'apiController@aboutus_member');
    $router->post('/admin/aboutus/member/add', 'apiController@add_aboutus_member');
    $router->patch('/admin/aboutus/member/update', 'apiController@update_aboutus_member');
    $router->delete('/admin/aboutus/member/delete', 'apiController@delete_aboutus_member');
    $router->delete('/admin/aboutus/member/file/remove', 'apiController@removeFile');
    
    //服務管理 OK
    $router->get('/admin/service/list', 'apiController@service');
    $router->post('/admin/service/add', 'apiController@add_service');
    $router->patch('/admin/service/update', 'apiController@update_service');
    $router->delete('/admin/service/delete', 'apiController@delete_service');
    
    //聯絡管理 OK
    $router->get('/admin/contactus/list', 'apiController@contactus');
    $router->post('/admin/contactus/add', 'apiController@add_contactus');
    $router->patch('/admin/contactus/update', 'apiController@update_contactus');
    $router->delete('/admin/contactus/delete', 'apiController@delete_contactus');
});
