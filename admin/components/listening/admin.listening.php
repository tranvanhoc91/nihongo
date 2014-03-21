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
                    <th nowrap="nowrap">Track</th>
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
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->li_id; ?>"  type="checkbox"/></td>
                    <td><a href=""><?php echo $row->li_title;?></a></td>
                    <td>
                    <audio controls>
                    <source src="horse.ogg" type="audio/ogg">
                    <source src="audio/kaiwa/<?php echo $row->li_track; ?>" type="audio/mpeg"></audio>
                    </td>
			        <td><?php echo splitText($row->li_script_jp, 70, 70); // echo $row->li_script_jp;?>...</td>
			        <td style="text-align:justify;"><?php echo splitText($row->li_script_en, 70, 70);?>...</td>
			        <td style="text-align:justify;"><?php echo splitText($row->li_script_vi, 70, 70);?>...</td>
                    <td><?php echo getLessons($row->li_lesson_id); ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->li_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="listening" />';
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
				<td><?php if ($record) getLessonList($record->li_lesson_id); else getLessonList(); ?></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Title</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->li_title;?>" type="search" size="60" name="li_title" /><br></td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Audio</p></td>
				<td>
				<?php if ($record) { ?>
					<audio id="audio" controls>
                    <source src="horse.ogg" type="audio/ogg">
                    <source src="audio/kaiwa/<?php echo $record->li_track;?>" type="audio/mpeg">
                    </audio>
                    <input type="file" id="inputFile" name="li_track" accept="audio/*" />
                    <a id="audioTask" class="change" href="#" onclick="audioTask();" >Change audio</a>
                    <script type="text/javascript">
                    var audioTask = $("#audioTask");
                    var inputFile =  $("#inputFile");
                    var audio = $("audio");
                    inputFile.hide();
                    audioTask.click(function(){
                        if(audioTask.attr("class") == "change"){
                        	audio.hide();
                        	inputFile.show();
                        	audioTask.text("Cancel");
                        	audioTask.attr("class","cancel");
                        }else{
                        	audio.show();
                        	inputFile.hide();
                        	audioTask.text("Chanege Audio");
                        	audioTask.attr("class","change");
                        }
				    });
                    </script>
				<?php } else {?>
				    <input type="file" id="file" name="li_track" accept="audio/*" />
				<?php } ?>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content jp</p></td>
				<td>
				<textarea cols="60" id="editor2" name="li_script_jp" rows="10"><?php if ($record) echo $record->li_script_jp; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor2');</script>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content vi</p></td>
				<td>
				<textarea cols="60" id="editor4" name="li_script_vi" rows="10"><?php if ($record) echo $record->li_script_vi; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor4');</script>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Content en</p></td>
				<td>
				<textarea cols="60" id="editor3" name="li_script_en" rows="10"><?php if ($record) echo $record->li_script_en; ?></textarea>
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
	<input type="hidden" name="option" value="listening" />
	<input type="hidden" name="li_id" value="<?php if($record) echo $record->li_id;?>" />
	<div class="clr"></div>
	<?php
	}
//Cac function process
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
	    
		$title = trim(Request::get('li_title'));
		$content_jp = trim(Request::get('li_script_jp'));
		$lessonId = trim(Request::get('li_lesson_id'));
		$audioFile = $_FILES["li_track"]; //object
		$dir = "audio/kaiwa/";
		
		if (!$title || !$content_jp || !$lessonId || !$audioFile['name']){
			 Message::setMessage('Please enter full',1);
		}else {
			//store audio
			$prefixName = "Dai ".$lessonId.' ka_';
			$fileNameUploaded = UploadFile("li_track",$dir,1,$prefixName);
			echo $fileNameUploaded;
			if ($fileNameUploaded){
			     $excute->li_track = $fileNameUploaded;
				 	//Kiem tra xem: user dang add hay edit bai viet
				 	//Neu laf edit thi phai lay ve id cua bai viet va cap nhat lai ten hinh anh
				 	$id = Request::get('li_id');
				 	if ($id){ //tuc la dang edit hinh anh
				 		//lay ve hinh hien tai va thay the bang hinh moi
				 		global $dbo;
						$dbo->setQuery("SELECT `li_track` FROM `listening` WHERE `li_id` = $id ");
						$audioCurrent = $dbo->loadObject();
						if ($audioCurrent->li_track)
							unlink($dir.$audioCurrent->li_track);
				 	}
				 if ($excute->store()) Message::setMessage('Saved');
			     else Message::setMessage('False',1);
			}
		}
		
	switch($task){
			case 'save':
				redirect('index.php?option=listening');
				break;
			case 'savex':
				redirect('index.php?option=listening&task=add');
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
			viewDefault();
		}
	}
	
	function cancel(){
		$option = Request::get('option');
		redirect('index.php?option='.$option);
	}
	
	
	function delete(){
		global $dbo;
		$id = Request::get('id');
		$num = count($id);
		$dir ='audio/kaiwa/';
		foreach ($id AS $i){
			$query="SELECT `li_track` FROM `listening` WHERE li_id = $i ";
			$dbo->setQuery($query);
			$audioCurr = $dbo->loadObject();
			if ($audioCurr->li_track){
				//unlink($dir.$audioCurr->li_track);
				//kiem tra xem co file audio trong dir khong da
				if (file_exists($dir.$audioCurr->li_track)) {
					if (unlink($dir.$audioCurr->li_track))
				        Message::setMessage('Audio is deleted',0);
				    else 
				        Message::setMessage('Cant deleted audio',0);
				}
			}
		}
		$excute = includeTable();
		$excute->delete($id);
		Message::setMessage($num.' Item(s) permanently deleted');
		redirect('index.php?option=listening');
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
			echo '<select style="width:330px;height:30px;" name="li_lesson_id">';
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
		$query = "SELECT COUNT(li_id) FROM listening ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`li_title` LIKE '%$searchText%' 
			             OR `li_track` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `li_lesson_id` = ".$lessonId;
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
		
	    $query = "SELECT  `li_id`,`li_lesson_id`,`li_title`,`li_script_jp`,`li_script_en`,`li_script_vi`,`li_track`
	              FROM listening ";
		
	    $where = array();
		if ($searchText){
			$where[] .=  " (`li_title` LIKE '%$searchText%' 
			             OR `li_track` LIKE '%$searchText%' 
			            )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `li_lesson_id` = ".$lessonId;
		}
		
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		$query .= " ORDER BY li_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>