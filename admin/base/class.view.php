<?php
class  View{
	var $_layout 	= null;
	var $_component = null;
	var $_viewname 	= null;
	
	function display(){
		
	}
	
	function setLayout($layout='default'){
		if($layout){
			$this->_layout = $layout;
		}
		//include file layout tuong ung
		$layout_file = 'components/com_'.$this->_component.'/views/'.$this->_viewname.'/tmpl/'.$this->_layout.'.php';
		require_once($layout_file);
		
		//$this->includeCssSystem();
	}
	
	function includeCssSystem(){
		global $siteDocument;
	}
	
} 