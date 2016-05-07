$(document).ready(function(){
	$('.all_m').hide();
	
	$(".all_m_l").click(function(event){
		event.preventDefault();
        $(this).next().slideToggle();
    });
	
});