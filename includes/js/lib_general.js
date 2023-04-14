/*
 * Conjunto de funciones necesarias para el funcionamiento de
 * algunas funcionalidades comunes a todos los archivos.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: propietaria
 *
 * @category   Libreria
 * @package    lib_general.js
 * @author     Sebastian Sack (sebasack@vianetcon.com.ar)
 * @author
 * @copyright  2008
 * @license    Propietary
 * @link       http://www.spi40.tacho.vianetcon.com.ar/includes/js/lib_general.js
 * @see
 * @since      Disponible desde Release 1
 * @deprecated
 */

// Extensiones varias a jquery
(function($) {
  var cache = [];
  // Arguments are image paths relative to the current page.
  $.preloadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
  }
})(jQuery)

// Comienza libreria general

var showBlock = false;
var ajaxTimeout = 30000;
var timer = 0;

$(document).ready(function() {

    $.ajaxSetup( {
              url: "./",
              type: "GET"
    } );

});

function getMsg($msg, $params ) {
	for(var clave in $params){
		$msg=$msg.replace(clave,$params[clave]);
	};
	return $msg;
};


function permitirSoloNumeros(e) {
    var returnVal = true;

	tecla = (document.all) ? e.keyCode : e.which;

     //inicio=2         fin= 3       flechas izq= 29   flechas der=28  flechas up=30
    //flechas down=31   backspace=8  supr=127          espacio=32      TAB=9


    //TODOS LOS NÚMEROS y ESPACIO
    if ((tecla >= 48 && tecla <= 57)){
        returnVal = true;
    }else{
        //FLECHAS+ESPACIO
        if ((tecla >= 28 && tecla <= 32)){
            returnVal = true;
        }else{
            //INICIO+FIN+BACKSPACE+SUPR+TAB
            if ((tecla == 2 || tecla == 3 || tecla == 8 || tecla == 127 || tecla == 9)){
                returnVal = true;
            }else{
                //NO VALIDA
                returnVal = false;
                //hacer el Beep!
                //doBeep();
            };
        };
    };
    return returnVal;
};

// Funciones de mensajeria de espera
function blockPage(msg) {

//    if (msg == '') msg = '<h5><img src="images/busy.gif" />'+msg+'</h5>';

//    document.all["div_msg"].display = 'block';
//    document.all["div_msg"].innerHTML = msg;

//    alert(msg);
//    if (showBlock) $.blockUI('<h4><img src="images/busy.gif" />'+msg+'</h4>');

};

function unblockPage() {

//    $("#div_msg").hide();
//    $.unblockUI();
//    showBlock = false;

};


function setCursor(set) {

    document.body.style.cursor = set;

};


function getContent(url, params, id, async, type, block, onComplete) {

    var ret;

    if (typeof(async) == 'undefined') async = false;
    if (typeof(type) == 'undefined') type = "GET";
    if (typeof(onComplete) == 'undefined') onComplete = function(){};

    //if (block) blockBody('/images/ajax-loader.gif');

	  $.ajax({
    	url: url,
	    data: params,
	    type: type,
	    timeout: ajaxTimeout,
	    async: async,
	    cache:false,
	    global: true,
    	processData: true,
	    ifModified: false,
	    contentType: "application/x-www-form-urlencoded",
      dataType: "html",
	    beforeSend: function(objeto){
		    setCursor('wait');
        //blockBody('/images/ajax-loader.gif');
	    },
    	error: function(objeto, quepaso, otroobj){
		    setCursor('default');
		    alert("No se pudo completar la operacion: "+quepaso);
		    ret = false;
      },
      complete: function(XMLHttpRequest, textStatus){
        if (block) unblockBody();
      },
      success: function(datos){
	    if (typeof(id) == 'undefined' || id == '') {
	        ret = datos;
            } else {
      		$("#"+id).html(datos);
        	$("#"+id).show();
        	ret = true;
	    }
	    setCursor('default');
	    onComplete(datos);
      }
    });

    return ret;

};

function toGetParams(array) {

    var out = '';

    $.each(array, function() {
       //alert(this+'  '+$('#'+this).val());
       if ($('#'+this).attr('type') == 'checkbox') {

           out = out + '&' + this + '=' + $.URLEncode($('#'+this).attr('checked'));

       } else {

           out = out + '&' + this + '=' + $.URLEncode($('#'+this).val());

       }

    });

    return out.replace(/\n/g, "%0A");

};

function blockBody(img) {

    if ($('#_block').html() != undefined) return;

    setCursor('wait');
    
    if (img == undefined) {

        img = '';

    } else {

        xtop = $(window).height() / 2 - 27;
        xleft =$(window).width() / 2 - 27;
        img = '<div style="position: relative; top: '+xtop+'px; left: '+xleft+'px;"><img src="'+img+'" border="0"/></div>';

    }

    $('body').append('<div id="_block" class="hide floating">'+img+'</div>').css('overflow', 'hidden');

    $('#_block').css({'z-index': '2',height:'100%',width:'100%', position:'absolute', left:0})
                 .css('top', $(document).scrollTop())
                 .css('background-color', '#eeeeee')
                 .css('opacity', '.5')
                 .css('filter', 'alpha(opacity=50)')
                 .css('-moz-opacity', '.5')
                 .show();


    
}

function unblockBody() {
    
    $('#_block').remove();
    $('body').css('overflow', 'auto')
    setCursor('default');

}

function browserHeight() {

   if (typeof( window.innerHeight ) == 'number' ) {
       val = window.innerHeight;
   } else {
       val = document.documentElement.clientHeight;
   }

   return val;

}

function browserWidth() {

   if (typeof( window.innerWidth ) == 'number' ) {
       val = window.innerWidth;
   } else {
       val = document.documentElement.clientWidth;
   }

   return val;

}

function isUndefined(x) {
    return x == null && x !== null;
};

function openModal(url, params, closebutton, w, h) {

    if (w != undefined) $('#main-modal div.main-modal-content').width(w);
    if (h != undefined) $('#main-modal div.main-modal-content').height(h);

    if (params == '' || params == undefined) {

        html = url;

    } else {

        html = getContent(url, params);

    }

    if (closebutton != undefined && closebutton) {
        html += '<div class="main-modal-close" onclick="closeModal();">x</div>';
    }

    $('body').css('overflow', 'hidden');
    $('#main-modal div.main-modal-content').html(html);
    $('#main-modal').fadeIn();

}

function closeModal() {

    $('#main-modal div').html('');
    $('#main-modal').fadeOut();
    $('body').css('overflow', 'auto');

}

