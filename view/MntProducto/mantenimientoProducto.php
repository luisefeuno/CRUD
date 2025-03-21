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
                        <div class="col-12 col-lg-3">
                            <label for="prod_nom" class="form-label">Nombre: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="text" class="form-control wd-500" name="prod_nom" id="prod_nom" maxlength="90" placeholder="Nombre Elemento" autofocus>
                            <div class="invalid-feedback small-invalid-feedback">Solo letras y espacios (mínimo 3
                                caracteres y máximo de 40)</div>
                        </div><!-- col-9 -->
                    </div><!-- row -->


                    <!-- teléfono -->
                    <!-- No se graba en la base de datos -->
                    <!-- Solo se pone aquí para trabajar la validación de campos -->
                    <div class="row no-gutters  mg-t-20">
                        <div class="col-12 col-lg-3">
                            <label for="prod_telefono" class="form-label">Teléfono: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="text" class="form-control wd-300" name="prod_telefono" id="prod_telefono" maxlength="14" placeholder="Teléfono">
                            <div class="invalid-feedback small-invalid-feedback">Solo números (máximo 14 pos)</div>
                        </div><!-- col-9 -->
                    </div><!-- row -->



                    <!-- email -->
                    <!-- No se graba en la base de datos -->
                    <!-- Solo se pone aquí para trabajar la validación de campos -->
                    <div class="row no-gutters  mg-t-20">
                        <div class="col-12 col-lg-3">
                            <label for="prod_email" class="form-label">Email: <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="text" class="form-control wd-300" name="prod_email" id="prod_email" maxlength="30" placeholder="Email">
                            <div class="invalid-feedback small-invalid-feedback">Formato de email valido (sin espacios)</div>
                        </div><!-- col-9 -->
                    </div><!-- row -->


                    <!-- estado del producto - estadoProducto -->
                    <!-- Es una radio button -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="prod_nom" class="form-label">Estado: </label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <fieldset>
                                <!-- <legend>Estado del producto</legend> -->
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
                            </fieldset>


                        </div><!-- col-9 -->
                    </div><!-- row -->

                    <!-- oferta - oferta -->
                    <!-- Es un checkbox -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="oferta" class="form-label">Oferta: </label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <input type="checkbox" name="oferta" id="oferta">
                            <span>Oferta</span>
                        </div><!-- col-9 -->
                    </div><!-- row -->

                    <!-- Vamos con los paises -->
                    <!-- Hacer un select -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="row no-gutters mg-t-20">
                        <div class="col-5 col-sm-3">
                            <label for="oferta" class="form-label">Pais (op-2): <span class="tx-danger">*</span></label>
                        </div><!-- col-4 -->
                        <div class="col-7 col-sm-9">
                            <!-- <select class="form-control select2-show-search" name="paisesId" id="paisesId"> -->
                            <select class=" form-control select2-show-search" name="paises_sel_id" id="paises_sel_id">
                            </select>
                            <div class="invalid-feedback small-invalid-feedback">Seleccione un país</div>
                        </div><!-- col-4 -->
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