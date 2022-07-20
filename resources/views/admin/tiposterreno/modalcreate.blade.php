<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      {!!Form::open(["route"=>"tiposterreno.store","method"=>"post","role"=>"form"])!!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
     <h4 class="modal-title" id="myModalLabel2">Nuevo Tipo de Proyecto</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Color:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="input-group demo2">
                  <input type="text" name="color" value="#000000" class="form-control" />
                  <span class="input-group-addon"><i></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Icono: </label>
              <div class="col-md-1 col-sm-1 col-xs-12" >
                <input type="hidden" name="icono" id="input_icono" value="fa fa-home">
                <i class="fa fa-home" id="i_icono" style="font-size: 26px;display: block;"></i>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="linea">
              @include("admin.tiposterreno.botones")  
                </div>
              </div>
          </div>
          <br>
          <div class="col-md-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Proyecto: </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="nombre" required  placeholder="Nombre de Tipo de Proyecto">
                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
              </div>
          </div>
          <br>
          <div class="col-md-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo: </label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <select name="tabla" id="tablac" class="form-control" style="width: 100%">
                  <option value="categorias">Categorias</option>
                  <option value="referencias">Referencias</option>
                </select>
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Precio x M <sup>2</sup>: </label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" class="form-control" id="precio" required name="precio"  placeholder="0.0">
                <span class="fa fa-usd form-control-feedback right" aria-hidden="true"></span>
              </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div>
    {!!Form::close()!!}
    </div>
  </div>
</div>