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
            const receipt = $('#receipt')[0]
            const address_wrap = $('#address_wrap')[0]
            // receipt.addEventListener('change',(e)=>{
            //     if(e.target.checked){
            //         console.log(address_wrap)
            //         address_wrap.style.display='flex'
            //     }else{
            //         address_wrap.style.display='none'

            //     }
            // })
            Form.api.bindevent($("#donate-form"), function (mthis, data, ret) {
                location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });
        },
        receipt: function () {

            $(document).on("click", "#receipt_submit", function (e) {
                // receipt_submit.disabled=true
                // console.log(e.target.disabled=true)
                // console.log(112233)
                // Layer.open({
                //     type: 1,
                //     title: __('Reset password'),
                //     area: ["450px", "355px"],
                //     content: 'AAAAAAAAAAAAAAAAAAAAAA',
                //     success: function (layero) {
                //         Form.api.bindevent($("#receipt-form"), function (mthis, data, ret) {
                            
                //             this[0].reset()
                //             Layer.closeAll();
                //         });

                //     }
                // });
                Form.api.bindevent($("#receipt-form"), function (mthis, data, ret) {
                    // receipt_submit.disabled = false;
                    this[0].reset()
                });
            });


            // const donate_name = document.querySelector('#donate_name');
            // const phone = document.querySelector('#phone');
            // const address = document.querySelector('#address');

            // const receipt_submit = document.querySelector('#receipt_submit');
            // receipt_submit.addEventListener('click',(e)=>{
            //     console.log(this)
            //     console.log(receipt_submit)
            //     console.log(receipt_submit.disabled=true)
            // })

            
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
