@can('cashRegister.edit')
    @if ($status == 'open')
        <a href="{{ route('cashRegister.edit', $id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
        data-placement="top" title="Cerrar Caja" ><i class="fas fa-user-lock"></i></a>
    @endif
@endcan
@can('cashRegister.show')
    <a href="{{ route('cashRegister.show', $id) }}" class="btn btn-sm btn-success" data-toggle="tooltip"
        data-placement="top" title="ver caja"><i class="fas fa-eye"></i></a>
@endcan
@can('cashInflow.index')
    <a href="{{ route('show_cashInflow', $id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip"
        data-placement="top" title="Recargar Caja"><i class="fas fa-dollar-sign"></i></a>
@endcan
@can('cashOutflow.index')
    <a href="{{ route('show_cashOutflow', $id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
    data-placement="top" title="Salida Efectivo"><i class="fas fa-dollar-sign"></i></a>
@endcan
<a href="{{ route('cashRegisterPos', $id) }}" class="btn btn-sm btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Reporte Pos">
    <i class="fas fa-newspaper"></i>
</a>
