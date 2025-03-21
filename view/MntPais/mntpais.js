$(document).ready(function () {

    /////////////////////////////////////
    //            TIPS                //
    ///////////////////////////////////
    // Ocultar dinámicamente la columna con índice 2 (tercera columna)
    // ----> $('#miTabla').DataTable().column(2).visible(false);



    // Agregue un controlador de eventos para el evento "keypress" en el campo de entrada
    //    capaAula.on('keypress', function (event) {
    //        // Obtener el código ASCII de la tecla presionada
    //        var charCode = (event.which) ? event.which : event.keyCode;
    //
    //        // Permitir solo caracteres numéricos (códigos ASCII 48-57)
    //        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    //            event.preventDefault(); // Impide la entrada de otros caracteres
    //        }
    //    });


    /////////////////////////////////////
    //          FIN DE TIPS           //
    ///////////////////////////////////


    /////////////////////////////////////
    // INICIO DE LA TABLA DE PRODUCTOS //
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
            { name: 'idpaises', data: 'idpaises' },
            { name: 'descrPaises', data: 'descrPaises' },
            { name: 'fech_crea', data: 'fech_crea' },
            { name: 'fech_modi', data: 'fech_modi' },
            { name: 'fech_elim', data: 'fech_elim' },
            { name: 'est', data: 'est' },
        ], // de las columnas
        columnDefs: [
            // Cuidado que el ordrData puede interferir con el ordenamiento de la tabla    
            // Esta no tocar es el + para mostrar más
            { targets: 0, width: '3%', searchable: false, orderable: false },
            // ID PAIS
            { targets: 1, width: '6%', searchable: false, orderable: false },
            //NOMBRE PAIS
            { targets: 2, width: '31%', searchable: true, orderable: true },
            //fech_crea PAIS
            {
                targets: 3, width: '10%', orderable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                } // de la function
            },
            //fech_modi PAIS
            {
                targets: 4, width: '10%', orderable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                } // de la function
            },
            //fech_elim PAIS
            {
                targets: 5, width: '10%', orderable: true, className: "text-center", render: function (data, type, row) {
                    if (type === "display" || type === "filter") {
                        return formatoFechaEuropeo(data);
                    } // de la function
                    return data; // para la ordenación y el procesamiento utiliza la original  
                }, // de la function },  
            },
            //est PAIS
            {
                targets: 6, width: '10%', orderable: true, searchable: true, className: "text-center",
                render: function (data, type, row) {
                    if (type === "display") {
                        return data == 1 ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>';
                    }
                    return data;
                }
            },
            {   // DETALLES PAIS
                // para añadir un botón de ver detalles que llama a un modal llamado ver-detalle
                targets: 7, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    return `<button class="btn btn-primary btn-sm ver-detalle" 
                             data-idpaises="${row.idpaises}" 
                             data-descrPaises="${row.descrPaises}" 
                             data-fech_crea="${row.fech_crea}" 
                             data-fech_modi="${row.fech_modi}" 
                             data-fech_elim="${row.fech_elim}"
                             data-est="${row.est}"
                             <i class="fa fa-eye"></i>
                            </button>`;
                } // de la function
            },
            // 
            {   // ACT/DESACT PAIS
                // para añadir un botón borrar SE SUPONE QUE MI TABLA NO TIENE ESTADO, NO SE MUY BIEN QUE SE VA A HACER FINALMENTE AQUI
                targets: 8, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    // El nombre que de la variable que se pasa por data-xxx debe ser el mismo que el nombre de la columna en la base de datos
                    if (row.est == 1) {
                        // permito desactivar el estado
                        return `<button type="button" class="btn btn-danger btn-sm desacPais" data-bs-toggle="tooltip-primary" data-placement="top" title="Desactivar" data-original-title="Tooltip on top" 
                             data-idpaises="${row.idpaises}"> <!-- Cambiado de data-id a data-prod_id -->
                             <i class="fa-solid fa-trash"></i>
                             </button>`}
                    else {
                        // debo permitir activar de nuevo el estado
                        return `<button class="btn btn-success btn-sm activarPais" data-bs-toggle="tooltip-primary" data-placement="top" title="Activar" data-original-title="Tooltip on top" 
                             data-idpaises="${row.idpaises}"> <!-- Cambiado de data-id a data-prod_id -->
                             <i class="bi bi-hand-thumbs-up-fill"></i>
                            </button>`}
                } // de la function
            },// de la columDef 8
            {   // para añadir un botón editar EDITAR PAISES
                targets: 9, width: '5%', searchable: false, orderable: false, class: "text-center",
                render: function (data, type, row) {
                    // El nombre que de la variable que se pasa por data-xxx debe ser el mismo que el nombre de la columna en la base de datos

                    // botón editar el producto
                    return `<button type="button" class="btn btn-info btn-sm editarPais" data-toggle="tooltip-primary" data-placement="top" title="Editar"  
                             data-idpaises="${row.idpaises}"> 
                             <i class="fa-solid fa-edit"></i>
                             </button>`

                } // de la function
            } // De la columna 9
        ], // de la columnDefs
        ajax: {
            url: '../../controller/pais.php?op=listar',
            type: 'GET',
            dataSrc: 'data' // Antes era "aaData"
        }, // del ajax
    }; // de la variable datatable_companiesConfig
    /////////////////////////////////
    // FIN DE LA TABLA DE FORUM   //
    ///////////////////////////////


    /************************************/
    //     ZONA DE DEFINICIONES        //
    /**********************************/
    // Definición inicial de la tabla de paises
    var $table = $('#paisesTabla');  /*<--- Es el nombre que le hemos dado a la tabla en HTML */
    var $tableConfig = datatable_productoConfig; /*<--- Es el nombre que le hemos dado a la declaración de la definicion de la tabla */
    //var $columSearch = 3; /* <-- Es la columna en la cual al hacer click el valor se colocará en la zona de search y se buscará */
    var $tableBody = $('#paisesTabla tbody'); /*<--- Es el nombre que le hemos dado al cuerpo de la tabla en HTML */
    /* en el tableBody solo cambiar el nombre de la tabla que encontraremos en HTML*/
    var $columnFilterInputs = $('#paisesTabla tfoot input'); /*<--- Es el nombre que le hemos dado a los inputs de los pies de la tabla en HTML */
    /* en el $columnFilterInputs solo cambiar el nombre de la tabla que encontraremos en HTML*/

    //ejemplo -- var table_e = $('#employees-table').DataTable(datatable_employeeConfig);
    var table_e = $table.DataTable($tableConfig);

    /************************************/
    //   FIN ZONA DE DEFINICIONES      //
    /**********************************/

    ////////////////////////////////////////////
    //   INICIO ZONA FUNCIONES DE APOYO      //
    //////////////////////////////////////////
    //Funcion para dar mostrar mas -- es en boton de +
    function format(d) {
        // Obtener el número de columnas de la tabla
        let textoEstadoPais, estiloEstadoPais
        switch (d.estadoProducto) {
            case 1:
                textoEstadoPais = "Nuevo";
                estiloEstadoPais = "background-color: green; color: white";
                break;
            case 2:
                textoEstadoPais = "Algo Usado";
                estiloEstadoPais = "background-color: orange; color: white";
                break;
            case 3:
                textoEstadoPais = "Segunda mano";
                estiloEstadoPais = "background-color: gray; color: white";
                break;
        }


        //Estilo 1   
        let tablaHTML = `
  <table class="table table-striped">
      <thead>
      </thead>
      <tbody>
          <tr>
              <td>Nombre país: ${d.descrPaises}</td>  <!-- Mostrando nombre del país -->
          </tr>
          <tr>
              <td>Estado país: ${d.est}</td>  <!-- Mostrando estado del país -->
          </tr>
      </tbody>
  </table>
`;
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


    ////////////////////////////////////////////
    //   INICIO ZONA LANZAMIENTO MODAL       //
    //////////////////////////////////////////
    $(document).on('click', '.ver-detalle', function () {
        let idpaises = $(this).data('idpaises');
        let descrPaises = $(this).data('descrPaises');
        let fech_crea = formatoFechaEuropeo($(this).data('fech_crea'));
        let fech_modi = formatoFechaEuropeo($(this).data('fech_modi'));
        let fech_elim = formatoFechaEuropeo($(this).data('fech_elim'));
        let est = $(this).data('est') == 1 ? 'Activo' : 'Desactivado'; // Cambiar el valor de est por Activo o Desactivado

        //    console.log('prod_nom', prod_nom);
        //    console.log('prod_id', prod_id);

        // Insertar los datos en el modal
        $('#idpaises').text(idpaises);
        $('#descrPaises').text(descrPaises);
        $('#fech_crea').text(fech_crea);
        $('#fech_modi').text(fech_modi);
        $('#fech_elim').text(fech_elim);
        $('#est').text(est);


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
        $('#modalMostrarPais').addClass('effect-scale');
        $('#modalMostrarPais').modal('show');
    });


    $('#modalMostrarPais').on('hidden.bs.modal', function () {
        $('#idpaises').text('');
        $('#descrPaises').text('');
        $('#fech_crea').text('');
        $('#fech_modi').text('');
        $('#fech_elim').text('');
        $('#est').text('');

    });
    ////////////////////////////////////////////
    //   FIN ZONA LANZAMIENTO MODAL          //
    //////////////////////////////////////////


    /////////////////////////////////////
    //   INICIO ZONA DELETE PRODUCTO  //
    ///////////////////////////////////
    function desacPais(id) {
        swal.fire({
            title: 'Desactivar',
            text: `¿Desea desactivar el pais con ID ${id}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("../../controller/pais.php?op=eliminar", { prod_id: id }, function (data) { // Cambiado a prod_id

                    $table.DataTable().ajax.reload();

                    swal.fire(
                        'Desactivado',
                        'El pais ha sido desactivado',
                        'success'
                    )
                });
            }
        })
    }


    // CAPTURAR EL CLICK EN EL BOTÓN DE BORRAR
    $(document).on('click', '.desacPais', function (event) {
        event.preventDefault();
        let id = $(this).data('idpaises'); // Cambiado de data('id') a data('prod_id')
        desacPais(id);
    });
    ////////////////////////////////////
    //   FIN ZONA DELETE PRODUCTO    //
    //////////////////////////////////

    ///////////////////////////////////////
    //   INICIO ZONA ACTIVAR PRODUCTO  //
    /////////////////////////////////////
    function activarPais(id) {
        swal.fire({
            title: 'Activar',
            text: `¿Desea activar el pais con ID ${id}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("../../controller/pais.php?op=activar", { idpaises: id }, function (data) {

                    $table.DataTable().ajax.reload();

                    swal.fire(
                        'Activado',
                        'El pais ha sido activado',
                        'success'
                    )
                });
            }
        })
    }


    // CAPTURAR EL CLICK EN EL BOTÓN DE ACTIVAR
    $(document).on('click', '.activarPais', function (event) {
        event.preventDefault();
        let id = $(this).data('idpaises'); // Cambiado de data('id') a data('prod_id')
        activarPais(id);
    });
    ////////////////////////////////////
    //   FIN ZONA ACTIVAR PRODUCTO    //
    //////////////////////////////////



    ///////////////////////////////////////
    //      INICIO ZONA NUEVO           //
    /////////////////////////////////////
    // CAPTURAR EL CLICK EN EL BOTÓN DE NUEVO
    $(document).on('click', '#btnnuevo', function (event) {
        event.preventDefault();
        $('#tituloPais').text('Nuevo registro');

        // $('#modalMantenimiento .modal-body #prod_id').focus();

        $('#modalMantenimiento').modal('show');

        $('#modalMantenimiento').on('shown.bs.modal', function () {
            $('#modalMantenimiento .modal-body #descrPaises').focus();
        });

        console.log('Modal mostrado');
    });

    // CAPTURAR EL CLICK EN EL BOTÓN DE SALVAR
    $(document).on('click', '#btnsalvar', function (event) {
        event.preventDefault();

        // Recoger el valor de cada input del formulario
        var descrPaises = $('#formPais').find('input[name="descrPaises"]').val().trim();
        var idpaises = $('#formProducto').find('input[name="idpaises"]').val();
        var estadoPais = $("input[name='est']:checked").val();  // Selecciona el radio button marcado

        //console.log('Valor de prod_nom:', prodNom);
        //console.log('Valor de prod_id:', prodId);

        if (descrPaises.length === 0) {
            toastr.error(`El campo nombre del pais está vacío.`, 'Error de Validación');
            return; // Salir de la función si hay un campo vacío
        }

        // Serializar los datos del formulario lo utilizaremos cuando no tengamos que
        // cambiar nada de los datos que se envían al servidor
        // var formData = $('#formProducto').serialize();
        // console.log('Datos del formulario serializados:', formData);

        var datosFormulario = {
            idpaises: idpaises,
            descrPaises: descrPaises,
            estadoPais: estadoPais
        };

        //console.log(datosFormulario.prod_nom);

        var formData = new FormData();

        // Agregar los datos al objeto FormData
        for (var key in datosFormulario) {
            formData.append(key, datosFormulario[key]);
        }

        //console.log('formData:', formData);

        $.ajax({
            url: "../../controller/pais.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            processData: false, // Evitar que jQuery procese los datos
            contentType: false, // Evitar que jQuery establezca el tipo de contenido
            success: function (data) {
                $('#modalMantenimiento').modal('hide');
                $table.DataTable().ajax.reload();
                $("#formPais")[0].reset();
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
                    'No se pudo guardar el producto',
                    'error'
                );
            }
        });
    });
    ///////////////////////////////////////
    //      FIN ZONA NUEVO           //
    /////////////////////////////////////
    ///////////////////////////////////////
    //      INICIO ZONA EDITAR           //
    /////////////////////////////////////
    // CAPTURAR EL CLICK EN EL BOTÓN DE EDITAR
    $(document).on('click', '.editarPais', function (event) {
        event.preventDefault();
        let id = $(this).data('idpaises');
        //console.log('Antes del click', id);
        $.post("../../controller/pais.php?op=mostrar", { idpaises: id }, function (data) {
            //console.log('Dentro del click', id);
            //console.log('data:', data);

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

                $('#tituloPais').text('Edición registro');
                $('#modalMantenimiento').modal('show');

                $('#modalMantenimiento .modal-body #idpaises').val(data.idpaises);
                $('#modalMantenimiento .modal-body #descrPaises').val(data.descrPaises);

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