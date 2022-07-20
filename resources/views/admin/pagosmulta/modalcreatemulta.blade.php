<div class="modal fade" id="modal_multas" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      {!!Form::open(["route"=>"pagosmulta.store","method"=>"post","role"=>"form"])!!}
      <input type="hidden" name="tipo" value="multa">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
     <h4 class="modal-title" id="myModalLabel2">Multas</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre de la Multa:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="nombre" required value="" class="form-control" placeholder="Multa Proyecto A" />
                  <span class="fa fa-legal form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label col-md-6 col-sm-6 col-xs-12">Se considera una multa despues de:</label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="dias" required id="diasm" value="1" class="form-control" />
                  <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
              <label class="control-label col-md-3 col-sm-3 col-xs-12"> dias de atraso.</label>
            </div>
          </div>
          <br>
          <div class="col-md-12">
              <label class="control-label col-md-4 col-sm-4 col-xs-12">El monto por atraso es: </label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" class="form-control" id="montom" required name="monto"  placeholder="0.0">
                <span class="fa fa-usd form-control-feedback right" aria-hidden="true"></span>
              </div>
          </div>
          <br>
          <br>
          <div class="col-md-12">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">El monto anterior es un porcentaje?: </label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <select name="pociento" id="pocientom" class="form-control">
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
              </div>
          </div>
          <div class="col-md-12">
              <label class="control-label col-md-7 col-sm-7 col-xs-12">El descuento se Multiplica por dia de atraso?: </label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <select name="pordia" id="pordiam" class="form-control">
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
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
