<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/post_box.css') }}">
        <title>Reporte de Caja</title>
    </head>
    <body>
        <header>
            <div class="center">
                <div id="logo">
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}">
                </div>
            </div>

            <div class="clearfix"></div>
        </header>
        <section>
            <div class="content_postbox">
                <div class="user_postbox">
                    <p>
                        Nombre: {{ $cashRegister->user->name }}:</p>
                </div>
            </div>
            @if ($cashRegister->in_cash > 0)
                <div class="content_postbox">
                    <p>REPORTE DE ENTRADAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashInflows as $cashInflow)
                            <tr>
                                <td>{{ $cashInflow->created_at }}</td>
                                <td>{{ $cashInflow->admin->name }}</td>
                                <td align="right">${{number_format($cashInflow->cash)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumCashInflows,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
            @if ($cashRegister->out_cash > 0)
                <div class="content_postbox">
                    <p>REPORTE DE SALIDAS EFECTIVO</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Autoriza</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashOutflows as $cashOutflow)
                            <tr>
                                <td>{{ $cashOutflow->created_at }}</td>
                                <td>{{ $cashOutflow->admin->name }}</td>
                                <td align="right">${{number_format($cashOutflow->cash)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" ><p align="right" >TOTAL:</p></th>
                                <td><p align="right" >${{ number_format($sumCashOutflows,2) }}</p></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif

            <div class="content_postbox">
                <p>REPORTE DE TOTALES</p>
                <table>
                    <tbody>

                        @if ($cashRegister->out_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL EGRESOS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->out_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->in_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL INGRESOS:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->in_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->cash_initial > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >EFECTIVO INICIAL:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->cash_initial,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->nequi > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >VENTAS NEQUI:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->nequi,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->credito > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >VENTAS CREDITO:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->credito,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->cash_in_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >TOTAL EFECTIVO:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->cash_in_total,2)}}</h2></td>
                            </tr>
                        @endif
                        @if ($cashRegister->cash_out_total > 0)
                            <tr>
                                <th colspan="4" ><p align="left" >SALIDA EFECTIVO:</p></th>
                                <td align="right"><h2>${{number_format($cashRegister->cash_out_total,2)}}</h2></td>
                            </tr>
                        @endif
                        <tr>
                            <th colspan="4" ><p align="left" >SALDO EN CAJA:</p></th>
                            <td align="right"><h2>${{number_format($cashRegister->cash_in_total - $cashRegister->cash_out_total ,2)}}</h2></td>
                        </tr>
                    </tbody>
                    <tfoot>


                    </tfoot>
                </table>
            </div>
            @if ($lotteryPlayTotal > 0)
                <div class="content_postbox">
                    <p>JUEGO REALIZADO</p>
                    <table>
                        <thead class="theadreport">
                            <tr>
                                <th class="uno">Loteria</th>
                                <th class="dos">Numero</th>
                                <th class="dos">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lotteryPlays as $lotteryPlay)
                            <tr>
                                <td>{{ $lotteryPlay->lottery->name }}</td>
                                <td>{{ $lotteryPlay->number }}</td>
                                <td align="right">$ {{ number_format($lotteryPlay->value,2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th  colspan="2"><p align="right">TOTAL:</p></th>
                                <th><p align="right">${{ number_format($lotteryPlayTotal,2) }}</p></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </section>
        <br>
        <br>
        <footer>
            Reporte cierre de Caja
        </footer>
    </body>
</html>



