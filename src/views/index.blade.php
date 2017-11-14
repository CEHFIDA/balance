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
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->title}}</td>
                                        <td><a data-id="{{$row->id}}" class="loaded_balance" href="javascript:void(0)">Показать</a> {{$row->currency}}</td>
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