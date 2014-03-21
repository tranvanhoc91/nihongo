<?php
//xuat du lieu html
//head
//body

//head: title, description, keyword,metadata ....
//head: javascript, stylesheet

//body: message, module, template, element
class SiteDocument {
	//var 	$_doc			= null;
	private $_title 		= null;
	private $_description 	= null;
	private $_keyword		= null;
	private $_scripts		= array();
	private $_stylesheets	= array();
	
	private $_message		= array();
	private $_module		= array();
	public $_template		= null;
	private $_component		= null;
	
	private $_dbo			= null;
	
	function __construct(){
		global $dbo;
		$this->_dbo = $dbo;
		
		$this->setTitle();
		$this->setDescription();
		$this->setKeywords();
		//$this->setScript();
		//$this->setStyleSheet();
		
		
		//$this->setMessages();
		$this->setModule();
		$this->setTemplate();
		$this->_template = $this->setTemplate();
		$this->includeCssModule();
		
		$this->getRequestComponent();
		$this->includeCssComponent();
	}
	
	//tao ra toan bo tai lieu truoc khi day xuong client
	function render(){
		$body = $this->getBody();
		$head = $this->getHeader();
		
		$doc = '<html>'.$head.$body.'</html>';
		//Nen web tren server truoc khi gui xuong client
		header('Content-Encoding:gzip');
        $doc = gzencode($doc);
		
		return $doc;
	}
	
	//thiet lap head cua tai lieu
	function getHeader(){
		$header = '<head>';
		$header .= '<title>'.$this->getTitle().'</title>';
		$header .= '<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">';
		$header .= '<meta content="'.$this->getDescription().'" name="description">';
		$header .= '<meta content="'.$this->getKeywords().'" name="keywords">';
		$header .= '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
		$header .= '<base href="http://localhost/mobileshop/" >';
		$header .= $this->includeStyleSheet();
		$header .= $this->includeScript();
		$header .= '</head>';
		//
		return $header;
	}
	
	function getTitle(){
		return $this->_title;
	}
	
	function getDescription(){
		return $this->_description;
	}
	
	function getKeywords(){
		return $this->_keyword;
	}
	
	function getBody(){
		//getTemplate
		//$this->addScript('admin/libraries/jquery/tooltip.js');
		ob_start();
		//include cac file template
			require_once(TMPL.'/'.$this->_template.'/index.php');
			$templateString = ob_get_contents();
			
		ob_clean();
		//include module
		$templateString	= $this->renderComponent($templateString);
		$templateString = $this->renderModules($templateString);
		
		//element
		//$body .= $this->renderComponent($templateString);
		
		$body = $this->renderMessage($templateString);
		
		return $body;
		
	}
	
	function setTitle($title = 'Bán hàng trực tuyến'){
		$this->_title = $title;
	}
	
	//neu lam tot la phai lay tu trong config
	function setDescription($description = 'des'){
		$this->_description = $description;
	}
	
	function setKeywords($key='computer,it,laptop'){
		$this->_keyword = $key;
	}
	
