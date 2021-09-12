<?php
namespace app\controller;
if ( ! defined('PPP')) exit('非法入口');
use app\model\apiModel;
/**
 * 處理視圖
 *
 */
class viewsController extends \core\PPP {
	//GET 首頁視圖
	public function index() {
        $database = new apiModel();
        $data = $database->index(array('status' => 'published'));
        $this->assign('data', $data);
		$this->display('index.html');
	}

    //GET 專案視圖
	public function projects() {
        $database = new apiModel();
        $data = $database->projects_type(array('status' => 'published'));
        $this->assign('data', $data);
		$this->display('projects.html');
	}

    //GET 專案類型視圖
	public function projects_type($id) {
        $database = new apiModel();
        $data = $database->projects_detail(array('status' => 'published', 'type_id' => $id));
        $this->assign('data', $data);
		$this->display('commercial.html');
	}

    //GET 專案視圖
	public function projects_detail($id) {
        $database = new apiModel();
        $data = $database->projects_detail(array('status' => 'published', 'id' => $id));
        if($data == null) {
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        $this->assign('data', $data[0]);
		$this->display('commercial_in.html');
	}

	//GET 服務視圖
	public function service() {
        $database = new apiModel();
		$data = $database->service(array('status' => 'published'));
        $this->assign('data', $data);
		$this->display('service.html');
    }

    //GET 聯絡視圖
	public function contact() {
        $database = new apiModel();
		$data = $database->contactus(array('status' => 'published'));
        $this->assign('data', $data);
		$this->display('contact.html');
    }

    //GET 關於視圖
	public function aboutus() {
        $database = new apiModel();
		$data[0] = $database->aboutus_intro();
        $data[0]['content'] = replaceEnterWithP($data[0]['content']);
        $data[1] = $database->aboutus_member(array('status' => 'published'));
        $this->assign('data', $data);
		$this->display('about.html');
    }
    
    //GET 後台視圖
    public function admin() {
		$this->display('admin/index.html');
	}
}