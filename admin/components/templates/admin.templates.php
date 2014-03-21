<?php
//ham dieu khien
	function a_display(){
		global $task;
		switch($task){
			case 'add':
				viewAdd();
				break;
			case 'edit':
				edit();
				break;
			case 'choose':
				setDefault();
				break;
			case 'delete':
				delete();
				break;
			case 'save':
			case 'savex':
				save();
				break;
			default:
				viewDefault();
				break;
		}
	}
	
	function viewDefault(){
		require_once('base/class.pagination.php');
		$total = getCountTemplate();
		
		$lms = Request::get('limitstart',0);
		
		$pageNav = new Pagination($total,$lms,10);
	
		$tems = getAllTemplate();
		?>
		
		<table class="adminlist">
			<thead>
			<tr>
				<th width="20"><a href="">STT</a></th>
				<th width="20" ></th>
				<th nowrap="nowrap"><a href="">Template Name</a>	</th>
				<th nowrap="nowrap" width="5%"><a href="">Default</a></th>
				<th nowrap="nowrap"><a href="">Description</a></th>
				<th width="2"><a href="">ID</a></th>
			</tr>
			</thead>
			<?php $i = 1; foreach($tems AS $tem) { ?>
			<tr>
				<td><?php echo $pageNav->getOfset($i);?></td>
				<td><input id="actions-box" name="id[]" value="<?php echo $tem->id;?>"  type="checkbox"/></td>
				<td><a href=""><?php echo $tem->title;?></a></td>
				<td><?php if ($tem->default=='1') echo "<span class='default-icon'>&nbsp;&nbsp;&nbsp;&nbsp;</span>";?></td>
				<td nowrap="nowrap" style="color:gray;"><?php echo $tem->description;?></td>
				<td nowrap="nowrap" style="color:gray;"><?php echo $tem->id;?></td>
			</tr>
			<?php $i++; }?>
		</table>
		<?php
		echo '<input type="hidden" name="option" value="templates" />';
	}
	
	function viewAdd(&$record=null){
	?>
	
	 <div class="col width-50">
		<fieldset class="adminform">
		<legend>Details</legend>
		<table cellspacing="1" class="admintable">
			<tbody>
        		<tr>
					<tr>
		    		<td valign="top" class="key"><label for="title">Title</label></td>
		            <td><input class="inputbox" type="text" name="title" value="<?php if($record) echo $record->title;?>" size="40"/></td>
				</tr>
				<tr><td><input type="hidden" name="default" value="<?php if($record) echo $record->default;?>" /></td></tr> 
				<tr>
					<td valign="top" class="key"><label for="title">Description</label></td>
    				<td valign="top" colspan="3">
    					<div>
                            <textarea cols="70" id="editor2" name="description" rows="10"><?php if ($record) echo $record->description; ?></textarea>
                            <script type="text/javascript">CKEDITOR.replace('editor2');</script>
                        </div>
    				</td>
    			</tr>
		</tbody>
		</table>
		</fieldset>
	</div>
	
	<div class="col width-50">
		<fieldset class="adminform">
			<legend>Parameters</legend>
              chua co gi  
		</fieldset>
	</div><!-- End div.col width-50-->
    <div class="clr"></div>
    
	<input type="hidden" name="el" value="templates" />
	<input type="hidden" name="id" value="<?php if($record) echo $record->id;?>" />
	<?php
	}
	function setDefault(){
		$id = Request::get('id');
		//echo $id[0];
		global $dbo;
		$dbo->setQuery("UPDATE templates SET  `default`='1' WHERE id ='$id[0]'");
		//$sql2 = $dbo->setQuery("UPDATE templates SET  `default`='0' WHERE id <>'$id[0]'");
		$dbo->query();
		
		$dbo->setQuery("UPDATE templates SET  `default`='0' WHERE id <>'$id[0]'");
		$dbo->query();
		viewDefault();
	}
	
	function save(){
		//include doi tuong bang
		$temp = includeTable();
		$temp->bind();
		if(!$temp->store()){
			Message::setMessage('False',1);
		}else {
			Message::setMessage('Saved');
		}
		global $task;
		switch($task){
			case 'save':
				redirect('index.php?option=templates');
				break;
			case 'savex':
				redirect('index.php?option=templates&task=add');
				break;
		}		
	}
	
	function edit(){
		$temp = includeTable();
		$id = Request::get('id');
		$temp->load($id[0]);
		viewAdd($temp);	
	}
	
	
	function delete(){
		$id = Request::get('id');
		$temp = includeTable();
		$temp->delete($id);
		viewDefault($temp);	
	}
	
	
	
	
	function getAllTemplate(){
		global $dbo;
		$dbo->setQuery(" SELECT * FROM templates");
		return $dbo->loadObjectList();
	}
	
	function getCountTemplate(){
		global $dbo;
		$dbo->setQuery(" SELECT COUNT(id) FROM templates");
		return $dbo->loadResult();
	}
	
	
?>
