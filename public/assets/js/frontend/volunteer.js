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
            const submit = document.querySelector('#sub_btn');
            console.log(agree.checked)
            agree.addEventListener('change', ()=>{
                if(agree.checked){
                    submit.disabled = false
                }else{
                    submit.disabled = true
                }
                console.log('112233')
            })
        },
    };
    return Controller;
});