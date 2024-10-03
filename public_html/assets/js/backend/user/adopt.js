define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/adopt/index',
                    add_url: 'user/adopt/add',
                    edit_url: 'user/adopt/edit',
                    del_url: 'user/adopt/del',
                    table: 'adopt',
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
                        {field: 'pet_id', title: __('pet_id'), sortable: true, visible: false},
                        {field: 'pet.code', title: __('pet.code'), sortable: true},
                        {field: 'pet.name', title: __('pet.name'), sortable: true},
                        {field: 'name', title: __('name'), sortable: true},
                        {field: 'family', title: __('family'), sortable: true},
                        {field: 'room', title: __('room'), sortable: true},
                        {field: 'hadpet', title: __('hadpet'), formatter: Controller.api.formatter.hadpet, searchList: {0: __('no'), 1: __('yes')}},
                        {field: 'haspet', title: __('haspet'), formatter: Controller.api.formatter.haspet, searchList: {0: __('no'), 1: __('yes')}},
                        {field: 'email', title: __('email'), sortable: true},
                        {field: 'phone', title: __('phone'), sortable: true},
                        {field: 'img', title: __('img'), events: Table.api.events.image, formatter: Table.api.formatter.images, operate: false},
                        {field: 'status', title: __('Status'), formatter: Controller.api.formatter.status, searchList: {0: __('Status 0'), 1: __('Status 1'), 2: __('Status 2')}},
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
                    var colorArr = {'0':'orange','1':'success','2':'danger'};
                    var valueArr = {'0':__('Status 0'),'1':__('Status 1'),'2':__('Status 2')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
                hadpet: function (value, row, index, custom) {
                    var colorArr = {'0':'orange','1':'success'};
                    var valueArr = {'0':__('no'),'1':__('yes')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
                haspet: function (value, row, index, custom) {
                    var colorArr = {'0':'orange','1':'success'};
                    var valueArr = {'0':__('no'),'1':__('yes')};
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