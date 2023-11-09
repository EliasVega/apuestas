<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="resolution">
        <div class="form-group">
            <label class="form-control-label" for="lottery_id">Loteria</label>
                <select name="lottery_id" class="form-control selectpicker" id="lottery_id" data-live-search="true">
                    <option value="" disabled selected>Loteria</option>
                    @foreach($lotteries as $lottery)
                        <option value="{{ $lottery->id }}">{{ $lottery->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" value="<?php echo date("Y-m-d");?>">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="number">Numero</label>
            <input type="number" name="number" id="number" class="form-control" placeholder="Numero">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="value">Valor</label>
            <input type="number" name="value" id="value" class="form-control" placeholder="Valor">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="type">Tipo</label>
        <div class="select">
            <select id="type" name="type" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($lotteryPlay->type ?? '') == '' ? "selected" : "" }} disabled>Seleccionar modo</option>
                    <option selected="selected" value="pleno">PLENO</option>
                    <option value="combinado">COMBINADO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Adicionar</label><br>
            <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Jugar"><i class="fas fa-check"></i> </button>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="pay">Valor Real</label>
            <input type="number" name="pay" id="pay" class="form-control" placeholder="V/real">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="actual_payment">V/aprox</label>
            <input type="number" name="actual_payment" id="actual_payment" class="form-control" placeholder="V/aprox" readonly>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="payment_form">Forma</label>
        <div class="select">
            <select id="payment_form" name="payment_form" class="form-control selectpicker" data-live-search="true">
                <option {{ ($play->payment_form ?? '') == '' ? "selected" : "" }} disabled>Forma</option>
                    <option selected="selected" value="contado">CONTADO</option>
                    <option value="credito">CREDITO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="payment_method">Forma</label>
        <div class="select">
            <select id="payment_method" name="payment_method" class="form-control selectpicker" data-live-search="true">
                <option {{ ($play->payment_method ?? '') == '' ? "selected" : "" }} disabled>Metodo</option>
                    <option selected="selected" value="efectivo">EFECTIVO</option>
                    <option value="nequi">NEQUI</option>
            </select>
        </div>
    </div>
</div>
