<?php
//require_once 'components/system/controller.php';
  class Model {
	protected $_dbo				= null;
	protected $_component 		= null;
	protected $_viewObject 		= null;
	protected $_viewname 		= null;
	
	function __construct($component){
		global $dbo;
		$this->_dbo				= &$dbo;
		$this->_component 		= $component;
	}
	
		
  	function action(){
		if(!$this->_viewObject) $this->setView();
		$this->_viewObject->display();
	}
	
	//ham khoi tao view tuong ung
	//khoi tao view do, gan cho $this->_view
	function setView($viewname='default'){
		if ($viewname){
			$this->_viewname = $viewname;
			if ($this->_component){
				require_once('components/'.$this->_component.'/views/'.$this->_viewname.'/view.html.php');
				
				$temp = explode('_', $this->_component);
				$this->_component = $temp[1];
				
				$view = ucfirst($this->_component).'View'.ucfirst($this->_viewname);
				$this->_viewObject = new $view;
				$this->_viewObject->_component = $this->_component;
				$this->_viewObject->_viewname = $this->_viewname;
			}else {
				Message::setMessage('View name not found!',1);
			}
		}
	}
	
	
	//ham chuyen du lieu sang view de hien thi 
	function assignToView($property,$value){
		if($this->_viewObject){
			$this->_viewObject->$property = $value;
		}
	}
	
	
	
	
 	
	
}