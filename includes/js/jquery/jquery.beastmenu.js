/*

JAVASCRIPT
==========

   $('.menu').beastMenu({
        backButton: true,
        levelCss: new Array(
          {
            color: 'red',
            'font-weight': 'bold'
          }
          ,
          {
            color: "blue",
            'font-size': '25px'
          }
          ,
          {
            color: "green"
          }
        )

    });

HTML
====

<table class="menu">
    <tr>
        <td>
          <span>Raiz 1</span>
            <table>
              <tr>
                <td>
                  <span>Raiz 1.1</span>
                    <table>
                        <tr>
                            <td>
                                <span>Raiz 1.1.1</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Raiz 1.1.2</span>
                            </td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td>
                  <span>Raiz 1.2</span>
                    <table>
                        <tr>
                            <td>
                                <span>Raiz 1.2.1</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Raiz 1.2.2</span>
                            </td>
                        </tr>
                    </table>
                </td>
              </tr>
            </table>
        </td>
    </tr>
</table>

   
*/
$.beastMenu = {

    backButton: true,
    backButtonText: '<span class="back"><</bnsp;</span>',
    levelClasses: [],
    selectedClass: null,
    executedClass: null,
    levelCss: [],
    selectedCss: null,
    simpleClickExecute: false,
    beforeRun: function() {},
    afterRun: function() {},

    Init: function(sel) {

        backButton = this.backButton;
        backButtonText = this.backButtonText;
        selectedClass = this.selectedClass;
        executedClass = this.executedClass;
        simpleClickExecute = this.simpleClickExecute;
        beforeRun = this.beforeRun;
        afterRun = this.afterRun;

        $(sel).addClass('beastMenu');

        levelBase = $(sel).parents('tr').size() + 1;

        // Oculto todo
        $(sel+' table').hide();

        // Asigno los niveles de cada submenu
        $(sel+' td > span').each(function(){

            var td = $(this).parent('td');
            td.attr('level', td.parents('tr').size()-levelBase);
            //td.children('table').css('margin-left', (parseInt(td.attr('level'))+1)*5);

        });

        for (i in this.levelClasses) {

            $(sel+" td[level='"+i+"']").addClass(this.levelClasses[i]);

        }

        for (i in this.levelCss) {

            for (key in this.levelCss[i]) {

                $(sel+" td[level='"+i+"']").css(key, this.levelCss[i][key]);

            }

        }

        // Evento de click en item
        $(sel+' td > span:not(.back)').mouseover(function(){$(this).css('cursor','pointer');}).click(function(e){

            $('.'+selectedClass).removeClass(selectedClass);
            $(this).addClass(selectedClass);
            
            var td = $(this).parent('td');

            //Borro todos los botones back
            if (backButton) $('span.back:not(:first)', td).remove();

            // Si esta cerrado y simpleClickExecute == true, esta abierto, o no tiene submenus veo si tengo que ejecutar algo
            if ((td.attr('open') != 1 && simpleClickExecute) || td.attr('open') == 1 || td.children('table').html() == null) {

                // Aca tengo que ejecutar url si la tiene
                if (td.attr('url') != undefined) {

                    $('.'+executedClass).removeClass(executedClass);
                    $(this).addClass(executedClass);

                    $(document).scrollTop(0);
                    setCursor('wait');
                    td.get(0).style.cursor="pointer";
                    beforeRun();

                    $('#'+td.attr('dst_id')).load(td.attr('url')+'?'+td.attr('params'), function() {setCursor('default'); afterRun();});
                    $(document).scrollTop(0);

                }

                if (!simpleClickExecute) return false;

            }

            // Si tiene submenus
            if (td.children('table').html() != null) {

                $(sel+' table').hide();
                td.parents('table').show();

                if (backButton) { // && !td.closest('table').hasClass('beastMenu')) {

                    td.closest('tbody').children('tr').hide();
                    td.parent('tr').show();
                    
                    td.children('table').show().
                       children('tbody').show().
                       children('tr').show().
                       children('tr').show();

                    // Agrego boton volver
                    //alert(td.children('span.back').html());
                    if (!td.children('span.back').html()) {
                      
                        td.prepend('<span class="back">'+backButtonText+'</span>');
                        
                        // Evento click en boton volver
                        td.children('span.back').attr('onmouseover', 'this.style.cursor="pointer"').click(function() {
                          
                            var td = $(this).parent('td');

                            td.removeClass(selectedClass);

                            td.children('table').hide();
                            td.closest('tbody').children('tr').show();
                            $('span.back', td).remove();
                            //$(this).remove();
                            td.attr('open', 0);

                            return false;

                        });

                    }


                }

                $(sel+' td').attr('open', 0);

                td.attr('open', 1);
                td.children('table').show();

            }

            return false;

        });

    }
    ,
    resetMenu: function() {

        // Oculto todo
        $(sel+' table').hide();
        $(sel+' span.back').remove();
        $(sel+' td').attr('open', 0);
        $(sel+' .'+selectedClass).removeClass(selectedClass);
        $(sel+' .'+executedClass).removeClass(executedClass);
        $(sel+' > tbody > tr ').show();

    }

}

$.fn.beastMenu = function(opt) {

    obj = $.beastMenu;
    sel = this.selector;
    
    if (opt != undefined) {
    
        if (opt.backButton != undefined) obj.backButton = opt.backButton;
        if (opt.backButtonText != undefined) obj.backButtonText = opt.backButtonText;
        if (opt.levelClasses != undefined) obj.levelClasses = opt.levelClasses;
        if (opt.selectedClass != undefined) obj.selectedClass = opt.selectedClass;
        if (opt.executedClass != undefined) obj.executedClass = opt.executedClass;
        if (opt.levelCss != undefined) obj.levelCss = opt.levelCss;
        if (opt.selectedCss != undefined) obj.selectedCss = opt.selectedCss;
        if (opt.simpleClickExecute != undefined) obj.simpleClickExecute = opt.simpleClickExecute;
        if (opt.beforeRun != undefined) obj.beforeRun = opt.beforeRun;
        if (opt.afterRun != undefined) obj.afterRun = opt.afterRun;

    }

    obj.Init(sel);

}

$.fn.beastMenuReset = function() {

    obj = $.beastMenu;
    sel = this.selector;
    obj.resetMenu(sel);

}