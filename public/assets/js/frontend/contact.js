define(['jquery', 'bootstrap', 'frontend', 'form', 'template'], function ($, undefined, Frontend, Form, Template) {
    var validatoroptions = {
        invalid: function (form, errors) {
            $.each(errors, function (i, j) {
                Layer.msg(j);
            });
        }
    };
    var Controller = {
        index: function () {
            Form.api.bindevent($("#contact-form"),function (mthis, data, ret) {
                if(data.code === 1){
                    $("#contact-form")[0].reset()
                }
                // location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
        }
    };
    return Controller;
});
