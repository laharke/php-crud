function load_tweet() {

    $('#tweets').html('<center><br><br><br><br><br><br><img src="images/loader.gif"></center>');
    getContent('get.php', 'action=twitters', 'tweets', true);

}

function load_caso_exito() {

    ce_cur = (++ce_cur>=ce.length?0:ce_cur);

    $('.caso-exito').animate({opacity: 0}, 'slow', function() {

	$('blockquote.caso-exito').html(ce[ce_cur].say);   
	$('div.caso-exito h4').html(ce[ce_cur].who);
	$('div.caso-exito h5').html(ce[ce_cur].role);
	$('div.caso-exito img').attr('src', ce[ce_cur].logo);
    
	$(this).animate({opacity: 1}, 'slow');
	
    });        
    
    setTimeout(function() {
	load_caso_exito();
    }, 20000);
    
}

