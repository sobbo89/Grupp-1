tinyMCE.init({
		theme : "advanced",
		mode : "exact",
		elements : "text_1,text_2",
		force_br_newlines : true,
		force_p_newlines : false,
		valid_elements : "a[href|target],strong/b,em/i,br",
		invalid_elements : "div",
		entity_encoding : "raw",
		theme_advanced_layout_manager : "SimpleLayout",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_buttons1 : "bold,italic,cut,copy,paste,undo,redo,link,unlink,charmap",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_disable : "underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,image,cleanup,help,code,hr,removeformat,formatselect,fontselect,fontsizeselect,styleselect,sub,sup,forecolor,backcolor,visualaid,anchor,newdocument,separator"
	});

function ShowOrHide(d1, d2) {
	  if (d1 != '') DoDiv(d1);
	  if (d2 != '') DoDiv(d2);
	}

function DoDiv(id) {
	  var item = null;
	  if (document.getElementById) {
		item = document.getElementById(id);
	  } else if (document.all){
		item = document.all[id];
	  } else if (document.layers){
		item = document.layers[id];
	  }
	  if (!item) {
	  }
	  else if (item.style) {
		if (item.style.display == "none"){ item.style.display = ""; }
		else {item.style.display = "none"; }
	  }else{ item.visibility = "show"; item.style.zIndex = "3"; }
 	}
 	
function confirmDelete(url,msg){
        var agree=confirm(msg);
        if (agree)
        document.location=url;
        }
        
function altrows(id){
 if(document.getElementsByTagName){  
   var table = document.getElementById(id);  
   var rows = table.getElementsByTagName("tr");  
   for(i = 0; i < rows.length; i++){          
 //manipulate rows
     if(i % 2 == 0){
       rows[i].className = "even";
     }else{
       rows[i].className = "odd";
     }      
   }
 }
}

function Select_Value_Set(SelectName, Value) {
  eval('SelectObject = document.' + 
    SelectName + ';');
  for(index = 0; 
    index < SelectObject.length; 
    index++) {
   if(SelectObject[index].value == Value)
     SelectObject.selectedIndex = index;
   }
}

function imagewin(url){
var newwin = window.open(url, '_Addfile', 'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390');
newwin.focus();
}