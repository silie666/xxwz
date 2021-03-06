<?php
use Silie\Model\Admin\AdminMenu;

class IndexController extends AdminBase{

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function indexAction() {
        $this->displays();
    }


    public function consoleAction(){
        $this->displays();
    }

    public function navAction(){
        $menus = json_decode($this->_redis->get('admin_menus_' . get_current_admin_id()),true);
        if(empty($menus)){
            $menus = AdminMenu::menuTree();
            $this->_redis->set('admin_menus_' . get_current_admin_id(),json_encode($menus,320));
        }
        api_success('获取成功',array_values($menus));
    }

}