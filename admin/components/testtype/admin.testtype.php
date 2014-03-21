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
			case 'cancel':
				cancel();
				break;	
			default:
				viewDefault();
				break;
		}
	}
	
	
	function viewDefault(){
		require_once('base/class.pagination.php');
		$search = Request::get('search');
		$lms = Request::get('limitstart',0);
		$total = getCountRows($search);
		$pageNav = new Pagination($total,$lms,10);
		$rows = getAllRows($search);
		?>
		<table class="toolbar-fitter" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<td width="100%"><input type="search" name="search" value="<?php echo $search;?>" /><input style="border-radius:8px;margin-left:5px;background:#ccc;" class="search" type="submit" value="Search" /></td>
			</tr>
		</table>
		
		<table class="adminlist">
			<thead>
            	<tr>
               		<th width="10">STT</th>
                    <th width="10" ><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>
                    <th nowrap="nowrap">Type</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->t_id; ?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $row->t_type;?></a></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->t_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="testtype" />';
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
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Type</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->t_type;?>" type="search" size="60" name="t_type" /><br></td>
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
	<input type="hidden" name="option" value="testtype" />
	<input type="hidden" name="t_id" value="<?php if($record) echo $record->t_id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
//Cac function process
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
	    
	    $type = trim(Request::get('t_type'));
	    if (!$type){
			    Message::setMessage('Please enter full',1);
		    }else {
		        if(!$excute->store()){
		    	    Message::setMessage('False',1);
		        }else{
		    	     Message::setMessage('Saved',0);
		        }
		 }
		switch($task){
			case 'save':
				redirect('index.php?option=testtype');
				break;
			case 'savex':
				redirect('index.php?option=testtype&task=add');
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
		$excute->load($id[0]);
		viewAdd($excute);	
	}
	
	function cancel(){
		$option = Request::get('option');
		redirect('index.php?option='.$option);
	}
	
	
	function delete(){
		$id = Request::get('id');
		$excute = includeTable();
		$excute->delete($id);
		//redirect('index.php?option=vocabulary');
		viewDefault();	
	}
	
	
	
/************************************************************************************/
	/**
	 * 
	 * Enter description here ...
	 * @param $searchText
	 */
	function getCountRows($searchText=''){
		global $dbo;
		$query = "SELECT COUNT(t_id) FROM testtype ";
		if ($searchText){
			$query .= " WHERE (`t_type` LIKE '%$searchText%' 
			             )"; 
		}
		$dbo->setQuery($query);
		return $dbo->loadResult();
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $searchText
	 * @param $lessonId
	 */
	function getAllRows($searchText=''){
		global $dbo; 
		$lm = Request::get('limit',10);
		$lms = Request::get('limitstart',0);
		$query = "SELECT t_id, t_type FROM testtype ";
		if ($searchText){
			$query .= " WHERE (`t_type` LIKE '%$searchText%' 
			             )"; 
		}
		$query .= " ORDER BY t_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>