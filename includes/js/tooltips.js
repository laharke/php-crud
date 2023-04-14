// IIFE to ensure safe use of $
(function( $ ) {

  // Create plugin
  $.fn.tooltips = function() { //el) {

//    els = $(el);
    els = $(this);

    var $tooltip,
	$body = $('body'),
        $el;

    // Ensure chaining works
    els.each(function(i, x) {
    
      a = $(this); 	

      $el = a.attr("data-tooltip", i); //.css('display', 'inline-block');

      // Make DIV and append to page 
      var $tooltip = $('<div class="tooltip" data-tooltip="' + i + '" style="display: none;">' + $el.attr('title') + '<div class="arrow"></div></div>').appendTo("body");

      // Position right away, so first appearance is smooth
      var linkPosition = $el.position();

      $el
      // Get rid of yellow box popup
      .removeAttr("title")

      // Mouseenter
      .hover(function() {

        o = $(this);
        $tooltip = $('div[data-tooltip="' + o.attr('data-tooltip') + '"]');

        // Reposition tooltip, in case of page movement e.g. screen resize                        
        var linkPosition = o.position();

        $tooltip.css({
          top: linkPosition.top - $tooltip.outerHeight()*2,
          left: linkPosition.left + (o.width()/2) - ($tooltip.width()/2) - 23,
          display: 'block'
        });

        // Adding class handles animation through CSS
        $tooltip.addClass("active");

        // Mouseleave
      }, function() {

        o = $(this);

        // Temporary class for same-direction fadeout
        $tooltip = $('div[data-tooltip=' + o.attr('data-tooltip') + ']').addClass("out");

        // Remove all classes
        setTimeout(function() {
          $tooltip.removeClass("active").removeClass("out");
        }, 300);

      });

    });

  }

})(jQuery);