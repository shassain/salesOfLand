<style>
	select{
 	-moz-appearance:none;
	-webkit-appearance:none;
	-ms-appearance:none;
	-o-appearance:none;
	appearance:none;
	cursor:pointer;
}
</style>
<div class="row">
		<div class="form-group">
	      <label class="control-label col-md-3 col-sm-3 col-xs-3">Tasa de Interes:</label>
	      <div class="col-md-3 col-sm-3 col-xs-3">
	        <input type="text" class="form-control" id="input_tasa">
	        <span class="fa fa-line-chart form-control-feedback right" aria-hidden="true"></span>
	      </div>
	      <label class="control-label col-md-3 col-sm-3 col-xs-3">Cantidad de Cuotas:</label>
	      <div class="col-md-3 col-sm-3 col-xs-3">
	        <input type="text" class="form-control" id="input_cuotas">
	        <span class="fa fa-database form-control-feedback right" aria-hidden="true"></span>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-md-3 col-sm-3 col-xs-3">Tipo de tasa:</label>
	      <div class="col-md-3 col-sm-3 col-xs-3">
	        <select id="select_tasa_tipo" class="form-control" style="appearance:none;">
	            <option value="mensual">Mensual</option>
	            <option value="anual">Anual</option>
	        </select>
	        <span class="fa fa-toggle-down form-control-feedback right" aria-hidden="true"></span>
	      </div>
	      <label class="control-label col-md-3 col-sm-3 col-xs-3">Periodo de Pago:</label>
	      <div class="col-md-3 col-sm-3 col-xs-3">
	        <select id="select_periodo" class="form-control">
		        <option value="diario">Diario</option>
		        <option value="semanal">Semanal</option>
		        <option value="quincenal">Quincenal</option>
		        <option value="mensual" selected="">Mensual</option>
		        <option value="bimestral">Bimestral</option>
		        <option value="trimestral">Trimestral</option>
		        <option value="cuatrimestral">Cuatrimestral</option>
		        <option value="semestral">Semestral</option>
		        <option value="anual">Anual</option>
		    </select>
	        <span class="fa fa-toggle-down form-control-feedback right" aria-hidden="true"></span>
	      </div>
	    </div>
	    <div class="form-group">
	      <input type="button" value="Calcular" onclick="calcular();" class="btn btn-sm btn-success">
	    </div>




    <div class="col-md-12">
    	<table id="table-2" style="width: 100%; text-align: right; border: 1px gray solid; border-collapse: collapse">
            <caption>Tabla de amortización</caption>
                <thead><tr>
                    <th>Número</th>
                    <th>Interés</th>
                    <th>Abono al capital</th>
                    <th>Valor de la cuota</th>
                    <th>Saldo al capital</th>
                </tr>
            </thead>
            <tbody id="tbody_1"></tbody>
        </table>
    </div>
    
</div>

<script type="text/javascript">
var DIARIO = "diario";
var SEMANAL = "semanal";
var QUINCENAL = "quincenal";
var MENSUAL = "mensual";
var BIMESTRAL = "bimestral";
var TRIMESTRAL = "trimestral";
var CUATRIMESTRAL = "cuatrimestral";
var SEMESTRAL = "semestral";
var ANUAL = "anual";

function getTasa(tasa, tasa_tipo, periodo) {
    if (tasa_tipo == ANUAL) { tasa = tasa / 12 }
    tasa = tasa / 100.0
    if (periodo == DIARIO) { tasa = tasa / 30.4167 };
    if (periodo == SEMANAL) { tasa = tasa / 4.34524 };
    if (periodo == QUINCENAL) { tasa = tasa / 2 };
    if (periodo == MENSUAL) { };
    if (periodo == BIMESTRAL) { tasa = tasa * 2 };
    if (periodo == TRIMESTRAL) { tasa = tasa * 3 };
    if (periodo == CUATRIMESTRAL) { tasa = tasa * 4 };
    if (periodo == SEMESTRAL) { tasa = tasa * 6 };
    if (periodo == ANUAL) { tasa = tasa * 12 };
    return tasa;
}

function getValorDeCuotaFija(monto, tasa, cuotas, periodo, tasa_tipo) {
  if(tasa==0){
    tasa=0;
    valor = monto / cuotas;
    return valor.toFixed(2);
  }else{
    tasa = getTasa(tasa, tasa_tipo, periodo);
    valor = monto *( (tasa * Math.pow(1 + tasa, cuotas)) / (Math.pow(1 + tasa, cuotas) - 1) );
    return valor.toFixed(2);
  } 
    
    
}

