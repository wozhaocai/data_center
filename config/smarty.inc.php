<?php
class GliderSkySmarty extends Smarty {

	function __construct() {
		parent::__construct();

		$this->template_dir = APPLICATION_PATH.'/templates/';
		$this->compile_dir = APPLICATION_PATH.'/templates_c/';
		$this->config_dir = SMARTY_DIR.'/configs/';
		$this->cache_dir = APPLICATION_PATH.'/cache/'; 
		
		$this->left_delimiter = '<{'; 
		$this->right_delimiter = '}>'; 	

		$this->caching = false;
		$this->assign('app_name','数据中心');
	}

}
?>
