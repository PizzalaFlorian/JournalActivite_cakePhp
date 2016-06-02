$(document).ready(function(){	
	$(".aide").hide();
	$(".description").click(function(event){
		console.log("click");
		//$("#aide").hide();
		$("this").children('.aide').show("slow");
	});
});