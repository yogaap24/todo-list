'use strict'

window.Swal = require('sweetalert2');
window.axios = require('axios');
window.toastr = require('toastr');
window.select2 = require('select2');
window.dayJs    =   require('dayjs')

import 'dayjs/locale/id'
dayJs.locale('id')
import 'sweetalert2/src/sweetalert2.scss'


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.messages = (message,url) => {
    Swal.fire({
        title: 'Success',
        text: message,
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    })
}

window.beforeLoadingAttr = (el) => {
    $(el).addClass("btn btn-brand kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
    $(el).attr("disabled", true);
}

window.afterLoadingAttr = (el) => {
    $(el).removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
    $(el).removeAttr("disabled");
}

window.getValue = (element) => {
    let el = document.getElementById(element)
    if (el != null) {
        return el.value
    } else {
        return null
    }
}

window.isNumber = evt => {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

window.generateAccessCode = (number) => {
   return Math.floor(Math.random()*parseInt('8' + '9'.repeat(number-1))+parseInt('1' + '0'.repeat(number-1)));
}

window.dataAutocomplete = (input, url, accessId) => {
    $(input).autocomplete({
        minLength: 2,
        // source: url,
        source: function (request, response) {
            $.ajax({
                url: url,
                data: 'term=' +  $(input).val(),
                success: function (data) {
                    var transformed = $.map(data, function (el) {
                        return {
                            label: el.name,
                            id: el.id
                        };
                    });
                    response(transformed);
                },
                error: function () {
                    response([]);
                }
            });
        },
        select: function (event, ui) {
            var parent = $(input).parent()
            $(input).val(ui.item.label);
            parent.find(accessId).val(ui.item.id)
            return false;
        }
    });
}



export default {
    messages
}
