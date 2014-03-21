<?php


class ComboBox{
	/*
	static function setYearCurrent(){
		$year =  date('Y');
		return $year;
	}
	*/
	
	static function show($name,$start,$end){
		$combo =  '<select name="'.$name.'">';
			for($i=$start;$i<=$end;$i++)
				$combo .= '<option value="'.$i.'">'.$i.'</option>';
		$combo .= '</select>';
		
		return $combo;
	}
	
}
