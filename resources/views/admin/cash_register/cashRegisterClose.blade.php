@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Emdisoft_pro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="form-control-label"> CIERRE DE CAJA N°. <strong>{{ $cashRegister->id }}</strong> </label>
            @can('cashRegister.index')
                <a href="{{ route('cashRegister.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
            @endcan
            @can('branch.index')
                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="nombre">Responsable</label>
                <p>{{ $cashRegister->user->name }}</p>
            </div>
        </div>
        @if ($cashRegister->cash_initial > 0)
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_open">Efectivo Inicial</label>
                    <p>${{ number_format($cashRegister->cash_initial,2) }}</p>
                </div>
            </div>
        @endif

        @if ($cashRegister->status == 'close')
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="open">Abierta</label>
                    <p>{{ $cashRegister->created_at }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="close">Cerrada</label>
                    <p>{{ $cashRegister->updated_at }}</p>
                </div>
            </div>
        @else
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="open">Abierta</label>
                    <p>{{ $cashRegister->created_at }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->cash_in_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_in_total">INGRESOS EFECTIVO</label>
                    <p>${{ number_format($cashRegister->cash_in_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->cash_out_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="cash_out">SALIDA EFECTIVO</label>
                    <p>${{ number_format($cashRegister->cash_out_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->cash_in_total - $cashRegister->cash_out_total != 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="balance">EFECTIVO EN CAJA</label>
                    <p>${{ number_format($cashRegister->cash_in_total - $cashRegister->cash_out_total,2) }}</p>
                </div>
            </div>
        @endif
        @if ($cashRegister->in_total > 0)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="pay">TOTAL INGRESOS</label>
                    <p>${{ number_format($cashRegister->in_total,2) }}</p>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
