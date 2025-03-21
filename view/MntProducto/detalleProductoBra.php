    <!-- this modal is static modal for presentation purpose. -->
    <!-- class .d-block annd .pos-relative in .modal is for demo only -->
    <!-- <div class="modal d-block pos-static"> -->
    <div class="modal" id="modalMostrarProductoBra" tabindex="-1" aria-labelledby="modalMostrarProductoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Producto</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Mantenimiento de productos</a></h4>
                    <p class="mg-b-5">

                    <p><strong>ID:</strong> <span id="prod_id"></span></p>
                    <p><strong>Nombre:</strong> <span id="prod_nom"></span></p>
                    <p><strong>Fecha creación</strong> <span id="fech_crea"></span></p>
                    <p><strong>Fecha modificación:</strong> <span id="fech_modi"></span></p>
                    <p><strong>Fecha eliminación:</strong> <span id="fech_elim"></span></p>
                    <p><strong>Estado:</strong> <span id="est"></span></p>
                    <p><strong>Oferta:</strong> <span id="oferta"></span></p>
                    <p><strong>Estado Producto:</strong> <span id="estadoproducto"></span></p>
                    <p><strong>PaisesId:</strong> <span id="paisesid"></span></p>
                    <p><strong>Descr Pais:</strong> <span id="descrPais"></span></p>
                    </p>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button> -->
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->