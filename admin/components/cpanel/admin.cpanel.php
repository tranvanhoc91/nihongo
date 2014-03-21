<?php
	function a_display(){
		ob_start();
			require_once 'components/cpanel/admin.cpanel.html.php';
			$cp = ob_get_contents();
		ob_clean();
		
		echo $cp;
	}
    
    function getUsernameLogined(){
  		global $dbo;
        $uid = $_SESSION['au']->id;
		$dbo->setQuery("SELECT username
						FROM `users` 
						WHERE id = $uid
						");
		return $dbo->loadObjectList();
    }
    
    function getUserLoginedIn($uid,$username,$ip){
		global $dbo;
        
		$dbo->setQuery("SELECT `user_id`,username
						FROM `sessions` 
						INNER JOIN users
						ON sessions.user_id = users.id
						WHERE `ip` = '$ip' 
						AND username = '$username'
						");
		return $dbo->loadObjectList();
	} 
    
    function getPopularArticle(){
        global $dbo;
        $dbo->setQuery("SELECT articles.id,articles.title as atitle,categories.title ctitle,hits,
								DATE_FORMAT(created ,' %d.%m.%Y <span>%H:%i</span> ' ) as created
								FROM articles 
                                INNER JOIN categories 
                                ON categories.id = articles.category_id
								WHERE trash = 0
								ORDER BY hits DESC 
								LIMIT 5 ");
		return $dbo->loadObjectList();
    }
    
    function getPopularProduct(){
        global $dbo;
        $dbo->setQuery("SELECT title,price,quantity,name
								FROM products 
                                INNER JOIN manufacturer 
                                ON manufacturer.id = products.manufacturer_id
								WHERE trash = 0 AND published = 1
								LIMIT 5 ");
		return $dbo->loadObjectList();
    }
?>