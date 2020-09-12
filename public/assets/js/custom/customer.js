//DataTable
$('#report-table').DataTable({});
$('#filing-table').DataTable({});
//EndDataTable

//Swal
function deleteRow(id) {
    swal({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus akan terhapus secara permanen!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $('#data-' + id).submit();
        }
    })
}
function chooseHouse() {
    swal({
        title: "Pemberitahuan",
        text: "Mohon maaf customer tersebut belum membayar UTJ",
        icon: "warning",
    })
}

function cantSp3(){
    swal({
        title: "Pemberitahuan",
        text: "Mohon maaf customer tersebut belum pemberkasan.",
        icon: "warning",
    })
}

function cantLPA(){
    swal({
        title: "Pemberitahuan",
        text: "Mohon maaf customer tersebut belum SP3.",
        icon: "warning",
    })
}

function cantAkad(){
    swal({
        title: "Pemberitahuan",
        text: "Mohon maaf customer tersebut memenuhi syarat.",
        icon: "warning",
    })
}
//EndSwal

//MaskMoney
$(document).ready(function () {
    $(".input-utj").maskMoney({
        thousands: '.',
        decimal: ',',
        affixesStay: false,
        precision: 0
    });
});

$(document).ready(function () {
    $(".input-fail").maskMoney({
        thousands: '.',
        decimal: ',',
        affixesStay: false,
        precision: 0
    });
});

$(document).ready(function () {
    $(".input-dp").maskMoney({
        thousands: '.',
        decimal: ',',
        affixesStay: false,
        precision: 0
    });
});

$(document).ready(function () {
    $(".input-lpa").maskMoney({
        thousands: '.',
        decimal: ',',
        affixesStay: false,
        precision: 0
    });
});
//EndMaskMoney


//Funtion
$(document).on("click",".id_customer", function(){
    var idCustomer = $(this).data('id');
    $('#id_customer_input').val(idCustomer);
})

$(document).on("click",".fail_customer", function(){
    var idCustomer = $(this).data('id');
    console.log(idCustomer);
    $('#id_customer_fail').val(idCustomer);
})

$(document).on("click",".dp_customer", function(){
    var idCustomer = $(this).data('id');
    $('#id_customer_dp').val(idCustomer);
});

$(document).on("click",".id_customer_lpa", function(){
    var idCustomerLPA = $(this).data('id');
    console.log(idCustomerLPA);
    $('#id_customer_lpa').val(idCustomerLPA);
});

$(document).on("click",".id_customer_bank", function(){
    var idCustomerBank = $(this).data('id');
    console.log(idCustomerBank);
    $('#id_customer_bank').val(idCustomerBank);
});
//EndFunction


//Pemberkasan



