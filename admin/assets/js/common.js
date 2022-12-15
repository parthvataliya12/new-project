function DeleteFunction(alt){
	if(confirm(alt)){
		return true;
	}else{
		return false;
	}
}

function numOnly(evt)
{	
	var charCode = (evt.which) ? evt.which : window.event.keyCode;

	if (charCode <= 13 || charCode == 46)
	{
		return true;
	}
	else
	{
		var keyChar = String.fromCharCode(charCode);
		var re = /[0-9]/
		return re.test(keyChar);
	}	
}

function saveorder(table)
{	
	var xmlHttpReq = false;
	var self = this;
	// Mozilla/Safari
	if (window.XMLHttpRequest) {
		self.xmlHttpReq = new XMLHttpRequest();
	}
	// IE
	else if (window.ActiveXObject) {
		self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	
	var dom=document.manage;	
	//alert(dom)
	var tmp ="";
	for(i=0;i<dom.length;i++)
	{	
		var nm=dom.elements[i].name.split('_');
		//alert(dom.elements[i].name);
		if(dom.elements[i].type == "text" && nm[0]=='setord')
		{   
			if(tmp=="")
			{
				tmp = nm[1]+":"+document.getElementById('setord_'+nm[1]).value;
			}
			else
			{
				tmp = tmp+","+nm[1]+":"+document.getElementById('setord_'+nm[1]).value;
			}
		}
	}	
	self.xmlHttpReq.open('POST', "ajax.inc.php?flag=displayorder&table="+table+"&disvalue="+tmp, true);
	self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
	self.xmlHttpReq.onreadystatechange = function() 
	{	
		if (self.xmlHttpReq.readyState == 4) {			
			//document.getElementById('DivDisplayMsg').innerHTML = 'Display order set successfully.';
			location.reload();
		}
	}
	self.xmlHttpReq.send(null);
}