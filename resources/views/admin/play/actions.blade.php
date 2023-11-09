@can('play.show')
    <a href="{{ route('play.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Juego"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('playPos', $id) }}" class="btn btn-primary btn-sm" target="_blank"
    data-toggle="tooltip" data-placement="top" title="pdf pos" ><i class="fas fa-receipt"></i>
</a>
@can('play.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}"
    data-toggle="modal" title="Eliminar"><i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.play.delete', ['id' => $id])
