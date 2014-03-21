<?php

class Controller {
	protected  $_dbo 		;
	protected $_modelObject 	= null;
	protected $_modelname 		= null;
	public  $_component 		= null;
	protected $_request 		= null;
	protected $_params 			= array();
	
	
	function __construct($component){
		global $dbo;
		$this->_dbo				= &$dbo;
		if ($component){
			$temp = explode('_', $component);
			$this->_component = $temp[1];
		}
	}
	
	function action(){
		if(!$this->_modelObject) $this->setModel();
		$this->_modelObject->action();
		
	}
	
	//ham khoi tao model tuong ung voi component
	//khoi tao model do, gan cho $this->_model
	function setModel($modelname='default'){
		if ($modelname){
			if ($this->_component){
			require_once('components/com_'.$this->_component.'/models/'.$modelname.'.php');
			$model = ucfirst($this->_component).'Model'.ucfirst($modelname);
			$this->_modelObject = new $model;
			//var_dump($this->_modelObject);
			}else 
				Message::setMessage('Model name not found!',1);
		}
	}
	
	//ham chuyen du lieu sang model de model xu ly
	function assignToModel($property,$value){
		if ($this->_modelObject){
			$this->_modelObject->$property = $value;
		}
	}
	
}