<div class="box-body row">
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="cash">Entrada Efectivo</label>
            <input type="number" id="cash" name="cash" value="{{ old('cash', $cashOutflow->cash ?? '') }}" class="form-control"
                placeholder="Efectivo" pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="reason">Razon</label>
            <input type="text" id="reason" name="reason" value="{{ old('reason', $cashInflow->reason ?? '') }}" class="form-control"
                placeholder="Motivo">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="form-group" id="save">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Aceptar</button>
            <a href="{{url('cashInflow')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
