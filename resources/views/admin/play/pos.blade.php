<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/post.css' }}">
    <title>Juego </title>

</head>

<header id="header">

    <div class="center">
        <!--DATOS company -->
        <div class="company">
            <p><strong class="companyName">{{ $play->lottery->name }} --- {{ $company->code }}</strong></p>
        </div>
        <!--DATOS FACTURA -->
        <div id="company">
            <p>
                <strong class="companyName">{{ date('d-m-Y', strtotime($play->date)) }}</strong>
            </p>
        </div>
    </div>
</header>

<body>
    <div class="content">
        <table class="table">
            <!--DETALLE DE VENTA -->
            <thead>
            </thead>
            <tbody>
                @foreach ($lotteryPlays as $lotteryPlay)
                    <tr>
                        <td>{{ $lotteryPlay->number }}</td>
                        <td> --- </td>
                        <td>{{ number_format($lotteryPlay->value) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <!--DATOS FTOTALES -->
                <tr>
                    <th colspan="2" class="footRight">TOTAL</th>
                    <td colspan="2" class="footRight"><strong>${{ number_format($play->total) }}</strong>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <br>
    <footer>
    </footer>
</body>

</html>
