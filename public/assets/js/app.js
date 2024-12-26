let token;
const choisejs = [];
const tokenInp = document.querySelector("input[name='token']");
if (tokenInp) {
    token = tokenInp.value;
}

function initSelects() {
    let sorterFunctions;
    const choies = document.querySelectorAll('.choicesjs, .choices-multiple');
    Array.from(choies, (elem) => {
        if (!choisejs.find(select => select.passedElement.element == elem)) {
            
            const classes = {
                'containerOuter': ['choices']
            };
            
            if (elem.dataset.class) {
                classes['containerOuter'].push(String(elem.dataset.class));
            }

            if (elem.classList.contains('sort-value')) {
                sorterFunctions = function(a, b) {
                    return a.value - b.value;
                }
            }

            let isSearchIncluded = true;
            if (elem.classList.contains('disable-search')) {
                isSearchIncluded = false;
            }

            const newChoice = new Choices(elem, {
                removeItemButton: true,
                searchPlaceholderValue: 'Поиск ...',
                noResultsText: 'Не найдено...',
                itemSelectText: 'Выбрать',
                noChoicesText: 'Нет доступных вариантов',
                classNames: classes,
                duplicateItemsAllowed: false,
                searchEnabled: isSearchIncluded,
                searchFields: ['label', 'value'],
                ...(sorterFunctions && {sorter: sorterFunctions})
            });

            if (elem.classList.contains('disabled')) {
                newChoice.disable();
            }

            choisejs.push(newChoice);
        }
    });
}
document.addEventListener('DOMContentLoaded', initSelects);
window.addEventListener('change', initSelects);

function getChoiceObject(elem) {
    const obj = choisejs.find(select => select.passedElement.element == elem);
    return obj;
}

function select(id, name, placeholder, items_arr, className, selected_value) {

    const select = document.createElement('select');
    select.id = id;
    select.name = name;
    select.dataset.class = 'hidden_options';

    select.classList.add('form-control', 'choicesjs');
    
    if (className) {
        select.classList.add(className);
    }
    if (className == 'choose_partner') {
        select.classList.add('disable-search');
    }

    let opt = document.createElement('option');
    opt.value = '';
    opt.setAttribute('placeholder', '');
    opt.innerText = placeholder ?? '';
    select.appendChild(opt);
        
    Array.from(items_arr, item => {
        let opt = document.createElement('option');
        opt.value = item.value;
        opt.innerHTML = item.label;
        if (item.value == selected_value) opt.selected = 'selected';
        if (item.disabled) opt.disabled = 'disabled';
        select.appendChild(opt);
    });
    
    // select.addEventListener('change', inputsChangesHandler);
    // select.addEventListener('addItem', choosedSelectItem, false);
    // select.addEventListener('removeItem', removeSelectItem, false);
    
    return select;
}

function renameProp(obj, old_name, new_name) {
    Object.defineProperty(obj, new_name, Object.getOwnPropertyDescriptor(obj, old_name));
    delete obj[old_name];

    return obj;
}

function agesOfTechnicHandler() {
    const sel = getChoiceObject($("select[name='order[ages_of_technic]']")[0]);

    if (sel.getValue()) {
        $('input.ages_of_technic')[0].disabled = true;
    } else {
        $('input.ages_of_technic')[0].disabled = false;
    }

}

function agesOfTechnicInputHandler(e) {
    const inp = $("input[name='order[ages_of_technic]']")[0];
    if (e.target.value) {
        getChoiceObject($("select[name='order[ages_of_technic]']")[0]).disable();
    } else {
        getChoiceObject($("select[name='order[ages_of_technic]']")[0]).enable();
    }
}

function brokenTypeHandler(event) {
    const selTechType = $("select[name='order[technic_type_id]']")[0];
    const selTechTypeObj = getChoiceObject(selTechType);
    const selBrokenType = $("select[name='order[broken_type_id]']")[0];
    const selBrokenTypeObj = getChoiceObject(selBrokenType);

    selBrokenTypeObj.enable();
    selBrokenTypeObj.removeActiveItems();
    selBrokenType.querySelectorAll(`option`).forEach(el => {
        el.disabled = 'disabled'
    });
    selBrokenType.querySelectorAll(`option[data-type="${event.detail.value}"]`).forEach(el => {
        el.disabled = '';
    });
    selBrokenTypeObj.refresh();
    if (!selTechTypeObj.getValue()) {
        selBrokenTypeObj.hideDropdown();
        selBrokenTypeObj.disable();
    }

}

