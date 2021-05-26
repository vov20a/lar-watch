$(document).ready(function() {
    //указатель меню
    $('.nav-sidebar a').each(function() {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });
    
    //initialize upload image name
    bsCustomFileInput.init();

    //Initialize Select2 Elements
    $('.select2').select2();
    //===================editor-content===========
    if ($('textarea').is('#content')) { //что бы не создавать объект на главной странице-иначе ошибка
        // var buttonCarousel = $('#img');
        // var file;


        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                image: {
                    // You need to configure the image toolbar, too, so it uses the new style buttons.
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight'
                    ]
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        'alignment',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'undo',
                        'redo',
                        'CKFinder',
                        'mediaEmbed'
                    ]
                },
                language: 'ru',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
            })
            .catch(function(error) {
                console.error(error);
            });
    }

})

// validation init
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

// =================Change status of order======
$('body').on('click', '#order_status', function() {
    let _token = $('.media-token').data('token');
    let id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: "/admin/order/status",
        data: {
            _token: _token,
            id: id
        },
        type: "POST",
        success: function(res) {
            if (!res) {
                alert("Not order");
            }
            //res-current path,добавляем get-параметр для получения flash message
            location = res.http + '?status=' + res.status;
        },
        error: function() {
            alert("Error status");
        }
    })
});
// reset radio boxes
$('#reset-filter').click(function () {
    $('#filter input[type=radio]').prop('checked', false);
    return false;
});