<?php
	function t_display(){
		global $task;
		switch($task){
			case 'edit':
			case 'add':
			case 'savex':
				toolbarAdd();
				break;
			default:
		if (Request::get('v_id')){
				toolbarAdd();
			}else{
				toolbarDefault();
			}
				
				break;
		}
	
	
	}
		
		
		
	
	
	function toolbarDefault(){
		ToolbarHelper::title('Vocabulary Manager');
		?>
		<table class="toolbar-button" >
			<tr>
				<td><?php ToolbarHelper::delete(); ?></td>
				<td><?php ToolbarHelper::edit(); ?></td>
				<td><?php ToolbarHelper::add(); ?></td>
			</tr>
		</table> 
		<?php
	}
	
	function toolbarAdd(){
		global $task;
		switch ($task){
			case 'add':
				ToolbarHelper::title('Add Vocabulary');
				break;
			case 'edit':
				ToolbarHelper::title('Edit Vocabulary');
				break;
		}
		?>
		<table class="toolbar-button">
			<tr>
				<td><?php ToolbarHelper::savex(); ?></td>
				<td><?php ToolbarHelper::save(); ?></td>
				<td><?php ToolbarHelper::cancel(); ?></td>
			</tr>
		</table>		
		<?php
	}
	
?>
