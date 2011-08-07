/*
jQuery scripts for theme minyx-20-lite
Code by Timothy 
Version:0.1
Create:2010.02.04
Last Modify:2010.06.14

Modify History List:
Add 2010-6-14 Double click to scroll top


*/


jQuery(document).ready(function($){
	
	//Ctrl+Enter for fast submit
	$("#comment").keydown(
    	function(event){
        	if(event.ctrlKey && event.keyCode == 13)
        	{
            		$("#commentform").submit();
        	}
    	});

	$(".reply").click(
	function(){
		var name = $(this).prevAll().find("cite:first").text();
		$("#comment").text("@"+name+":").focus();
	});
	
	$("#wrapper .post h2 a").click(function(){$(this).text("页面加载中……"); windows.location = $(this).attr("href");  });
	
	
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body'); 
	/*$body.dblclick(function(){$('#container').fadeTo("0", 0.4, function(){$body.animate({scrollTop: 0},700, function(){$('#container').fadeTo("100", 1);});});});*/

	$("#scroller-top").click(
	function(){
	if(!$.browser.msie){
	$('#container').fadeTo("0", 0.4, function(){$body.animate({scrollTop: 0},700, function(){$('#container').fadeTo("100", 1);});});
	}
	else{
	$body.animate({scrollTop: 0},700);
	}
	});
	
	$("#scroller-bottom").click(
	function(){
	if(!$.browser.msie){
	$('#container').fadeTo("0", 0.4, function(){$body.animate({scrollTop: $("#footContent").offset().top},700, function(){$('#container').fadeTo("100", 1);});});
	}
	else{
	$body.animate({scrollTop: $("#footContent").offset().top},700);
	}
	});
	
	$('#container').dblclick(function(e){e.stopPropagation();}); 	
	
	$('#comment').focus(function(){
        time = window.setInterval( 
                function() {
        var val = $('#comment').val();
        var length = val.length;
        if( $("#str").html() != (length) ){

                $("#wordcount")[0].firstChild.nodeValue = "您已输入";
                $("#str").html(length);
        }
    } ,100 );});
    
	
	/* 用 jQuery 为每张图片链接自动加上 class="thickbox" */
$('#content p a').each(function(){ //根据主题内容区的 id 设置选择器
var a_href = $(this).attr('href').toLowerCase();
var file_type = a_href.substring(a_href.lastIndexOf('.'));
if (file_type == '.jpg' || file_type == '.png' || file_type == '.gif'){$(this).addClass('thickbox')};
});

});