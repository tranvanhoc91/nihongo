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
		$typeId = Request::get('q_type');
		$lms = Request::get('limitstart',0);
		$total = getCountRows($search);
		$pageNav = new Pagination($total,$lms,50);
		$rows = getAllRows($search,$typeId);
		?>
		<table class="toolbar-fitter" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<td width="100%"><input type="search" name="search" value="<?php echo $search;?>" /><input style="border-radius:8px;margin-left:5px;background:#ccc;" class="search" type="submit" value="Search" /></td>
				<td nowrap="nowrap">
					<?php  getTypeList(); //getTestTypeList(); ?>
					<input class="next" type="submit" name="search-fitter" value="Xem" />
				</td>
			</tr>
		</table>
		
		<table class="adminlist">
			<thead>
            	<tr>
               		<th width="10">STT</th>
                    <th width="10" ><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>
                    <th nowrap="nowrap">Question</th>
                    <th nowrap="nowrap">Anwser 1</th>
                    <th nowrap="nowrap">Anwser 2</th>
                    <th nowrap="nowrap">Anwser 3</th>
                    <th nowrap="nowrap">Anwse 4</th>
                    <th nowrap="nowrap">Correct</th>
                    <th nowrap="nowrap">Test Type</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->q_id; ?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $row->q_question;?></a></td>
                    <td><?php echo $row->q_anwser1;?></td>
                    <td><?php echo $row->q_anwser2;?></td>
                    <td><?php echo $row->q_anwser3;?></td>
                    <td><?php echo $row->q_anwser4;?></td>
                    <td><?php echo 'Anwser '.$row->q_correct;?></td>
                    <td><?php echo getTestType($row->q_type); ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->q_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="question" />';
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
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Test Type</p></td>
				<td><?php if ($record) getTypeList($record->q_type); else getTypeList(); ?></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Question</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->q_question;?>" type="search" size="60" name="q_question" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Anwser 1</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->q_anwser1;?>" type="search" size="60" name="q_anwser1" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Anwser 2</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->q_anwser2;?>" type="search" size="60" name="q_anwser2" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Anwser 3</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->q_anwser3;?>" type="search" size="60" name="q_anwser3" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Anwser 4</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->q_anwser4;?>" type="search" size="60" name="q_anwser4" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Correct</p></td>
				<td>
				    <select name="q_correct" style="width:330px;height:30px;">
				    <?php 
				    for ($i = 1; $i <= 4; $i++){
				    	if ($record && $record->q_correct == $i){
				    		echo '<option selected="selected" value="'.$i.'">Anwser '.$i.'</option>';
				    	}else {
				    	    echo '<option value="'.$i.'">Anwser '.$i.'</option>';	
				    	}
				    ?>   	
				    <?php }?>
				    </select>
				<br></td>
			</tr>
			</tbody></table>
	</td></tr></tbody></table>
	<div class="clr"></div>
	</div><!-- end m -->
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
	<div class="clr"></div>
	<input type="hidden" name="option" value="question" />
	<input type="hidden" name="q_id" value="<?php if($record) echo $record->q_id;?>" />
	<div class="clr"></div>
	<!--<?php
	}
	
	
//Cac function process
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
		$question = trim(Request::get('q_question'));
		$anwser1 = trim(Request::get('q_anwser1'));
		$anwser2 = trim(Request::get('q_anwser2'));
		$anwser3 = trim(Request::get('q_anwser3'));
		$anwser4 = trim(Request::get('q_anwser4'));
		$type = Request::get('q_type');
		$correct = trim(Request::get("q_correct"));
		
	  if (!$question || !$anwser1 || !$anwser2 || !$anwser3 || !$anwser2 || !$type ){
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
				redirect('index.php?option=question');
				break;
			case 'savex':
				redirect('index.php?option=question&task=add');
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
	 * Hien thi test type
	 * @param $lessionId
	 */
	function getTestType($tid){
		global $dbo;
		$dbo->setQuery("SELECT t_type FROM testtype WHERE t_id = '$tid' ");
		$row = $dbo->loadObjectList();
		foreach ($row AS $r)
			return $r->t_type;
	}
	
	
	/**
	 * 
	 * Get list of the lesson to search
	 */
/*	function getTestTypeList() {
		global $dbo;
		$dbo->setQuery("SELECT t_id,t_type FROM testtype ORDER BY t_id ASC ");
		$rows = $dbo->loadObjectList();
			echo '<select name="q_type">';
				echo '<option value="">--Select Type--</option>';
			foreach ($rows as $row){?>
				<option value="<?php echo $row->t_id; ?>"><?php echo $row->t_type; ?></option>
			<?php }
			echo '</select>';
	}*/
	
	
	/**
	 * 
	 * Hien thi list type khi add/ edit/ search
	 * @param $lid
	 */
	function getTypeList($id='') {
		global $dbo;
		$dbo->setQuery("SELECT t_id,t_type FROM testtype ORDER BY t_id ASC ");
		$rows = $dbo->loadObjectList();
			echo '<select style="width:330px;height:30px;" name="q_type">';
			echo '<option value="">--Select Type--</option>';
			foreach ($rows as $row){?>-->
				<option <?php if($id && $row->t_id == $id) echo 'selected="selected"'?> value="<?php echo $row->t_id; ?>"><?php echo $row->t_type; ?></option>
			<?php }
			echo '</select>';
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $searchText
	 * @param $lessonId
	 */
	function getCountRows($searchText='',$testtype=''){
		global $dbo;
		$query = "SELECT COUNT(q_id) FROM question ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`q_question` LIKE '%$searchText%' 
			            OR `q_anwser1` LIKE '%$searchText%' 
			            OR `q_anwser2` LIKE '%$searchText%' 
			            OR `q_anwser3` LIKE '%$searchText%' 
			            OR `q_anwser4` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($testtype){
			$where[] .=  " `q_type` = ".$testtype;
		}
		
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
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
	function getAllRows($searchText='',$testtype=''){
		global $dbo; 
		$lm = Request::get('limit',50);
		$lms = Request::get('limitstart',0);
		
	    $query = "SELECT q_id,q_question,q_anwser1,q_anwser2,q_anwser3,q_anwser4,q_type,q_correct
	              FROM question ";
		
	    $where = array();
	    if ($searchText){
			$where[] .=  " (`q_question` LIKE '%$searchText%' 
			            OR `q_anwser1` LIKE '%$searchText%' 
			            OR `q_anwser2` LIKE '%$searchText%' 
			            OR `q_anwser3` LIKE '%$searchText%' 
			            OR `q_anwser4` LIKE '%$searchText%' 
			            )"; 
		}
	    if ($testtype){
			$where[] .=  " `q_type` = ".$testtype;
		}
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		$query .= " ORDER BY q_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>