@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <!-- {{ Auth::user()->id }}
        {{ __('You are logged in!') }} -->
    </div> 
    <div>
        <a type="button" href="{{ route('products.createproduct',Auth::user()->id) }}" class="btn btn-primary">Createproduct</a>
        <a type="button" href="{{ route('home') }}" class="btn btn-info">Home</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>วันที่ซื้อ</th>
            <th>price</th>
            <th>ชื่อ Beat</th>
            <th>Type</th>
            <th>รายละเอียด</th>
        </tr>
        </thead>
        @foreach($trading_histories as $tradingHis)
                <tr>
                    <td>{{ $tradingHis->datatime}}</td>
                    <td>{{ $tradingHis->Price }}</td>
                    <td>{{ $tradingHis->ProductTitle }}</td>
                    <td>{{ $tradingHis->ProductType  }}</td>
                    <td>{{ $tradingHis->ProductDescriptions  }}</td>
        
                </tr>
        @endforeach

    </table>

  

</div>


@endsection