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
                    <th nowrap="nowrap">Mean</th>
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
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->g_id; ?>"  type="checkbox"/></td>
                    <td><span style="" ><?php echo $row->g_title;?></span></td>
                    <td><?php splitText($row->g_mean,100,80)?></td>
                    <td><?php echo getLessons($row->g_lesson_id); ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->g_id;?></td>
              	</tr>
             <?php $i++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="grammar" />';
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
				<td><?php if ($record) getLessonList($record->g_lesson_id); else getLessonList(); ?></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Title</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->g_title;?>" type="search" size="60" name="g_title" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->g_mean;?>" type="search" size="60" name="g_mean" /><br></td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Example</p></td>
				<!-- 
				Nhieu nhat la 3 vi du, it nhat la 1 
				Dem xem g_example_jp co may vi du -> hien thi so input tuong ung
				-->
				<td>
				<?php 
				if($record){
				    $example_jp = $record->g_example_jp;
				    $example_en = $record->g_example_en;
				    $example_vi = $record->g_example_vi;
				    //cat chuoi $example_jp
				    $example_jp_arr = explode("|", $example_jp);
				    $example_en_arr = explode("|", $example_en);
				    $example_vi_arr = explode("|", $example_vi);
				    
				    if (count($example_jp_arr) <3){
				    	switch (count($example_jp_arr) ){
				    		case 1:
				    			?>
				    <input style="height:30px;" value="<?php echo $example_jp_arr[0];?>" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				    <input style="height:30px;" value="<?php echo $example_vi_arr[0];?>" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				    <input style="height:30px;" value="<?php echo $example_en_arr[0]; ?>" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				    <?php 
				    			break;
				    		case 2:
				    			?>
				    <input style="height:30px;" value="<?php echo $example_jp_arr[0];?>" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				    <input style="height:30px;" value="<?php echo $example_vi_arr[0];?>" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				    <input style="height:30px;" value="<?php echo $example_en_arr[0]; ?>" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				    <input style="height:30px;" value="<?php echo $example_jp_arr[1];?>" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				    <input style="height:30px;" value="<?php echo $example_vi_arr[1];?>" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				    <input style="height:30px;" value="<?php echo $example_en_arr[1]; ?>" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				    <?php 
				    			break;
				    			
				    		default:
				    	        for ($i=0; $i <count($example_jp_arr); $i++){
				    ?>
				    <input style="height:30px;" value="<?php echo $example_jp_arr[$i];?>" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				    <input style="height:30px;" value="<?php echo $example_vi_arr[$i];?>" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				    <input style="height:30px;" value="<?php echo $example_en_arr[$i]; ?>" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				    <?php 
				                }
				    			break;
				    		
				    	}
				    }else {
				        for ($i=0; $i <count($example_jp_arr); $i++){
				    ?>
				    <input style="height:30px;" value="<?php echo $example_jp_arr[$i];?>" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				    <input style="height:30px;" value="<?php echo $example_vi_arr[$i];?>" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				    <input style="height:30px;" value="<?php echo $example_en_arr[$i]; ?>" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				    <?php 
				        }
				    }
				    
				    
				}else {
				?>
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				<input style="height:30px;" value="" type="search" placeholder="Japanese" size="60" name="g_example_jp[]" />
				<input style="height:30px;" value="" type="search" placeholder="Vietnamese" size="60" name="g_example_vi[]" />
				<input style="height:30px;" value="" type="search" placeholder="English"  size="60" name="g_example_en[]" />
				<br>
				<?php }?>
				</td>
			</tr>
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Explain</p></td>
				<td>
				<textarea cols="60" id="editor2" name="g_explain" rows="10"><?php if ($record) echo $record->g_explain; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor2');</script>
				</td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Note</p></td>
				<td>
				<textarea cols="60" id="editor4" name="g_note" rows="10"><?php if ($record) echo $record->g_note; ?></textarea>
				<script type="text/javascript">CKEDITOR.replace('editor4');</script>
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
	<input type="hidden" name="option" value="grammar" />
	<input type="hidden" name="g_id" value="<?php if($record) echo $record->g_id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
		$title = trim(Request::get('g_title'));
		$mean = trim(Request::get('g_mean'));
		$explain = trim(Request::get('g_explain'));
		$example_jp = Request::get('g_example_jp');
		$example_vi = Request::get('g_example_vi');
		$example_en = Request::get('g_example_en');
		$lessonId = trim(Request::get('lesson_id'));
		$excute->g_lesson_id = $lessonId;
		$exampleMax = 3;
		//kiem tra. neu $example_jp ma khong co cai nao, tuc la null het -> loi
		//Neu 1 row nao do ma $example_en or $example_vi co data ma $example_jp tuong ung khong co - > loi
		if (!$title ){
			    Message::setMessage('Please enter title',1);
		}
	    if (!$mean){
			    Message::setMessage('Please enter mean',1);
		}
		
	    if (!$explain){
			    Message::setMessage('Please enter explain',1);
		}
	    if (!$lessonId){
			    Message::setMessage('Please select lesson',1);
		}
	    if(count(array_flip(array_flip($example_jp))) == 1){ // tat ca de trong
	        Message::setMessage('Vui long nhap it nhat 1 vi du',1);
	        //redirect('index.php?option=grammar&task=add');
	    }else {
	         for ($i=0; $i<$exampleMax; $i++){
				if ($example_vi[$i] || $example_en[$i]){
					if (!$example_jp[$i]){
						Message::setMessage('Vi du khong duoc de trong phan tieng nhat',1);
						//redirect('index.php?option=grammar&task=add');
					    break;
					}
				}
		    }
		    //store
		    $excute->g_example_jp = "";
		    $excute->g_example_vi = "";
		    $excute->g_example_en = "";
		    for ($i=0; $i<$exampleMax-1; $i++){
		    	if ($example_jp[$i] == null) $excute->g_example_jp .= '...'." | ";
		    	else $excute->g_example_jp .= $example_jp[$i]." | ";
		    	    
		    	if ($example_vi[$i] == null) $excute->g_example_vi .= '...'." | ";
		    	else $excute->g_example_vi .= $example_vi[$i]." | ";
		    	
		    	if ($example_en[$i] == null) $excute->g_example_en .= '...'." | ";
		    	else $excute->g_example_en .= $example_en[$i]." | ";
		    }
		        ///insert ele sau cung
		        if ($example_jp[$exampleMax-1] == null) $excute->g_example_jp .= '...';
		    	else $excute->g_example_jp .= $example_jp[$exampleMax-1];
		    	    
		    	if ($example_vi[$exampleMax-1] == null) $excute->g_example_vi .= '...';
		    	else $excute->g_example_vi .= $example_vi[$exampleMax-1];
		    	
		    	if ($example_en[$exampleMax-1] == null) $excute->g_example_en .= '...';
		    	else $excute->g_example_en .= $example_en[$exampleMax-1];
		    
		    
	            if(!$excute->store()){
		    	    Message::setMessage('False',1);
		        }else{
		    	     Message::setMessage('Saved',0);
		        }
	    }
	    
	    switch($task){
			case 'save':
				redirect('index.php?option=grammar');
				break;
			case 'savex':
				redirect('index.php?option=grammar&task=add');
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
			redirect('index.php?option=grammar');
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
		    //redirect('index.php?option=grammar');
		}
		redirect('index.php?option=grammar');
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
		$query = "SELECT COUNT(g_id) FROM grammar ";
		
	    $where = array();
		if ($searchText){
		    $where[] .=  " (`g_title` LIKE '%$searchText%' OR `g_mean` LIKE '%$searchText%' OR `g_explain` LIKE '%$searchText%' OR `g_note` LIKE '%$searchText%' )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `g_lesson_id` = ".$lessonId;
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
		
	    $query = "SELECT `g_id`,`g_title`,`g_mean`,`g_explain`,`g_note`,`g_example_jp`,`g_example_en`,`g_example_vi`,`g_lesson_id`
	              FROM grammar ";
	    $where = array();
		if ($searchText){
			$where[] .=  " (`g_title` LIKE '%$searchText%' OR `g_mean` LIKE '%$searchText%' OR `g_explain` LIKE '%$searchText%' OR `g_note` LIKE '%$searchText%' )"; 
		}
		
	    if ($lessonId){
			$where[] .=  " `g_lesson_id` = ".$lessonId;
		}
		
	    if (count($where) == 1){
			$query .= " WHERE ".$where[0];
		}
		
		if (count($where) > 1){
			$w = implode(' AND ', $where);
			$query .= " WHERE ".$w;
		}
		$query .= " ORDER BY g_lesson_id ASC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>