<?php
	function t_display(){
		global $task;
		switch($task){
			case 'add':
			case 'savex':
				toolbarAdd();
				break;
			case 'edit':
				if (Request::get('k_id')) toolbarAdd();
				else toolbarDefault();
				break;
			default:
				toolbarDefault();
				break;
		}
	}
		
	function toolbarDefault(){
		ToolbarHelper::title('Kanji Manager');
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
				ToolbarHelper::title('Add Kanji');
				break;
			case 'edit':
				ToolbarHelper::title('Edit Kanji');
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
