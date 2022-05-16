$(document).ready(function () {
    $('#table_crear').DataTable();
});

$(document).ready(function () {
    $('#table_facturas').DataTable();
});

$(document).ready(function () {
    $('#table_1').DataTable();
});

$(document).ready(function () {
    $('#table_2').DataTable();
});

$(document).ready(function () {
    $('#table_3').DataTable();
});



$("form").submit(function (e) {
    e.preventDefault();
    let name = e.target.name;
    let method = e.target.method;
    let action = e.target.action;


    let product = {

        "sale_id": "",
        "employee":"",
        "coffe_store":"",
        "payment_method":"",

        "product_id": "",
        "name": "",
        "price": "",
        "reference": "",
        "amount": "",
        "check": ""

    };

    if (name == 'crear') {

        let index = document.getElementById('table_crear').getElementsByTagName("tr").length - 1;
        let sale_collect = [];
        let indice = 0;
        let texto = "";
        
        for (let i = 0; i < index; i++) {
          
            let product = {

                "sale_id": "",
                "employee": "",
                "coffe_store": "",
                "payment_method": "",

                "product_id": "",
                "name": "",
                "price": "",
                "reference": "",
                "amount": "",
                "check": ""

            };

            product.coffe_store = document.getElementsByName('coffe_store')[0].value;
            product.employee = document.getElementsByName('employee')[0].value;
            product.payment_method = document.getElementsByName('payment_method')[0].value;
            product.product_id = document.getElementById('table_crear').getElementsByTagName("tr")[i + 1].getElementsByTagName("span")[0].innerHTML;
            product.name = document.getElementById('table_crear').getElementsByTagName("tr")[i + 1].getElementsByTagName("span")[1].innerHTML;
            product.price = parseFloat(document.getElementById('price').value);
            product.reference = document.getElementById("preference").innerHTML;
            product.amount = document.getElementById('table_crear').getElementsByTagName("tr")[i + 1].getElementsByTagName("input")[1].value;

            comprar = document.getElementById('table_crear').getElementsByTagName("tr")[i + 1].getElementsByTagName("input")[2].checked;

            if (comprar === true){
                if (product.coffe_store.length < 1 || typeof (product.coffe_store) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo tienda',
                        text: 'tipo de dato incorrecto :text',
                        footer: '<a href="#">coffe store</a>'
                    });
                } else if (product.employee.length < 1 || typeof (product.employee) != 'string') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Campo empleado',
                        text: 'tipo de dato incorrecto :text',
                        footer: '<a href="#">coffe store</a>'
                    });

                } else if (product.payment_method.length < 1 || typeof (product.payment_method) != 'string') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Campo metodo de pago',
                        text: 'tipo de dato incorrecto :text',
                        footer: '<a href="#">coffe store</a>'
                    });

                } else if (product.product_id.length < 1 || typeof (parseInt(product.product_id)) != 'number') {


                    if (product.product_id < 1){

                        Swal.fire({
                            icon: 'error',
                            title: 'Campo id producto',
                            text: 'campo id debe ser mayor a 0',
                            footer: '<a href="#">coffe store</a>'
                        })

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Campo id producto',
                            text: 'tipo de dato incorrecto :numeric',
                            footer: '<a href="#">coffe store</a>'
                        })
                    }
                    

                } else if (product.name.length < 3 || typeof (product.name) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo nombre producto',
                        text: 'tipo de dato incorrecto  debe tener minimo 3 caracteres :text',
                        footer: '<a href="#">coffe store</a>'
                    });
                } else if (product.price.length < 1 || typeof (parseFloat(product.price)) != 'number') {
                    

                    if (product.price < 1) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Campo precio producto',
                            text: 'tipo de dato incorrecto  debe ser mayor de 0 :numeric',
                            footer: '<a href="#">coffe store</a>'
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Campo precio producto',
                            text: 'tipo de dato incorrecto  debe tener minimo 1 caracteres :numeric',
                            footer: '<a href="#">coffe store</a>'
                        })

                    }
                } else if (product.reference.length < 2 || typeof (product.reference) != 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo referencia producto',
                        text: 'tipo de dato incorrecto  debe tener minimo 3 caracteres :text',
                        footer: '<a href="#">coffe store</a>'
                    });
                } else if (product.amount.length < 1 || typeof (parseInt(product.amount)) != 'number' || parseInt(product.amount) < 1) {
                    if (parseInt(product.amount) < 1) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Campo cantidad producto',
                            text: 'tipo de dato incorrecto  debe ser mayor de 0  :numeric',
                            footer: '<a href="#">coffe store</a>'
                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Campo cantidad producto',
                            text: 'tipo de dato incorrecto  debe tener minimo 1 caracteres :numeric',
                            footer: '<a href="#">coffe store</a>'
                        });

                    }
                }else {
                    texto = texto + "<p> ID: " + product.product_id + " NOMBRE: " + product.name + " CANTIDAD: " + product.amount + "</p>";
                    sale_collect[indice] = product;

                    indice++;
                    console.log(sale_collect);
                    
                }
            }
        }  
        

        if (sale_collect.length > 0) {

            Swal.fire({
                title: 'Desea realizar la compra de los siguiente articulos?',
                html:  texto ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, comprar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    console.log(product);
                    debugger;

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: method,
                        url: action,
                        data: { sale_collect },
                        success: function (data) {
                            console.log(data);
                            debugger;                        
                            let timerInterval
                            if (data.successful == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salio mal!',
                                    text: data.message+"er",
                                    footer: '<a href="#">coffe store</a>'
                                })

                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Exito',
                                    html: 'Datos insertados correctamente!, <b></b> milliseconds.',
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
                                    window.location.href = "/sale";
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        console.log('closed')
                                    }
                                });

                            }

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
            })

            

        }
    }

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
    
    if (name == 'eliminar') {

        let id = $('#delete_id').val();

        if (
            (id > 0)
        ) {

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
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('closed')
                            }
                        });
                        window.location.href = "/product";
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

        } else {
            console.log('error');
        }


    }
});

