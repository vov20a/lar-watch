// slider
$(function() {
    // Slideshow 4
    $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function() {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function() {
            $('.events').append("<li>after event fired.</li>");
        }
    });

});
//slider product
$(window).load(function() {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });
});
//accordion
$(function() {

    var menu_ul = $('.menu_drop > li > ul'),
        menu_a = $('.menu_drop > li > a');

    menu_ul.hide();

    menu_a.click(function(e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true, true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true, true).slideUp('normal');
        }
    });

});
//search=====================
jQuery(document).ready(function($) {
    $(function() {
        // console.log(path + "/search")
        $("#autocomplete").autocomplete({
            //создаем первый запрос на изменение в input #autocomplete
            source: path + "/search",
            minLength: 1,
            select: function(event, ui) {
                // console.log(ui.item.value);
                let search = ui.item.value;
                $.ajax({
                    url: path + "/search",
                    type: "get",
                    data: {
                        search: search
                    },
                    success: function(res) {
                        // console.log(res);
                        res = JSON.parse(res);
                        window.location =
                            path + "/product/" + encodeURIComponent(res.slug);
                    },
                    error: function() {
                        alert("ERROR SEARCH");
                    }
                });
            }
        });
    });
});
//=====$currency========

function menu(event) {
    let ul_el;
    if ($(event.target).hasClass('icon-curr')) {
        ul_el = event.target.parentNode.parentNode;
    } else ul_el = event.target.parentNode;

    let elem = ul_el.querySelector('ul');
    //скрипты внесенные из .css не отображаются в console.log,
    // отображаются только те которые внесены из .js
    if (elem.style.display == '' || elem.style.display == 'none') elem.style.display = 'block';
    else elem.style.display = 'none';
    //теперь они отображаются в console.log и добавляем ||elem.style.display == 'none'
}

function change(event) {
    let sub_elem = $(event.target);
    let head_elem = $(event.target).closest('ul').closest('li').find('span.curr_selected');
    let triangle = $(event.target).closest('ul').closest('li').find('span.icon-curr');
    let temp = sub_elem.text();
    $(sub_elem).text(head_elem.text());
    $(head_elem).text(temp).append(triangle);
    //переходим в контроллер currency/change с get-параметром= code валюты
    window.location = '/currency?curr=' + head_elem.text();
    // console.log();
}
document.body.onload = function(event) {
        let item = document.body.querySelector('.curr_selected');
        item.addEventListener('click', menu);
        let subs = document.body.querySelectorAll('.curr_change');
        for (let sub of subs) {
            sub.addEventListener('click', change);
        }
    }
    // ===============end currency=============
    //=============/ cart============

$('body').on("click", ".add-to-cart", function(e) {
    e.preventDefault();
    let id = $(this).data("id");
    //берем qty то что в input, иначе qty=1
    let qty = null;
    if ($('.product-qty').find('input').val() != null & $(this).hasClass('add-cart')) qty = $('.product-qty').find('input').val()
    else qty = 1;
    $.ajax({
        url: "/cart/add",
        data: {
            id: id,
            qty: qty
        },
        type: "GET",
        success: function(res) {
            if (!res) {
                alert("Not product");
            }
            // console.log(res);
            showCart(res);
        },
        error: function() {
            alert("Error add");
        }
    });
    // return false;
});

function showCart(cart) {
    //выводим модальнле окно
    $("#modal-cart .modal-body").html(cart);
    $("#modal-cart").modal();
    //выводим сумму в  окно-корзина в header
    let cartSum = $("#cart-sum").text() ? $("#cart-sum").text() : "Empty Cart";
    // //ставим это значение в окно-корзина в header
    if (cartSum) {
        $(".cart-sum").text(cartSum);
    }
}

function getCart() {
    let _token = $(".cart-price .cart-button").data("token");
    // console.log(_token);
    $.ajax({
        url: "cart",
        type: "POST",
        data: { _token: _token },
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(res) {
            if (!res) alert("Ошибка cart");
            showCart(res);
        },
        error: function() {
            alert("Error! cart");
        }
    });
}
//удаляет один э-нт
$("body").on("click", ".del-item", function() {
    let id = $(this).data("id");
    let _token = $(".cart-price .cart-button").data("token");
    // console.log(id);
    $.ajax({
        url: "del",
        data: {
            id: id,
            _token: _token
        },
        type: "POST",
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        //     },
        success: function(res) {
            if (!res) alert("Ошибка deleteItem");
            //перезагрузка страницы оформления
            let now_location = document.location.pathname;
            showCart(res);
            if (now_location == "/checkout") {
                document.location = "checkout";
                showCart(res);
            }

            // console.log(res);

        }
    });
});

