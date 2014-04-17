<?php

/**
 * @author trieugiathang
 * @copyright 2011
 */

class Upload {
    //xac dinh cac thuoc tinh upload
    
    //Bien luu tru ten file
    var  $fileName;
    
     var  $newfileName;

    //bien luu tru phan mo ro cua file 
    var $fileExtension;
    
    //Bien luu tru dung luong upload file
    var $fileSize;
    
    //Bien luu tru thu muc tam cua file
    var $fileTMP;
    
    //bien luu tru thu muc chua file tren server
    var $uploadDir;
    
    //Bien luu tru cac loi xay ra
    var $errors;
    
    //xac dinh cac phuong thuc can thiet cho viec upload
    
    //phuong thuc khoi tao doi tuong 
    function __construct($file_name){
    	
        $fileInfo = $_FILES[$file_name];
        if (!$fileInfo) $this->errors[] = 'khong ton tai file upload';
        else{
	        $this->fileName = $fileInfo['name'];
	        $this->fileSize = $fileInfo['size'];
	        $this->fileExtension = $this->getFileExtension();
	        $this->fileTMP = $fileInfo['tmp_name'];
        }
    }
    
    //phuong thuc lay thanh phan mo rong cua tap tin upload
    function getFileExtension()
    {
        $string = $this->fileName;
       	$pattern = '#\.([^\.]+)$#i';
        //su dung ham pre_match de lay ra nhung phan can thiet trong chuoi can lay ra 
        //$pattern : mo hinh,bieu thuc lay ra thanh phan mo rong 
        //$tring : chuoi can tach
        //$matches : la ket qua tra ve
        preg_match($pattern,$string,$matches);
        return $matches[1]; //lay gia tri "jpg"  Con $matches[0] : la ".jpg"
       
    }
    
    //phuong thuc thiet lap cac thanh phan mo rong dc phep upload(Kiem tra cac thanh phan hoc le xem co hop le hay khong)
    //vd:gif,jpg,ext,txt,png...
    //function setFileExtension($value)
    function setFileExtension($value){
        $file_exten = $this->fileExtension;
        $pattern = '#(' .$value. ')$#i';
        if(preg_match($pattern,$file_exten,$matches) !=1)
            $this->errors[] = 'Phan mo rong khong hop le';

    }
    
    //phuong thuc thiet lap dung luong file dc phep upload
    function setFileSize($value)
    {
        $size = $value * 1024;
        if($this->fileSize > $size)
        {
            $this->errors[] = 'Kich thuoc file qua lon';
        }
    }
    
    //phuong  thuc thiet lap thu muc chu tap tin upload tren server
    function setUploadDir($value)
    {
        if(file_exists($value))
        {
        	$this->uploadDir = $value;
        }
        else
        {
            $this->errors[] = 'Thu muc upload khong ton tai';
        }
    }
    
    //Phuong thuc kiem tra dieu kien upload (Phuong thuc bat loi xay ra)
    function CheckError(){
        $flagError = false; //mac dinh luc dau chua co loi
        //kiem tra
        if(count($this->errors) > 0)    
        {
            $flagError = true;
        }
        return $flagError;
    }
    
    //phuong thuc upload tap tin
    /*
    function upload($rename = false,$prefix = 'images_' )
    {
        if($rename == false)    //khong cho phep doi ten
        {
        $source = $this->fileTMP;
        $des = $this->uploadDir . $this->fileName;
        }
        else    //$rename == true.   tuc la cho phep doi ten file upload len
        {
        	$this->newfileName = $prefix . time() . '.' . $this->fileExtension;
            $source = $this->fileTMP;
            $des = $this->uploadDir.$this->newfileName;
        }
        copy($source,$des);
    }   
    */ 
    
    
    
    
}
?>