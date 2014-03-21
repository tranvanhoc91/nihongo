<?php
//ham dieu khien
	function a_display(){
		global $task;
		switch($task){
			case 'edit':
				edit();
				break;
			case 'delete':
				delete();
				break;
			case 'save':
			case 'savex':
				save();
				break;
			case 'status':
				changeUserStatus();
				break;
			case 'publish':
			case 'unpublish':
				updateUserBlock($task);
				break;
			case 'active':
				changeUserActivation();
				break;
			case 'activation':
			case 'unactivation':
				updateActivation($task);
				break;
			case 'add':
				viewAdd();
				break;
			default:
				viewDefault();
				break;
		}
	}
	
	
	function viewDefault(){
		require_once('base/class.pagination.php');
		$search = Request::get('search');
		$status = Request::get('status');
		$activation = Request::get('actived');
		//$ugroups = Request::get('group_id');
		$total = getCountUser($search,$status,$activation);
		$lms = Request::get('limitstart',0);
		$pageNav = new Pagination($total,$lms,10);
		$users = getAllUser($search,$status,$activation);
		?>
		
		<table class="toolbar-fitter" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<td width="100%"><input type="text" name="search" value="<?php echo $search;?>" /><input style="border-radius:8px;margin-left:5px;background:#ccc;" class="search" type="submit" value="Search" /></td>
				<td nowrap="nowrap">
					<?php  //getSelectGroupToSearch(); ?>
					<select name="actived">
						<option value="">--Select activation--</option>
						<option value="1">Actived</option>
						<option value="0">Unactived</option>
					</select>
					
					<select name="status">
						<option value="">--Select status--</option>
						<option value="1">Block</option>
						<option value="0">Unblock</option>
					</select>
					
					<input class="next" type="submit" name="search-fitter" value="Xem" />
				</td>
			</tr>
		</table>
		
		<table class="adminlist">
			<thead>
            	<tr>
               		<th width="10">STT</th>
                    <th width="10" ><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>
                    <th nowrap="nowrap">Name</th>
                    <th nowrap="nowrap">Username</th>
                    <th nowrap="nowrap">Email</th>
                    <th nowrap="nowrap">Group</th>
                    <th nowrap="nowrap">Logined In</th>
                    <th nowrap="nowrap">Actived</th>
                    <th nowrap="nowrap">Block</th>
                    <th nowrap="nowrap">registerDate</th>
                    <th nowrap="nowrap">lastvisitDate</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($users AS $user) {
			$class = $user->block ? 'published':'unpublished';
			$block = '<a href="index.php?option=users&task=status&id='.$user->id.'" class="'.$class.'">&nbsp;</a>';
			
			$class = $user->actived ? 'activation':'unactivation';
			$activation = '<a href="index.php?option=users&task=active&id='.$user->id.'" class="'.$class.'">&nbsp;</a>';
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $user->id;?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $user->name;?></td>
                    <td><a href=""><?php echo $user->username;?></td>
                    <td><a href=""><?php echo $user->email;?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo getGroupUser($user->group_id); ?></td>
                    <td>
                    <?php  
                    	$uid_login = getUserLoginedIn($user->id,$user->username,$_SERVER['REMOTE_ADDR']);
                    ?>
                    </td>
                    <td><?php echo $activation;?></td>
                    <td><?php echo $block;?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $user->registerDate;?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $user->lastvisitDate;?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $user->id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="users" />';
	}
	
	function viewAdd(&$record=null){
	?>
	<div class="col width-45">
		<fieldset class="adminform">
		<legend>User Details</legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
						<td class="key" width="150"><label for="name">Name</label></td>
						<td>
							<input name="name" value="<?php if($record) echo $record->name;?>" id="name" class="inputbox" size="40" type="text">
						</td>
					</tr>
					<tr>
						<td class="key"><label for="username">Username</label></td>
						<td>
							<input name="username" value="<?php if($record) echo $record->username;?>" id="username" class="inputbox" size="40" autocomplete="off" type="text" />
						</td>
					</tr>
					<tr>
						<td class="key"><label for="email">E-mail</label></td>	
						<td>
							<input class="inputbox" name="email" value="<?php if($record) echo $record->email;?>" id="email" size="40" value="" type="text">
						</td>
					</tr>
					
					<tr>
						<td class="key"><label for="password">New Password</label></td>			
						<td>
							<input class="inputbox" name="password" id="password" size="40" value="" type="password">
						</td>
					</tr>
					<tr>
						<td class="key"><label for="password2">Verify Password</label></td>
						<td>
							<input class="inputbox" name="re-password" id="password2" size="40" value="" type="password">
						</td>
					</tr>
					
					<tr>
						<td class="key" valign="top"><label for="gid">Group</label></td>
						<td><?php if ($record) getAllSelectGroupUser($record->group_id); else getAllSelectGroupUser(); ?></td>
					</tr>
					
					<tr>
						<td class="key">Block</td>
						<td>
						<?php if ($record){?>
							<input id="block1" class="inputbox" size="1" type="radio" name="block" value="1" <?php if($record && $record->block==1) echo 'checked="checked"' ?> /> <label for="block1">Yes</label>
							<input id="block0" class="inputbox" size="1" type="radio" name="block" value="0" <?php if($record && $record->block==0) echo 'checked="checked"' ?> /> <label for="block0">No</label>
						<?php }else {?>
							<input id="block1" class="inputbox" size="1" type="radio" name="block" value="1"  /> <label for="block1">Yes</label>
							<input type="radio" name="block" value="0" checked="checked" id="block1" class="inputbox" size="1"  /> <label for="block0">No</label>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td class="key">Activation</td>
						<td>
						<?php if ($record){?>
							<input id="actived" class="inputbox" size="1" type="radio" name="actived" value="1" <?php if($record && $record->actived==1) echo 'checked="checked"' ?> /> <label for="block1">Yes</label>
							<input id="unactived" class="inputbox" size="1" type="radio" name="actived" value="0" <?php if($record && $record->actived==0) echo 'checked="checked"' ?> /> <label for="block0">No</label>
						<?php }else {?>
							<input id="actived" class="inputbox" size="1" type="radio" name="actived" value="1" checked="checked" /> <label for="block1">Yes</label>
							<input id="actived" class="inputbox" size="1" type="radio" name="actived" value="0"    /> <label for="block0">No</label>
						<?php } ?>
						</td>
					</tr>
					<?php 
					if ($record && $record->registerDate){ ?>
						<tr>
							<td class="key">Register Date</td>	
							<td><?php echo $record->registerDate; ?></td>
							<input type="hidden" name="registerDate" value="<?php echo $record->registerDate; ?>" />
						 </tr>
					<?php }else { ?> 
						<input type="hidden" name="registerDate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
					<?php } 
					if ($record && $record->lastvisitDate){ ?>
						<tr>
							<td class="key">Last Visit Date</td>	
							<td><?php echo $record->lastvisitDate; ?></td>
							<input type="hidden" name="lastvisitDate" value="<?php echo $record->lastvisitDate; ?>" />
						 </tr>
					<?php } ?> 
				</tbody>
			</table>
		</fieldset>
	</div>
	<div class="col width-55">
		<fieldset class="adminform">
		<legend>Parameters</legend>
			<table class="admintable">
				<tbody>
					<tr>
						<td><table class="paramlist admintable" width="100%" cellspacing="1">
							<tbody><tr>
							<td class="paramlist_key" width="40%"><span class="editlinktip"><label id="paramsadmin_language-lbl" for="paramsadmin_language" class="hasTip">Back-end Language</label></span></td>
							<td class="paramlist_value"><select name="params[admin_language]" id="paramsadmin_language" class="inputbox"><option value="" selected="selected">- Select Language -</option><option value="en-GB">English (United Kingdom)</option></select></td>
							</tr>
							<tr>
							<td class="paramlist_key" width="40%"><span class="editlinktip"><label id="paramslanguage-lbl" for="paramslanguage" class="hasTip">Front-end Language</label></span></td>
							<td class="paramlist_value"><select name="params[language]" id="paramslanguage" class="inputbox"><option value="" selected="selected">- Select Language -</option><option value="en-GB">English (United Kingdom)</option></select></td>
							</tr>
							<tr>
							<td class="paramlist_key" width="40%"><span class="editlinktip"><label id="paramseditor-lbl" for="paramseditor" class="hasTip">User Editor</label></span></td>
							<td class="paramlist_value"><select name="params[editor]" id="paramseditor" class="inputbox"><option value="" selected="selected">- Select Editor -</option><option value="none">Editor - No Editor</option><option value="tinymce">Editor - TinyMCE</option></select></td>
							</tr>
							<tr>
							<td class="paramlist_key" width="40%"><span class="editlinktip"><label id="paramshelpsite-lbl" for="paramshelpsite" class="hasTip">Help Site</label></span></td>
							<td class="paramlist_value"><select name="params[helpsite]" id="paramshelpsite" class="inputbox"><option value="" selected="selected">Local</option><option value="http://help.joomla.org">English (GB) - help.joomla.org</option><option value="http://comunidadjoomla.org"> Spanish -comunidadjoomla.org</option><option value="http://www.joomla.it"> Italian - joomla.it</option><option value="http://help.joomla.org.hu"> Hungarian -joomla.org.hu</option><option value="http://hilfe.jgerman.de"> German -hilfe.jgerman.de</option><option value="http://help.joomlacommunity.eu"> Dutch(NL) - help.joomlacommunity.eu</option><option value="http://www.joomla.cat"> Catalan - joomla.cat</option><option value="http://help.joomla.fr"> French - Joomla.fr</option><option value="http://joomfa.org"> Farsi - Joomfa.org</option><option value="http://help15.joomlainorge.no/"> Norwegian - joomlainorge.no</option><option value="http://www.joomla-ua.org/help/"> Ukrainian - joomla-ua.org</option></select></td>
							</tr>
							<tr>
							<td class="paramlist_key" width="40%"><span class="editlinktip"><label id="paramstimezone-lbl" for="paramstimezone" class="hasTip">Time Zone</label></span></td>
							<td class="paramlist_value"><select name="params[timezone]" id="paramstimezone" class="inputbox"><option value="-12">(UTC -12:00) International Date Line West</option><option value="-11">(UTC -11:00) Midway Island, Samoa</option><option value="-10">(UTC -10:00) Hawaii</option><option value="-9.5">(UTC -09:30) Taiohae, Marquesas Islands</option><option value="-9">(UTC -09:00) Alaska</option><option value="-8">(UTC -08:00) Pacific Time (US &amp; Canada)</option><option value="-7">(UTC -07:00) Mountain Time (US &amp; Canada)</option><option value="-6">(UTC -06:00) Central Time (US &amp; Canada), Mexico City</option><option value="-5">(UTC -05:00) Eastern Time (US &amp; Canada), Bogota, Lima</option><option value="-4">(UTC -04:00) Atlantic Time (Canada), Caracas, La Paz</option><option value="-4.5">(UTC -04:30) Venezuela</option><option value="-3.5">(UTC -03:30) St. John's, Newfoundland and Labrador</option><option value="-3">(UTC -03:00) Brazil, Buenos Aires, Georgetown</option><option value="-2">(UTC -02:00) Mid-Atlantic</option><option value="-1">(UTC -01:00) Azores, Cape Verde Islands</option><option value="0" selected="selected">(UTC 00:00) Western Europe Time, London, Lisbon, Casablanca, Reykjavik</option><option value="1">(UTC +01:00) Amsterdam, Berlin, Brussels, Copenhagen, Madrid, Paris</option><option value="2">(UTC +02:00) Istanbul, Jerusalem, Kaliningrad, South Africa</option><option value="3">(UTC +03:00) Baghdad, Riyadh, Moscow, St. Petersburg</option><option value="3.5">(UTC +03:30) Tehran</option><option value="4">(UTC +04:00) Abu Dhabi, Muscat, Baku, Tbilisi</option><option value="4.5">(UTC +04:30) Kabul</option><option value="5">(UTC +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option><option value="5.5">(UTC +05:30) Bombay, Calcutta, Madras, New Delhi, Colombo</option><option value="5.75">(UTC +05:45) Kathmandu</option><option value="6">(UTC +06:00) Almaty, Dhaka</option><option value="6.5">(UTC +06:30) Yagoon</option><option value="7">(UTC +07:00) Bangkok, Hanoi, Jakarta, Phnom Penh</option><option value="8">(UTC +08:00) Beijing, Perth, Singapore, Hong Kong</option><option value="8.75">(UTC +08:00) Ulaanbaatar, Western Australia</option><option value="9">(UTC +09:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option><option value="9.5">(UTC +09:30) Adelaide, Darwin, Yakutsk</option><option value="10">(UTC +10:00) Eastern Australia, Guam, Vladivostok</option><option value="10.5">(UTC +10:30) Lord Howe Island (Australia)</option><option value="11">(UTC +11:00) Magadan, Solomon Islands, New Caledonia</option><option value="11.5">(UTC +11:30) Norfolk Island</option><option value="12">(UTC +12:00) Auckland, Wellington, Fiji, Kamchatka</option><option value="12.75">(UTC +12:45) Chatham Island</option><option value="13">(UTC +13:00) Tonga</option><option value="14">(UTC +14:00) Kiribati</option></select></td>
							</tr>
							</tbody>
						</table></td>
					</tr>
				</tbody></table>
		</fieldset>
		<fieldset class="adminform">
		<legend>Contact Information</legend>
					<table class="admintable">
				<tbody><tr>
					<td>
						<br>
						<span class="note">
							No Contact details linked to this User:
							<br>
							See Components ⇒Contact⇒ Manage Contacts for details.
						</span>
						<br><br>
					</td>
				</tr>
			</tbody></table>
				</fieldset>
	</div>
	<div class="clr"></div>
	<input type="hidden" name="option" value="users" />
	<input type="hidden" name="lastvisitDate" value="<?php if($record) echo $record->lastvisitDate;?>" />
	<input type="hidden" name="id" value="<?php if($record) echo $record->id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
//Cac function process

	function checkEmail($email){
		if ($email == null){
			Message::setMessage('Please enter email.', 1);
			return false;
		}
		
		if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-])*[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-])*[@]{1}[_a-zA-Z-]*[.]{1}[_a-zA-z-]{2,4}",$email) ){
			Message::setMessage('Email is invalid.', 1);
			return false;
		}
		
		global $dbo;
		$dbo->setQuery("SELECT `email` 
						FROM `users` 
						WHERE `email` = '$email'");
		$result = $dbo->loadResult();
		//neu khong co tra ve gia tri null,neu co tri tra ve email can check
		if ($result){
			Message::setMessage('Email already exists.', 1);
			return false; // tuc la chua ton tai email nay
		}
		return true;
	}
	
	function checkUsername($username){
		if ($username == null){
			Message::setMessage('Please enter username.', 1);
			return false;
		}
		
		if (preg_match("/[_0-9-]/i",$username)){
			Message::setMessage('Username do not match‘. ', 1);
			return false;
		}
		
		if (strlen($username) <= 3){
			Message::setMessage('The lengh must more 3 characters . ', 1);
			return false;
		}
		
		if (preg_match("/ /i", $username)){
			Message::setMessage('The username do not match. ', 1);
			return false;
		}
		
		global $dbo;
		$dbo->setQuery("SELECT `username`
						FROM `users` 
						WHERE `username` = '$username' ");
		$result = $dbo->loadResult();
		//neu khong co tra ve gia tri null,neu co tri tra ve username can check
		if ($result){
			Message::setMessage('Username ready exist. ', 1);
			return false; // tuc la chua ton tai username nay
		}
		
		return true;
	}
	
	
	function checkValueBeforeSave(){
		$username = Request::get('username');
		$email = Request::get('email');
		
		//if (checkUsername($username) == false){
			//return false;
		//
		if (checkEmail($email) == false){
			return false;
		}
		
		return true;
	}
	
	
	
	function save(){
		$user = includeTable();
		$user->bind();
		
		if (checkValueBeforeSave() == true){
			$id = Request::get('id');
			$password = Request::get('password');
			$repass = Request::get('re-password');
			if ($id){//truong hop edit
				if (!$password){ //neu ko edit password
					global $dbo;
					$dbo->setQuery("SELECT `password` FROM users WHERE id = $id");
					$upass = $dbo->loadObject();
					$user->password = $upass->password;
					if(!$user->store()){
						Message::setMessage('False',1);
					}else {
						Message::setMessage('Saved',0);
					}
				}else {//neu edit password
					if ($password != $repass) Message::setMessage('Two password do not match',1);
					elseif (strlen($password) < 6 ) Message::setMessage('The length of password must more 6 characters',1);
					else {
						$user->password = md5($password);
						if(!$user->store()){
							Message::setMessage('False',1);
						}else {
							Message::setMessage('Saved',0);
						}
					}
				}
			}else { //truong hop add
				if ($password != $repass) Message::setMessage('Two password do not match',1);
				elseif (strlen($password) < 6) Message::setMessage('The length of password must more 6 characters',1);
				else {
					$user->password = md5($password);
					if(!$user->store()){
						Message::setMessage('False',1);
					}else {
						Message::setMessage('Saved',0);
					}
				}
			}
		} //end kiem tra value truoc khi save
		global $task;
		switch($task){
			case 'save':
				redirect('index.php?option=users');
				break;
			case 'savex':
				redirect('index.php?option=users&task=add');
				break;
		}		
	}
	
	function setError($msg){
		$errors[] = $msg;
		return $errors;
	}
	
	
	function edit(){
		$user = includeTable();
		$id = Request::get('id');
		$user->load($id[0]);
		viewAdd($user);	
	}
	
	function delete(){
		$id = Request::get('id');
		$user = includeTable();
		$user->delete($id);
		viewDefault();	
	}
	
	function updateUserBlock($task){
		//lay danh sach cac record can thay doi trang thai block
		$id = Request::get('id');
		$p = $task == 'block' ? 1 : 0;
		$query = " UPDATE `users` SET `block` = ".$p." WHERE `id` IN(".implode(',',$id).") ";
		global $dbo;
		$dbo->setQuery($query);
		$dbo->query();
		viewDefault();
	}
	
	function changeUserStatus(){
		$id = Request::get('id');
		if($id){
			$user = includeTable();
			$user->load($id);
			if($user->block==1) $user->block = 0;
			else $user->block = 1;
			$user->store();
		}
		 viewDefault();
	}
	
	function updateUserActivation($task){
		$id = Request::get('id');
		$act = $task=='actived' ? 1 : 0;
		$query = " UPDATE users SET `actived` = ".$act." WHERE id IN(".implode(',',$id).") ";
		global $dbo;
		$dbo->setQuery($query);
		$dbo->query();
		 viewDefault();
	}
	
	function changeUserActivation(){
		$id = Request::get('id');
		if($id){
			$user = includeTable();
			$user->load($id);
			if($user->actived == 1) $user->actived = 0;
			else $user->actived = 1;
			$user->store();
		}
		 viewDefault();
	}
	
/************************************************************************************/
	function getAllUser($s='',$status='',$active='',$gid=''){	//lay tat cac cac user de hien thi ra luoi du lieu
		global $dbo; 
		$lm = Request::get('limit',10);
		$lms = Request::get('limitstart',0);
		
		$query = "SELECT users.id,username,password,email,actived,block,registerDate,lastvisitDate,group_id,name
				  FROM users
				  ";
		
		$where = array();
		if($s) {
			$where[] .= " (`name` LIKE '%$s%' OR `username` LIKE '%$s%' OR `email` LIKE '%$s%')"; 
		}
		
		switch ($status){
			case '1': $where[] .= " `block` = '1' ";
				break;
			case '0':$where[] .= " `block` = '0' ";
				break;
		}
		
		switch ($active){
			case '1': $where[] .= " `actived` = '1' ";
				break;
			case '0':$where[] .= " `actived` = '0' ";
				break;
		}
		/*
		if ($gid) {
			$where[] .= " `group_id` = $gid";
		}
		*/
		
		if (count($where) == 1){
			$query .= "WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		
		$query .= " ORDER BY id ASC LIMIT $lms,$lm ";
		
		$dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
	
	
	function getCountUser($s='',$status='',$active='',$gid=''){
		global $dbo;
		$lm = Request::get('limit',10);
		$lms = Request::get('limitstart',0);
		
		$query = "SELECT COUNT(id) FROM users ";
		
		$where = array();
		if($s) {
			$where[] .= " (`name` LIKE '%$s%' OR `username` LIKE '%$s%' OR `email` LIKE '%$s%')"; 
		}
		switch ($status){
			case '1': $where[] .= " `block` = '1' ";
				break;
			case '0':$where[] .= " `block` = '0' ";
				break;
		}
		
		switch ($active){
			case '1': $where[] .= " `actived` = '1' ";
				break;
			case '0':$where[] .= " `actived` = '0' ";
				break;
		}
		
		/*
		if ($gid) {
			$where[] .= " `group_id` = $gid";
		}
		*/
		if (count($where) == 1){
			$query .= "WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		
		$dbo->setQuery($query);
		return $dbo->loadResult();
	}
	
	
	
//Lay ve nhom user cua mot user trong viewDefault
	function getGroupUser($gu){
		global $dbo;
		$dbo->setQuery("SELECT name FROM groups WHERE id = '$gu' ");
		$ugroup = $dbo->loadObjectList();
		foreach ($ugroup AS $ugroup)
			return $ugroup->name;
	}

	
//Lay ve danh sach nhom user ->> tim kiem 
	function getSelectGroupToSearch() {
		global $dbo;
		$dbo->setQuery("SELECT name,id FROM groups ORDER BY id ASC ");
		$group = $dbo->loadObjectList();
			echo '<select name="group_id">';
				echo '<option value="">--Select group--</option>';
			foreach ($group as $group){?>
				<option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
			<?php }
			echo '</select>';
	}
	
	function getAllSelectGroupUser($uid='') {
		global $dbo;
		$dbo->setQuery("SELECT name,id FROM groups ORDER BY id DESC ");
		$ugroup = $dbo->loadObjectList();
			echo '<select name="group_id">';
			foreach ($ugroup as $group){?>
				<option <?php if($group->id == $uid) echo 'selected="selected"'?> value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
			<?php }
			echo '</select>';
	}
	
	//lay ve user da-dang dang nhap vao trang quan tri
	function getUserLoginedIn($uid,$username,$ip){
		global $dbo;
		$dbo->setQuery("SELECT `user_id`,username
						FROM `sessions` 
						INNER JOIN users
						ON sessions.user_id = users.id
						WHERE `ip` = '$ip' 
						AND username = '$username'
						");
		$uid_login = $dbo->loadObjectList();
		foreach ($uid_login AS $uLogin)
			if ($uid = $uLogin->user_id) echo '<a class="activation"</a>';
	} 
?>