function clearCart() {
    let _token = $(".cart-price .cart-button").data("token");
    $.ajax({
        url: "clear",
        type: "POST",
        data: {
            _token: _token
        },
        // headers: {
        //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        //     },
        success: function(res) {
            if (!res) alert("Ошибка");
            //перезагрузка страницы оформления
            let now_location = document.location.pathname;
            if (now_location == "/checkout") {
                document.location = "checkout";
                return;
            }
            showCart(res);
        },
        error: function() {
            alert("Error clear!");
        }
    });
}
//=============/cart==========
// ==========Checkout=============
$("body").on("click", ".value-minus, .value-plus", function() {
    //меньше 1 уменьшать нельзя
    if (
        $(this).hasClass("value-minus") && $(this).parent('td').next().text() == 1) {
        return;
    }
    let id = $(this).data("id"),
        qty = $(this).data("qty"),
        qty_obj = $(this).parent('td').next();
    $(".checkout-table .overlay").fadeIn();
    let _token = $(".cart-price .cart-button").data("token");
    // console.log(qty_obj.text());
    $.ajax({
        url: "/checkout/change-cart",
        type: "POST",
        data: {
            id: id,
            qty: qty,
            _token: _token
        },

        success: function(res) {
            if (!res) alert("Ошибка change");
            $(".checkout-table .overlay").fadeOut();
            // let data = JSON.parse(res);
            $(qty_obj).text(res["qty"]);
            //окошко корзины
            $(".cart-button .cart-sum").text(symbol_left + res["sum"].toFixed(2) + symbol_right);
            //итоговые значения
            $('.checkout-table td.sum-total').text(symbol_left + res["sum"].toFixed(2) + symbol_right);
            //пересчет общего кол-ва товаров
            // $('#qty_total').text(symbol_left + (res["qty"] * res['price'] * value).toFixed(2) + symbol_right);
            $('#qty_total').text(res["qty_total"]);

            // document.location = "checkout";
        },
        error: function() {
            alert("Error change!");
        }
    });
});
// restore password=======
$(function() {
    $('#forgot-link').click(function() {
        $('#forgot').fadeOut(300, function() {
            $('#auth').fadeIn();
            return false;
        });
    });
    $('#auth-link').click(function() {
        $('#auth').fadeOut(300, function() {
            $('#forgot').fadeIn();
            return false;
        });
    });
});
/*=========== filters============== */
$('body').on('change', '.w_sidebar input', function() {
    var checked = $('.w_sidebar input:checked'),
        data = '';
    checked.each(function() {
        data += this.value + ',';
    });
    // console.log(data);
    if (data) {
        $.ajax({
            //работаем с текущим URL-domen/category/slug
            //потом появляются get-параметры(?filter=2,1,&page=2)
            url: location.href,
            data: { filter: data },
            type: 'GET',
            beforeSend: function() {
                $('.preloader').fadeIn(300, function() {
                    $('.product-one').hide();
                })
            },
            success: function(res) {
                // console.log(res);
                $('.preloader').delay(500).fadeOut('slow', function() {
                    $('.product-one').html(res).fadeIn();
                    //метод search-ищет get параметра в адресной строке
                    var url = location.search.replace(/filter(.+?)(&|$)/g, '');
                    var newURL = location.pathname + url + (location.search ? "&" : "?") +
                        "filter=" + data;

                    newURL = newURL.replace('&&', '&');
                    newURL = newURL.replace('?&', '?');
                    //если page=>2 при сбросе птички-ошибка(если на этой странице нечего показывать)-принудительно идем на page=1
                    if (newURL.match(/(page=[^1])/g)) {
                        newURL = newURL.replace(/(page=[^1])/g, 'page=1');
                        history.pushState({}, '', newURL);
                        location = newURL;
                    }
                    //pushState() -заменяет старую адр строку на newURL
                    history.pushState({}, '', newURL);
                });
            },
            error: function() {
                alert('Ошибка фильтра');
            }
        });
    } else {
        //перезагрузка страницы
        window.location = location.pathname;
    }

});