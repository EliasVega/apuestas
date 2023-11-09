<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="name">Loteria</label>
            <input type="text" name="name" value="{{ old('name', $lottery->name ?? '') }}" class="form-control" placeholder="Nombre Loteria">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="day">Dia</label>
        <div class="select">
            <select id="day" name="day" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($lottery->day ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Dia</option>
                    <option value="domingo">DOMINGO</option>
                    <option value="lunes">LUNES</option>
                    <option value="martes">MARTES</option>
                    <option value="miercoles">MIERCOLES</option>
                    <option value="jueves">JUEVES</option>
                    <option value="viernes">VIERNES</option>
                    <option value="sabado">SABADO</option>
                    <option value="todos">todos los dias</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="code">Codigo</label>
        <div class="select">
            <select id="code" name="code" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($lottery->code ?? '') == '' ? "selected" : "" }} disabled>Seleccionar modo</option>
                    <option value="iday">UN DIA</option>
                    <option value="7days">TODOS LOS DIAS</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-10">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
            <a href="{{url('lottery')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>
</div>
