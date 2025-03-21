<!DOCTYPE html>
<html lang="es">

<!-- ---------------------- -->
<!--      MainHead.php      -->
<!-- ---------------------- -->

<head>
    <?php include_once('../../config/template/mainHead.php') ?>
</head>

<!-- ---------------------- -->
<!--  END MainHead.php      -->
<!-- ---------------------- -->

<body>

    <!-- ########## START: LEFT PANEL ########## -->

    <!-- ---------------------- -->
    <!--      MainLogo.php      -->
    <!-- ---------------------- -->

    <?php require_once('../../config/template/mainLogo.php') ?>

    <!-- ---------------------- -->
    <!--   END MainLogo.php     -->
    <!-- ---------------------- -->

    <div class="br-sideleft sideleft-scrollbar">
        <!-- ---------------------- -->
        <!--   MainSideBar.php      -->
        <!-- ---------------------- -->
        <?php require_once('../../config/template/mainSidebar.php') ?>

        <?php require_once('../../config/template/mainSidebarDown.php') ?>
        <!-- ---------------------- -->
        <!-- END MainSideBar.php    -->
        <!-- ---------------------- -->
        <br>
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->


    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <?php include_once('../../config/template/mainHeader.php') ?>
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->


    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="br-sideright">
        <!-- ---------------------- -->
        <!--   mainRightPanel.php      -->
        <!-- ---------------------- -->
        <?php include_once('../../config/template/mainRightPanel.php') ?>
        <!-- ------------------------- -->
        <!-- END MainRightPanel.php    -->
        <!-- ------------------------- -->

    </div><!-- br-sideright -->
    <!-- ########## END: RIGHT PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="index.html">Dashboard</a>
                <span class="breadcrumb-item active">Mantenimiento Productos</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagetitle">
            <i class="icon icon ion-ios-bookmarks-outline"></i>
            <div>
                <h4>Mantenimiento de productos</h4>
                <p class="mg-b-0">Tabla básica para el mantenimiento de los productos</p>
            </div>
        </div><!-- d-flex -->

        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <!-- <h6 class="br-section-label">Basic Responsive DataTable</h6>
                <p class="br-section-text">Searching, ordering and paging goodness will be immediately added to the
                    table, as
                    shown in this example.</p> -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-oblong btn-outline-primary mr-5" id="btnnuevo" style="width: 20%;">Nuevo</button>
                </div>

                <!-- Botones de radio para filtrar -->
                <div class="d-flex justify-content-start mb-3">
                    <div class="radio-container" style="margin-left: 20px; border: 1px solid #ccc; padding: 5px; margin-left:70px;">
                        <div class="form-check form-check-inline">
                            <input class=" form-check-input" type="radio" name="filterStatus" id="filterAll" value="all" checked>
                            <label class="form-check-label" for="filterAll">Todos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filterStatus" id="filterActive" value="1">
                            <label class="form-check-label" for="filterActive">Activado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filterStatus" id="filterInactive" value="0">
                            <label class="form-check-label" for="filterInactive">Desactivado</label>
                        </div>

                    </div>


                    <div class="col-7 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div>
                            <input id="dateCreateFilter" type="text" class="form-control fc-datepicker" placeholder="dd-mm-aaaa" readonly>
                        </div><!-- input-group -->
                        <div class="tx-8 tx-info" id="borrarFechaFiltro">Borrar fecha</div>
                    </div><!-- col-4 -->

                </div>

                <!-- Para mostrar en el caso de un filtro activo -->
                <div class="alert alert-warning" role="alert" id="filter-alert">
                    <i class="bi bi-funnel"></i> Hay un filtro activo.
                    <button type="button" class="btn btn-primary" id="clear-filter">Limpiar</button>
                </div>

                <div class="table-wrapper" class="table, order-colum, hover, row-border, stripe responsive">
                    <table id="productos_data" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Creación</th>
                                <th>Modificación</th>
                                <th>Eliminación</th>
                                <th>Estado</th>
                                <th>Oferta</th>
                                <th>Estado Producto</th>
                                <th>id paises</th>
                                <th>Descripción País</th>
                                <th>Detalles</th>
                                <th>Act./Desac.</th>
                                <th>Edit.</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- Botón de MAS -->
                                <th><input type="text" placeholder="NO Buscar " class="d-none" /></th>
                                <th><input type="text" placeholder="Buscar ID" class="d-none" /></th>
                                <th><input type="text" placeholder="Buscar Descripción" /></th>
                                <!-- A pesar de ser una fecha debemos colocarle tipo = text no funciona con fechas -->
                                <th><input type="text" placeholder="dd-mm-yyyy hh:mm:ss" /></th>
                                <!-- A pesar de ser una fecha debemos colocarle tipo = text no funciona con fechas -->
                                <th><input type="text" placeholder="dd-mm-yyyy hh:mm:ss" /></th>
                                <!-- A pesar de ser una fecha debemos colocarle tipo = text no funciona con fechas -->
                                <th><input type="text" placeholder="dd-mm-yyyy hh:mm:ss" /></th>
                                <!-- Estado Activo o inactivo -->
                                <th><input type="text" placeholder="1=Act.,0 =Desac." /></th>

                                <!-- oferta -->
                                <th><input type="text" placeholder="NO BUSCAR" class="d-none" /></th>

                                <!-- Estado producto -->
                                <th><input type="text" placeholder="NO BUSCAR" class="d-none" /></th>

                                <!-- id paises -->
                                <th><input type="text" placeholder="NO BUSCAR" class="d-none" /></th>

                                <!-- descr paises -->
                                <th><input type="text" placeholder="NO BUSCAR" class="d-none" /></th>

                                <!-- Boton de DETALLES -->
                                <th><input type="text" placeholder="NO Buscar " class="d-none" /></th>
                                <!-- Botón de ACTIVAR DESACTIVAR -->
                                <th><input type="text" placeholder="NO Buscar " class="d-none" /></th>
                                <!-- Botón de MODIFICAR -->
                                <th><input type="text" placeholder="NO Buscar " class="d-none" /></th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

        <!-- ----------------------- -->
        <!--     mainFooter.php      -->
        <!-- ----------------------- -->
        <footer class="br-footer">
            <?php include_once('../../config/template/mainFooter.php') ?>
        </footer>
        <!-- ------------------------- -->
        <!--   END mainFooter.php      -->
        <!-- ------------------------- -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- *********************************** -->
    <!-- MODAL QUE SE DISPARA DESDE EL BOTON -->
    <!--        DE LA PROPIA TABLA           -->
    <!--        columDef                     -->
    <!-- *********************************** -->

    <?php include_once('detalleProductoBra.php') ?>

    <!-- *********************************** -->
    <!--                FIN                  -->
    <!-- MODAL QUE SE DISPARA DESDE EL BOTON -->
    <!--        DE LA PROPIA TABLA           -->
    <!--             columDef                -->
    <!-- *********************************** -->


    <!-- *********************************** -->
    <!-- MODAL QUE SE DISPARA DESDE EL BOTON -->
    <!--             NUEVO                   -->
    <!-- *********************************** -->

    <?php include_once('mantenimientoProducto.php') ?>


    <!-- *********************************** -->
    <!--                FIN                  -->
    <!-- MODAL QUE SE DISPARA DESDE EL BOTON -->
    <!--               NUEVO                 -->
    <!-- *********************************** -->

    <!-- ----------------------- -->
    <!--       mainJs.php        -->
    <!-- ----------------------- -->
    <?php include_once('../../config/template/mainJs.php') ?>

    <script src="../../public/js/tooltip-colored.js"></script>
    <script src="../../public/js/popover-colored.js"></script>
    <!-- ------------------------- -->
    <!--     END mainJs.php        -->
    <!-- ------------------------- -->
    <script type="text/javascript" src="mntproducto.js"></script>

</body>

</html>