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
		$pageNav = new Pagination($total,$lms,30);
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
                    <th nowrap="nowrap">Kanji</th>
                    <th nowrap="nowrap">Kunyomi</th>
                    <th nowrap="nowrap">Onyomi</th>
                    <th nowrap="nowrap">Mean Kanji</th>
                    <th nowrap="nowrap">Mean En</th>
                    <th nowrap="nowrap">Mean Vi</th>
                    <th nowrap="nowrap">KUN example</th>
                    <th nowrap="nowrap">ON example</th>
                    <th nowrap="nowrap">Remeber</th>
                    <th nowrap="nowrap" width="1">ID</th>
               	</tr>
            </thead>
            <tbody>
            <?php 
			$h = 1; foreach($rows AS $row) {
			?>
            	<tr>
                	<td><?php echo $pageNav->getOfset($h);?></td>
                    <td><input id="actions-box" name="id[]" value="<?php echo $row->k_id; ?>"  type="checkbox"/></td>
                    <td><a style="font-size:32px;padding:5px 5px;" href=""><?php echo $row->k_kanji;?></a></td>
                    <td><?php 
                        $kunyomi = explode(";", $row->k_kunyomi);
                        for($i = 0; $i < count($kunyomi); $i++){
                        	echo $kunyomi[$i].'</br>';
                        }
                    ?></td>
                    <td><?php 
                        $kunyomi = explode(";", $row->k_onyomi);
                        for($i = 0; $i < count($kunyomi); $i++){
                        	echo $kunyomi[$i].'</br>';
                        }
                    ?></td>
                    <td><?php echo $row->k_mean_kanji;?></td>
                    <td><?php echo $row->k_mean_en;?></td>
                    <td><?php echo $row->k_mean_vi;?></td>
                    <td><?php 
			            $kunyomi = explode("|", $row->k_kun_ex);
                        for($i = 0; $i < count($kunyomi); $i++){
                        	//echo $kunyomi[$i].'</br>';
                        	$tem = explode(":", $kunyomi[$i]);
                        	//echo '<table><tr>';
                        	for($j = 0; $j < count($tem); $j++){
                        		//echo $tem[$j].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        		//echo '<td>'.$tem[$j].'</td>';
                        		echo '<span style="margin:0 10px;">'.$tem[$j].'</span>';
                        	}
                        	echo '</br>';
                        	//echo '</tr></table>';
                        }
                    ?></td>
                    <td><?php 
                        $kunyomi = explode("|", $row->k_on_ex);
                        for($i = 0; $i < count($kunyomi); $i++){
                        	//echo $kunyomi[$i].'</br>';
                        	$tem = explode(":", $kunyomi[$i]);
                        	//echo '<table><tr>';
                        	for($j = 0; $j < count($tem); $j++){
                        		//echo $tem[$j].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        		//echo '<td>'.$tem[$j].'</td>';
                        		echo '<span style="margin:0 10px;">'.$tem[$j].'</span>';
                        	}
                        	echo '</br>';
                        	//echo '</tr></table>';
                        }
                    ?></td>
                    <td><?php $note = splitText($row->k_remember, 60, 60); echo " ". $note; ?></td>
                    <td nowrap="nowrap" style="color:gray;"><?php echo $row->k_id;?></td>
              	</tr>
             <?php $h++; } ?>
	            <tr>
					<td style="border:none !important;" colspan="12"><?php $pageNav->displayCpanel();?></td>
				</tr>
            </tbody>
        </table>
		<?php
		echo '<input type="hidden" name="option" value="kanji" />';
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
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Kanji</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_kanji;?>" type="search" size="60" name="k_kanji" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Kunyomi</p></td>
				<td>
				<input style="height:30px;" value="<?php if($record) echo $record->k_kunyomi;?>" type="search" size="60" name="k_kunyomi" />
				</br><span style="color:#a3a3a3">Example: おさ.める; おさ.まる; なお.る; なお.　す</span>
				<br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Onyomi</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_onyomi;?>" type="search" size="60" name="k_onyomi" />
				</br><span style="color:#a3a3a3">Example: ジ; チ</span><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean Kanji</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_mean_kanji;?>" type="search" size="60" name="k_mean_kanji" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean En</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_mean_en;?>" type="search" size="60" name="k_mean_en" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Mean Vi</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_mean_vi;?>" type="search" size="60" name="k_mean_vi" /><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">On Example</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_on_ex;?>" type="search" size="60" name="k_on_ex" />
				</br><span style="color:#a3a3a3">Example: 学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ：Hoc phi</span><br></td>
				<br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Kun Example</p></td>
				<td><input style="height:30px;" value="<?php if($record) echo $record->k_kun_ex;?>" type="search" size="60" name="k_kun_ex" />
				</br><span style="color:#a3a3a3">Example: 学校:がっこう:truong hoc|学生:がくせい:hoc sinh|学費:がくひ：Hoc phi</span><br></td><br></td>
			</tr>
			
			<tr>
				<td><p style="text-indent:20px;font-size:18px;font-family:Times New Roman, Times, serif;">Remember</p></td>
				<td>
				<textarea cols="60" id="editor3" name="k_remember" rows="10"><?php if ($record) echo $record->k_remember; ?></textarea>
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
	<input type="hidden" name="option" value="kanji" />
	<input type="hidden" name="k_id" value="<?php if($record) echo $record->k_id;?>" />
	<div class="clr"></div>
	<?php
	}
	
	
//Cac function process
	
	
	function save(){
		$excute = includeTable();
		$excute->bind();
	    global $task;
	    
	    
	    $kanji = Request::get('k_kanji');
	    $mean_kanji = Request::get('k_mean_kanji');
	    $mean_en = trim(Request::get('k_mean_en'));
	    $mean_vi = Request::get('k_mean_vi');
	    $mean_vi = Request::get('k_mean_vi');
	    $remember =   Request::get('k_remember');
	   // if (!$kanji || !$mean_kanji || !$mean_vi){
			    //Message::setMessage('Please enter full',1);
		//}else {
		        if(!$excute->store()){
		    	    Message::setMessage('False',1);
		        }else{
		    	     Message::setMessage('Saved',0);
		        }
		 //}
		 
		 ///--> insert data
	  /*      if(!$excute->store()){
		    	    Message::setMessage('False',1);
		        }else{
		    	     Message::setMessage('Saved',0);
		        }*/
		        
		        
		switch($task){
			case 'save':
				redirect('index.php?option=kanji');
				break;
			case 'savex':
				redirect('index.php?option=kanji&task=add');
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
		$id = Request::get('id');
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
	 */
	function getCountRows($searchText=''){
		global $dbo;
		$query = "SELECT COUNT(k_id) FROM kanji ";
		if ($searchText){
			$query .= " WHERE (`k_kanji` LIKE '%$searchText%' 
			            OR `k_mean_kanji` LIKE '%$searchText%' 
			            OR `k_mean_en` LIKE '%$searchText%' 
			            OR `k_mean_vi` LIKE '%$searchText%' 
			            OR `k_remember` LIKE '%$searchText%' 
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
		$lm = Request::get('limit',30);
		$lms = Request::get('limitstart',0);
		$query = "SELECT k_id,k_kanji,k_mean_kanji, k_mean_en, k_mean_vi, k_onyomi, k_kunyomi, k_on_ex, k_kun_ex, k_remember FROM kanji ";
		if ($searchText){
			$query .= " WHERE (`k_kanji` LIKE '%$searchText%' 
			            OR `k_mean_kanji` LIKE '%$searchText%' 
			            OR `k_mean_en` LIKE '%$searchText%' 
			            OR `k_mean_vi` LIKE '%$searchText%' 
			            OR `k_remember` LIKE '%$searchText%' 
			             )"; 
		}
		$query .= " ORDER BY k_id DESC LIMIT $lms,$lm ";
	    $dbo->setQuery($query);
		return $dbo->loadObjectList();
	}
	
?>