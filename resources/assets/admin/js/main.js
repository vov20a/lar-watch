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
// ==========================
//Initialize Select2 Elements
// $('.select2').select2();

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