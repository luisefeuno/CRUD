<!-- // File: mantenimientoProducto.php -->
<div class="modal" id="modalMantenimiento" tabindex="-1" aria-labelledby="modalMostrarProductoLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-lg" role="document"> -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Producto</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <h4 class="lh-3 mg-b-20" id="mdltitulo"><a href="" class="tx-inverse hover-primary">Mantenimiento de productos</a></h4>
                <p class="mg-b-5">
                <form id="formProducto">
                    <!-- id -->
                    <input type="hidden" name="prod_id" id="prod_id">

                    <!-- nombre -->
                    <div class="row no-gutters">
                        <div class="col-5 col-sm-3">
                            <label for="prod_nom" class="form-label">Nombre: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="text" class="form-control wd-500" name="prod_nom" id="prod_nom" maxlength="90" placeholder="Nombre Elemento" autofocus>
                            <div class="invalid-feedback small-invalid-feedback">Solo letras y espacios (mínimo 3
                                caracteres y máximo de 40)</div>
                        </div><!-- col-9 -->
                    </div><!-- row -->

                    <!-- estado del producto - estadoProducto -->
                    <!-- Es una radio button -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="prod_nom" class="form-label">Estado: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <label class="rdiobox">
                                <input name="estado" type="radio" value=1 checked>
                                <!-- <input name="estado" type="radio" value=1 > -->
                                <span>Nuevo</span>
                            </label>
                            <label class="rdiobox">
                                <input name="estado" type="radio" value=2>
                                <span>Usado</span>
                            </label>
                            <label class="rdiobox">
                                <input name="estado" type="radio" value=3>
                                <span>Segunda mano</span>
                            </label>

                            <div class="invalid-feedback small-invalid-feedback">Solo letras y espacios (mínimo 3 caracteres y máximo de 40)</div>
                        </div><!-- col-9 -->
                    </div><!-- row -->

                    <!-- oferta - oferta -->
                    <!-- Es un checkbox -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="oferta" class="form-label">Oferta: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="checkbox" name="oferta" id="oferta">
                            <span>Oferta</span>
                        </div><!-- col-9 -->
                    </div><!-- row -->


                    <!-- Vamos con los paises -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="oferta" class="form-label">Pais: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->

                        <!-- PARA EL PAIS - 3 CAMPOS -->
                        <div class="col-7 col-sm-1">
                            <input class="form-control" placeholder="Pais" name="paisesId" id="paisesId" type="text">
                        </div>
                        <div class="col-7 col-sm-6">
                            <input class="form-control" placeholder="" name="descrPais" id="descrPais" type="text" readonly tabindex="-1">
                        </div>
                        <div class="col-7 col-sm-2">
                            <button class="btn btn-primary" type="button" id="btnbuscarpais">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div><!-- col-9 -->
            </div><!-- row -->
            </form>

            <div class="modal-footer">
                <button type="button" name="action" id="btnsalvar" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Salvar</button>
                <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- modal-body -->
    </div>
</div><!-- modal-dialog -->
</div><!-- modal -->