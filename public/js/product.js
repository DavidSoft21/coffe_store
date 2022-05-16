$(document).ready(function () {
    $('#table').DataTable();
});

$("form").submit(function (e) {
    e.preventDefault();
    let name = e.target.name;
    let method = e.target.method;
    let action = e.target.action;
    let product = {
        "id": "",
        "name": "",
        "reference": "",
        "category": "",
        "price": "",
        "stock": "",
        "_token": "",

    };
    let editar_id = e.currentTarget.name.substring(7, e.currentTarget.name.length)
    if (name == 'editar_' + editar_id) {

        let inputs = document.getElementsByName("editar_" + editar_id)[0].elements

        let name_edit = inputs["product[name]"].value;
        let category_edit = inputs["product[category]"].value;
        let reference_edit = inputs["product[reference]"].value;
        let stock_edit = inputs["product[stock]"].value;
        let price_edit = inputs["product[price]"].value;

        product.id = editar_id;
        product.name = name_edit
        product.category = category_edit;
        product.reference = reference_edit;
        product.stock = stock_edit;
        product.price = price_edit;

        console.log("===============================" + product.name.length);
        console.log(product);
        console.log("===============================");



        if (product.name.length < 3 || typeof (product.name) != 'string') {
            Swal.fire({
                icon: 'error',
                title: 'Campo nombre',
                text: 'debes ingresar mas de 3 caracteres!, :text ',
                footer: '<a href="#">coffe store</a>'
            })
        }




        if (product.reference.length < 2 || typeof (product.reference) != 'string') {
            Swal.fire({
                icon: 'error',
                title: 'Campo referencia',
                text: 'debes ingresar mas de 3 caracteres!, :text',
                footer: '<a href="#">coffe store</a>'
            })
        }
        //console.log(field.value)



        if (product.category.length < 3 || typeof (product.category) != 'string') {
            Swal.fire({
                icon: 'error',
                title: 'Campo categoria',
                text: 'debes ingresar mas de 3 caracteres! :text',
                footer: '<a href="#">coffe store</a>'
            })
        }
        //console.log(field.value)



        if (product.price.length < 1 || typeof (parseFloat(product.price)) != 'number') {
            Swal.fire({
                icon: 'error',
                title: 'Campo precio',
                text: 'tipo de dato incorrecto :numeric',
                footer: '<a href="#">coffe store</a>'
            })
        } else if (product.price.value < 0) {

            Swal.fire({
                icon: 'error',
                title: 'Campo precio',
                text: 'ingrese numero mayor a 0! :numeric',
                footer: '<a href="#">coffe store</a>'
            })

        }
        //console.log(field.value)



        if (product.stock.length < 1 || typeof (parseInt(product.stock)) != 'number') {

            Swal.fire({
                icon: 'error',
                title: 'Campo stock',
                text: 'tipo de dato incorrecto! :numeric',
                footer: '<a href="#">coffe store</a>'
            })
        } else if (product.stock.value < 0) {

            Swal.fire({
                icon: 'error',
                title: 'Campo stock',
                text: 'ingrese numero mayor a 0! :numeric',
                footer: '<a href="#">coffe store</a>'
            })

        }
        //console.log(field.value)
        if (
            (product.name.length > 0) &&
            (product.reference.length > 0) &&
            (product.category.length > 0) &&
            (product.price.length > 0) &&
            (product.stock.length > 0)
        ) {
            product.id = editar_id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: method,
                url: action,
                data: product,
                success: function (data) {
                    console.log(data);

                    let timerInterval
                    if (data.successful == false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salio mal!',
                            text: data.message,
                            footer: '<a href="#">coffe store</a>'
                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito',
                            html: 'Datos editados correctamente!, <b></b> milliseconds.',
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            window.location.href = "/product";
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('closed')
                            }
                        });

                    }
                    
                    console.log('datos editados!.');

                },
                error: function (data) {

                    let timerInterval
                    Swal.fire({
                        title: 'Error al editar',
                        html: data.message + '., <b></b> milliseconds.',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('closed')
                        }
                    });
                    console.log('ha ocurrido un error!.');
                    console.log(data);
                },
            });

        } else {
            console.log('error editar');
        }
    }
    if (name == 'crear') {

        //validacion data y creacion object product
        $.each($('#crear').serializeArray(), function (i, field) {

            if (field.name == 'product[name]') {

                if (field.value.length < 3 || typeof (field.value) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo nombre',
                        text: 'debes ingresar mas de 3 caracteres!, :text ',
                        footer: '<a href="#">coffe store</a>'
                    })
                } else {
                    product.name = field.value;
                }

            }

            if (field.name == 'product[reference]') {
                if (field.value.length < 2 || typeof (field.value) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo referencia',
                        text: 'debes ingresar mas de 3 caracteres!, :text',
                        footer: '<a href="#">coffe store</a>'
                    })
                } else {
                    product.reference = field.value;
                }
                //console.log(field.value)
            }

            if (field.name == 'product[category]') {
                if (field.value.length < 3 || typeof (field.value) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo categoria',
                        text: 'debes ingresar mas de 3 caracteres! :text',
                        footer: '<a href="#">coffe store</a>'
                    })
                } else {
                    product.category = field.value;
                }
                //console.log(field.value)
            }

            if (field.name == 'product[price]') {
                if (field.value.length < 1 || typeof (parseFloat(field.value)) != 'number') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo precio',
                        text: 'tipo de dato incorrecto :numeric',
                        footer: '<a href="#">coffe store</a>'
                    })
                } else if (field.value < 0) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Campo precio',
                        text: 'ingrese numero mayor a 0! :numeric',
                        footer: '<a href="#">coffe store</a>'
                    })

                } else {
                    product.price = field.value;
                }
                //console.log(field.value)
            }

            if (field.name == 'product[stock]') {

                if (field.value.length < 1 || typeof (parseInt(field.value)) != 'number') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Campo stock',
                        text: 'tipo de dato incorrecto! :numeric',
                        footer: '<a href="#">coffe store</a>'
                    })
                } else if (field.value < 0) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Campo stock',
                        text: 'ingrese numero mayor a 0! :numeric',
                        footer: '<a href="#">coffe store</a>'
                    })

                } else {
                    product.stock = field.value;
                }
                //console.log(field.value)
            }

        });

        if (
            (product.name.length > 0) &&
            (product.reference.length > 0) &&
            (product.category.length > 0) &&
            (product.price.length > 0) &&
            (product.stock.length > 0)
        ) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: method,
                url: action,
                data: product,
                success: function (data) {

                    let timerInterval
                    if (data.successful == false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salio mal!',
                            text: data.message,
                            footer: '<a href="#">coffe store</a>'
                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro insertado!',
                            text: data.message,
                            footer: '<a href="#">coffe store</a>'
                        })
                        window.location.href = "/product";
                    }
                    console.log('datos insertados!.');
                    console.log(data.successful);

                },
                error: function (data) {

                    let timerInterval
                    Swal.fire({
                        title: 'Error al insertar',
                        html: data.message + '., <b></b> milliseconds.',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('closed')
                        }
                    });
                    console.log('ha ocurrido un error!.');
                    console.log(data);
                },
            });

        }


    }
    if (name == 'eliminar') {

        let id = $('#delete_id').val();

        if (
            (id > 0)
        ) {

            Swal.fire({
                title: 'Desea eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: method,
                        url: action,
                        data: id,
                        success: function (data) {
                            console.log(data);

                            let timerInterval
                            if (data.successful == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salio mal!',
                                    text: data.message,
                                    footer: '<a href="#">coffe store</a>'
                                })

                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Exito',
                                    html: 'Datos eliminados correctamente!, <b></b> milliseconds.',
                                    timer: 1000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer().querySelector('b')
                                        timerInterval = setInterval(() => {
                                            b.textContent = Swal.getTimerLeft()
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    window.location.href = "/product";
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        console.log('closed')
                                    }
                                });
                               
                            }
                            console.log('datos eliminados!.');


                        },
                        error: function (data) {

                            let timerInterval
                            Swal.fire({
                                title: 'Error al eliminar',
                                html: data.message + '., <b></b> milliseconds.',
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('closed')
                                }
                            });
                            console.log('ha ocurrido un error!.');
                            console.log(data);
                        },
                    });

                }
            })

        } else {
            console.log('error');
        }


    }
}); 

