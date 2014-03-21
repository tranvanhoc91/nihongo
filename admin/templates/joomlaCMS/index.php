
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>MobileShop - Administrator</title>
        <link rel="icon" href="templates/joomlaCMS/favicon.ico" type="image/gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <meta http-equiv="Refresh" content="3600" >
        <?php require_once('head.inc.php'); ?>
    </head>
    <body id="minwidth-body">
        <div id="border-top" class="h_green">
            <div>
                <div>
                	<span class="title" style="padding-left:100px">Hệ thống quản trị cơ sở dữ liệu - Minnanonihongo</span>
                    <span class="version" >Version 1.0 Alpha</span>
                </div>
            </div>
        </div>
        <div id="header-box">
            <div id="module-status">
                <a href="#">
                    <span class="no-unread-messages">0</span>
                </a>
                <span class="loggedin-users">1</span>
                <span class="logout">
                    <a href="index.php?task=logout">Logout</a>
                </span>
            </div>
            <div id="module-menu">

                <!-- BEGIN: Menu -->
                <ul class="menuTiny" id="menuTiny">
                    <li><a href="index.php" class="menuTinyLink">Home</a></li>
                    <li><a href="index.php?option=lesson" class="menuTinyLink">Lesson</a></li>
                    <li><a href="index.php?option=vocabulary" class="menuTinyLink">Vocabulary</a></li>
                    <li><a href="index.php?option=listening" class="menuTinyLink">Listening</a></li>
                    <li><a href="index.php?option=reading" class="menuTinyLink">Reading</a></li>
                    <li><a href="index.php?option=grammar" class="menuTinyLink">Grammar</a></li>
                    <li><a href="index.php?option=kanji" class="menuTinyLink">Kanji</a></li>
                    <li><a href="index.php?option=testtype" class="menuTinyLink">Test</a></li>
                    <li><a href="index.php?option=question" class="menuTinyLink">Question</a></li>
                    <li><a href="#" class="menuTinyLink">Help</a></li>
                <script type="text/javascript">
                    var menu=new menu.dd("menu");
                    menu.init("menuTiny","menuTinyHover");
                </script><!-- END: Menu -->	
            </div><!-- end module-menu -->
            <div class="clr"></div>
        </div><!-- end header-box -->
        
        <div id="content-box">
            <div class="border">
                <div class="padding">
                    <form id="mainform" action="" method="post" enctype="multipart/form-data">
                    
                        <div id="toolbar-box">
                            <div class="t"><div class="t"><div class="t"></div></div></div>
                            <div class="m">
                            	<div class="toolbar" >
	                            	<?php t_display();  ?>
                            	 </div>
                            </div>
                            <div class="clr"></div>
                            <div class="b"><div class="b"><div class="b"></div></div></div>
                        </div>
                        
                        <!-- end toolbar-box -->
                        <div class="clr"></div>
                        <!-- BEGIN: element-box -->
                        <div id="element-box">
                            <div class="t"><div class="t"><div class="t"> </div></div></div>
                            <div class="m">
                            	<?php Message::dumpMessage(); ?>
                				<?php a_display(); ?>
                            </div>
                            <div class="clr"></div>
                            <div class="b"><div class="b"> <div class="b"> </div></div></div>
                        </div>
                        <!-- END: 	element -->
                    </form>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <!-- end content-box -->
        
        <div id="border-bottom"><div><div></div></div></div>
        <div id="footer">
            <p class="copyright">
			Copyright © 2012 <a target="_black" href="../index.php">www.mobileshop.com</a>  All Rights Reserved.</p>
			<!--<div style="font-size:11px;color:#000000;text-align:center;">
				<h3 id="r1">Lớp CN09A - Khoa Công Nghệ Thông Tin - Trường Đại học Giao Thông Vận Tải TpHCM</h3>
				<script type="text/javascript">
					var r1=document.getElementById("r1"); //get span to apply rainbow
					var myRainbowSpan=new RainbowSpan(r1, 0, 360, 255, 50, 18); //apply static rainbow effect
					myRainbowSpan.timer=window.setInterval("myRainbowSpan.moveRainbow()", myRainbowSpan.speed);
				</script>
			</div>
        --></div>
    </body>
</html>

