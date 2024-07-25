define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/donateorder/index',
                    add_url: 'user/donateorder/add',
                    edit_url: 'user/donateorder/edit',
                    // del_url: 'user/donateorder/del',
                    table: 'donate_order',
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
                        {field: 'order_no', title: __('order_no'), operate: 'LIKE'},
                        {field: 'trans_order_no', title: __('trans_order_no'), operate: 'LIKE'},
                        {field: 'donate_name', title: __('donate_name'), operate: 'LIKE'},
                        {field: 'phone', title: __('phone'), operate: 'LIKE'},
                        {field: 'amount', title: __('amount'), operate: 'LIKE'},
                        {field: 'donation_project', title: __('donation_project'), operate: 'LIKE'},
                        {field: 'donate_type', title: __('donate_type'), formatter: Controller.api.formatter.donate_type, searchList: {1: __('donate_type 1'), 2: __('donate_type 2'), 3: __('donate_type 3')}},
                        {field: 'PeriodType', title: __('PeriodType'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'Frequency', title: __('Frequency'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'ExecTimes', title: __('ExecTimes'), operate: 'LIKE'},
                        {field: 'TotalSuccessTimes', title: __('TotalSuccessTimes'), operate: 'LIKE'},
                        {field: 'RtnMsg', title: __('RtnMsg'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'RtnCode', title: __('RtnCode'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'SimulatePaid', title: __('SimulatePaid'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'PaymentDate', title: __('PaymentDate'), operate: 'LIKE'},
                        {field: 'PaymentType', title: __('PaymentType'), operate: 'LIKE'},
                        {field: 'card4no', title: __('card4no'), operate: 'LIKE'},
                        {field: 'ATMAccNo', title: __('ATMAccNo'), operate: 'LIKE'},
                        {field: 'WebATMAccNo', title: __('WebATMAccNo'), operate: 'LIKE'},
                        {field: 'memo', title: __('Memo'), operate: 'LIKE'},
                        {field: 'CheckMacValue', title: __('CheckMacValue'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'result', title: __('result'), operate: 'LIKE', operate: false, visible: false},
                        {field: 'receipt', title: __('receipt'), formatter: Controller.api.formatter.receipt, searchList: {0: __('Receipt 0'), 1: __('Receipt 1')}},
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
                receipt: function (value, row, index, custom) {
                    var colorArr = {'0':'orange','1':'success','2':'danger'};
                    var valueArr = {'0':__('Receipt 0'),'1':__('Receipt 1'),'2':__('Receipt 2')};
                    if (typeof custom !== 'undefined') {
                        colorArr = $.extend(colorArr, custom);
                    }
                    var color = typeof colorArr[value] !== 'undefined' ? colorArr[value] : 'orange';
                    return '<span class="text-' + color + '">' + valueArr[value] + '</span>';
                },
                donate_type: function (value, row, index, custom) {
                    var colorArr = {'1':'info','2':'orange'};
                    var valueArr = {'1':__('donate_type 1'),'2':__('donate_type 2'),'3':__('donate_type 3')};
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