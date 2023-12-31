@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Cerrar Caja N°. : {{ $cashRegister->id }}</h5>
            </div>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!Form::model($cashRegister, ['method'=>'PATCH','route'=>['cashRegister.update', $cashRegister->id]])!!}
            {!!Form::token()!!}
                <div class="box-body row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fas fa-lock"></i>&nbsp; Cerrar Caja</button>
                            <a href="{{ url('cashRegister') }}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i> Cancelar</a>
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection
