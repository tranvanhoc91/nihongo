<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>ADMINISTRATOR PAGE - MINNANONIHONGO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="templates/login/css/style.css" rel="stylesheet" type="text/css" />
	<link rel="icon" href="templates/login/favico.ico" type="image/gif" />
	
	<script language="javascript" src="templates/login/js/rainbowText.js"></script>
	<script language="javascript" src="../libraries/js/mootools/core.js"></script>
    <script language="javascript" src="../libraries/js/mootools/more.js"></script>
    
    <script language="javascript" src="../libraries/plugins/formcheck/lang/en.js"></script>
    <script language="javascript" src="../libraries/plugins/formcheck/formcheck-yui.js"></script>
    <link rel="stylesheet" href="../libraries/plugins/formcheck/theme/green/formcheck.css" type="text/css" media="screen" />
    
	<script type="text/javascript">
	window.addEvent('domready', function(){
	    new FormCheck('form-login');
	});
	</script>
</head>

<body onload="document.frm_themtv.txtUsername.focus()">
<!-- BEGIN: TOP -->
	<div id="logo"></div>
	<div id="slogan">
		<h2 id="fly" style="color:#FFFFFF;font-size:22px;">ADMINISTRATOR PAGE - MINNANONIHONGO</h2>
		<script language="javascript" src="templates/login/js/flyText.js"></script>
	</div>
<!-- END: TOP -->

<!-- BEGIN: Hộp đăng nhập -->
	<div class="box">
		<!--//  Tiêu đề hộp Login -->
		<div class="welcome" id="welcometitle"> Administrator Login	</div>  
		<div id="fields">
			<form action="index.php" method="post" id="form-login" name="frm_themtv" onsubmit="return validForm(this)">
			<table width="333">    	
		      	<tr><!--//  Tên đăng nhập  -->
		        <td width="79" height="35"><span class="login">Username</span></td>
		        <td width="244" height="35">
		      	<input type="text" name="username"  class="fields validate['required']" /></td>
		      	</tr>      
		      	<tr><!--//  Mật khẩu -->
		        <td height="35"><span class="login">Password</span></td>
		        <td height="35"><input type="password" name="password" class="fields validate['required']" /></td> 
		      	</tr>      
		        <tr style="height:20px;">
		        <td>&nbsp;</td>
		        <td>
		        <span style="color:#F00">
				         
		        </span>
		        </tr>
		    </table>
		    
		    <div id="submit">
		    	<div class="btnsubmit">
					<input type="submit" class="button" name="button" id="button" value="Login" tabindex="3" />
				</div>
		    </div>
		    </form>
		    <p class="back_to_site"><a href="../">Return to site Home Page</a></p>
		</div> 
		
	
<!-- END: Hộp đăng nhập. -->

<!--//  Copyright -->  
		<div class="copyright" id="copyright">
			Copyright &copy; 2010. All rights Reserved.<br />
			Developed by Trần Văn Học-Nguyễn Giang Nam-CN09A-Trường ĐH GTVT TpHCM
		</div>
	</div><!-- END Box -->
</body>
</html>
