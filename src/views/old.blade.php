@extends('adminamazing::teamplate')

@section('pageTitle', 'Баланс платежных систем')
@section('content')
    <script>
        var route = '{{ route('home') }}';
        var message = 'Вы точно хотите удалить данное сообщение?';
        var routeLoadedBalance = '{{route('AdminBalanceLoad')}}';
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.js"></script>

    <script src="{{ asset('vendor/balance/balance.js') }}"></script>
    <script src="{{ asset('vendor/adminamazing/assets/plugins/chartist-js/dist/chartist.min.js')}}"></script>
    <script src="{{ asset('vendor/adminamazing/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <style type="text/css">
        .total-revenue4 .ct-series-a .ct-point {
            stroke: #55ce63;
            stroke-width: 5px;
        }
        .total-revenue4 .ct-series-a .ct-area{
            fill: #55ce63;
            fill-opacity: 0.2;
        }
        .total-revenue4 .ct-series-a .ct-line{
            stroke: #55ce63;
            stroke-width: 1px;
        }
        .text-purcharse{
            color: #55ce63;
        }


        .total-revenue4 .ct-series-b .ct-point {
            stroke: #ff0000;
            stroke-width: 5px;
        }
        .total-revenue4 .ct-series-b .ct-area{
            fill: #ff0000;
            fill-opacity: 0.2;
        }
        .total-revenue4 .ct-series-b .ct-line{
            stroke: #ff0000;
            stroke-width: 1px;
        }
        .text-withdraw{
            color: #ff0000;
        }
    </style>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                "use strict";
                if ( typeof Chartist === 'undefined' ) return;

                new Chartist.Line('.total-revenue4', {
                    labels: 
                        [
                            @foreach($data_for_chart as $key => $row)'{{$key}}', @endforeach
                        ],
                    series: [
                        [
                            @foreach($data_for_chart as $key => $row) {{$row['purchase']}}, @endforeach
                        ], 
                        [
                            @foreach($data_for_chart as $key => $row) {{$row['withdraw']}}, @endforeach
                        ],
                  ]
                }, {
                    high: {{$max_value_chart}}, 
                    low: 0, 
                    showArea: true, 
                    fullWidth: true, 
                    plugins: [
                        Chartist.plugins.tooltip()
                    ],
                    axisY: {
                        onlyInteger: true, 
                        offset: 20, 
                        labelInterpolationFnc: function (value) {
                            return (value / 1) + 'k';
                        }
                    }
                });
            });
        </script>
    @endpush
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                <div>
                                    <h3>Статистика пополнений в USD</h3>
                                    <h6 class="card-subtitle">Январь 2018</h6> </div>
                                <div class="ml-auto ">
                                    <ul class="list-inline">
                                        <li>
                                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-purcharse"></i>Пополнения</h6> </li>
                                        <li>
                                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-withdraw"></i>Вывод</h6> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="total-revenue4" style="height: 350px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                            <h1 class="m-b-0 font-light">${{$total_deposits}}</h1>
                            <h6 class="text-muted">Всего пополнено</h6></div>
                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                            <h1 class="m-b-0 font-light">${{$total_withdraw}}</h1>
                            <h6 class="text-muted">Всего вывода</h6></div>
                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                            <h1 class="m-b-0 font-light">${{$total_referral}}</h1>
                            <h6 class="text-muted">Реферальных</h6></div>
                        <div class="col-lg-3 col-md-6 m-b-30 m-t-20 text-center">
                            <h1 class="m-b-0 font-light">${{$total_accurrals}}</h1>
                            <h6 class="text-muted">Начислений</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title pull-left">Баланс </h4>
                    <a href="javascript:void(0)" class="pull-right show_all_balance">Показать все балансы</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Платежная система</th>
                                    <th>Баланс</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payment_system as $row)
                                    <tr>
                                        <td>{{$row->payment_systems_in}}</td>
                                        <td>{{$row->title}}</td>
                                        <td><a data-id="{{$row->payment_systems_in}}" class="loaded_balance" href="javascript:void(0)">Показать</a> {{$row->currency}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
    </div>
@endsection