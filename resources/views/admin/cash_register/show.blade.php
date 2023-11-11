@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 offset-lg-4">
            <a href="{{ route('cashRegister.index') }}" class="btn btn-lightBlueGrad"><i class="fa fa-plus mr-2"></i>Regresar</a>
            <a href="{{ route('company.index') }}" class="btn btn-blueGrad"><i class="fa fa-plus mr-2"></i>Inicio</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="nombre"># caja</label>
                <p>{{ $cashRegister->id }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="cash_open">Efectivo apertura</label>
                <p>{{ number_format($cashRegister->cash_initial,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="open">fecha de apertura</label>
                <p>{{ $cashRegister->created_at }}</p>
            </div>
        </div>

        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="close"> fecha de Cierre</label>
                @if ($cashRegister->status == 'close')
                    <p>{{ $cashRegister->updated_at }}</p>
                @endif

            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">total entradas</label>
                <p>{{ number_format($cashRegister->in_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Total salidas</label>
                <p>{{ number_format($cashRegister->out_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Venta x nequi</label>
                <p>{{ number_format($cashRegister->nequi,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Venta a Credito</label>
                <p>{{ number_format($cashRegister->credito,2) }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="abono">Entrada de efectivo</label>
                <p>{{ number_format($cashRegister->cash_in_total,2) }}</p>
            </div>
        </div>

        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="pay">Salida de efectivo</label>
                <p>{{ number_format($cashRegister->cash_out_total,2) }}</p>
            </div>
        </div>
        <div class="col-12 col-md-4 col-sm-6">
            <div class="form-group">
                <label class="form-control-label" for="balance">Saldo en caja</label>
                <p>{{ number_format(($cashRegister->cash_in_total - $cashRegister->cash_out_total),2) }}</p>
            </div>
        </div>
    </div>
    <div class="row">

        @if ($cashRegister->out_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Entregas de efectivo</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Recibe Administrador</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumCashOutflow,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cashOutflows as $cashOutflow)
                                <tr>
                                    <td>{{ $cashOutflow->created_at }}</td>
                                    <td>{{ $cashOutflow->id }}</td>
                                    <td>{{ $cashOutflow->admin->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($cashOutflow->cash,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_cash > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <strong class="tpdf">Detalle Recarga de efectivo</strong>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Fecha</th>
                                <th>ID</th>
                                <th>Recibe</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="3"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($sumCashInflow,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cashInflows as $cashInflow)
                                <tr>
                                    <td>{{ $cashInflow->created_at }}</td>
                                    <td>{{ $cashInflow->id }}</td>
                                    <td>{{ $cashInflow->name }}</td>
                                    <td class="rightfoot">$ {{ number_format($cashInflow->cash,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($lotteryPlayTotal > 0)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <strong class="tpdf">Numeros</strong>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>id</th>
                                <th>Fecha</th>
                                <th>Loteria</th>
                                <th>Numero</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($lotteryPlayTotal,2) }}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($lotteryPlays as $lotteryPlay)
                                <tr>
                                    <td>{{ $lotteryPlay->id }}</td>
                                    <td>{{ $lotteryPlay->created_at }}</td>
                                    <td>{{ $lotteryPlay->lottery->name }}</td>
                                    <td class="rightfoot">{{ $lotteryPlay->number }}</td>
                                    <td class="rightfoot">$ {{ number_format($lotteryPlay->value,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