	function setModule(){
		//global $uo;
		//$gid = $uo->get('gid');
			
		//chua lam phan quyen
		//$this->_dbo->setQuery("SELECT * FROM modules WHERE published = 1 AND access <= $gid ORDER BY position ASC, order ASC");
		$this->_dbo->setQuery("SELECT module,position
								FROM modules 
								WHERE published = 1 
								ORDER BY `position` ASC, `ordering` ASC");
		$this->_modules = $this->_dbo->loadObjectList();
	}
	
	public function setTemplate(){
		$this->_dbo->setQuery("SELECT `title` FROM templates WHERE `default`=1 ");
		$this->_template = $this->_dbo->loadResult();
		return $this->_template;
	}
	
	function includeStyleSheet(){
		$stylesheet = '';
		foreach($this->_stylesheets AS $st){
			$stylesheet .= '<link type="text/css" rel="stylesheet" media="screen" href="'.$st.'">';
		}
		return $stylesheet;
	}
	
	function includeScript(){
		$script = '';
		foreach($this->_scripts AS $sc){
			$script .= '<script language="javascript" src="'.$sc.'"></script>';
		}
		return $script;
	}
	
	function addStyleSheet($stylesheet){
		if($stylesheet){
			$this->_stylesheets[] = $stylesheet;
		}
	}
	
	function addScript($script){
		if($script){
			$this->_scripts[] = $script;
		}
	}
	
	function renderModules($temString){
		//lay ve duong dan include module
		//$module = $this->_modules;
		//echo $this->getLayoutPath($module[1]);
		
		//tim tat ca cac vi tri
		//lap qua moi vi tri va lam viec ben duoi
		$positions = $this->getAllPosition($temString);
		foreach($positions AS $p) {
			//tim ra ten position
			if($p) {
				$tem = explode('"',$p);
				ob_start();
					foreach($this->_modules AS $mod){
						$path =  $this->getLayoutPath($mod->module);
						//var_dump($path);
						if($mod->position==$tem[1])	
							require($path);
					}
					$modString = ob_get_contents();
				ob_clean();
				$temString = str_replace($p,$modString,$temString);
			}
		}
		return $temString;
	}
	
	
	function getRequestComponent(){
		$this->_component = Request::get('option','com_product');
		return $this->_component;
	}
	
	function includeCssComponent(){
		if ($this->_component){
			//neu co thu muc components: vi du: com_user, thi mo thu muc do ra xem co file css nao khong
			$dirname = TMPL.'/'.$this->_template.'/'.'asset/'.COMPONENT.'/'.$this->_component.'/css/';
			if ($dirname){
				$dir = opendir($dirname);
				while (false != ($file = readdir($dir))){
					if ($file != "css" && $file != "..") {
						$f = explode('.', $file);
						if ($f[1] == 'css') //kiem tra xem file do co duoi la css hay khong,Neu co thi include
						{
							$comStyleSheet = $dirname.$file;
							$this->addStyleSheet($comStyleSheet);
						}
					}
				}
			}
		}
	}
	
	function includeCssModule(){
		foreach ($this->_modules AS $m){
			$filestyle = TMPL.'/'.$this->_template.'/asset/'.MODULE.'/'.$m->module.'/css/style.css';
			if (file_exists($filestyle)){
				$this->addStyleSheet($filestyle);
			}
		}
	}
	
	
	function getLayoutPath($module, $layout = 'default'){
	 	$tmpl = $this->setTemplate();
	 	//$tPath = 'TMPL/'.$tmpl.'/html/'.$module.'/'.$layout.'.php';
	 	$tPath = 'TMPL/'.$tmpl.'/html/'.$module.'/'.$layout.'.php';
	 	//$bPath = $_SERVER['DOCUMENT_ROOT'].$_SERVER["REQUEST_URI"].'modules/'.$module.'/'.$module.'.php';
	 	$bPath = 'modules/'.$module.'/tmpl/'.$layout.'.php';
	 	
	 	if (file_exists($tPath)==true) {
			return $tPath;
		} else {
			return $bPath;
		}
	}
	
	
	function requireModulePHP($module){
		$pathrequire =  $_SERVER['DOCUMENT_ROOT'].$_SERVER["REQUEST_URI"].'modules/'.$module.'/'.$module.'.php';
		require_once ($pathrequire);
		echo $pathrequire;
	}
	
	
	
	function renderMessage($temString){
		//lay cac loi
		//xuat cac loi do tai vi tri cua {message}
		//lay cac message
		$ms = Message::getMessage(0);
		//lay cac loi
		$msString = '';
		if($ms) foreach($ms AS $item){
			$msString .=$item->msg.'<br />';
		}
		
		if($msString) $msString = '<div id="system_message">'.$msString.'</div>';
		
		$err= Message::getMessage(1);
		$errString = '';
		if($err) foreach($err AS $item){
			$errString .=$item->msg.'<br />';
		}
		
		if($errString) $errString = '<div id="system_error">'.$errString.'</div>';
		
		$ms = $errString.$msString;
		
		$temString=str_replace('{message}',$ms,$temString);
		
		Message::removeAllMessage();
		
		return $temString;
	}
	
	
	function renderComponent($temString){
		//$this->_component co dang com_product
		$temp = explode('_', $this->_component);
		$comNanme = $temp[1];
		ob_start();
			if($this->_component){
				require_once('admin/base/class.controller.php');
				require_once('admin/base/class.model.php');
				require_once('admin/base/class.view.php');
				
				require_once('components/'.$this->_component.'/controller.php');
				$controller = ucfirst($comNanme).'Controller';
				$controllerObject = new $controller();
				$controllerObject->action();//lam viec voi model
				//$controllerObject->display();//lam viec voi view
				$componentString = ob_get_contents();
			}
		ob_clean();
		
		
		//doi cum {element} bang chuoi hien thi cua view
		$temString = str_replace('{component}',$componentString,$temString);
		return $temString;
	}
	
	
	function getAllPosition($str){
		//tim ra tat ca cac chuoi
		//bat dau bang {modules
		//ket thuc bang }
		//o trong chuoi $str
		//tra ve mang tat ca cac chuoi tim duoc nhu the
		$pos = array();
		while(strpos($str,'}')!=false){
			$i1 	= strpos($str,'{modules');
			$i2 	= strpos($str,'modules}');
			
			$pos[] 	= substr($str,$i1,$i2-$i1+8);
			$str 	= substr($str,$i2+9);
		}
		return $pos;	
	}
}






























class SiteJsonDocument{
	function __construct(){
		global $dbo;
		$this->_dbo = $dbo;
	}
	
	function render(){
		$body = $this->getBody();
		$doc = $body;
		
		//kiem tra xem co nen hay khong
		return $doc;
	}
	
	function getBody(){
		$body	= $this->renderComponent();		
		return $body;
		
	}
	
	function renderComponent(){
		
	}
}

class SiteRssDocument{

}

class SitePDFDocument{

}