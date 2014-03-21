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
		$lessonId = Request::get('lesson_id');
		$lms = Request::get('limitstart',0);
		$total = getCountRows($search);
		$pageNav = new Pagination($total,$lms,20);
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
                    <th nowrap="nowrap">Title</th>
                    <th nowrap="nowrap">Content jp</th>
                    <th nowrap="nowrap">Content en</th>
                    <th nowrap="nowrap">Content vi</th>
                    <th nowrap="nowrap">Lesson</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$i = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($i);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->r_id; ?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $row->r_title;?></a></td>
			        <td><?php echo splitText($row->r_content_jp, 70, 70); // echo $row->li_script_jp;?>...</td>
			        <td style="text-align:justify;"><?php echo splitText($row->r_content_en, 70, 70);?>...</td>
			        <td style="text-align:justify;"><?php echo splitText($row->r_content_vi, 70, 70);?>...</td>
                    <td><?php echo getLessons($row->r_lesson_id); ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->r_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="reading" />';
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
				<td><?php if ($record) getLessonList($record->r_lesson_id); else getLessonList(); ?></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Title</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->r_title;?>" type="search" size="60" name="r_title" /><br></td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content jp</p></td>
				<td>
				<textarea cols="60" id="editor2" name="r_content_jp" rows="10"><?php if ($record) echo $record->r_content_jp; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor2');</script>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content vi</p></td>
				<td>
				<textarea cols="60" id="editor4" name="r_content_en" rows="10"><?php if ($record) echo $record->r_content_en; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor4');</script>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content en</p></td>
				<td>
				<textarea cols="60" id="editor3" name="r_content_vi" rows="10"><?php if ($record) echo $record->r_content_vi; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor3');</script>
				</td>
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
	<input type="hidden" name="option" value="reading" />
	<input type="hidden" name="r_id" value="<?php if($record) echo $record->r_id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
	    
		$title = trim(Request::get('r_title'));
		$content_jp = trim(Request::get('r_content_jp'));
		$lessonId = trim(Request::get('lesson_id'));
		
		$excute->r_lesson_id = $lessonId;
		
		if (!$title || !$content_jp || !$lessonId){
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
				redirect('index.php?option=reading');
				break;
			case 'savex':
				redirect('index.php?option=reading&task=add');
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
			redirect('index.php?option=reading');
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
		redirect('index.php?option=reading');
		//viewDefault();	
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
	 * Hien thi list type khi add/ edit/ search
	 * @param $lid
	 */
	function getLessonList($id='') {
		global $dbo;
		$dbo->setQuery("SELECT le_id,le_title FROM lesson ORDER BY le_id ASC ");
		$rows = $dbo->loadObjectList();
			echo '<select style="width:330px;height:30px;" name="lesson_id">';
			echo '<option value="">--Select Type--</option>';
			foreach ($rows as $row){?>-->
				<option <?php if($id && $row->le_id == $id) echo 'selected="selected"'?> value="<?php echo $row->le_id; ?>"><?php echo $row->le_title; ?></option>
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
		$query = "SELECT COUNT(r_id) FROM reading ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`r_title` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `r_lession_id` = ".$lessonId;
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
		$lm = Request::get('limit',20);
		$lms = Request::get('limitstart',0);
		
	    $query = "SELECT `r_id`,`r_lesson_id`,`r_title`,`r_content_jp`,`r_content_en`,`r_content_vi` 
	              FROM reading ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`r_title` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `r_lesson_id` = ".$lessonId;
		}
		
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		$query .= " ORDER BY r_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>