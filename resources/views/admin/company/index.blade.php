
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Empresa
                @can('lottery.index')
                    <a href="lottery" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Loteria</a>
                @endcan
                @can('play.index')
                    <a href="play" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Juego</a>
                @endcan
                <a href="lotteryPlay" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Numeros Jugados</a>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="companies">
                    <thead>
                        <tr class="bg-info">
                            <th>Id</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Empresa</th>
                            <th>NIT</th>
                            <th>Logo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
<script type="text/javascript">
$(document).ready(function ()
    {
        $('#companies').DataTable(
        {
            responsive: true,
            info: true,
            paging: true,
            ordering: true,
            searching: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            ajax: '{{ route('company.index') }}',
            columns:
            [
                {data: 'id'},
                {data: 'department'},
                {data: 'municipality'},
                {data: 'name'},
                {data: 'nit'},
                {data: 'logo',
                    'sortable': false,
                    'searchable': false,
                    'render': function (image) {
                    if (!image) {
                        return 'N/A';
                    } else {
                        var img = image;
                        return '<img src="' + img + '" height="50px" width="50px" />';
                    }
                }},
                {data: 'accesos'},
            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection
