<?php
class ToolbarHelper {
	static function title($str){
		echo '<div id="'.str_replace(' ', '_', $str).'" class="toolbar-title">'.$str.'</div>';
	}
	
	static function add(){
		self::custom('add','Add');
	}

	static function edit(){
		self::custom('edit','Edit',true);
	}
	
	static function save(){
		self::custom('save','Save');
	}
	
	static function savex(){
		self::custom('savex','Save & New');
	}
	
	static function delete(){
		self::custom('delete','Delete',true);
	}
	
	static function clean(){
		self::custom('clean','Clean');
	}
	
	static function remove(){
		self::custom('remove','Remove',true);
	}
	
	static function restore(){
		self::custom('restore','Restore',true);
	}
	
	static function custom($task, $label,$checked_require = false){
		if($checked_require)
		{
			echo '<button name="task" onclick="return checkedRequire();" class="checked_require" id="'.$task.'"  value="'.$task.'" type="submit" title="'.$task.'"></button>';
		}
		else 
		{
		 	echo '<button id="'.$task.'" name="task" value="'.$task.'" type="submit" title="'.$task.'">
				 	</button>
				 	';
		}
			echo '<br />';
		 	echo '<span class="toolbar-lable" >'.$label.'</span>';
	}
	
	static function publish(){
		self::custom('publish','Publish',true);
	}
	
	static function unpublish(){
		self::custom('unpublish','Un-publish',true);
	}
	
	static function choose(){
		self::custom('choose','Default',true);
	}
	
	static function cancel(){
		self::custom('cancel','Cancel');
	}
	
	static function back(){
		echo '<button class="back" title="Back" onclick="window.history.back(); return false;" type="submit"></button>';
	}
	
	
	
	
}