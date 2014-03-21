// JavaScript Document
function onSubmitForm(formName,url)
{ 
	var theForm = document.getElementById(formName);
	theForm.action = url;
	theForm.submit();
	return true;
  
	/*var form = document.getElementById(formName);
   document.appForm.action = url;
   document.appForm.submit();
   return true;*/
}

function checkCheckBox(){
	var theForm = document.appForm;
	if (theForm.elements[i].name=='cid[]')
	{
        theForm.elements[i].checked = checked;
        if(theForm.elements[i].checked = true){
        	window.alert(this.value);
        }
    }
}

var checked=false;
function checkedAll() {
    var theForm = document.appForm;
    if (checked == false)
    {
    	checked = true;
    	//theForm.checkValue.value = theForm.elements.length;
    }
    else
    {
    	checked = false;
    	//theForm.checkValue.value = 0;
    }
    
    var countCheckBox = 0;
    for (i=0; i<theForm.elements.length; i++) {
        if (theForm.elements[i].name=='ckb[]'){
            theForm.elements[i].checked = checked;
            countCheckBox++;
        }
    }
    
    if (checked == true)
    {
    	theForm.checkValue.value = countCheckBox;
    }
    else
    {    	
    	theForm.checkValue.value = 0;
    }
}