$(document).ready(function () {
    $(".form-false").keypress(function (event) {
        if (event.which == 13) {
            return false;
        }
    });

    $('#search_menu').change(function () {
        let _url = $('#search_menu option:selected').val();

        if (_url != "") {
            window.location.href = _url;
        }
    });

    $('.selectpicker').select2();

    $(".email").on("input", function () {
        const email = $(this).val();
        const parent = $(this).closest(".form-group");

        if (validateEmail(email)) {
            // Email válido: Agregar clase de éxito
            parent.removeClass("has-error").addClass("has-success");
        } else {
            // Email inválido: Agregar clase de error
            parent.removeClass("has-success").addClass("has-error");
        }
    });

    // $('.loader').click(function () {
    // 	// $.LoadingOverlay("show");
    // 	$.LoadingOverlay("show", {
    // 		image: "../../assets/images/logo_loader.gif",
    // 		maxSize: "200px",
    // 		minSize: "100px",
    // 		size: "100%",
    // 		css: {
    // 			"z-index": "9999"
    // 		},
    // 		//fontawesome : "fa fa-spinner fa-spin",
    // 		//fade  : [2000, 1000]
    // 	});
    // });

    window.aleatorio = function (min, max) {
        var num = Math.floor(Math.random() * (max - min + 1)) + min; return num;
    }

    /*Script del Reloj */
    window.get_today = function (tipo = false, formato = false) {
        /* Capturamos la Hora, los minutos y los segundos */
        marcacion = new Date()
        /* Capturamos la Hora */
        Hora = marcacion.getHours()
        /* Capturamos los Minutos */
        Minutos = marcacion.getMinutes()
        /* Capturamos los Segundos */
        Segundos = marcacion.getSeconds()
        /*variable para el apóstrofe de am o pm*/
        dn = "a.m"
        if (Hora > 12) {
            dn = "p.m"
            Hora = Hora - 12
        }
        if (Hora == 0)
            Hora = 12
        /* Si la Hora, los Minutos o los Segundos son Menores o igual a 9, le añadimos un 0 */
        if (Hora <= 9) Hora = "0" + Hora
        if (Minutos <= 9) Minutos = "0" + Minutos
        if (Segundos <= 9) Segundos = "0" + Segundos
        /* Termina el Script del Reloj */

        /*Script de la Fecha */

        var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        var Mes = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        var Hoy = new Date();
        var Anio = Hoy.getFullYear();
        var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + ". ";

        /* Termina el script de la Fecha */

        /* Creamos 2 variables para darle formato a nuestro Script */
        var Script, Total, formato_hora;

        /* En Reloj le indicamos la Hora, los Minutos y los Segundos */
        formato_hora = Hora + ":" + Minutos + ":" + Segundos + " " + dn;
        Script = Fecha + Hora + ":" + Minutos + ":" + Segundos + " " + dn;

        if (tipo) {
            if (tipo == 1) {
                //FECHA
                if (formato == 'd') {
                    return Dia[Hoy.getDay()];
                } else if (formato == 'm') {
                    return Hoy.getDate();
                } else if (formato == 'a') {
                    return Anio;
                } else {
                    return Fecha;
                }
            } else {
                //HORA
                if (formato == 'h') {
                    return Hora;
                } else if (formato == 'm') {
                    return Minutos;
                } else if (formato == 'd') {
                    return Segundos;
                } else {
                    return formato_hora;
                }
            }
        } else {
            //FECHA Y HORA
            return Script;
        }

        /* En total Finalizamos el Reloj uniendo las variables */
        //Total = Script;

        /* Capturamos una celda para mostrar el Reloj */
        //document.getElementById('Fecha_Reloj').innerHTML = Total;

        /* Indicamos que nos refresque el Reloj cada 1 segundo */
        //setTimeout("actualizaReloj()", 1000);
    }

    window.numeric_format = function (value, decimals, separators) {
        decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
        separators = separators || ['.', "'", ','];
        var number = (parseFloat(value) || 0).toFixed(decimals);
        if (number.length <= (4 + decimals))
            return number.replace('.', separators[separators.length - 1]);
        var parts = number.split(/[-.]/);
        value = parts[parts.length > 1 ? parts.length - 2 : 0];
        var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
            separators[separators.length - 1] + parts[parts.length - 1] : '');
        var start = value.length - 6;
        var idx = 0;
        while (start > -3) {
            result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
                + separators[idx] + result;
            idx = (++idx) % 2;
            start -= 3;
        }
        return (parts.length == 3 ? '-' : '') + result;
    }

    window.parseAndRound = function (value) {
        const parsedValue = parseFloat(value);
        if (isNaN(parsedValue)) {
            return 0; // Devolver 0 si el valor no es un número
        }
        return parseFloat(parsedValue.toFixed(2)); // Redondear a 2 decimales y devolver como número
    }

    window.enviar_imagen = function (item, ruta) {
        var form_data = new FormData();
        var file_data = item;
        var return_ = "";

        form_data.append('file', file_data);
        $.ajax({
            url: '../assets/php/upload' + ruta + '.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (name) {
                return_ = name; // display response from the PHP script, if any
            }, error: function () {
                return_ = "Error al subir Imagen.";
            }
        });

        return return_;
    }

    window.ajax_function_object = function (data = { server: 'default', route: '', data: {}, method: '', async: true, function: function () { } }) {

        switch (data.server) {
            case 'nodejs':
                $.ajax({
                    cache: false,
                    async: data.async,
                    method: data.method.toUpperCase(),
                    url: 'http://192.168.80.118:3000/' + data.ruta,
                    // url: 'http://localhost:3000/' + data.ruta,
                    data: JSON.stringify(data.data),
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    success: function (_result) {
                        data.function(_result);
                    }, error: function (error) {
                        console.log('ERROR: ', error.responseJSON.message);
                        bootbox_alert('ERROR', error.responseJSON.message);
                    }
                });
                break;

            default:
                if (data.method != "") {
                    $('#breadcrumb-item').html(data.method.toUpperCase());
                } else {
                    $('#breadcrumb-item').html('INDEX');
                }

                let _newData = {};
                if (typeof data.data.form != "undefined") {
                    $("#datatable-list").LoadingOverlay("show");

                    $.each(data.data.form.serializeArray(), function (_, kv) {
                        _newData[kv.name] = kv.value;
                    });

                    if (typeof data.data.data != "undefined") _newData['data'] = data.data.data;
                    if (typeof data.data.image != "undefined") _newData['image'] = enviar_imagen(data.data.image, 'ComprobanteIngreso');
                } else {
                    $.LoadingOverlay("show");
                    _newData = data.data;
                }

                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    cache: false,
                    async: data.async,
                    method: data.method.toUpperCase(),
                    url: data.route,
                    data: _newData,
                    success: function (_result) {
                        if (typeof data.data.form != "undefined") {
                            $("#datatable-list").LoadingOverlay("hide");
                        } else {
                            $.LoadingOverlay("hide");
                        }


                        _result = $.parseJSON(_result);
                        data.function(_result);
                    }, error: function (error) {
                        if (typeof data.data.form != "undefined") {
                            $("#datatable-list").LoadingOverlay("hide");
                        } else {
                            $.LoadingOverlay("hide");
                        }

                        console.log('ERROR: ', error);
                        bootbox_alert({
                            title: 'informative',
                            type: 'error',
                            subtitle: 'error',
                            message: error.responseJSON.message
                        });
                    }
                });
                break;
        }
    }


    window.getFecha = function (fecha = "") {
        if (fecha == "") {
            var today = new Date();
            return today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + " " + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        } else {
            var today = new Date(fecha);
            return today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + " " + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        }
        //return new Date().toJSON().slice(0,10).replace(/-/g,'/');
    }

    window.validateEmail = function (email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    window.get_param = function (_data = { search: null }) {
        // Creamos la instancia
        const _value = window.location.search;
        const _urlParams = new URLSearchParams(_value);
        // Obtenemos el valor
        let _result = _urlParams.get(_data.search);
        // Si se solicita eliminar el parámetro
        _urlParams.delete(_data.search);
        const newUrl = `${window.location.pathname}?${_urlParams.toString()}`;
        window.history.replaceState(null, '', newUrl);

        return _result;
    }

    window.localstorage_function = function (_tipo, _variable, _object = {}) {
        switch (_tipo.toLowerCase()) {
            case 'get':
                return $.parseJSON(localStorage.getItem(_variable));
                break;
            case 'set':
                localStorage.setItem(_variable, JSON.stringify(_object));
                break;
            case 'remove':
                localStorage.removeItem(_variable);
                break;
        }
    }

    window.split_datetime = function (_date_time = '') {
        if (_date_time != '') {
            // CONVERTIMOS LA CADENA A UN OBJETO DATE
            let fechaHora = new Date(_date_time);

            // OBTENEMOS LA FECHA Y HORA POR SEPARADOS
            data = {
                date: fechaHora.toISOString().slice(0, 10),
                time: fechaHora.toTimeString().slice(0, 8)
            };

            return data;
        }

        return false;
    }

    window.sweet_alert = function (_data = { type: 'info', message: 'you need to type the message to show.' }) {
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        let _type = '';

        switch (_data.type.toLowerCase()) {
            case 'success':
            case 'info':
            case 'error':
            case 'warning':
            case 'question':
                _type = _data.type;
                break;
        }

        if (_type != "") {
            Toast.fire({
                icon: _type.toLowerCase(),
                title: _data.message
            })
        }
    }

    window.toast_alert = function (_data = { type: 'info', message: 'you need to type the message to show.' }) {
        switch (_data.type.toLowerCase()) {
            case 'info':
                toastr.info(_data.message)
                break;
            case 'success':
                toastr.success(_data.message)
                break;
            case 'error':
                toastr.error(_data.message)
                break;
            case 'warning':
                toastr.warning(_data.message)
                break;
        }
    }

    window.bootbox_alert = function (_data = { title: 'title', message: 'you need to type the message to show.', type: '', hide: true, delay: 750, position: 'topLeft', icon: 'fas fa-envelope fa-lg', subtitle: '' }) {
        let _type = '';
        if (typeof _data.hide == "undefined") _data.hide = true;
        if (typeof _data.delay == "undefined") _data.delay = 5000;
        if (typeof _data.position == "undefined") _data.position = 'topRight';
        if (typeof _data.icon == "undefined") _data.icon = 'fa fa-info';
        if (typeof _data.subtitle == "undefined") _data.subtitle = '';

        if (typeof _data.type != "undefined") {

            switch (_data.type.toLowerCase()) {
                case 'success':
                    _type = 'bg-success';
                    break;
                case 'info':
                    _type = 'bg-info';
                    break;
                case 'error':
                    _type = 'bg-danger';
                    break;
                case 'warning':
                    _type = 'bg-warning';
                    break;
                case 'maroon':
                    _type = 'bg-maroon';
                    break;
            }
        }


        $(document).Toasts('create', {
            title: _data.title.toUpperCase(),
            autohide: _data.hide,
            delay: _data.delay,
            body: _data.message,
            position: _data.position, // bottomRight, bottomLeft, topLeft, topRight
            icon: _data.icon,
            subtitle: _data.subtitle,
            class: _type
        });
    }

    window.bootbox = function (_data = { type: 'alert', title: '', message: '', function: function () { } }) {
        switch (_data.type) {
            case 'alert':

                break;
            case 'confirm':
                bootbox.confirm({
                    message: "This is a confirm with custom button text and color! Do you like it?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-primary'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                    }
                });
                break;
        }
    }

    window.form_clear = function (_element_id) {
        $('#' + _element_id)[0].reset();
        document.querySelectorAll('#' + _element_id + ' input[type=checkbox]').forEach(function (checkElement) {
            checkElement.checked = false;
        });
    }

    window.input_validation = function (data = { item: [] }) {
        // ESTO VA DEBAJO DEL INPUT A VALIDAR
        // <div id="message_error_sistema" class="invalid-feedback"></div>
        if (data.item.length > 0) {
            data.item.forEach((element) => {
                $('#message_error_' + element).css('display', 'none');

                $('#' + element).on("input", function () {
                    if ($(this).val() != "") {
                        $(this).removeClass('is-invalid');
                        $('#message_error_' + element).css('display', 'none');
                    } else {
                        $(this).addClass('is-invalid');
                        $('#message_error_' + element).css('display', 'inline');
                        $('#message_error_' + element).html('You must type a ' + element + '.');
                    }
                });
            });
        } else {
            console.log('NESECITA RECIBIR LOS SIGUIENTES PARAMETROS: { item: [] }');
        }
    }

    window.form_validation = function (data = { item: [] }) {
        // ESTO VA DEBAJO DEL INPUT A VALIDAR
        // <div id="message_error_sistema" class="invalid-feedback"></div>
        let _array_true = [];

        if (data.item.length > 0) {
            data.item.forEach((element) => {
                if ($('#' + element).val() != "") {
                    _array_true.push(1);
                } else {
                    $("#" + element).removeClass("is-valid").addClass("is-invalid");
                    $('#message_error_' + element).css('display', 'inline');
                    $('#message_error_' + element).html('You must type a ' + element);
                }
            });

            return (_array_true.length == data.item.length) ? true : false;
        } else {
            console.log('NESECITA RECIBIR LOS SIGUIENTES PARAMETROS: { item: [] }');
        }
    }

});

