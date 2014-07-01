
$(document).ready(setupNav);  

var navCurrent;

function setupNav(){
	var items = $("#nav li:has(ul) > a");

	items.click(function(e){
		e.preventDefault();
		
		if(navCurrent != this){
			// Close all
			$("#nav ul").hide();
			$("#nav li > a").css("color", null);
		
			// Open selected element
			$(this).parent().children("ul").slideDown("fast");
			$(this).parent().children("ul a").css("color", "#666");
			$("#nav li.active > a").css("color", null); 
			
			navCurrent = this;
		}else{
			$(this).parent().children("ul").slideUp("fast");
			navCurrent = null;
		}

	});
}

