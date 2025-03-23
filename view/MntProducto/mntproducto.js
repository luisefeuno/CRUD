$(document).ready(function () {

    /////////////////////////////////////
    //            TIPS                //
    ///////////////////////////////////
    // Ocultar dinámicamente la columna con índice 2 (tercera columna)
    // ----> $('#miTabla').DataTable().column(2).visible(false);

    /////////////////////////////////////
    //          FIN DE TIPS           //
    ///////////////////////////////////

    ////////////////////////////////////
    //  FUNCIONES DE APOYO            //
    ///////////////////////////////////


    /////////////////////////////////////
    //     FORMATEO DE CAMPOS          //
    ///////////////////////////////////

    /* DATEPICKER DE FILTRO DATATABLES */
    // Aplicar la máscara para fecha dd/mm/yyyy
    //9 : numeric
    //a: alphabetical
    // * : alphanumeric

    $('#dateCreateFilter').inputmask('99-99-9999');
    // NO FUNCIONA - Muestra la máscara pero no permite escribir.
    //$('#prod_telefono').inputmask('(+99) 999-999-999');


    // Configura el datepicker en español
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#dateCreateFilter').datepicker({
        showAnim: "slideDown",
        dateFormat: 'dd-mm-yy',
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 1
    });


    var formValidator = new FormValidator('formProducto', {
        prod_nom: {
            // Letras, números con espacios, acentos y ñÑ con un mínimo de 3 pos.
            // pattern: '^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{3,}$', Sin posibilida de números
            pattern: '^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9"/ºª ]{3,}$',
            required: true
        },
        prod_email: {
            pattern: '^[\\w.-]+@[a-zA-Z\\d.-]+\\.[a-zA-Z]{2,}$',
            required: false
        },
        prod_telefono: {
            pattern: '^(\\+?\\d{1,3}[ ]?)?\\d{9,10}$',
            required: false
        },
        // Para los select, si son requiered, se omite el valor 0 (es lo que se chequea)
        paises_sel_id: {
            required: true
        },
        prod_img: {
            required: true,
            fileType: ['jpg', 'jpeg', 'png'], // Tipos de archivo permitidos
            maxSize: 2048 // Tamaño máximo en KB (2MB)
        }
    });


    // Solo permito pulsar los numeros
    // Si mas de una campo que debemos limitar el ingreso de caracteres
    // $('#prod_telefono, #otro_campo_id, #otro_campo_id2').on('keypress', function (event) {
    $('#prod_telefono').on('keypress', function (event) {
        //        // Obtener el código ASCII de la tecla presionada
        var charCode = (event.which) ? event.which : event.keyCode;
        //        // Permitir solo caracteres numéricos (códigos ASCII 48-57)
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault(); // Impide la entrada de otros caracteres
        }
    });

    // Para que se mantenga dentro del modal
    $('#paises_sel_id').select2({
        dropdownParent: $('#modalMantenimiento')
    });
    // Para el resto se ha colocado un CSS en el mainHead

    /////////////////////////////////////////
    //     FIN FORMATEO DE CAMPOS          //
    ////////////////////////////////////////


    /////////////////////////////////////
    // INICIO DE LA TABLA DE PRODUCTOS //
    //         DATATABLES             //
    ///////////////////////////////////
    var datatable_productoConfig = {
        //serverSide: true, // procesamiento del lado del servidor
        processing: true, // mostrar el procesamiento de la tabla
        layout: {
            bottomEnd: { // que elementos de la paginación queremos que aparezcan
                paging: {
                    firstLast: true,
                    numbers: false,
                    previousNext: true
                }
            }
        }, //
        language: {
            // Se hace para cambiar la paginación por flechas
            paginate: {
                first: '<i class="bi bi-chevron-double-left"></i>', // Ícono de FontAwesome
                last: '<i class="bi bi-chevron-double-right"></i>', // Ícono de FontAwesome
                previous: '<i class="bi bi-chevron-compact-left"></i>', // Ícono de FontAwesome
                next: '<i class="bi bi-chevron-compact-right"></i>'  // Ícono de FontAwesome
            }
        }, // de la language
        columns: [

            // Son los botones para más
            // No tocar
            { name: 'control', data: null, defaultContent: '', className: 'details-control' },

            { name: 'prod_id', data: 'prod_id' },
            { name: 'prod_nom', data: 'prod_nom' },
            { name: 'fech_crea', data: 'fech_crea' },
            { name: 'fech_modi', data: 'fech_modi' },
            { name: 'fech_elim', data: 'fech_elim' },
            { name: 'est', data: 'est' },
            { name: 'oferta', data: 'oferta', visible: false }, // La pongo a false para que no se vea, pero que los datos estén disponibles.
            { name: 'estadoproducto', data: 'estadoProducto', visible: false }, // La pongo a false para que no se vea, pero que los datos estén disponibles.
            { name: 'paisesid', data: 'paisesId', visible: false },
            { name: 'descrpais', data: 'descrPais', visible: false }
        ], // de las columnas
        columnDefs: [
            // Cuidado que el ordrData puede interferir con el ordenamiento de la tabla    
            // Esta no tocar es el + para mostrar más
            { targets: 0, width: '3%', searchable: false, orderable: false },
            // prod_id
            { targets: 1, width: '6%', searchable: false, orderable: false },
            //prod_nom
            { targets: 2, width: '31%', searchable: true, orderable: true },
            //fech_crea
            {
                targets: 3, width: '10%', orderable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                } // de la function
            },
            //fech_modi
            {
                targets: 4, width: '10%', orderable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                } // de la function
            },
            //fech_elim
            {
                targets: 5, width: '10%', orderable: true, className: "text-center", render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                }, // de la function },  
            },
            //est
            {
                targets: 6, width: '10%', orderable: true, searchable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display") {
                        return data == 1 ? '<i class="bi bi-check-circle text-success tx-24"></i>' : '<i class="bi bi-x-circle text-danger tx-24"></i>';
                    }
                    return data;
                }
            },
            //oferta
            {
                targets: 7, width: '5%', searchable: false, orderable: false, class: "text-center"
            },
            //estadoProducto
            {
                targets: 8, width: '5%', searchable: false, orderable: false, class: "text-center"
            },
            //paisesId
            {
                targets: 9, width: '5%', searchable: false, orderable: false, class: "text-center"
            },
            //descrPaises
            {
                targets: 10, width: '5%', searchable: false, orderable: false, class: "text-center"
            },
            {   // para añadir un botón de ver detalles que llama a un modal llamado ver-detalle
                targets: 11, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    // Agregar log para depurar los valores que se están asignando al botón
                    //          console.log('Datos del botón (fila completa):', row);
                    //          console.log('Valor de estadoProducto:', row.estadoProducto, 'Tipo:', typeof row.estadoProducto);
                    //          console.log('Valor de oferta:', row.oferta, 'Tipo:', typeof row.oferta);

                    /// TRABAJAR TODO EN MINUSCULAS JQUERY LOS TRANSFORMA EN MINUSCULAS

                    return `<button class="btn btn-primary btn-sm ver-detalle" 
                             data-prod_id="${row.prod_id}" 
                             data-prod_nom="${row.prod_nom}"  
                             data-fech_crea="${row.fech_crea}" 
                             data-fech_modi="${row.fech_modi}" 
                             data-fech_elim="${row.fech_elim}" 
                             data-oferta="${row.oferta}" 
                             data-estadoproducto="${row.estadoProducto}" 
                             data-paisesid="${row.paisesId}" 
                             data-paisesnom="${row.descrPais}" 
                             data-est="${row.est}">

                             <i class="fa fa-eye"></i>
                            </button>`;


                } // de la function
            },
            {   // para añadir un botón borrar
                targets: 12, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    // El nombre que de la variable que se pasa por data-xxx debe ser el mismo que el nombre de la columna en la base de datos
                    if (row.est == 1) {
                        // permito desactivar el estado
                        return `<button type="button" class="btn btn-danger btn-sm desacProducto" data-bs-toggle="tooltip-primary" data-placement="top" title="Desactivar" data-original-title="Tooltip on top" 
                             data-prod_id="${row.prod_id}"> <!-- Cambiado de data-id a data-prod_id -->
                             <i class="fa-solid fa-trash"></i>
                             </button>`}
                    else {
                        // debo permitir activar de nuevo el estado
                        return `<button class="btn btn-success btn-sm activarProducto" data-bs-toggle="tooltip-primary" data-placement="top" title="Activar" data-original-title="Tooltip on top" 
                             data-prod_id="${row.prod_id}"> <!-- Cambiado de data-id a data-prod_id -->
                             <i class="bi bi-hand-thumbs-up-fill"></i>
                            </button>`}
                } // de la function
            },// de la columDef 8
            {   // para añadir un botón editar
                targets: 13, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    // El nombre que de la variable que se pasa por data-xxx debe ser el mismo que el nombre de la columna en la base de datos

                    // botón editar el producto
                    return `<button type="button" class="btn btn-info btn-sm editarProducto" data-toggle="tooltip-primary" data-placement="top" title="Editar"  
                             data-prod_id="${row.prod_id}"> 
                             <i class="fa-solid fa-edit"></i>
                             </button>`

                } // de la function
            } // De la columna 9
        ], // de la columnDefs
        ajax: {
            url: '../../controller/producto.php?op=listar',
            type: 'GET',
            dataSrc: 'data' // Antes era "aaData"
            /*****************************************************************************************/
            /************  ESTO LO UTILIZAREMOS PARA SABER LO QUE NOS TRAE el AJAX ******************/
            /***************************************************************************************/
            //dataSrc:
            //    function (json) {
            //        console.log("JSON recibido:", json); // 📌 Esto mostrará la respuesta en la consola
            //        return json.data; // Asegúrate de que tu JSON tiene la clave "data"
            //    }
            /*********************************************************************************************/
            /************  FIN ESTO LO UTILIZAREMOS PARA SABER LO QUE NOS TRAE el AJAX ******************/
            /*******************************************************************************************/
        }, // del ajax
    }; // de la variable datatable_companiesConfig
    ////////////////////////////
    // FIN DE LA TABLA DE    //
    ///////////////////////////


    /************************************/
    //     ZONA DE DEFINICIONES        //
    /**********************************/
    // Definición inicial de la tabla de empleados
    var $table = $('#productos_data');  /*<--- Es el nombre que le hemos dado a la tabla en HTML */
    var $tableConfig = datatable_productoConfig; /*<--- Es el nombre que le hemos dado a la declaración de la definicion de la tabla */
    //var $columSearch = 3; /* <-- Es la columna en la cual al hacer click el valor se colocará en la zona de search y se buscará */
    var $tableBody = $('#productos_data tbody'); /*<--- Es el nombre que le hemos dado al cuerpo de la tabla en HTML */
    /* en el tableBody solo cambiar el nombre de la tabla que encontraremos en HTML*/
    var $columnFilterInputs = $('#productos_data tfoot input'); /*<--- Es el nombre que le hemos dado a los inputs de los pies de la tabla en HTML */
    /* en el $columnFilterInputs solo cambiar el nombre de la tabla que encontraremos en HTML*/

    //ejemplo -- var table_e = $('#employees-table').DataTable(datatable_employeeConfig);
    var table_e = $table.DataTable($tableConfig);

    /************************************/
    //   FIN ZONA DE DEFINICIONES      //
    /**********************************/

    ////////////////////////////////////////////
    //   INICIO ZONA FUNCIONES DE APOYO      //
    //////////////////////////////////////////


    // Carga los datos de los países en el select2.
    // @param { string } selectId - ID del elemento select2.
    //////////////////////////////////////
    // Funcion para cargar un select    //
    ///////////////////////////// ///////
    function cargarPaisesEnSelect2(selectId, idPaisSeleccionado) {
        $.post("../../controller/pais.php?op=listar", function (data) {
            const jsondata = data;
            var select = $(selectId);
            // Limpiar las opciones existentes
            select.empty();
            // Agregar la opción por defecto
            select.append($('<option>', { value: '', text: 'Seleccione un país...' }));

            if (data) {
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data);
                    } catch (e) {
                        console.error('Error al parsear JSON:', e);
                    }
                }
            }

            $.each(jsondata.data, function (index, pais) {
                let selected = (idPaisSeleccionado !== undefined && idPaisSeleccionado !== null && idPaisSeleccionado !== '' && pais.idpaises == idPaisSeleccionado) ? 'selected' : '';
                var optionHtml = '<option value="' + pais.idpaises + '" ' + selected + '>' + pais.descrPaises + '</option>';

                select.append(optionHtml);
            });
        }, "json").fail(function (xhr, status, error) {
            console.error("Error al cargar los países:", error);
        });
    }
    //////////////////////////////////////
    //              FIN                 //
    // Funcion para cargar un select    //
    ///////////////////////////// ///////


    /////////////////////////////
    // Funcion para guardar    //
    ///////////////////////////// 
    function guardarProducto() {
        // Recoger el valor de cada input del formulario
        var prodNom = $('#formProducto').find('input[name="prod_nom"]').val().trim();
        var prodId = $('#formProducto').find('input[name="prod_id"]').val();
        // checkbox - Corregir cómo se obtiene el valor del checkbox
        var Oferta = $("input[name='oferta']").is(":checked") ? 1 : 0;

        // radio button
        var Estado = $("input[name='estado']:checked").val();
        var Pais = $('#paises_sel_id').val();

        var prodImg = $('#prod_img')[0].files[0]; // Obtener el archivo de imagen



        //        var paisesId = $('#formProducto').find('input[name="paisesId"]').val();

        //        console.log('Valor de prod_nom:', prodNom);
        //        console.log('Valor de prod_id:', prodId);
        //console.log('EstadoProducto:', Estado);
        //console.log('Oferta (checkbox checked):', $("#oferta").is(":checked"));--> error por el selector
        //console.log('Oferta (valor final):', Oferta);


        // No hacer falta el sistema de formValidator ya lo hace.
        // if (prodNom.length === 0) {
        //     toastr.error(`El campo nombre está vacío.`, 'Error de Validación');
        //     return; // Salir de la función si hay un campo vacío
        // }

        // Validar el formulario usando FormValidator
        const isValid = formValidator.validateForm(event);

        // Si la validación falla, no enviar el formulario
        if (!isValid) {
            toastr.error(`Por favor, corrija los errores en el formulario.`, 'Error de Validación');
            return; // Salir de la función si la validación falla
        }
        // Serializar los datos del formulario lo utilizaremos cuando no tengamos que
        // cambiar nada de los datos que se envían al servidor
        // var formData = $('#formProducto').serialize();
        // console.log('Datos del formulario serializados:', formData);



        // primero <<nombre del campo de la BD>>:<<nombre de la variable>
        var datosFormulario = {
            prod_id: prodId,
            prod_nom: prodNom,
            oferta: Oferta,
            estadoProducto: Estado,
            paisesId: Pais,
            prod_img: prodImg
        };

        //console.log(datosFormulario);

        var formData = new FormData();

        // Agregar los datos al objeto FormData
        for (var key in datosFormulario) {
            formData.append(key, datosFormulario[key]);
        }

        //console.log('formData:', formData);

        $.ajax({
            url: "../../controller/producto.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            processData: false, // Evitar que jQuery procese los datos
            contentType: false, // Evitar que jQuery establezca el tipo de contenido
            success: function (data) {
                $('#modalMantenimiento').modal('hide');
                $table.DataTable().ajax.reload();
                $("#formProducto")[0].reset();
                // Alternativa 1 de información
                //swal.fire(
                //    'Guardado',
                //    'El producto ha sido guardado',
                //    'success'
                //);
                // Alternativa 2 de información con toastr
                //https://codeseven.github.io/toastr/demo.html
                toastr["success"]("El producto ha sido guardado", "Guardado");
            },
            error: function (xhr, status, error) {
                swal.fire(
                    'Error',
                    'No se pudo guardar el producto. ' + error + '. Respuesta del servidor: ' + xhr.responseText,
                    'error'
                );
            } // del error
        }); // del ajax
    } // de la función guardarProducto
    /////////////////////////////
    //        FIN              //
    // Funcion para guardar    //
    ///////////////////////////// 


    //////////////////////////////////
    //    Funcion control del +    //
    //////////////////////////////// 
    //Funcion para dar mostrar mas -- es en boton de +
    function format(d) {
        // Obtener el número de columnas de la tabla
        const textoOferta = d.oferta === 1 ? "Oferta" : "Precio normal";

        let textoEstadoProducto, estiloEstadoProducto
        switch (d.estadoProducto) {
            case 1:
                textoEstadoProducto = "Nuevo";
                estiloEstadoProducto = "background-color: green; color: white";
                break;
            case 2:
                textoEstadoProducto = "Usado";
                estiloEstadoProducto = "background-color: orange; color: white";
                break;
            case 3:
                textoEstadoProducto = "Segunda mano";
                estiloEstadoProducto = "background-color: gray; color: white";
                break;
        }
        //console.log('Valor Oferta', d.oferta);
        //console.log('Valor estadoProducto', d.estadoProducto);

        //Estilo 1
        let tablaHTML = `
              <table class="table table-striped">
                  <thead>
                  <!-- Se puede utilizar para otro formato de tabla -->   
                  <!-- <tr>
                           <th>Descripción</th>
                       </tr> -->
                  </thead>
                  <tbody>
                         <tr>
                              <td>Descripción: ${d.prod_nom}</td>
                         </tr>
                          <tr>
                            <td>Oferta: ${textoOferta}</td>
                          </tr>
                          <tr>
                            <td style="${estiloEstadoProducto}">Estado producto: ${textoEstadoProducto}</td>
                          </tr>
                          <tr>
                              <td>Pais: ${d.paisesId} - ${d.descrPais}</td>
                         </tr>
                  </tbody>
              </table>
          `;
        return tablaHTML;
    }

    // Vamos a definir cómo funcionará el botón de mostrar más
    // NO TOCAR, se configura en la parte superior --> funcion format(d)
    $tableBody.on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table_e.row(tr);

        if (row.child.isShown()) {
            // Esta fila ya está abierta, la cerramos
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Abrir esta fila
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
    //////////////////////////////////
    //           FIN               //
    //    Funcion control del +    //
    //////////////////////////////// 


    ////////////////////////////////////////////
    //   INICIO ZONA LANZAMIENTO MODAL       //
    //           DE VER DETALLE              //
    //////////////////////////////////////////
    $(document).on('click', '.ver-detalle', function () {
        // Agregar log para depurar los valores que se están obteniendo del botón
        //console.log('Atributos del botón:', $(this).data());
        //console.log('Valor de estadoProducto (botón):', $(this).data('estadoproducto'), 'Tipo:', typeof $(this).data('estadoproducto'));
        //console.log('Valor de oferta (botón):', $(this).data('oferta'), 'Tipo:', typeof $(this).data('oferta'));

        let prod_id = $(this).data('prod_id');
        let prod_nom = $(this).data('prod_nom');
        let fech_crea = formatoFechaEuropeo($(this).data('fech_crea'));
        let fech_modi = formatoFechaEuropeo($(this).data('fech_modi'));
        let fech_elim = formatoFechaEuropeo($(this).data('fech_elim'));
        let est = $(this).data('est') == 1 ? 'Activo' : 'Desactivado'; // Cambiar el valor de est por Activo o Desactivado
        let oferta = $(this).data('oferta') == 1 ? 'Oferta' : 'Precio normal';

        // CUIDADO : JQUERY LOS TRABAJA SIEMPRE EN MINUSCULAS //

        let paisesId = $(this).data('paisesid');
        let descrPais = $(this).data('paisesnom');

        // jQuery convierte los atributos data a minúsculas
        let estadoProducto = $(this).data('estadoproducto');

        let textoEstadoProductoF = ""; // Definir la variable antes del switch
        // Convertir a número si es necesario para el switch
        let estadoProductoNum = parseInt(estadoProducto);

        console.log('EstadoProducto convertido a número:', estadoProductoNum, 'Tipo:', typeof estadoProductoNum);

        switch (estadoProductoNum) {
            case 1:
                textoEstadoProductoF = "Nuevo";
                break;
            case 2:
                textoEstadoProductoF = "Usado";
                break;
            case 3:
                textoEstadoProductoF = "Segunda mano";
                break;
            default:
                textoEstadoProductoF = "No definido";
                console.log('EstadoProducto no definido:', estadoProducto);
        }


        //    console.log('prod_nom', prod_nom);
        //    console.log('prod_id', prod_id);
        //console.log('EstadoProducto:', textoEstadoProductoF);


        // Insertar los datos en el modal
        $('#prod_id').text(prod_id);
        $('#prod_nom').text(prod_nom);
        $('#fech_crea').text(fech_crea);
        $('#fech_modi').text(fech_modi);
        $('#fech_elim').text(fech_elim);
        $('#est').text(est);
        $('#oferta').text(oferta);
        $('#estadoproducto').text(textoEstadoProductoF);
        $('#paisesid').text(paisesId);
        $('#descrPais').text(descrPais);


        // Mostrar el modal
        // Posibles efectos 
        // effect-scale
        //effect-slide-in-right
        //effect-slide-in-bottom
        //effect-newspaper
        //effect-fall
        //effect-flip-horizontal
        //effect-flip-vertical
        //effect-super-scaled
        //effect-sign
        //effect-rotate-bottom
        //effect-rotate-left
        //effect-just-me
        $('#modalMostrarProductoBra').addClass('effect-scale');
        $('#modalMostrarProductoBra').modal('show');
    });


    $('#modalMostrarProductoBra').on('hidden.bs.modal', function () {
        $('#prod_id').text('');
        $('#prod_nom').text('');
        $('#fech_crea').text('');
        $('#fech_modi').text('');
        $('#fech_elim').text('');
        $('#est').text('');
        $('#oferta').text('');

    });
    //////////////////////////////////////////////////////
    //       FIN ZONA LANZAMIENTO MODAL de DETALLE     //
    ////////////////////////////////////////////////////


    /////////////////////////////////////
    //   INICIO ZONA DELETE PRODUCTO  //
    ///////////////////////////////////
    function desacProducto(id) {
        swal.fire({
            title: 'Desactivar',
            text: `¿Desea desactivar el producto con ID ${id}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("../../controller/producto.php?op=eliminar", { prod_id: id }, function (data) { // Cambiado a prod_id

                    $table.DataTable().ajax.reload();

                    swal.fire(
                        'Desactivado',
                        'El producto ha sido desactivado',
                        'success'
                    )
                });
            }
        })
    }


    // CAPTURAR EL CLICK EN EL BOTÓN DE BORRAR
    $(document).on('click', '.desacProducto', function (event) {
        event.preventDefault();
        let id = $(this).data('prod_id'); // Cambiado de data('id') a data('prod_id')
        desacProducto(id);
    });
    ////////////////////////////////////
    //   FIN ZONA DELETE PRODUCTO    //
    //////////////////////////////////

    ///////////////////////////////////////
    //   INICIO ZONA ACTIVAR PRODUCTO  //
    /////////////////////////////////////
    function activarProducto(id) {
        swal.fire({
            title: 'Activar',
            text: `¿Desea activar el producto con ID ${id}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("../../controller/producto.php?op=activar", { prod_id: id }, function (data) {

                    $table.DataTable().ajax.reload();

                    swal.fire(
                        'Activado',
                        'El producto ha sido activado',
                        'success'
                    )
                });
            }
        })
    }


    // CAPTURAR EL CLICK EN EL BOTÓN DE ACTIVAR
    $(document).on('click', '.activarProducto', function (event) {
        event.preventDefault();
        let id = $(this).data('prod_id'); // Cambiado de data('id') a data('prod_id')
        activarProducto(id);
    });
    ////////////////////////////////////
    //   FIN ZONA ACTIVAR PRODUCTO    //
    //////////////////////////////////

    ////////////////////////////////////
    //   TRATAMIENTO DE LA IMAGEN    //
    //////////////////////////////////

    // Función para mostrar la previsualización de la imagen
    $("#prod_img").change(function () {
        mostrarPreview(this);
    });

    // Función para limpiar la imagen seleccionada
    $("#btnLimpiarImagen").click(function () {
        limpiarInputImagen();
    });


    // Función para mostrar la previsualización de la imagen
    function mostrarPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#previewImagen").html('<img src="' + e.target.result + '" alt="Vista previa" class="img-fluid" style="max-height: 200px;" />');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Función para limpiar el input de imagen
    function limpiarInputImagen() {
        // Limpiar el valor del input file
        $("#prod_img").val("");
        // Limpiar la previsualización
        $("#previewImagen").empty();
    }
    ////////////////////////////////////
    //               FIN             //
    //   TRATAMIENTO DE LA IMAGEN    //
    //////////////////////////////////



    ///////////////////////////////////////
    //      INICIO ZONA NUEVO           //
    //        BOTON DE NUEVO           // 
    /////////////////////////////////////
    // CAPTURAR EL CLICK EN EL BOTÓN DE NUEVO
    $(document).on('click', '#btnnuevo', function (event) {
        event.preventDefault();
        $('#mdltitulo').text('Nuevo registro');

        $('#modalMantenimiento').modal('show');

        // Limpiar el formulario
        $("#formProducto")[0].reset();

        // Limpiar las validaciones
        formValidator.clearValidation(); // Llama al método clearValidation

        // Vamos a cargar el select2 con los datos de los países
        cargarPaisesEnSelect2('#paises_sel_id');
        // Limpiar la imagen por si se ha seleccionado una anteriormente
        // La función se ha definido en la parte inferior de este documento
        limpiarInputImagen();

        // Mostrar el mantenimiento(modal) con el foco en el primer campo
        $('#modalMantenimiento').on('shown.bs.modal', function () {
            $('#modalMantenimiento .modal-body #prod_nom').focus();
        });

        //console.log('Modal mostrado');
    });

    ///////////////////////////////////////
    //      FIN ZONA NUEVO           //
    /////////////////////////////////////


    ///////////////////////////////////////
    //      INICIO ZONA EDITAR           //
    //        BOTON DE EDITAR           //
    /////////////////////////////////////
    // CAPTURAR EL CLICK EN EL BOTÓN DE EDITAR
    $(document).on('click', '.editarProducto', function (event) {
        event.preventDefault();

        // Limpiar las validaciones
        formValidator.clearValidation(); // Llama al método clearValidation

        let id = $(this).data('prod_id');
        //        console.log('Antes del click', id);
        $.post("../../controller/producto.php?op=mostrar", { prod_id: id }, function (data) {
            //console.log('Datos recibidos del servidor:', data);

            if (data) {
                // Podría ser que los datos estén llegando como una cadena JSON
                // Intentemos parsear si es necesario
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data);
                    } catch (e) {
                        console.error('Error al parsear JSON:', e);
                    }
                }

                //console.log('Datos parseados:', data);

                $('#mdltitulo').text('Edición registro');
                $('#modalMantenimiento').modal('show');

                $('#modalMantenimiento .modal-body #prod_id').val(data.prod_id);
                $('#modalMantenimiento .modal-body #prod_nom').val(data.prod_nom);

                // Si el producto tiene oferta, marcamos el checkbox
                if (data.oferta == 1) {
                    $('#modalMantenimiento .modal-body #oferta').prop('checked', true);
                } else {
                    $('#modalMantenimiento .modal-body #oferta').prop('checked', false);
                }

                // Seleccionamos el radio button correspondiente al estado del producto
                $(`#modalMantenimiento .modal-body input[name="estado"][value="${data.estadoProducto}"]`).prop('checked', true);

                //console.log('data.idpaises:', data.paisesId);

                // Vamos a cargar el select2 con los datos de los países
                cargarPaisesEnSelect2('#paises_sel_id', data.paisesId);
                // Esperar a que Select2 se inicialice y las opciones se carguen

                // debemos cargar el campo de texto de la imagen desde la otra tabla



            } else {
                console.error('Error: Datos no encontrados');
            }
        }).fail(function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
        });
    });
    ///////////////////////////////////////
    //        FIN ZONA EDITAR           //
    /////////////////////////////////////

    // CAPTURAR EL CLICK EN EL BOTÓN DE SALVAR
    $(document).on('click', '#btnsalvar', async function (event) {
        event.preventDefault();
        guardarProducto();
    }); // del click


    ////////////////////////////////////////////////////////
    //        ZONA FILTROS RADIOBUTTON CABECERA           //
    ///////////////////////////////////////////////////////
    // Escuchar cambios en los radio buttons
    // Si es necesario filtrar por texto en lugar de valores numéricos, hay que asegurarse que los valores de los radio buttons coincidan con los valores de la columna.
    $('input[name="filterStatus"]').on('change', function () {
        var value = $(this).val(); // Obtener el valor seleccionado

        if (value === "all") {
            // Si se selecciona "Todos", limpiar el filtro
            table_e.column(6).search("").draw(); // Cambiar numero por el índice de la columna a filtrar
        } else {
            // Filtrar la columna por el valor seleccionado
            table_e.column(6).search(value).draw(); // Cambia numero por el índice de la columna a filtrar

        }
    });
    ////////////////////////////////////////////////////////////
    //        FIN ZONA FILTROS RADIOBUTTON CABECERA          //
    //////////////////////////////////////////////////////////
    ////////////////////////////////////////////////
    //        ZONA FILTRO DE LA FECHA            //
    ///////////////////////////////////////////////
    $('#dateCreateFilter').on('change', function () {
        var value = $(this).val(); // Obtener el valor seleccionado
        //console.log(value);
        table_e.column(3).search(value).draw();
    });


    // borrar la fecha
    $('#borrarFechaFiltro').on('click', function () {
        $('#dateCreateFilter').val('');
        $('#dateCreateFilter').trigger('change');
    });

    // cambiar el cursor
    $('#borrarFechaFiltro').on('mouseenter', function () {
        $(this).css('cursor', 'pointer');
    }).on('mouseleave', function () {
        $(this).css('cursor', 'default');
    });
    ////////////////////////////////////////////////
    //     FIN ZONA FILTRO DE LA FECHA           //
    ///////////////////////////////////////////////


    /*********************************************************** */
    /********************************************************** */
    /* A PARTIR DE AQUI NO TOCAR  SE ACTUALIZA AUTOMATICAMENTE */
    /******************************************************** */
    /******************************************************* */

    //ejemplo -- var table_e = $('#employees-table').DataTable(datatable_employeeConfig);
    //var table_e = $table.DataTable($tableConfig);

    /////////////////////////////////////
    //  INICIO ZONA CLICS COLUMNA     //
    //    NO ES NECESARIO TOCAR      // 
    //////////////////////////////////
    //Código para capturar clics solo en la tercera columna (edad) y filtrar DataTables
    // El resto no responden al clic
    //ejemplo - $('#employees-table tbody').on('click', 'td', function () {

    // En caso de no querer que se filtre por columna se puede comentar o eliminar

    /*  En este caso no deseamos buscar por ninguna columna al hacer clic
        $tableBody.on('click', 'td', function () {
            var cellIndex = table_e.cell(this).index().column; // Índice real de la columna en DataTables
     
            // ejemplo - if (cellIndex === 3) { // Asegúrarse de que es la columna 'edad' 
            if (cellIndex === $columSearch) { // Asegúrarse de que es la columna 'edad' 
                var cellValue = $(this).text().trim();
                table_e.search(cellValue).draw();
                updateFilterMessage(); // Actualizar el mensaje cuando se aplique el filtro
            }
        });
    */
    /////////////////////////////////////
    //  FIN ZONA CLICS COLUMNA     //
    ///////////////////////////////////

    ////////////////////////////////////////////
    //  INICIO ZONA FILTROS PIES y SEARCH     //
    //    NO ES NECESARIO TOCAR              //
    //     FUNCIONES NO TOCAR               // 
    ///////////////////////////////////////////

    /* IMPORTANTE ---- IMPORTANTE ---- IMPORTANTE ---- IMPORTANTE */
    /* Si algún campo no quiere que se habilite en el footer la busqueda, 
    bastará con poner en el columnDefs -- > searchable: false */

    // Filtro de cada columna en el pie de la tabla de empleados (tfoot)
    // ejemplo - $('#employees-table tfoot input').on('keyup', function () {
    $columnFilterInputs.on('keyup', function () {
        var columnIndex = $(this).closest('th').index(); // Obtener el índice de la columna del encabezado correspondiente
        var searchValue = $(this).val(); // Obtener el valor del campo de búsqueda

        // Aplicar el filtro a la columna correspondiente
        table_e.column(columnIndex).search(searchValue).draw();

        // Actualizar el mensaje de filtro
        updateFilterMessage();
    });

    // Función para actualizar el mensaje de filtro activo
    function updateFilterMessage() {
        var activeFilters = false;

        // Revisamos si hay algún filtro activo en cualquier columna
        $columnFilterInputs.each(function () {
            if ($(this).val() !== "") {
                activeFilters = true;
                return false; // Si encontramos un filtro activo, salimos del loop
            }
        });

        // Revisamos si hay un filtro activo en la búsqueda global
        if (table_e.search() !== "") {
            activeFilters = true;
        }

        // Muestra u oculta el mensaje "Hay un filtro activo"
        if (activeFilters) {
            $('#filter-alert').show();
        } else {
            $('#filter-alert').hide();
        }
    }

    // Esto es solo valido para la busqueda superior //
    table_e.on('search.dt', function () {
        updateFilterMessage(); // Actualizar mensaje de filtro
    });
    ////////////////////////////////////////////////////////

    // Botón para limpiar los filtros y ocultar el mensaje ////////////////////////////////////////////
    $('#clear-filter').on('click', function () {
        //console.log('Limpiando filtros...');
        table_e.destroy();  // Destruir la tabla para limpiar los filtros

        // Limpiar los campos de búsqueda del pie de la tabla
        // ejemplo - $('#employees-table tfoot input').each(function () {
        $columnFilterInputs.each(function () {
            //console.log('Campo:', $(this).attr('placeholder'), 'Valor antes:', $(this).val());
            $(this).val('');  // Limpiar cada campo input del pie y disparar el evento input
            //console.log('Valor después:', $(this).val());
        });

        table_e = $table.DataTable($tableConfig);

        // Ocultar el mensaje de "Hay un filtro activo"
        $('#filter-alert').hide();
    });
    ////////////////////////////////////////////
    //  FIN ZONA FILTROS PIES y SEARCH     //
    ///////////////////////////////////////////
}); // de document.ready


