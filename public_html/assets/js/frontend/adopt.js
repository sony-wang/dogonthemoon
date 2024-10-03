define(['jquery', 'bootstrap', 'frontend', 'form', 'template'], function ($, undefined, Frontend, Form, Template) {
    var validatoroptions = {
        invalid: function (form, errors) {
            $.each(errors, function (i, j) {
                Layer.msg(j);
            });
        }
    };
    var Controller = {
        info: function () {
            Form.api.bindevent($("#adopt-form"),function (mthis, data, ret) {
                if(data.code === 1){
                    
                }
                // location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
        }
    };
    return Controller;
});
