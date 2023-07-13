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
            Form.api.bindevent($("#donate-form"), function (mthis, data, ret) {
                location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
        },
        orders: function () {
            Form.api.bindevent($("#orders-form"), function (mthis, data, ret) {
                let dom = ''
                // console.log(mthis)
                // console.log(data)
                // console.log(ret)
            mthis.forEach(e => {
                console.log(e)

                //時間戳轉換
                //2022-09-30 10:15:53
                let timestamp = e.createtime*1000
                let date = new Date(timestamp);
                let finalTime = `${date.getFullYear()}-${(date.getMonth()+1)}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`               
                dom += 
                `
                <tr>
                    <th scope="row">${finalTime}</th>
                    <td>${e.donate_name}</td>
                    <td>${e.amount}元</td>
                    <td>衛服救字第${e.donation_project}</td>
                </tr>
                `
            });
            const orderList = document.querySelector('#orderList');
            console.log(orderList)
            orderList.innerHTML = dom;
                // location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
            
        }
    };
    return Controller;
});
