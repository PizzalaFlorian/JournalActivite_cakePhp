$(document).ready(function(){
 $(".menu_aide").next().hide();
 
 // $("*:not(.menu_aide)").click(function(e){
 //   $(".menu_aide").next().hide();
 // });
 
 $(".menu_aide").click(function(e){
		e.preventDefault();   
		$(".menu_aide").next().hide();
  $(this).next().show();
		});
});