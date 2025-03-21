<!-- // File: mantenimientoPais.php -->
<div class="modal" id="modalMantenimiento" tabindex="-1" aria-labelledby="modalMostrarPaisLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Pais</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <h4 class="lh-3 mg-b-20" id="tituloPais"><a href="" class="tx-inverse hover-primary">Mantenimiento de países</a></h4>
                <p class="mg-b-5">
                <form id="formPais">
                    <input type="hidden" name="idpaises" id="idpaises">
                    <!-- nombre -->
                    <div class="wd-300">
                        <div class="d-flex mg-b-30 ">
                            <div class="form-group mg-b-0 ">
                                <label for="descrPaises" class="form-label">Nombre: <span class="tx-danger">*</span></label>
                                <input type="text" class="form-control wd-450" name="descrPaises" id="descrPaises" maxlength="90" placeholder="Nombre Elemento" autofocus>
                                <div class="invalid-feedback small-invalid-feedback">Solo letras y espacios (mínimo 3
                                    caracteres y máximo de 40)</div>
                            </div><!--form-group -->
                        </div><!-- d-flex -->
                    </div> <!-- wd-300 -->

                     <!-- estado del pais - estadoPais -->
                    <!-- Es una radio button -->
                    <!-- Para poner un borde ---- bd bd-primary bd-4 -->
                    <div class="wd-450 ">
                        <span>Estado articulo:</span>
                        <div class="d-flex mg-t-8 ">
                            <div class="form-group mg-b-0 ">
                                <label class="rdiobox">
                                    <input name="est" id="est" type="radio" value=1 checked>
                                    <!-- <input name="estado" type="radio" value=1 > -->
                                    <span>Nuevo</span>
                                </label>
                                <label class="rdiobox">
                                    <input name="est" id="est" type="radio" value=2>
                                    <span>Usado</span>
                                </label>
                                <label class="rdiobox">
                                    <input name="est" id="est" type="radio" value=3>
                                    <span>Segunda mano</span>
                                </label>

                                <div class="invalid-feedback small-invalid-feedback">Solo letras y espacios (mínimo 3
                                    caracteres y máximo de 40)</div>
                            </div><!--form-group -->
                        </div><!-- d-flex -->
                    </div> <!-- wd-450 -->

                </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="button" name="action" id="btnsalvar" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Salvar</button>
                <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->