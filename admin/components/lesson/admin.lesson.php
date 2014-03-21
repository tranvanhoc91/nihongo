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
			case 'add':
				viewAdd();
				break;
			default:
				viewDefault();
				break;
		}
	}
	
	
	function viewDefault(){
		//global $data;
		require_once('base/class.pagination.php');
		$search = Request::get('search');
		$total = getCountRows($search);
		$lms = Request::get('limitstart',0);
		$pageNav = new Pagination($total,$lms,10);
		//lay ve lesson objects
		$rows = getAllRows($search);
		?>
		<table class="toolbar-fitter" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<td width="100%"><input type="search" name="search" value="<?php echo $search;?>" /><input style="border-radius:8px;margin-left:5px;background:#ccc;" class="search" type="submit" value="Search" /></td>
			</tr>
		</table>
		<table class="adminlist" id="data" cellspacing="0">
			<thead>
            	<tr>
               		<th width="10">STT</th>
                    <th width="10" ><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>
                    <th nowrap="nowrap">Title</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->le_id;?>"  type="checkbox"/></td>
                    <td class="editableSingle categoryName removable"><?php echo $row->le_title;?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->le_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
        <script type="text/javascript" src="js/jquery.inlineEdit.js"></script>
        <script type="text/javascript">
        jQuery.noConflict();
        jQuery( document ).ready(function( $ ) {
            // You can use the locally-scoped $ in here as an alias to jQuery.
        		$.inlineEdit({
        			categoryName: 'ajax.php?type=name&categoryId=',
        			categoryPrice: 'ajax.php?type=price&categoryId=',
        			remove: 'ajax.php?remove&type=price&categoryId='
        		}, {
        			animate: false,
        			filterElementValue: function($o){
        				if ($o.hasClass('categoryPrice')) {
        					return $o.html().match(/\$(.+)/)[1];
        				} else {
        					return $o.html();
        				}
        			},
        			afterSave: function(o){
        				if (o.type == 'categoryPrice') {
        					$('.categoryPrice.id' + o.id).prepend('$');
        				}
        			}
        		});
        });
        </script>
		<?php
		echo '<input type="hidden" name="option" value="lesson" />';
	}
	
	function viewAdd(&$record=null){
	?>
	<div class="t">
 		<div class="t">
			<div class="t"></div>
 		</div>
	</div>
	<div class="m">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr>
		<td valign="top">
			<table class="adminform">
			<tbody>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Lesson</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->le_title;?>" type="search" size="60" name="le_title" /><br></td>
			</tr>
			</tbody></table>
	     </td>
	</tr></tbody></table>
	<div class="clr"></div>
	</div><!-- end m -->
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
	<div class="clr"></div>
	<input type="hidden" name="option" value="lesson" />
	<input type="hidden" name="le_id" value="<?php if($record) echo $record->le_id;?>" />
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
		
		if (checkEmail($email) == false){
			return false;
		}
		return true;
	}
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
	    $title = trim(Request::get('le_title'));
	    if (!$title){
			    Message::setMessage('Please enter title before save',1);
		    }else {
		        if(!$excute->store()){
		    	    Message::setMessage('False',1);
		        }else{
		    	     Message::setMessage('Saved',0);
		        }
		 }
		switch($task){
			case 'save':
				redirect('index.php?option=lesson');
				break;
			case 'savex':
				redirect('index.php?option=lesson&task=add');
				break;
		}		
	}
	
	function setError($msg){
		$errors[] = $msg;
		return $errors;
	}
	
	
	function edit(){
		$excute = includeTable();
		$id = Request::get('id');
		if (count($id) > 0){
			$excute->load($id[0]);
		    viewAdd($excute);	
		}else {
			Message::setMessage('Please select item to edit',1);
			redirect('index.php?option=lesson');
		}
	}
	
	function cancel(){
		$option = Request::get('option');
		redirect('index.php?option='.$option);
	}
	
	
	/**
	 * 
	 * Enter description here ...
	 */
	function delete(){
		global $dbo;
		$id = Request::get('id');
		if (!$id){
			Message::setMessage('Please select item to delete',1);
		}else {
			$excute = includeTable();
		    $excute->delete($id);
		    Message::setMessage(count($id).' Item(s) permanently deleted');
		    //redirect('index.php?option=reading');
		}
		redirect('index.php?option=lesson');
	}
	
/************************************************************************************/
	function getAllRows($searchText){
		global $dbo; 
		$lm = Request::get('limit',10);
		$lms = Request::get('limitstart',0);
		$query = "SELECT le_id, le_title
				  FROM lesson
				  ";
		if ($searchText){
			$query .= " WHERE (`le_title` LIKE '%$searchText%' )"; 
		}
		$query .= " ORDER BY le_id ASC LIMIT $lms,$lm ";
		$dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
	
	/**
	 * 
	 * Dem so record trong table
	 * @param $s
	 * @param $status
	 * @param $active
	 * @param $gid
	 */
	function getCountRows($searchText=''){
		global $dbo;
		$query = "SELECT COUNT(le_id) FROM lesson ";
		if ($searchText){
			$query .= " WHERE (`le_title` LIKE '%$searchText%' )"; 
		}
		$dbo->setQuery($query);
		return $dbo->loadResult();
	}
	
	
?>