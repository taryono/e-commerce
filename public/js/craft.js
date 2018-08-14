/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false
});
Array.prototype.inArray = function (value) {
    var i;
    for (i = 0; i < this.length; i++) {
        if (this[i] == value) {
            return true;
        }
    }
    return false;
};

var app = {
    rupiah: function rupiah(bilangan) {
        var number_string = bilangan.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return "Rp. " + rupiah;
    },
    number: function number(bilangan) {
        var number_string = bilangan.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }
        return rupiah;
    },
    uppercase: function touppercase(element) {
        var str = $(element).val().toLowerCase();
        var lowercase = (str + '').replace(/^(.)|\s+(.)/g, function ($1) {
            return $1.toUpperCase()
        });
        $(element).val(lowercase);
    },
    idrFormat: function rupiah(bilangan) {
        var number_string = bilangan.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return "IDR. " + rupiah + ".00";
    },
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.post-review img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(function(){
    $("input.post-input").change(function () { 
        console.log(this);
        readURL(this);
    });
}); 