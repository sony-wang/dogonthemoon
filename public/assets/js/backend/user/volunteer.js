define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/volunteer/index',
                    add_url: 'user/volunteer/add',
                    edit_url: 'user/volunteer/edit',
                    del_url: 'user/volunteer/del',
                    multi_url: 'user/volunteer/multi',
                    table: 'volunteer',
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
                        {field: 'join_time', title: __('join_time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', datetimeFormat: 'YYYY-MM-DD', sortable: true},
                        {field: 'name', title: __('name'), operate: 'LIKE'},
                        {field: 'birthday', title: __('birthday'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', datetimeFormat: 'YYYY-MM-DD', sortable: true},
                        {field: 'idnum', title: __('idnum'), operate: 'LIKE'},
                        {field: 'phone', title: __('phone'), operate: 'LIKE'},
                        {field: 'email', title: __('email'), operate: 'LIKE'},
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
                }
            }
        }
    };
    return Controller;
});