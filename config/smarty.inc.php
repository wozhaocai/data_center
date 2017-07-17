<?php
class GliderSkySmarty extends Smarty {

	function __construct() {
		parent::__construct();

		$this->template_dir = SYSTEM_DIR.'/templates/';
		$this->compile_dir = SYSTEM_DIR.'/templates_c/';
		$this->config_dir = SYSTEM_DIR.'/smarty/configs/';
		$this->cache_dir = SYSTEM_DIR.'/cache/'; 
		
		$this->left_delimiter = '<{'; 
		$this->right_delimiter = '}>'; 	

		$this->caching = false;
		$this->assign('app_name','Settlement');
	}

}
?>
