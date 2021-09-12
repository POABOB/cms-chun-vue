<?php
namespace app\controller;
if ( ! defined('PPP')) exit('非法入口');
use core\lib\Mailer;
use app\model\apiModel;
use core\lib\resModel;
use core\lib\Validator;
use core\lib\JWT;
/**
 * 處理api
 *
 */
class apiController extends \core\PPP {
    //GET 獲取首頁資料api
    public function index() {
        $database = new apiModel();
        $data[0] = $database->index();
        $data[1] = array();
        foreach ($data[0] as $key => $value) {
            if($data[0][$key]['img'] != "") {
                $data[1][] = array(
                    'name' => $data[0][$key]['img'],
                    'path' => $data[0][$key]['img']
                );
            }
            
            if($data[0][$key]['img2'] != "") {
                $data[1][] = array(
                    'name' => $data[0][$key]['img2'],
                    'path' => $data[0][$key]['img2']
                );
            }

            if($data[0][$key]['small_img'] != "") {
                $data[1][] = array(
                    'name' => $data[0][$key]['small_img'],
                    'path' => $data[0][$key]['small_img']
                );
            }
        }
        if(count($data[1]) == 0) {
            $data[1][0] = [];
        }
        json(new resModel(200, $data));
    }

    //POST 新增首頁資料api
    public function add_index() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '圖片1' => $post['img'],
                '圖片2' => $post['img2'],
                '圖片(mobile)' => $post['small_img'],
                '狀態' => $post['status']
            ),
            array(
                '圖片1' => array('required', 'maxLen' => 256),
                '圖片2' => array('maxLen' => 256),
                '圖片(mobile)' => array('maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $data = $database->insertOrUpdate_index(
            array(
                'img' => $post['img'],
                'img2' => $post['img2'],
                'small_img' => $post['small_img'],
                'status' => $post['status']
            )
        );

        if($data) {
            json(new resModel(200, '圖片新增成功'));
        } else {
            json(new resModel(400, '圖片新增失敗'));
        }
    }

    //PATCH 更新首頁資料api
    public function update_index() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '圖片1' => $post['img'],
                '圖片2' => $post['img2'],
                '圖片(mobile)' => $post['small_img'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '圖片1' => array('required', 'maxLen' => 256),
                '圖片2' => array('maxLen' => 256),
                '圖片(mobile)' => array('maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $return = $database->insertOrUpdate_index(
            array(
                'img' => $post['img'],
                'img2' => $post['img2'],
                'small_img' => $post['small_img'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

        if($return == 2) {
            json(new resModel(200, '圖片更新成功'));
        } else if($return == 1) {
            json(new resModel(400, '圖片更新失敗'));
        } else {
            json(new resModel(400, '圖片ID異常'));
        }
    }

    //DELETE 刪除首頁資料api
    public function delete_index() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $this->_removeFile($post['img']);
        $this->_removeFile($post['img2']);
        $this->_removeFile($post['small_img']);
        $data = $database->delete_index(array('id' => $post['id'], 'orders' => intval($post['orders'])));

        if($data) {
            json(new resModel(200, '圖片刪除成功'));
        } else {
            json(new resModel(400, '圖片刪除失敗'));
        }
    }

    //GET 獲取專案類型api
    public function projects_type() {
        $database = new apiModel();
        $data[0] = $database->projects_type();
        $data[1] = array();
        foreach ($data[0] as $key => $value) {
            if($data[0][$key]['img'] != "") {
                $data[1][] = array(
                    'name' => $data[0][$key]['img'],
                    'path' => $data[0][$key]['img']
                );
            }
        }
        if(count($data[1]) == 0) {
            $data[1][0] = [];
        }
        json(new resModel(200, $data));
    }

    //POST 新增專案類型api
    public function add_projects_type() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '類別' => $post['name'],
                '類別(ENG)' => $post['eng_name'],
                '圖片' => $post['img'],
                '狀態' => $post['status']
            ),
            array(
                '類別' => array('required', 'maxLen' => 64),
                '類別(ENG)' => array('maxLen' => 64),
                '圖片' => array('required','maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $data = $database->insertOrUpdate_projects_type(
            array(
                'name' => $post['name'],
                'eng_name' => $post['eng_name'],
                'img' => $post['img'],
                'status' => $post['status']
            )
        );

        if($data) {
            json(new resModel(200, '專案類別新增成功'));
        } else {
            json(new resModel(400, '專案類別新增失敗'));
        }
    }

    //PATCH 更新專案類別api
    public function update_projects_type() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '類別' => $post['name'],
                '類別(ENG)' => $post['eng_name'],
                '圖片' => $post['img'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '類別' => array('required', 'maxLen' => 64),
                '類別(ENG)' => array('maxLen' => 64),
                '圖片' => array('required','maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $return = $database->insertOrUpdate_projects_type(
            array(
                'name' => $post['name'],
                'eng_name' => $post['eng_name'],
                'img' => $post['img'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

        if($return == 2) {
            json(new resModel(200, '專案類別更新成功'));
        } else if($return == 1) {
            json(new resModel(400, '專案類別更新失敗'));
        } else {
            json(new resModel(400, '專案類別ID異常'));
        }
    }

    //DELETE 刪除專案類別api
    public function delete_projects_type() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();

        //刪除前先確認有沒有專案
        if(!$database->has('Projects_detail', array('type_id' => $post['id']))) {
            $this->_removeFile($post['img']);
            $data = $database->delete_projects_type(array('id' => $post['id'], 'orders' => intval($post['orders'])));
            if($data) {
                json(new resModel(200, '專案類別刪除成功'));
            } else {
                json(new resModel(400, '專案類別刪除失敗'));
            }
        } else {
            json(new resModel(400, '專案類別仍有專案，請先刪除專案!'));
        }
    }

    //GET 獲取專案api
    public function projects_detail() {
        $database = new apiModel();
        $data[0] = $database->projects_detail();
        $array = array('cover', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10', 'img11');
        $data[1] = array();
        foreach ($data[0] as $key => $value) {
            foreach ($array as $key2 => $value2) {
                if($data[0][$key][$value2] != "") {
                    $data[1][] = array(
                        'name' => $data[0][$key][$value2],
                        'path' => $data[0][$key][$value2]
                    );
                }
            }
        }
        if(count($data[1]) == 0) {
            $data[1][0] = [[], [],[], [],[], [],[], [],[], [],[], []];
        }
        $data[2] = $database->projects_type();
        json(new resModel(200, $data));
    }

    //POST 新增專案api
    public function add_projects_detail() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '專案名稱' => $post['name'],
                '類別' => $post['type_id'],
                '描述' => $post['description'],
                '封面' => $post['cover'],
                '圖片1' => $post['img1'],
                '圖片2' => $post['img2'],
                '圖片3' => $post['img3'],
                '圖片4' => $post['img4'],
                '圖片5' => $post['img5'],
                '圖片6' => $post['img6'],
                '圖片7' => $post['img7'],
                '圖片8' => $post['img8'],
                '圖片9' => $post['img9'],
                '圖片10' => $post['img10'],
                '圖片11' => $post['img11'],
                '狀態' => $post['status']
            ),
            array(
                '專案名稱' => array('required', 'maxLen' => 64),
                '類別' => array('required', 'maxLen' => 11),
                '描述' => array('maxLen' => 1024),
                '封面' => array('required','maxLen' => 256),
                '圖片1' => array('required','maxLen' => 256),
                '圖片2' => array('required','maxLen' => 256),
                '圖片3' => array('required','maxLen' => 256),
                '圖片4' => array('required','maxLen' => 256),
                '圖片5' => array('required','maxLen' => 256),
                '圖片6' => array('required','maxLen' => 256),
                '圖片7' => array('required','maxLen' => 256),
                '圖片8' => array('required','maxLen' => 256),
                '圖片9' => array('required','maxLen' => 256),
                '圖片10' => array('required','maxLen' => 256),
                '圖片11' => array('required','maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $data = $database->insertOrUpdate_projects_detail(
            array(
                'name' => $post['name'],
                'type_id' => $post['type_id'],
                'description' => $post['description'],
                'cover' => $post['cover'],
                'img1' => $post['img1'],
                'img2' => $post['img2'],
                'img3' => $post['img3'],
                'img4' => $post['img4'],
                'img5' => $post['img5'],
                'img6' => $post['img6'],
                'img7' => $post['img7'],
                'img8' => $post['img8'],
                'img9' => $post['img9'],
                'img10' => $post['img10'],
                'img11' => $post['img11'],
                'status' => $post['status']
            )
        );

        if($data) {
            json(new resModel(200, '專案新增成功'));
        } else {
            json(new resModel(400, '專案新增失敗'));
        }
    }

    //PATCH 更新專案api
    public function update_projects_detail() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '專案名稱' => $post['name'],
                '類別' => $post['type_id'],
                '描述' => $post['description'],
                '封面' => $post['cover'],
                '圖片1' => $post['img1'],
                '圖片2' => $post['img2'],
                '圖片3' => $post['img3'],
                '圖片4' => $post['img4'],
                '圖片5' => $post['img5'],
                '圖片6' => $post['img6'],
                '圖片7' => $post['img7'],
                '圖片8' => $post['img8'],
                '圖片9' => $post['img9'],
                '圖片10' => $post['img10'],
                '圖片11' => $post['img11'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '專案名稱' => array('required', 'maxLen' => 64),
                '類別' => array('required', 'maxLen' => 11),
                '描述' => array('maxLen' => 1024),
                '封面' => array('required','maxLen' => 256),
                '圖片1' => array('required','maxLen' => 256),
                '圖片2' => array('required','maxLen' => 256),
                '圖片3' => array('required','maxLen' => 256),
                '圖片4' => array('required','maxLen' => 256),
                '圖片5' => array('required','maxLen' => 256),
                '圖片6' => array('required','maxLen' => 256),
                '圖片7' => array('required','maxLen' => 256),
                '圖片8' => array('required','maxLen' => 256),
                '圖片9' => array('required','maxLen' => 256),
                '圖片10' => array('required','maxLen' => 256),
                '圖片11' => array('required','maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $return = $database->insertOrUpdate_projects_detail(
            array(
                'name' => $post['name'],
                'type_id' => $post['type_id'],
                'description' => $post['description'],
                'cover' => $post['cover'],
                'img1' => $post['img1'],
                'img2' => $post['img2'],
                'img3' => $post['img3'],
                'img4' => $post['img4'],
                'img5' => $post['img5'],
                'img6' => $post['img6'],
                'img7' => $post['img7'],
                'img8' => $post['img8'],
                'img9' => $post['img9'],
                'img10' => $post['img10'],
                'img11' => $post['img11'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

        if($return == 2) {
            json(new resModel(200, '專案更新成功'));
        } else if($return == 1) {
            json(new resModel(400, '專案更新失敗'));
        } else {
            json(new resModel(400, '專案ID異常'));
        }
    }

    //DELETE 刪除專案api
    public function delete_projects_detail() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $array = array('cover', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10', 'img11');
        foreach ($array as $key => $value) {
            if($post[$value] != "") {
                $this->_removeFile($post[$value]);
            }
        }
        $data = $database->delete_projects_detail(array('id' => $post['id'], 'orders' => intval($post['orders'])));

        if($data) {
            json(new resModel(200, '專案刪除成功'));
        } else {
            json(new resModel(400, '專案刪除失敗'));
        }
    }

    //GET 獲取關於我們資料api
    public function aboutus_intro() {
        $database = new apiModel();
        $data = $database->aboutus_intro();
        json(new resModel(200, $data));
    }

    //PATCH 更新關於我們資料api
    public function update_aboutus_intro() {
        $post = array();
        $post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '關於我們' => $post['content']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '關於我們' => array('required', 'maxLen' => 2048)
            )
        );

        if($v->error()) {
            json(new resModel(400, $v->error(), '提交格式有誤'));
            return;
        }

        $database = new apiModel();
        $return = $database->insertOrUpdate_aboutus_intro(
            array('content' => $post['content']),
            array('id' => $post['id'])
        );

        if($return == 2) {
            json(new resModel(200, '關於我們更新成功'));
        } else if($return == 1) {
            json(new resModel(400, '關於我們更新失敗'));
        } else {
            json(new resModel(400, '關於我們ID異常'));
        }
    }

    //GET 獲取成員資料api
    public function aboutus_member() {
        $database = new apiModel();
		$data[0] = $database->aboutus_member();
        $data[1] = array();
        foreach ($data[0] as $key => $value) {
            $data[1][] = array(
                'name' => $data[0][$key]['avatar'],
                'path' => $data[0][$key]['avatar']
            );
        }
        if(count($data[1]) == 0) {
            $data[1][0] = [];
        }
        json(new resModel(200, $data));
    }

    //POST 新增成員資料api
    public function add_aboutus_member() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '職位' => $post['position'], 
                '姓名' => $post['name'],
                '頭像' => $post['avatar'],
                '狀態' => $post['status']
            ),
            array(
                '職位' => array('required', 'maxLen' => 64),
                '姓名' => array('required', 'maxLen' => 64),
                '頭像' => array('required', 'maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->insertOrUpdate_aboutus_member(
            array(
                'position' => $post['position'], 
                'name' => $post['name'],
                'avatar' => $post['avatar'],
                'status' => $post['status']
            )
        );

		if($data) {
			json(new resModel(200, '成員新增成功'));
		} else {
			json(new resModel(400, '成員新增失敗'));
		}
    }

    //PATCH 更新成員資料api
    public function update_aboutus_member() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '職位' => $post['position'], 
                '姓名' => $post['name'],
                '頭像' => $post['avatar'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '職位' => array('required', 'maxLen' => 64),
                '姓名' => array('required', 'maxLen' => 64),
                '頭像' => array('required', 'maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$return = $database->insertOrUpdate_aboutus_member(
            array(
                'position' => $post['position'], 
                'name' => $post['name'],
                'avatar' => $post['avatar'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

		if($return == 2) {
			json(new resModel(200, '成員更新成功'));
		} else if($return == 1) {
			json(new resModel(400, '成員更新失敗'));
		} else {
            json(new resModel(400, '成員ID異常'));
        }
    }

    //DELETE 刪除成員資料api
    public function delete_aboutus_member() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
        $this->_removeFile($post['avatar']);
		$data = $database->delete_aboutus_member(array('id' => $post['id'], 'orders' => intval($post['orders'])));

		if($data) {
			json(new resModel(200, '成員刪除成功'));
		} else {
			json(new resModel(400, '成員刪除失敗'));
		}
    }

    //GET 獲取服務資料api
    public function service() {
        $database = new apiModel();
		$data = $database->service();
        json(new resModel(200, $data));
    }

    //POST 新增服務資料api
    public function add_service() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '項目' => $post['item'], 
                '標準' => $post['standard'],
                '狀態' => $post['status']
            ),
            array(
                '項目' => array('required', 'maxLen' => 64),
                '標準' => array('required', 'maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->insertOrUpdate_service(
            array(
                'item' => $post['item'], 
                'standard' => $post['standard'],
                'status' => $post['status']
            )
        );

		if($data) {
			json(new resModel(200, '收費標準新增成功'));
		} else {
			json(new resModel(400, '收費標準新增失敗'));
		}
    }

    //PATCH 更新服務資料api
    public function update_service() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '項目' => $post['item'], 
                '標準' => $post['standard'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '項目' => array('required', 'maxLen' => 64),
                '標準' => array('required', 'maxLen' => 256),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$return = $database->insertOrUpdate_service(
            array(
                'item' => $post['item'], 
                'standard' => $post['standard'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

		if($return == 2) {
			json(new resModel(200, '收費標準更新成功'));
		} else if($return == 1) {
			json(new resModel(400, '收費標準更新失敗'));
		} else {
            json(new resModel(400, '收費標準ID異常'));
        }
    }

    //DELETE 刪除服務資料api
    public function delete_service() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->delete_service(array('id' => $post['id'], 'orders' => intval($post['orders'])));

		if($data) {
			json(new resModel(200, '收費標準刪除成功'));
		} else {
			json(new resModel(400, '收費標準刪除失敗'));
		}
    }

    //GET 獲取聯絡資料api
    public function contactus() {
        $database = new apiModel();
		$data = $database->contactus();
        json(new resModel(200, $data));
    }

    //POST 新增聯絡資料api
    public function add_contactus() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                '部門' => $post['department'], 
                '電話' => $post['tel'],
                '傳真' => $post['tax'],
                '地址' => $post['addr'],
                '地址連結' => isset($post['addr_map']) ? $post['addr_map'] : '',
                'Email' => $post['email'],
                '統編' => $post['tax_id'],
                '狀態' => $post['status']
            ),
            array(
                '部門' => array('required', 'maxLen' => 64),
                '電話' => array('required', 'maxLen' => 15),
                '傳真' => array('required', 'maxLen' => 20),
                '地址' => array('required', 'maxLen' => 256),
                '地址連結' => array('maxLen' => 256),
                'Email' => array('required', 'maxLen' => 128, 'email'),
                '統編' => array('required', 'maxLen' => 20),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->insertOrUpdate_contactus(
            array(
                'department' => $post['department'], 
                'tel' => $post['tel'],
                'tax' => $post['tax'],
                'addr' => $post['addr'],
                'addr_map' => isset($post['addr_map']) ? $post['addr_map'] : '',
                'email' => $post['email'],
                'tax_id' => $post['tax_id'],
                'status' => $post['status']
            )
        );

		if($data) {
			json(new resModel(200, '公司新增成功'));
		} else {
			json(new resModel(400, '公司新增失敗'));
		}
    }

    //PATCH 更新聯絡資料api
    public function update_contactus() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array(
                'ID' => $post['id'], 
                '部門' => $post['department'], 
                '電話' => $post['tel'],
                '傳真' => $post['tax'],
                '地址' => $post['addr'],
                '地址連結' => isset($post['addr_map']) ? $post['addr_map'] : '',
                'Email' => $post['email'],
                '統編' => $post['tax_id'],
                '狀態' => $post['status']
            ),
            array(
                'ID' => array('required', 'maxLen' => 11),
                '部門' => array('required', 'maxLen' => 64),
                '電話' => array('required', 'maxLen' => 15),
                '傳真' => array('required', 'maxLen' => 20),
                '地址' => array('required', 'maxLen' => 256),
                '地址連結' => array('maxLen' => 256),
                'Email' => array('required', 'maxLen' => 128, 'email'),
                '統編' => array('required', 'maxLen' => 20),
                '狀態' => array('required', 'maxLen' => 9)
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$return = $database->insertOrUpdate_contactus(
            array(
                'department' => $post['department'], 
                'tel' => $post['tel'],
                'tax' => $post['tax'],
                'addr' => $post['addr'],
                'addr_map' => isset($post['addr_map']) ? $post['addr_map'] : '',
                'email' => $post['email'],
                'tax_id' => $post['tax_id'],
                'status' => $post['status']
            ),
            array('id' => $post['id'])
        );

		if($return == 2) {
			json(new resModel(200, '公司更新成功'));
		} else if($return == 1) {
			json(new resModel(400, '公司更新失敗'));
		} else {
            json(new resModel(400, '公司ID異常'));
        }
    }

    //DELETE 刪除聯絡資料api
    public function delete_contactus() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('ID' => $post['id']),
            array('ID' => array('required', 'maxLen' => 11))
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->delete_contactus(array('id' => $post['id'], 'orders' => intval($post['orders'])));

		if($data) {
			json(new resModel(200, '公司刪除成功'));
		} else {
			json(new resModel(400, '公司刪除失敗'));
		}
    }

    //POST 聯絡api
	public function contact() {
        $post = post_json();

        // //樣式
        // $post = array(
        //     'name' => 'xxx',
        //     'gender' => '男',
        //     'phone' => '0912345678',
        //     'cellphone' => '0912345678',
        //     'email' => '123@gmail.com',
        //     'location' => '台中',
        //     'type' => '室內設計',
        //     'size' => '25',
        //     'budget' => '2500000',
        //     'time' => '2022/02',
        //     'desc' => '大點'
        // );
        $v = new Validator();
        $v->validate(
            array(
                '客戶名稱' => $post['name'], 
                '手機' => $post['cellphone'],
                '電子郵件' => $post['email'],
                '施工地點' => $post['location'],
                '設計性質' => $post['type'],
                '室內坪數' => $post['size'],
                '預算' => $post['budget'],
                '性別' => isset($post['gender']) ? $post['gender'] : '',
                '電話' => isset($post['phone']) ? $post['phone'] : '',
                '入住時間' => isset($post['time']) ? $post['time'] : '',
                '需求描述' => isset($post['desc']) ? $post['desc'] : ''
            ),
            array(
                '客戶名稱' => array('required', 'maxLen' => 64),
                '手機' => array('required', 'maxLen' => 15),
                '施工地點' => array('required', 'maxLen' => 256),
                '電子郵件' => array('required', 'maxLen' => 128, 'email'),
                '設計性質' => array('required', 'maxLen' => 128),
                '室內坪數' => array('required', 'maxLen' => 10),
                '預算' => array('required', 'maxLen' => 15),
                '性別' => array('maxLen' => 1),
                '電話' => array('maxLen' => 20),
                '入住時間' => array('maxLen' => 10),
                '需求描述' => array('maxLen' => 256),
            )
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $post['gender'] = ($post['gender'] == 1) ? '男' : '女';
        $body = <<<BODY
        <table class='pure-table pure-table-horizontal' style='border-collapse: collapse; border-spacing: 0px; empty-cells: show; border-style: solid; border-color: rgb(203, 203, 203); color: rgb(0, 0, 0); font-family: sans-serif; font-size: medium;'>
        <thead style='background-color: rgb(224, 224, 224); vertical-align: bottom;'>
        <tr><th colspan='2' style="padding: 0.5em 1em; border-left: 0px solid rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible;">客戶資料</th></tr></thead>
        <tbody>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">客戶名稱</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[name]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">性別</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[gender]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">電話</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[phone]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">手機</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[cellphone]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">電子郵件</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[email]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">施工地點</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[location]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">設計性質</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[type]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">室內坪數</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[size]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">預算</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[budget]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">入住時間</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[time]</td></tr>
        <tr><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">需求描述</td><td style="padding: 0.5em 1em; border-left-style: solid; border-left-color: rgb(203, 203, 203); border-top-width: 0px; border-right-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(203, 203, 203); font-size: inherit; margin: 0px; overflow: visible; background-color: transparent;">$post[desc]</td></tr>
        </tbody>
        </table>
        BODY;
        
        $mailer = new Mailer();
        $mailer->setMessage(
            "來自網站留言:" . $post['name'],
            $post['email'],
            // 'Chunspacedesign@gmail.com',
            // 'zxc752166@gmail.com',
            'Chunspacedesign@gmail.com',
            // 'm0920173456@gmail.com',
            $body
        );
        
        $return = $mailer->send();
        if($return == true) {
            json(new resModel(200, 'Successfully Sent!'));
        } else {
		    json(new resModel(400, $return));
        }
    }

    //POST 登入
    public function login() {
        $post = array();
		$post = post_json();

        //Validation
        $v = new Validator();
        $v->validate(
            array('account' => $post['account'], 'password' => $post['password']),
            array('account' => array('required'),'password' => array('required'))
        );

		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
		}

        $database = new apiModel();
		$data = $database->login(array('account' => $post['account'],'password' => md5($post['password'])));

		//有則加入SESSION，沒有就返回Error
		if($data) {
            //JWT
            $payload=array('account' => $post['account'], 'avatar' => site_url('/images/avatar.gif'),'iat'=>time(),'exp'=>time()+60*60*24*30,'nbf'=>time());
            $token = JWT::getToken($payload);
			json(new resModel(200, array('token' => $token), '登入成功'));
		} else {
			json(new resModel(400, '帳號或密碼錯誤'));
		}
	}

    //POST 登出
    public function logout() {
		json(new resModel(200, '登出成功'));
	}
    
    //POST 更新密碼
    public function update_password() {
		$post = post_json();
        //Validator
        $v = new Validator();
        $v->validate(
            array('密碼' => $post['password'], '密碼確認' => $post['passconf']),
            array('密碼' => array('required', 'maxLen' => 32), '密碼確認' => array('required', 'same' => $post['password']))
        );
		if($v->error()) {
			json(new resModel(400, $v->error(), '提交格式有誤'));
			return;
        }

        $db = new apiModel();
        $return = $db->update_password(array('chunadmin', (isset($post['oldpass']) ? md5($post['oldpass']) : ''), md5($post['password'])));
        
        //0帳密錯誤 1不明原因 2成功
        if($return == 0) {
            json(new resModel(400, '帳號或密碼錯誤'));
        } else {
            if($return == 2) {
                json(new resModel(200, '更新密碼成功'));
            } else {
                json(new resModel(400, '更新密碼失敗'));
            }
        }
	}

    //POST 上傳文件api
    public function uploadFile() {
        $uploadfile = date('Y_m_d_H_i_s').'_'.$_GET['type'].'_'.basename($_FILES['upload']['name']);
        if (move_uploaded_file($_FILES['upload']['tmp_name'], ASSET.'/'.$uploadfile)) {
            chmod(ASSET.'/'.$uploadfile, 0755);
            $data['path'] = '/'.$uploadfile;
            $data['name'] = '/'.$uploadfile;
            json(new resModel(200, $data, '圖片新增成功'));
        } else {
            json(new resModel(400, '圖片新增失敗'));
        }
    }

    //DELETE 刪除文件api
    public function removeFile() {
        $post = post_json();
        if (file_exists(ASSET.$post['file'])) {
            unlink(ASSET.$post['file']);
            if(!file_exists(ASSET.$post['file'])) {
                json(new resModel(200, '刪除圖片成功'));
            } else {
                json(new resModel(400, '刪除圖片失敗'));
            }
        } else {
            json(new resModel(200, '刪除圖片成功'));
        }
    }

    //刪除文件
    private function _removeFile($file) {
        if($file != null) {
            if (file_exists(ASSET.$file)) {
                unlink(ASSET.$file);
                if(!file_exists(ASSET.$file)) {
                    return 2;
                } else {
                    return 1;
                }
            } else {
                return 0;
            }
        }
    }

    //掃描文件
    public function scan() {
        $folder_list = scandirFolder(ASSET . '/');

        $list = array();
        $database = new apiModel();
        //首頁圖
        $data = $database->index();
        foreach ($data as $key => $value) {
            if($data[$key]['img'] != "") {
                $list[] = $data[$key]['img'];
            }
            if($data[$key]['img2'] != "") {
                $list[] = $data[$key]['img2'];
            }
            if($data[$key]['small_img'] != "") {
                $list[] = $data[$key]['small_img'];
            }
        }
        //專案類型圖
        $data = $database->projects_type();
        foreach ($data as $key => $value) {
            if($data[$key]['img'] != "") {
                $list[] = $data[$key]['img'];
            }
        }
        //專案圖
        $data = $database->projects_detail();
        $array = array('cover', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10', 'img11');
        foreach ($data as $key => $value) {
            foreach ($array as $key2 => $value2) {
                if($data[$key][$value2] != "") {
                    $list[] = $data[$key][$value2];
                }
            }
        }
        //成員圖
        $data = $database->aboutus_member();
        foreach ($data as $key => $value) {
            if($data[$key]['avatar'] != "") {
                $list[] = $data[$key]['avatar'];
            }
        }
        $diff = array_diff($folder_list,$list);
        p($diff);

        foreach ($diff as $key => $value) {
            $this->_removeFile($value);
        }
    }

    //delete twig
    public function twig() {
        if(is_dir(PPP . '/log/twig/')) {
            delTree(PPP . '/log/twig/');
        }
        
        json(new resModel(200, '刪除cache成功'));
    }
}