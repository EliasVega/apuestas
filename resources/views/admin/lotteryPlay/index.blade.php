
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5> Numeros
                <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="lotteryPlays">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Loteria</th>
                            <th>Numero</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th colspan="5" style="text-align:right">Total:</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
<script type="text/javascript">
$(document).ready(function ()
    {
        $('#lotteryPlays').DataTable(
        {
            info: true,
            paging: true,
            ordering: true,
            searching: true,
            responsive: true,
            autoWidth: true,
            processing: true,
            serverSide: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            ajax: '{{ route('lotteryPlay.index') }}',
            columns:
            [
                {data: 'id'},
                {data: 'created_at'},
                {data: 'type'},
                {data: 'lottery'},
                {data: 'number'},
                {data: 'value', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 0, '')},
            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\€]/g, '').replace(/,/g, '.') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var total = api
                    .column(5)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var totalPage = api
                    .column(5, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    `$ ${new Intl.NumberFormat("es-CO").format(totalPage)} ($ ${new Intl.NumberFormat("es-CO").format(total)})`
                )
            },
        });
    });
</script>
@endpush
</main>
@endsection





