<?php
//tao lop de tao ra thanh phan trang
//bat dau lay tu record nao(limitstart)
//lay bao nhieu record	(limit)

class Pagination {
	private $limitstart;
	private $limit;
	private $total;
	private $view;
	private $option;
	private $layout;
	private $section;
	private $category;
	
	private $numberPage;
	private $currentPage;
	private $previous;
	private $next;
	private $start;
	private $end;
	
	var $url = null;
	
	 function __construct($total,$limitstart,$limit){
	 	$this->total		=	$total;
	 	$this->limitstart	=	$limitstart;
	 	$this->limit		=	$limit;
	 	//lay ve cac gia tham so tren trinh duyet
	 	$this->getFieldURL();
	 	$this->setURL();
	 	
	 	$this->numberPage	=	$this->getNumberPage();
		$this->currentPage	=	($this->limitstart/$this->limit) + 1;
		$this->next			=	$this->limitstart + $this->limit;
		$this->previous		=	$this->limitstart - $this->limit;
		$this->start	= 	0;
		$this->end		=	($this->numberPage-1)*$this->limit;
	}
	
	function getFieldURL(){
		$this->option	= 	addslashes(Request::get('option'));
		$this->view		=	addslashes(Request::get('view'));
		$this->layout	=	addslashes(Request::get('layout','grid'));
		$this->section	=	addslashes(Request::get('section'));
		$this->category	=	addslashes(Request::get('category'));
	}
	
	function setURL(){
		$this->url = '?option='.$this->option.'&view='.$this->view;
		//$this->url	=	'?option='.$this->option;
		//if ($this->view)		$this->url	.=	'&view='.$this->view;
		if ($this->section) 	$this->url 	.= 	'&section='.$this->section;
		if ($this->category) 	$this->url 	.= 	'&category='.$this->category;
		if ($this->layout)		$this->url	.=	'&layout='.$this->layout;
		return $this->url;
	}
	
	function getOfset($index){
		//(trang_hien_tai - 1)*so_record_1_trang + 1;
		return ($this->limitstart/$this->limit)*$this->limit + $index;
		
	}
	
	function getNumberPage(){
		//tra ve so trang
		if($this->total){
			return ceil($this->total/$this->limit);
		}		
		return 0;
	}
	
	function displayPaginationBackEnd(){
		
	}
	
	function displayPaginationFontEnd(){
		if($this->numberPage > 1) { ?>
		<div class="pagination-default">
		<?php 
		if ($this->currentPage > 1){
			echo '<span class=""><a href="'.$this->url.'">Start</a></span>';
			echo '<span class="disabled"><a class="img-previous" href="'.$this->url.'&limitstart='.$this->previous.'&limit='.$this->limit.'">&nbsp;&nbsp;</a></span>';
		}//end $this->currentPage > 1
		
		//duyet qua so trang
		for ($i=1; $i <= $this->numberPage; $i++ ){
			if ($i	==	$this->currentPage) 
				echo '<span class="current">'.$i.'</span>';	
			else{
				$limistart = ($i-1)*$this->limit;
				echo '<a href="'.$this->url.'&limitstart='.$limistart.'&limit='.$this->limit.'">'.$i.'</a>';
			}//end else
		}//end for
		//Neu trang hien tai bang tong so trang tuc la trang cuoi cung
		if ($this->currentPage == $this->numberPage)
			echo '<span class="disabled"></span>';
		else {
			echo '<a class="img-next" href="'.$this->url.'&limitstart='.$this->next.'&limit='.$this->limit.'">&nbsp;&nbsp;</a>';
			echo '<a href="'.$this->url.'&limitstart='.$this->end.'&limit='.$this->limit.'">End</a></span>';
		}
		?>
		</div>
		<?php 
		}//end if($numpage)
	}
	
	function displayPaginationSearch(){
		
	}
	
	function displayCpanel(){
		if($this->numberPage > 1) {
		?>
		<del class="container">
			<div class="pagination">
				<div class="limit">Display #
					<select >
						<option selected="selected" value="5">5</option>
						<option value="10">10</option>
					</select>
				</div>
						<?php
						$task = Request::get('task');
						if($this->currentPage == 1){
							echo '<div class="button2-right off"><div class="start"><span>Start</span></div></div>';
							echo '<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>';
						}else {
							if($task=='trash'){
								echo '<div class="button2-right"><div class="start"><a title="Start" href="index.php?option='.$this->option.'&task=trash">Start</a></div></div>';
								echo '<div class="button2-right"><div class="prev"><a title="Prev" href="index.php?option='.$this->option.'&task=trash&limitstart='.$this->previous.'&limit='.$this->limit.'">Prev</a></div></div>';
							}else{
								echo '<div class="button2-right"><div class="start"><a title="Start" href="index.php?option='.$this->option.'">Start</a></div></div>';
								echo '<div class="button2-right"><div class="prev"><a title="Prev" href="index.php?option='.$this->option.'&limitstart='.$this->previous.'&limit='.$this->limit.'">Prev</a></div></div>';
							}
						}
						
						echo '<div class="button2-left"><div class="page">';
						for($i=1; $i<=$this->numberPage; $i++){
							if($i==$this->currentPage){
								echo '<span class="current">'.$i.'</span>';
							}else {
								$limitstart = ($i-1)*$this->limit;
								switch ($task){
									case 'trash':
										$url = 'index.php?option='.$this->option.'&task=trash&limitstart='.$limitstart.'&limit='.$this->limit;
										break;
									default:
										$url = 'index.php?option='.$this->option.'&limitstart='.$limitstart.'&limit='.$this->limit;
										break;
								}//end switch
								echo '<a href="'.$url.'">'.$i.'</a>';
							}//end else
						}
						echo '</div></div>';
						
						
						if ($this->currentPage == $this->numberPage){
							echo '<div class="button2-left off"><div class="next"><span>Next</span></div></div>';
							echo '<div class="button2-left off"><div class="end"><span>End</span></div></div>';
						}else{
							if($task=='trash'){
								echo '<div class="button2-left"><div class="next"><a href="index.php?option='.$this->option.'&task=trash&limitstart='.$this->next.'&limit='.$this->limit.'">Next</a></div></div>';
								echo '<div class="button2-left"><div class="end"><a href="index.php?option='.$this->option.'&task=trash&limitstart='.$this->end.'&limit='.$this->limit.'">End</a></div></div>';
							}else{
								echo '<div class="button2-left"><div class="next"><a href="index.php?option='.$this->option.'&limitstart='.$this->next.'&limit='.$this->limit.'">Next</a></div></div>';
								echo '<div class="button2-left"><div class="end"><a href="index.php?option='.$this->option.'&limitstart='.$this->end.'&limit='.$this->limit.'">End</a></div></div>';
							}
						}
						echo '<div class="limit">Page '.$this->currentPage.' of '.$this->numberPage.'</div>';
						?>
			</div>
		</del>
		<?php 
		}//end if($numpage)
	}//end display()
	
	
	
}
?>