function getAmortizacion(monto, tasa, cuotas, periodo, tasa_tipo) {
    var valor_de_cuota = getValorDeCuotaFija(monto, tasa, cuotas, periodo, tasa_tipo);
    var saldo_al_capital = monto;
    var items = new Array();

    for (i=0; i < cuotas; i++) {
        interes = saldo_al_capital * getTasa(tasa, tasa_tipo, periodo);
        abono_al_capital = valor_de_cuota - interes;
        saldo_al_capital -= abono_al_capital;
        numero = i + 1;
        
        interes = interes.toFixed(2);
        abono_al_capital = abono_al_capital.toFixed(2);
        saldo_al_capital = saldo_al_capital.toFixed(2);

        item = [numero, interes, abono_al_capital, valor_de_cuota, saldo_al_capital];
        items.push(item);
    }
    return items;
}


function setMoneda(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num)) num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10) cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + '$' + num + ((cents == "00") ? '' : '.' + cents));
}





        function calcular() {
            var monto = document.getElementById("precio_venta").value;
            var cuotas = document.getElementById("input_cuotas").value;
            var tasa = document.getElementById("input_tasa").value;
            if (!monto) {
                alert('Indique el monto');
                return;
            }
            if (!cuotas) {
                alert('Indique las cuotas');
                return;
            }
           
            if (parseInt(cuotas) < 1) {
                alert('Las cuotas deben ser de 1 en adelante');
                return;
            }
            var select_periodo = document.getElementById("select_periodo");
            periodo = select_periodo.options[select_periodo.selectedIndex].value;
            var select_tasa_tipo = document.getElementById("select_tasa_tipo");
            tasa_tipo = select_tasa_tipo.options[select_tasa_tipo.selectedIndex].value;
            var items = getAmortizacion(monto, tasa, cuotas, periodo, tasa_tipo);
            var tbody = document.getElementById("tbody_1");
            tbody.innerHTML = "";
  

if (parseInt(cuotas) > 3000) { alert("Ha indicado una cantidad excesiva de cuotas, porfavor reduzcala a menos de 3000"); return; }



            for (i = 0; i < items.length; i++) {
                item = items[i];
                tr = document.createElement("tr");
                for (e = 0; e < item.length; e++) {
                    value = item[e];
                    if (e > 0) { value = setMoneda(value); }
                    td = document.createElement("td");
                    textCell = document.createTextNode(value);
                    td.appendChild(textCell);
                    tr.appendChild(td);
                }
                tbody.appendChild(tr);
            }
            var div1 = document.getElementById("div-valor-cuota");

            valor = setMoneda(items[0][3]);
            div1.innerHTML = valor;
            var msg = "";
            if (periodo == "diario") { 
    msg = "Usted estará pagando " + valor + ", todos los dias durante " + items.length + " dias.";
   }
   if (periodo == "semanal") {
    msg = "Usted pagará " + valor + ", semanalmente durante " + items.length + " semanas.";
   }
   if (periodo == "mensual") {
    msg = "Usted pagará " + valor + ", mensualmente durante " + items.length + " meses.";
   }
   if (periodo == "quincenal") {
    msg = "Usted pagará " + valor + ", de manera quincenal por un periodo de " + items.length + " quincenas.";
   }
   if (periodo == "bimestral") {
    msg = "Usted pagará " + valor + ", cada 2 meses durante un periodo de " + items.length + " bimestres.";
   }
   if (periodo == "trimestral") {
    msg = "Usted va a pagar " + valor + ", cada 3 meses durante " + items.length + " trimestres.";
   }
   if (periodo == "cuatrimestral") {
    msg = "Usted pagará " + valor + ", cada cuatrimestre (4 meses) por un periodo de " + items.length + " cuatrimestres.";
   }
   if (periodo == "semestral") {
    msg = "Usted pagará " + valor + ", cada 6 meses durante " + items.length + " semestres";
   }
   if (periodo == "anual") {
    msg = "Usted pagará " + valor + ", anualmente por un periodo de " + items.length + " años";
   }
   var div2 = document.getElementById("div-comentario");
   div2.innerHTML = msg;
        }
        
</script>