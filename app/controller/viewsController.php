<?php
namespace app\controller;
if ( ! defined('PPP')) exit('非法入口');
use app\model\apiModel;
use core\lib\CacheHTML;
/**
 * 處理視圖
 *
 */
class viewsController extends \core\PPP {
	//GET 首頁視圖
	public function index() {
        $folder = '/index';
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
        $data = $database->index(array('status' => 'published'));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
        $this->display('index.html');
        $c->create_html($folder);
	}

    //GET 專案視圖
	public function projects() {
        $folder = '/projects';
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
        $data = $database->projects_type(array('status' => 'published'));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
		$this->display('projects.html');
        $c->create_html($folder);
	}

    //GET 專案類型視圖
	public function projects_type($id) {
        $folder = '/projects_type/' . $id;
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
        $data = $database->projects_detail(array('status' => 'published', 'type_id' => $id));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
		$this->display('commercial.html');
        $c->create_html($folder);
	}

    //GET 專案視圖
	public function projects_detail($id) {
        $folder = '/projects_detail/' . $id;
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
        $data = $database->projects_detail(array('status' => 'published', 'id' => $id));
        if($data == null) {
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        $this->assign('data', $data[0]);
        $c->pre_create_html($folder);
		$this->display('commercial_in.html');
        $c->create_html($folder);
	}

	//GET 服務視圖
	public function service() {
        $folder = '/service';
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
		$data = $database->service(array('status' => 'published'));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
		$this->display('service.html');
        $c->create_html($folder);
    }

    //GET 聯絡視圖
	public function contact() {
        $folder = '/contact';
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
		$data = $database->contactus(array('status' => 'published'));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
		$this->display('contact.html');
        $c->create_html($folder);
    }

    //GET 關於視圖
	public function aboutus() {
        $folder = '/aboutus';
        $c = new CacheHTML();
        if($c->check_folder($folder)) {
            $c->include_html($folder);
        }
        $database = new apiModel();
		$data[0] = $database->aboutus_intro();
        $data[0]['content'] = replaceEnterWithP($data[0]['content']);
        $data[1] = $database->aboutus_member(array('status' => 'published'));
        $this->assign('data', $data);
        $c->pre_create_html($folder);
		$this->display('about.html');
        $c->create_html($folder);
    }
    
    //GET 後台視圖
    public function admin() {
		$this->display('admin/index.html');
	}
}