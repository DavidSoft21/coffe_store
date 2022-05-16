/* READY -- DataTables Global */
$(function() {
    $('#table').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "scrollX": true
    });

    $('#table_crear').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "scrollX": true
    });

    $('#table_facturas').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "order": [[4, "desc"]],
        "scrollX": true
    });


    $('#table_1').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "order": [[3, "desc"]],
        "scrollX": true
    });

    $('#table_2').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "order": [[2, "desc"]],
        "scrollX": true
    });

    $('#table_3').DataTable({
        'language': {
            'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
        },
        "order": [[2, "desc"]],
        "scrollX": true
    });

    

});

