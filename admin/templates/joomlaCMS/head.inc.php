<link href="templates/joomlaCMS/css/menuTiny.css" media="screen" rel="stylesheet" type="text/css" >
<link href="templates/joomlaCMS/css/rounded.css" media="screen" rel="stylesheet" type="text/css" >
<link href="templates/joomlaCMS/css/general.css" media="screen" rel="stylesheet" type="text/css" >
<link href="templates/joomlaCMS/css/icon.css" media="screen" rel="stylesheet" type="text/css" >
<link href="templates/joomlaCMS/css/menu.css" media="screen" rel="stylesheet" type="text/css" >      
<link href="templates/joomlaCMS/css/style.css" media="screen" rel="stylesheet" type="text/css" >
<link href="templates/joomlaCMS/css/ui.all.css" media="screen" rel="stylesheet" type="text/css" > 


<script type="text/javascript" src="templates/joomlaCMS/js/jquery/jquery-1.4min.js"></script>
<script language="javascript" src="templates/login/js/rainbowText.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/jquery/jquery-1.4min.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/jquery/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/menuTiny.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/submit.js"></script>

<script type="text/javascript" src="templates/joomlaCMS/js/checkall.selectbox.js"></script>

<?php 
$whitelist = array('listening','reading','grammar');

$component = Request::get('option');

if ($component && in_array($component,$whitelist)){
	echo '<script type="text/javascript" src="libs/plugins/ckeditor/ckeditor.js"></script>';
}
?>