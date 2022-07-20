<div class="modal fade" id="editarterreno"  role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!!Form::open(["route"=>"terrenos.update","method"=>"put","role"=>"form","id"=>"formeditterreno"])!!}
      <input type="hidden" id="id_editm" name="edit_id" value="0">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
     <h4 class="modal-title" id="myModalLabel2">Editar terreno</h4>
      </div>
      <div class="modal-body">
        <div class="row">
              <div class="col-md-12">
                <form action="">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Manzano</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <input type="text" id="manzano_edit" name="manzano" class="form-control">
                      <span class="fa fa-columns form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Nro:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <input type="text" class="form-control" id="nro_lote_edit" name="nro_lote">
                      <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Categoria:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <select name="categoria_id" id="categoria_id_edit" class="form-control">
                        @foreach($categoria as $cate)
                        <option value="{{$cate->id}}" style="background: {{$cate->color}}">{{$cate->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Superficie:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <input type="text" class="form-control" id="superficie_edit" name="superficie">
                      <span class="fa fa-flag form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Precio:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <input type="text" class="form-control" name="precio" id="precio_edit">
                      <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="subiredicion()" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>  
      </div>

    {!!Form::close()!!}
    </div>
  </div>
</div>