
<div id="participante" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Relacionar persona</h4>
      </div>
      <form id="form-create">
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-4">
                <label>NUMERO IDENTIFICACION: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-cc" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" name="dc" id="dc">
                    <input type="hidden" name="id">
                </div>
                <small class="form-text text-muted">identificacion participante del proceso</small>
            </div>
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <label>NOMBRE O RAZON SOCIAL: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="nom">
                </div>
                <small class="form-text text-muted">Nombre completo de el participante</small>
            </div>
            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-4">
                <label>PERSONA LEGAL: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                    <select name="persona" class="form-control" id="persona">
                        <option value="NATURAL">NATURAL</option>
                        <option value="JURIDICA">JURIDICA</option>
                    </select>
                </div>
                <small class="form-text text-muted">selecciona si el participante es persona juridica o natural</small>
            </div>
        </div>
             

        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <label>CORREO ELECTRONICO: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="email">
                </div>
                <small class="form-text text-muted">correo electronico del participante a ingresar</small>
            </div>
            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-4">
                <label>DIRECCION: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="direccion">
                </div>
                <small class="form-text text-muted">Direccion de residencia del participante</small>
            </div>
            <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-4">
                <label>TELEFONO: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="telefono">
                </div>
                <small class="form-text text-muted">telefono  del participante</small>
            </div>
        </div>
        <div class="row">
            <div id="representante" class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4 ocultar">
                <label>Representante Legal: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="representante">
                </div>
                <small class="form-text text-muted">Nombre Completo Representante Legal</small>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


         
             
             
           

            <div class="row">
                <div class="form-group">
                      
                    						  	
                </div>
            </div>
        </form>