const autosubmitSelects = document.querySelectorAll('.autosubmit');
autosubmitSelects.forEach(select => {
    select.addEventListener('change', (e) => {
        e.target.closest('form').submit();
    });
});

// const timeField = document.querySelector('input.time');
// console.log(123);
// timeField.addEventListener('beforeinput', (e) => {
//     console.log(e);
// });



(function(jQuery) {

    "use strict";

    jQuery(document).ready(function() {

        document.addEventListener('gesturestart', function (e) {
            e.preventDefault();
        });

        if ($("select[name='order[technic_type_id]']").length){
            $("select[name='order[technic_type_id]']")[0].addEventListener('change', brokenTypeHandler);
        }

        if ($("select[name='order[ages_of_technic]']").length){
            $("select[name='order[ages_of_technic]']")[0].addEventListener('change', agesOfTechnicHandler);
        }

        if ($("input[name='order[ages_of_technic]']").length){
            $("input[name='order[ages_of_technic]']")[0].addEventListener('input', agesOfTechnicInputHandler);
        }

        if ($(".show_more_logs").length){
            $(".show_more_logs").on('click', (e) => {
                e.preventDefault();
                
                $(".log.d-none").each((idx, log) => {
                    log.classList.remove('d-none');
                });

                e.target.classList.add('d-none');
            });
        }
        


        if ($("input.time").length) {
            $.mask.definitions['h']='[0,1,2]';
            $.mask.definitions['H']='[0,1,2,3,4,5,6,7,8,9]';
            $.mask.definitions['m']='[0,1,2,3,4,5]';
            $.mask.definitions['M']='[0,1,2,3,4,5,6,7,8,9]';
            $("input.time").mask("hH:mM", {autoclear: false});
        }

        document.querySelectorAll('input.time').forEach(time_inp => {
            time_inp.addEventListener('beforeinput', function (event) {
                console.log(event);
            });
        });

        if ($(".types_selector").length){
            
            $(".types_selector label").each((num, el) => {
                
                $(el).on('click', (e) => {
                    e.preventDefault();

                    const single = $(e.target).parents('.one_type');
                    const input = $(single).find('input')[0];

                    if (input.checked) {
                        $(input).prop('checked', false);
                        $(e.target).parents('form').submit();
                    } else {
                        $(input).prop('checked', true);
                        $(e.target).parents('form').submit();
                    }
                    
                });
            });
        }

        if ($("#pictureCustomFile").length){
            if (pictureCustomFile) {
                pictureCustomFile.onchange = evt => {
                    const [file] = pictureCustomFile.files;
        
                    if (file) {
                        let preview_img = $(".picture-choose").find('.preview-block').find('img');
                        preview_img[0].src = URL.createObjectURL(file);
                    }
                }
            }
        }

        if ($(".animated-background").length > 0){
            var blocks_to_load = $(".animated-background");

            // blocks_to_load.each(function() {
            //     var block = $(this);
            //     if ($(this).hasClass('get-data-method')) {
            //         var method = $(this).data('method');
            //
            //         var date_start = $('input[name="stat_start"]').val();
            //         var date_finish = $('input[name="stat_finish"]').val();
            //
            //         $.ajax({
            //             url: '/get-data.php',
            //             type: 'POST',
            //             async: true,
            //             data: {
            //                 action: method,
            //                 date_start: date_start,
            //                 date_finish: date_finish,
            //             },
            //             beforeSend: function(xhr) {},
            //             success: function(data) {
            //                 // console.log(data);
            //                 if (method == "get_ya_direct_summary_expense") {
            //                     var inc_data = jQuery.parseJSON(data);
            //                     block.find('h6 span').html(inc_data[0]);
            //                     block.find('input .ya_direct_summary_expense').val(inc_data[1]);
            //                     block.removeClass('animated-background');
            //
            //                     var summary_incomes = $('.summary_income').val(); // суммарный приход
            //                     var summary_turn = $('.summary_turn').val(); // суммарный оборот
            //                     var other_expenses = $('.other_expenses').val(); // прочие расходы
            //                     var other_incomes = $('.other_incomes').val(); // прочие приходы
            //                     var orders = $('.sum_good_orders').val(); // заказов
            //
            //                     var fixed_income = Math.round( parseFloat(summary_incomes)
            //                                                  + parseFloat(other_incomes)
            //                                                  - parseFloat(inc_data[1])
            //                                                  - parseFloat(other_expenses) ); // прибыль
            //
            //                     var fixed_income_percent = Math.round( fixed_income * 100 / summary_turn * 10)  / 10; // процент прибыли
            //                     if (fixed_income_percent == -Infinity) fixed_income_percent = 0;
            //
            //                     var lead_price = Math.round( inc_data[1] / orders );
            //
            //                     $('.fixed_income').find('h6').html( fixed_income.toLocaleString('ru') + '  ₽');
            //                     $('.fixed_income').find('input').val(fixed_income);
            //                     $('.fixed_income').find('.income_fixed_val').html(fixed_income_percent + "%");
            //                     $('.fixed_income').removeClass('animated-background');
            //
            //                     $('.lead_price').html(lead_price.toLocaleString('ru') + '  ₽');
            //                     $('.lead_price').closest('.card-body').removeClass('animated-background');
            //
            //                 } else if (method == "get_ya_direct_today") {
            //                     block.find('h6 span').html(data);
            //                     block.removeClass('animated-background');
            //                 } else {
            //                     block.find('h6').html(data);
            //                     block.removeClass('animated-background');
            //                 }
            //
            //             },
            //             error: function(errorThrown) {
            //                 block.append('<p>Произошла ошибка при загрузки блока.</p>');
            //                 block.removeClass('animated-background');
            //             }
            //         });
            //
            //
            //     }
            //
            // });

        }

        $('img.img-svg').each(function(){
            const $img = jQuery(this);
            const imgClass = $img.attr('class');
            const imgURL = $img.attr('src');
            jQuery.get(imgURL, function(data) {
                let $svg = jQuery(data).find('svg');
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }
                $img.replaceWith($svg);
            }, 'xml');
        });

        $('.input-file input[type=file]').on('change', function(){
            let $preview_img = $(this).closest('.file-block').next('.preview-block').find('img');

            var dt = new DataTransfer();

            let file = this.files.item(0);
            dt.items.add(file);

            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function(){
                $preview_img.attr('src', reader.result);
            }
        });

        function iconChoose() {

            var iconModalBlock = document.getElementById('iconModal');
            var iconModal = new bootstrap.Modal(iconModalBlock, {
                keyboard: false
            });

            $(".icon-choose").on("click", "a.choose-icon", function(e){
                e.preventDefault();
                iconModal.show();

                $.ajax({
                    url: "/api/v1/app/getIconsList",
                    async: false,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer scGz0URiSG99ds-nRCJPxWw46TJTBquXF58Qub8DL5V3b2gU5siU!qOUGcZSF0iPILyRjajOym");
                    },
                    success: function(data) {
                        var data = $.parseJSON(data);
                        var outputIcons = '';

                        $(data).each(function(key, val){
                            outputIcons = outputIcons + '<img src="/' + val + '">';
                        });
                        $("#iconModal").find('.modal-body').html(outputIcons);
                    },
                    error: function (request, status, error) {
                        $("#iconModal").find('.modal-body').html(error);
                    }

                });

            });

            $("#iconModal .modal-body").bind("click", "img", function(e){
                var src = e.target.getAttribute('src');
                let $input = $(".icon-choose").find('input[name="icon"]');
                let $preview_img = $(".icon-choose").find('.preview-block').find('img');
                $preview_img.attr('src', src);
                $input.val(src);
                iconModal.hide();
            });

            $("#iconModal").on("click", "button.btn-close", function(e){
                iconModal.hide();
            });

        }
        iconChoose();


        $(".card_chat").on("click", ".search_chat .btn", function(){

            var block = $(this).parent('.search_block').parent('.search_chat');
            var search_found = block.find('.search_found');
            var text         = block.find("input").val().toUpperCase();

            if (text.length > 0) {
                var messages = $(".conversation-container .message .body");
                var found = [];

                messages.each(function(e,v){
                    if (v.innerHTML.toUpperCase().indexOf(text) > -1) {
                        found.push($(this).parent('.message').attr('id'));
                    }
                });

                if ( found.length === 0 ) {
                    search_found.html('<div>Ничего не найдено.</div>');
                } else {
                    if (found.length === 1) {
                        var div = $(".conversation-container");
                        var target = $("#" + found[0]);
                        target.addClass('target_mes');
                        div.animate({ scrollTop: target.prop('offsetTop') }, 400);
                        search_found.html('<div>Найдено 1 сообщение.</div>');
                    } else if (found.length >= 2) {
                        var div = $(".conversation-container");
                        var target = $("#" + found[0]);
                        target.addClass('target_mes');
                        div.animate({ scrollTop: target.prop('offsetTop') }, 400);
                        search_found.html('<div>Найдено сообщений: ' + found.length + '.<input type="hidden" class="cur_mes" value="' + found[0] + '"></div><div class="next_mes">К следующему</div>');
                        localStorage.setItem("search_res", JSON.stringify(found));
                    }

                }

            } else {
                search_found.html('<div class="error">Вы не ввели поисковой запрос.</div>');
            }

        });

        if ($(".services_select").length > 0){

            $(".table_filter").on("change", ".services_select, .cities_select", function(){
                $('form.orders_filter').submit();
            });

        }

        // $('.audio').each('click', 'class', function(e){

        // });

        $.fn.setCursorPosition = function(pos) {
              if ($(this).get(0).setSelectionRange) {
                $(this).get(0).setSelectionRange(pos, pos);
              } else if ($(this).get(0).createTextRange) {
                var range = $(this).get(0).createTextRange();
                range.collapse(true);
                range.moveEnd('character', pos);
                range.moveStart('character', pos);
                range.select();
              }
        };

        $(function(){
            $.mask.definitions['~']='[3,4,8,9]';

            $("input[type='tel']").click(function(elem){
                var mypos = $(this).val().match(/[0-9]/g).length;
                if ( mypos <= 4 ) {
                    $(this).setCursorPosition(mypos + 3);
                } else if ( mypos > 4 && mypos <= 7 ) {
                    $(this).setCursorPosition(mypos + 5);
                } else if ( mypos > 7 ) {
                    $(this).setCursorPosition(mypos + 6);
                }
            }).mask("+7 (~99) 999-99-99",{autoclear: false});

        });

        

        $("form.create-client").on("click", "button[type=submit]", function(){
            if ( $('input[name="clients[phone]"]').val().replace(/[^0-9]/gi,'').length < 11 ) {
                alert('Заполните поле телефон!');
                return false;
            }

        });

        $(document).on('input', '.numeric', function (e) {
            this.value = this.value.replace(/[^\d.]+|(\.\d{2})\d*$/g, '$1').replace(/\d(?=(?:\d{3})+(?!\d))/g, "$& ");
        });
        $('.numeric').keydown(function(e) {
          if (e.keyCode === 190) {
            e.preventDefault();
            return;
          }
        });

        /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
        jQuery('[data-toggle="popover"]').popover();
        jQuery('[data-toggle="tooltip"]').tooltip();

        /*---------------------------------------------------------------------
        Fixed Nav
        -----------------------------------------------------------------------*/

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 0) {
                $('.iq-top-navbar').addClass('fixed');
            } else {
                $('.iq-top-navbar').removeClass('fixed');
            }
        });

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 0) {
                $('.white-bg-menu').addClass('sticky-menu');
            } else {
                $('.white-bg-menu').removeClass('sticky-menu');
            }
        });


       /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/

        jQuery(document).on("click", '.side-menu > li > a', function() {
            jQuery('.side-menu > li > a').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
        });

        // Active menu
        var parents = jQuery('li.active').parents('.submenu.collapse');

        parents.addClass('show');


        parents.parents('li').addClass('active');
        jQuery('li.active > a[aria-expanded="false"]').attr('aria-expanded', 'true');

        /*---------------------------------------------------------------------
        FullScreen
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.full-screen', function() {
            let elem = jQuery(this);
            elem.find('i').addClass('d-none');
            elem.find('i').addClass('d-none');
            if (!document.fullscreenElement &&
                !document.mozFullScreenElement && // Mozilla
                !document.webkitFullscreenElement && // Webkit-Browser
                !document.msFullscreenElement) { // MS IE ab version 11
                    elem.find('.min').removeClass('d-none');
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                elem.find('.max').removeClass('d-none');
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        });


        /*---------------------------------------------------------------------
        Page Loader
        -----------------------------------------------------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay().fadeOut("");


        /*---------------------------------------------------------------------
        Counter
        -----------------------------------------------------------------------*/
        if (window.counterUp !== undefined) {
            const counterUp = window.counterUp["default"]
            const $counters = $(".counter");
            $counters.each(function (ignore, counter) {
                var waypoint = new Waypoint( {
                    element: $(this),
                    handler: function() {
                        counterUp(counter, {
                            duration: 1000,
                            delay: 10
                        });
                        this.destroy();
                    },
                    offset: 'bottom-in-view',
                } );
            });
        }


        /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
        jQuery('.iq-progress-bar > span').each(function() {
            let progressBar = jQuery(this);
            let width = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'width 2s'
            });
            setTimeout(function() {
                    progressBar.css('width', width + '%');
            }, 100);
        });

        jQuery('.progress-bar-vertical > span').each(function () {
            let progressBar = jQuery(this);
            let height = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'height 2s'
            });
            setTimeout(function () {
                    progressBar.css('height', height + '%');
            }, 100);
        });


        /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.wrapper-menu', function() {
            jQuery(this).toggleClass('open');
        });

        jQuery(document).on('click', ".wrapper-menu", function() {
            jQuery("body").toggleClass("sidebar-main");
        });


      /*---------------------------------------------------------------------
       Close  navbar Toggle
       -----------------------------------------------------------------------*/

        jQuery('.close-toggle').on('click', function () {
            jQuery('.h-collapse.navbar-collapse').collapse('hide');
        });

        /*---------------------------------------------------------------------
        user toggle
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.user-toggle', function() {
            jQuery(this).parent().addClass('show-data');
        });

        jQuery(document).on('click', ".close-data", function() {
            jQuery('.user-toggle').parent().removeClass('show-data');
        });
        jQuery(document).on("click", function(event){
        var $trigger = jQuery(".user-toggle");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            jQuery(".user-toggle").parent().removeClass('show-data');
        }
        });

        /*---------------------------------------------------------------------
        Data tables
        -----------------------------------------------------------------------*/
        if($.fn.DataTable){
            const table = $('.data-table').DataTable({
                "language": {
                    "sProcessing":    "Выполняется...",
                    "sLengthMenu":    "Показывать _MENU_ записей на странице",
                    "sZeroRecords":   "Записей не найдено",
                    "sEmptyTable":    "Пустая таблица",
                    "sInfo":          "Показаны с _START_ по _END_ запись из _TOTAL_ записей",
                    "sInfoEmpty":     "Показано 0 из 0 записей, всего 0 записей",
                    "sInfoFiltered":  "(Отфильтровано _MAX_ записей)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Поиск:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Загрузка...",
                    "oPaginate": {
                        "sFirst":    "Первая",
                        "sLast":    "Последняя",
                        "sNext":    "Следующая",
                        "sPrevious": "Предыдущая"
                    },
                    "oAria": {
                        "sSortAscending":  ": Сортировать по возрастанию",
                        "sSortDescending": ": Сортировать по убыванию"
                    }
                },
                "aoColumnDefs" : [ {
                    "bSortable" : false,
                    "aTargets" : [ "no-sort" ]
                }],
                "order": [[ 0, "desc" ]]
            });
        }


        /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

      /*---------------------------------------------------------------------
       Active Class for Pricing Table
       -----------------------------------------------------------------------*/
      jQuery("#my-table tr th").click(function () {
        jQuery('#my-table tr th').children().removeClass('active');
        jQuery(this).children().addClass('active');
        jQuery("#my-table td").each(function () {
          if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active')
          }
        });
        var col = jQuery(this).index();
        jQuery("#my-table tr td:nth-child(" + parseInt(col + 1) + ")").addClass('active');
      });


        /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/

        jQuery('.data-scrollbar').each(function () {
            var attr = $(this).attr('data-scroll');
            if (typeof attr !== typeof undefined && attr !== false){
            let Scrollbar = window.Scrollbar;
            var a = jQuery(this).data('scroll');
            Scrollbar.init(document.querySelector('div[data-scroll= "' + a + '"]'));
            }
        });


      /*---------------------------------------------------------------------
      image-upload
      -----------------------------------------------------------------------*/

      $('.form_gallery-upload').on('change', function() {
          var length = $(this).get(0).files.length;
          var galleryLabel  = $(this).attr('data-name');

          if( length > 1 ){
            $(galleryLabel).text(length + " files selected");
          } else {
            $(galleryLabel).text($(this)[0].files[0].name);
          }
        });

    /*---------------------------------------------------------------------
        video
      -----------------------------------------------------------------------*/
      $(document).ready(function(){
      $('.form_video-upload input').change(function () {
        $('.form_video-upload p').text(this.files.length + " file(s) selected");
      });
    });


        /*---------------------------------------------------------------------
        Button
        -----------------------------------------------------------------------*/

        jQuery('.qty-btn').on('click',function(){
          var id = jQuery(this).attr('id');

          var val = parseInt(jQuery('#quantity').val());

          if(id == 'btn-minus')
          {
            if(val != 0)
            {
              jQuery('#quantity').val(val-1);
            }
            else
            {
              jQuery('#quantity').val(0);
            }

          }
          else
          {
            jQuery('#quantity').val(val+1);
          }
        });

    });


    $(document).on('click', '[data-toggel-extra="side-nav"]', function () {
        const pannel = $(this).attr('data-expand-extra')
        $(pannel).addClass('active')
    })

    $(document).on('click', '[data-toggel-extra="side-nav-close"]', function () {
        const pannel = $(this).attr('data-expand-extra')
        $(pannel).removeClass('active')
    })

    $(document).on('click', '[data-toggel-extra="right-sidenav"]', function () {
        const target = $(this).data('target')
        $(target).addClass('active')
    })

    $(document).on('click', '[data-extra-dismiss="right-sidenav"]', function () {
        $(this).closest('.right-sidenav').removeClass('active')
    })

    $(document).on('click', '[data-toggle="end-call"]', function(){
        $(this).closest('.tab-pane').removeClass('active').removeClass('show')
        $($(this).attr('data-target')).tab('show')
        $('.chat-action').find('[data-toggle="tab"]').removeClass('active')
    })

    $(document).on('click', '[data-toggle-extra="tab"]', function () {
        const target = $(this).attr('data-target-extra')
        $('[data-toggle-extra="tab-content"]').removeClass('active')
        $(target).addClass('active')
        $(this).parent().find('.active').removeClass('active')
        $(this).addClass('active')
    })

    $('emoji-picker').on('emoji-click', function(e){
        $(e.target.dataset.targetInput).val($(e.target.dataset.targetInput).val()+e.detail.unicode)
    })

    $('.dropdown-menu').on('click', function(event){
        event.stopPropagation();
    });

    // calender 1 js
    var calendar1;
    if (jQuery('#calendar1').length) {
        var calendarEl = document.getElementById('calendar1');

            calendar1 = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                plugins: ["timeGrid", "dayGrid", "list", "interaction"],
                timeZone: "UTC",
                defaultView: "dayGridMonth",
                contentHeight: "auto",
                eventLimit: true,
                dayMaxEvents: 4,
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                },
                dateClick: function (info) {
                    $('#schedule-start-date').val(info.dateStr)
                    $('#schedule-end-date').val(info.dateStr)
                    $('#date-event').modal('show')
                },
                events: [
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-20, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#4731b6'
                    },
                    {
                        title: 'All Day Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-18, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#465af7'
                    },
                    {
                        title: 'Long Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-16, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        end: moment(new Date(), 'YYYY-MM-DD').add(-13, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#7858d7'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-14, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#465af7'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-12, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#5baa73'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-10, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#01041b'
                    },
                    {
                        title: 'Birthday Party',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-8, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#4731b6'
                    },
                    {
                        title: 'Meeting',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-6, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#15ca92'
                    },
                    {
                        title: 'Birthday Party',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-5, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#f4a965'
                    },
                    {
                        title: 'Birthday Party',
                        start: moment(new Date(), 'YYYY-MM-DD').add(-2, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#ea643f'
                    },

                    {
                        title: 'Meeting',
                        start: moment(new Date(), 'YYYY-MM-DD').add(0, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#15ca92'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: moment(new Date(), 'YYYY-MM-DD').add(0, 'days').format('YYYY-MM-DD') + 'T06:30:00.000Z',
                        color: '#4731b6'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(0, 'days').format('YYYY-MM-DD') + 'T07:30:00.000Z',
                        color: '#5baa73'
                    },
                    {
                        title: 'Birthday Party',
                        start: moment(new Date(), 'YYYY-MM-DD').add(0, 'days').format('YYYY-MM-DD') + 'T08:30:00.000Z',
                        color: '#f4a965'
                    },
                    {
                        title: 'Doctor Meeting',
                        start: moment(new Date(), 'YYYY-MM-DD').add(0, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#f4a965'
                    },
                    {
                        title: 'All Day Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(1, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#465af7'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(8, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#465af7'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: moment(new Date(), 'YYYY-MM-DD').add(10, 'days').format('YYYY-MM-DD') + 'T05:30:00.000Z',
                        color: '#5baa73'
                    }
                ]
            });
            calendar1.render();

        $(document).on("submit", "#submit-schedule", function (e) {
            e.preventDefault()
            const title = $(this).find('#schedule-title').val()
            const startDate = moment(new Date($(this).find('#schedule-start-date').val()), 'YYYY-MM-DD').format('YYYY-MM-DD') + 'T05:30:00.000Z'
            const endDate = moment(new Date($(this).find('#schedule-end-date').val()), 'YYYY-MM-DD').format('YYYY-MM-DD') + 'T05:30:00.000Z'
            const color = $(this).find('#schedule-color').val()
            const event = {
                title: title,
                start: startDate || '2020-12-22T02:30:00',
                end: endDate || '2020-12-12T14:30:00',
                color: color || '#7858d7'
            }
            $(this).closest('#date-event').modal('hide')
            calendar1.addEvent(event)
        })
    }

    const progressBar = document.getElementsByClassName('circle-progress')
    Array.from(progressBar, (elem) => {
        const minValue = elem.getAttribute('data-min-value')
        const maxValue = elem.getAttribute('data-max-value')
        const value = elem.getAttribute('data-value')
        const  type = elem.getAttribute('data-type')
        if (elem.getAttribute('id') !== '' && elem.getAttribute('id') !== null) {
            new CircleProgress('#'+elem.getAttribute('id'), {
            min: minValue,
        max: maxValue,
        value: value,
        textFormat: type,
        });
        }
    })
    /*---------------------------------------------------------------------
            Vanila Datepicker
    -----------------------------------------------------------------------*/

    // const datepickers = document.querySelectorAll('.vanila-datepicker')
    // Array.from(datepickers, (elem) => {
    //     new Datepicker(elem, {
    //         language: 'ru',
    //     })
    // })

    Datepicker.locales.ru = {
          days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
          daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
          daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
          months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
          monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
          today: "Сегодня",
          weekstart: 1,
          clear: "Очистить",
          titleFormat: "MM y",
          format: "dd.mm.yyyy"
    }

    if ($('#createOrderDate').length > 0) {

        const createOrderDate = document.querySelector('#createOrderDate');

        const orderDate = new Datepicker(createOrderDate, {
            title: "Дата заказа",
            clearBtn: 1,
            weekStart: 1,
            todayBtn: 1,
            todayBtnMode: 1,
            todayHighlight: 1,
            autohide: 1,
            clearButton: true,
            language: 'ru',

        });

    }

    if ($('#DateOfFix').length > 0) {

        const DateOfFix = document.querySelector('#DateOfFix');

        const DateOfFixObj = new Datepicker(DateOfFix, {
            title: "Дата и время заказа",
            clearBtn: 1,
            weekStart: 1,
            todayBtn: 1,
            todayBtnMode: 1,
            todayHighlight: 1,
            autohide: 1,
            clearButton: true,
            language: 'ru',
        });

    }

    if ($('#createExpenseDate').length > 0) {

        const createExpenseDate = document.querySelector('#createExpenseDate');

        const expenseDate = new Datepicker(createExpenseDate, {
            title: "Дата расхода",
            clearBtn: 1,
            weekStart: 1,
            todayBtn: 1,
            todayBtnMode: 1,
            todayHighlight: 1,
            autohide: 1,
            clearButton: true,
            language: 'ru',

        });

    }


    const daterangePickers = document.querySelectorAll('#datesForStat')
    Array.from(daterangePickers, (elem) => {
        new DateRangePicker(elem, {
            title: "Диапазон дат",
            clearBtn: 1,
            weekStart: 1,
            todayBtn: 1,
            todayBtnMode: 1,
            todayHighlight: 1,
            autohide: 1,
            clearButton: true,
            language: 'ru',
        });
    });


        // console.log(elem);
        // DateRangePicker.locales.ru = {
        //   days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        //   daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        //   daysMin: ["Su", "Пн", "Tu", "We", "Th", "Fr", "Sa"],
        //   months: ["January", "February", "March", "April", "May", "June", "July", "August", "Сентябрь", "October", "November", "December"],
        //   monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //   today: "Today",
        //   clear: "Очистить",
        //   titleFormat: "MM y",
        //   format: "mm/dd/yyyy",
        //   weekstart: 1
        // }
    // })
})(jQuery);
