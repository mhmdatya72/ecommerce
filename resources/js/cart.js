(function ($) {
    $('.item-quantity').on('change', function (e) {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            }
        })
    });
    $('.remove-item').on('click', function (e) {
        e.preventDefault(); // منع التصرف الافتراضي

        let id = $(this).data('id');

        // نافذة تأكيد الحذف
        if (confirm("هل أنت متأكد أنك تريد حذف هذا العنصر؟")) {
            $.ajax({
                url: "/cart/" + id,
                method: 'DELETE',
                data: {
                    _token: csrf_token // تأكد من أن csrf_token معرّف بشكل صحيح
                },
                success: response => {
                    $('#item-' + id).remove(); // تأكد من أن id عنصر HTML يطابق العنصر المحذوف
                    alert(response.message); // عرض رسالة النجاح
                },
                error: err => {
                    alert("حدث خطأ أثناء حذف العنصر.");
                }
            });
        }
    });


})(jQuery);
