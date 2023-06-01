define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'frontend/pet/index',
                    add_url: 'frontend/pet/add',
                    edit_url: 'frontend/pet/edit',
                    del_url: 'frontend/pet/del',
                    table: 'pet',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                escape: false,
                columns: [
                    [
                        {checkbox: true, visible: false},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'code', title: __('code'), sortable: true},
                        {field: 'name', title: __('name'), sortable: true},
                        {field: 'age', title: __('age'), sortable: true},
                        {field: 'sex', title: __('sex'), formatter: Controller.api.formatter.sex, searchList: {0: __('sex 0'), 1: __('sex 1'), 2: __('sex 2')}},
                        {field: 'color', title: __('color'), sortable: true},
                        {field: 'size', title: __('size'), sortable: true},
                        {field: 'ligation', title: __('ligation'), formatter: Controller.api.formatter.ligation, searchList: {0: __('ligation 0'), 1: __('ligation 1')}},
                        {field: 'medical', title: __('medical'), sortable: true},
                        {field: 'personality', title: __('personality'), sortable: true},
                        {field: 'img', title: __('img'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'status', title: __('Status'), formatter: Controller.api.formatter.status, searchList: {0: __('Status 0'), 1: __('Status 1')}},
                        {field: 'createtime', title: __('createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true, visible: false},
                        {field: 'updatetime', title: __('updatetime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

        },
        add: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"));
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter:{
                status: function (value, row, index, custom) {
                    var colorArr = {'0':'orange','1':'success'};
                    var valueArr = {'0':__('Status 0'),'1':__('Status 1')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
                sex: function (value, row, index, custom) {
                    var colorArr = {'0':'black','1':'black','2':'black'};
                    var valueArr = {'0':__('sex 0'),'1':__('sex 1'),'2':__('sex 2')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
                ligation: function (value, row, index, custom) {
                    var colorArr = {'0':'orange','1':'success'};
                    var valueArr = {'0':__('ligation 0'),'1':__('ligation 1')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
            }
        }
    };
    return Controller;
});