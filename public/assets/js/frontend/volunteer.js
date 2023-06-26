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
            Form.api.bindevent($("#volunteer-form"),function (mthis, data, ret) {
                console.log('778899')
                if(data.code === 1){
                    for(let i=0;i<$("#volunteer-form")[0].length; i++){
                        console.log(i)
                        if(i>=2){
                            console.log($("#volunteer-form")[0][i].value = '')
                        }
                    }
                }
                // location.href = Config.url.furl+'/index/donate/orderpage/number/'+data.data;
            });

            const thisYear = new Date().getFullYear();
            flatpickr("#join_time", {
                // enableTime: true,
                locale: "zh_tw",
                altInput: true,
                minDate: "today",
                dateFormat: "Y-m-d",
                maxDate: `${thisYear}/12/31`,
                altFormat: "Y/n/j",
                // altFormat: "F j, Y - h:i", 
            });

            const agree = document.querySelector('#agree');
            const submit = document.querySelector('#submit');
            // console.log(agree.checked)
            agree.addEventListener('change', ()=>{
                if(agree.checked){
                    submit.disabled = false
                }else{
                    submit.disabled = true
                }
            })
        },
    };
    return Controller;
});