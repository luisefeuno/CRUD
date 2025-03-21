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
                <h4>Mantenimiento de paises</h4>
                <p class="mg-b-0">Tabla básica para el mantenimiento de los paises</p>
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

                    <!-- Campo de fecha para filtrar -->
                    <div class="form-check form-check-inline" style="margin-left : 20px;">
                        <input type="text" id="filterDate" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" placeholder=" Fecha de Creación">
                    </div>


                </div>

                <!-- Para mostrar en el caso de un filtro activo -->
                <div class="alert alert-warning" role="alert" id="filter-alert">
                    <i class="bi bi-funnel"></i> Hay un filtro activo.
                    <button type="button" class="btn btn-primary" id="clear-filter">Limpiar</button>
                </div>

                <div class="table-wrapper" class="table, order-colum, hover, row-border, stripe responsive">
                    <table id="paisesTabla" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Creación</th>
                                <th>Modificación</th>
                                <th>Eliminación</th>
                                <th>Estado</th>
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
                                <!-- ID PAÍS -->
                                <th><input type="text" placeholder="Buscar ID" class="d-none" /></th>
                                <!-- NOMBRE PAÍS -->
                                <th><input type="text" placeholder="Buscar Nombre" /></th>
                                <!-- FECHA CREACION PAÍS -->
                                <th><input type="text" placeholder="dd/mm/yyyy hh:mm:ss" /></th>
                                <!-- FECHA MODIFICACION PAÍS -->                                
                                 <th><input type="text" placeholder="dd/mm/yyyy hh:mm:ss" /></th>
                                <!-- FECHA ELIMINAR PAÍS -->                                
                                <th><input type="text" placeholder="dd/mm/yyyy hh:mm:ss" /></th>
                                <!-- ESTADO ACTIVO O INACTIVO -->
                                <th><input type="text" placeholder="1=Act.,0 =Desac." /></th>
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

    <?php include_once('detallePais.php') ?>

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

    <?php include_once('mantenimientoPais.php') ?>


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
    <script type="text/javascript" src="mntpais.js"></script>

</body>

</html>