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
    
	
	/**
	 * 
	 * Enter description here ...
	 * @param $limit
	 */
    function getLastListening($limit=5){
        global $dbo;
        $dbo->setQuery("SELECT li_id,`li_title`,le_title
								FROM listening 
                                INNER JOIN lesson 
                                ON listening.li_lesson_id = lesson.le_id
                                ORDER BY li_id DESC 
								LIMIT  ".$limit);
		return $dbo->loadObjectList();
    }
    
    /**
     * 
     * Enter description here ...
     * @param $limit
     */
    function getLastReading($limit=5){
        global $dbo;
        $dbo->setQuery("SELECT `r_id`,`r_lesson_id`,`r_title`,le_title
								FROM reading 
                                INNER JOIN lesson 
                                ON reading.r_lesson_id = lesson.le_id
                                ORDER BY r_id DESC 
								LIMIT  ".$limit);
		return $dbo->loadObjectList();
    }
    
    
    function getLastKanji($limit=5){
        global $dbo;
        $dbo->setQuery("SELECT `k_id`, k_kanji,k_mean_kanji, k_mean_en, k_mean_vi
								FROM kanji 
                                ORDER BY k_id DESC 
								LIMIT  ".$limit);
		return $dbo->loadObjectList();
    }
?>