<?php
class ModuleObject{
	protected $_dbo;
	protected $_module;
	protected $_modTitle;
	protected $_modPosition;
	
	function __construct($module){
		global $dbo;
		$this->_dbo 		= $dbo;
		$this->_module 		= $module;
		
	}
	
	function getTitleModule(){
		$this->_dbo->setQuery("SELECT show_title,title
								FROM modules 
								WHERE published = 1 
								AND module = '$this->_module'");
		$this->_modTitle = $this->_dbo->loadObject();
		if ($this->_modTitle->show_title == 1 ) 
			return $this->_modTitle->title;
		else 
			return null;
	}
	
	function getPositionModule(){
		$this->_dbo->setQuery("SELECT position
								FROM modules 
								WHERE published = 1 
								AND module = '$this->_module'");
		$this->_modPosition = $this->_dbo->loadObject();
		return $this->_modPosition->position;
	}
	
	function getAccessModule(){
		
	}
}