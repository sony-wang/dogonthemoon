define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {
    var Controller = {
        index: function () {
            Form.api.bindevent($("form[role=form]"));
            
            // $(document).on("click", ".btn_endrank", function () {
            //     Fast.api.open('frontend/siteconfig/endrank', '結算排行');
            // });
        }
    };
    return Controller;
});