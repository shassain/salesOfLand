<input type="hidden" id="id_img" name="id_img" value="0">
  <div class="row">
    <div class="col-md-4">Rotar:</div>
    <div class="col-md-8">
      <img src="{{asset("logots/rotar.png")}}" id="spin-ball" width="30%" height="30%" style="transform: rotate({{($existe->rotate*3.14159)/180}}rad);">
      <input id="rotate" name="rotate" class="option form-control input-sm" type="number" value="{{$existe->rotate}}" step="0.1" />
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">Opacidad:</div>
    <div class="col-md-8"><input id="opacity" name="opacity" class="option input-sm" type="range" value="{{$existe->opacity}}" min="0" max="1" step="0.1" /></div>
  </div>
  <div class="row">
    <div class="col-md-4">Centro: </div>
    <div class="col-md-4"><input id ="x" name="posx" class="option form-control input-sm" type="number" value="{{$existe->posx}}" /></div>
    <div class="col-md-4"><input id ="y" name="posy" class="option form-control input-sm" type="number" value="{{$proyecto->posy}}" /></div>
  </div>
  <div class="row">
    <div class="col-md-4">Escala:</div>
    <div class="col-md-4"><input id ="w" name="w" class="option form-control input-sm" type="number" step="0.001" value="{{$existe->w}}" /></div>
    <div class="col-md-4"><input id ="h" name="h" class="option form-control input-sm" type="number" step="0.001" value ="{{$existe->h}}" /></div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-4">Cortar:</div>
    <div class="col-md-4"><input id ="xmin" name="xminimo" class="option form-control input-sm" type="number" value="{{$existe->xminimo}}" step="1" /></div>
    <div class="col-md-4"><input id ="ymin" name="yminimo" class="option form-control input-sm" type="number" value ="{{$existe->yminimo}}" step="1" /></div>
    <div class="col-md-4"></div>
    <div class="col-md-4"><input id ="xmax" name="xmaximo" class="option form-control input-sm" type="number" value="{{$existe->xmaximo}}" step="1" /></div>
    <div class="col-md-4"><input id ="ymax" name="ymaximo" class="option form-control input-sm" type="number" value ="{{$existe->ymaximo}}" step="1" /></div>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <button type="submit" id="subirform" disabled class="btn btn-success"><i class="fa fa-save"></i>Guardar</button>
    </div>
    <div class="col-md-4">
      <a class="btn btn-danger" href="{{URL::previous()}}"><i class="fa fa-close"></i>Cancelar</a>
    </div>
  </div>