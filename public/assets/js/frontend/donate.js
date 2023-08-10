define(['jquery', 'bootstrap', 'frontend', 'form', 'template'], function ($, undefined, Frontend, Form, Template) {
    var validatoroptions = {
        invalid: function (form, errors) {
            $.each(errors, function (i, j) {
                Layer.msg(j);
            });
        }
    };
    var Controller = {
        onlinepayment: function () {
            Form.api.bindevent($("#donate-form"), function (mthis, data, ret) {
                location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
        },
        orders: function () {
            const submit = document.querySelector('#submit');
            submit.addEventListener('click',()=>{
                if(donetUsername.value.length >0){
                    submit.children[0].classList.remove('d-none')
                }
            })

      
            Form.api.bindevent($("#orders-form"), function (mthis, data, ret) {
                const submit = document.querySelector('#submit');
                // console.log(submit.children)
                submit.children[0].classList.add('d-none')
                let dom = ''
                // console.log(mthis)
                // console.log(data)
                // console.log(ret)
            mthis.forEach(e => {
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
            const noDonateList = document.querySelector('.noDonateList');
            const donateList = document.querySelector('.donateList');
            orderList.innerHTML = dom;
            if(orderList.children.length == 0){
                noDonateList.style.display = 'block';
                donateList.style.display = 'none';
            }else{
                noDonateList.style.display = 'none';
                donateList.style.display = 'block';
            }
            });
            
        }
    };
    return Controller;
});
