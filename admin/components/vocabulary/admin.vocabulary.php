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
		$lessonId = Request::get('v_lesson_id');
		$lms = Request::get('limitstart',0);
		$total = getCountRows($search);
		$pageNav = new Pagination($total,$lms,10);
		$rows = getAllRows($search,$lessonId);
		?>
		<table class="toolbar-fitter" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<td width="100%"><input type="search" name="search" value="<?php echo $search;?>" /><input style="border-radius:8px;margin-left:5px;background:#ccc;" class="search" type="submit" value="Search" /></td>
				<td nowrap="nowrap">
					<?php  getLessonList(); ?>
					<input class="next" type="submit" name="search-fitter" value="Xem" />
				</td>
			</tr>
		</table>
		
		<table class="adminlist">
			<thead>
            	<tr>
               		<th width="10">STT</th>
                    <th width="10" ><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>
                    <th nowrap="nowrap">Word</th>
                    <th nowrap="nowrap">Hiragana</th>
                    <th nowrap="nowrap">Mean Kanji</th>
                    <th nowrap="nowrap">Mean En</th>
                    <th nowrap="nowrap">Mean Vi</th>
                    <th nowrap="nowrap">Lesson</th>
                    <th nowrap="nowrap">Note</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="v_id[]" value="<?php echo $row->v_id; ?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $row->v_word;?></a></td>
                    <td><?php echo $row->v_hiragana;?></td>
                    <td><?php echo $row->v_mean_kanji;?></td>
                    <td><?php echo $row->v_mean_en;?></td>
                    <td><?php echo $row->v_mean_vi;?></td>
                    <td><?php echo getLessons($row->v_lesson_id); ?></td>
                    <td><?php $note = splitText($row->v_note, 60, 60); echo $note; ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->v_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="vocabulary" />';
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
				<td><?php if ($record) getSelectLessonList($record->v_lesson_id); else getSelectLessonList(); ?></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Word</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->v_hiragana;?>" type="search" size="60" name="v_hiragana" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Kanji</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->v_word;?>" type="search" size="60" name="v_word" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean Vi</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->v_mean_vi;?>" type="search" size="60" name="v_mean_vi" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean Kanji</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->v_mean_kanji;?>" type="search" size="60" name="v_mean_kanji" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean En</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->v_mean_en;?>" type="search" size="60" name="v_mean_en" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Note</p></td>
				<td><textarea name="v_note" rows="7" cols="45">
				<?php if($record) echo $record->v_note;?>
				</textarea><br></td>
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
	<input type="hidden" name="option" value="vocabulary" />
	<input type="hidden" name="v_id" value="<?php if($record) echo $record->v_id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
//Cac function process
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
		$word = trim(Request::get('v_word'));
		$mean_kanji = trim(Request::get('v_mean_kanji'));
		$mean_en = trim(Request::get('v_mean_en'));
		$mean_vi = trim(Request::get('v_mean_vi'));
		$v_hiragana = trim(Request::get('v_hiragana'));
		
	    if (!$v_hiragana || !$mean_vi){
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
				redirect('index.php?option=vocabulary');
				break;
			case 'savex':
				redirect('index.php?option=vocabulary&task=add');
				break;
		}		
	}
	
	function setError($msg){
		$errors[] = $msg;
		return $errors;
	}
	
	
	function edit(){
		$excute = includeTable();
		$id = Request::get('v_id');
		$excute->load($id[0]);
		viewAdd($excute);	
	}
	
	function cancel(){
		$option = Request::get('option');
		redirect('index.php?option='.$option);
	}
	
	
	function delete(){
		$id = Request::get('v_id');
		$excute = includeTable();
		$excute->delete($id);
		//redirect('index.php?option=vocabulary');
		viewDefault();	
	}
	
	
	
/************************************************************************************/
	/**
	 * 
	 * Get lesson by lesson id
	 * @param $lessionId
	 */
	function getLessons($lessionId){
		global $dbo;
		$dbo->setQuery("SELECT le_title FROM lesson WHERE le_id = '$lessionId' ");
		$row = $dbo->loadObjectList();
		foreach ($row AS $r)
			return $r->le_title;
	}
	
	
	/**
	 * 
	 * Get list of the lesson to search
	 */
	function getLessonList() {
		global $dbo;
		$dbo->setQuery("SELECT le_id,le_title FROM lesson ORDER BY le_id ASC ");
		$rows = $dbo->loadObjectList();
			echo '<select name="v_lesson_id">';
				echo '<option value="">--Select lesson--</option>';
			foreach ($rows as $row){?>
				<option value="<?php echo $row->le_id; ?>"><?php echo $row->le_title; ?></option>
			<?php }
			echo '</select>';
	}
	
	
	function getSelectLessonList($lid='') {
		global $dbo;
		$dbo->setQuery("SELECT le_id,le_title FROM lesson ORDER BY le_id ASC ");
		$rows = $dbo->loadObjectList();
			echo '<select style="width:330px;height:30px;" name="v_lesson_id">';
			foreach ($rows as $row){?>
				<option <?php if($row->le_id == $lid) echo 'selected="selected"'?> value="<?php echo $row->le_id; ?>"><?php echo $row->le_title; ?></option>
			<?php }
			echo '</select>';
	}
	
	
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param $searchText
	 * @param $lessonId
	 */
	function getCountRows($searchText='',$lessonId=''){
		global $dbo;
		$query = "SELECT COUNT(v_id) FROM vocabulary ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`v_word` LIKE '%$searchText%' 
			            OR `v_hiragana` LIKE '%$searchText%' 
			            OR `v_mean_kanji` LIKE '%$searchText%' 
			            OR `v_mean_en` LIKE '%$searchText%' 
			            OR `v_mean_vi` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `v_lesson_id` = ".$lessonId;
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
	function getAllRows($searchText='',$lessonId=''){
		global $dbo; 
		$lm = Request::get('limit',10);
		$lms = Request::get('limitstart',0);
		
	    $query = "SELECT v_id, v_word, v_hiragana, v_mean_kanji, v_mean_en, v_mean_vi, v_lesson_id,v_note 
	              FROM vocabulary ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`v_word` LIKE '%$searchText%' 
			            OR `v_hiragana` LIKE '%$searchText%' 
			            OR `v_mean_kanji` LIKE '%$searchText%' 
			            OR `v_mean_en` LIKE '%$searchText%' 
			            OR `v_mean_vi` LIKE '%$searchText%' 
			            )"; 
		}
	    if ($lessonId){
			$where[] .=  " `v_lesson_id` = ".$lessonId;
		}
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		$query .= " ORDER BY v_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>