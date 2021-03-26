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
        <a type="button" href="{{ route('products.index',Auth::user()->id) }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
          <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
        </svg> You Inventory
        </a>
    </div>
    </br>
  <div class="card-header"></div>        
  <table class="table table-striped">
    <thead>
      <tr>
        <th>image</th>
        <th></th>
       <th>ผู้ลงขาย</th>
        <th>title</th>
        <th>type</th>
        <th>Descriptions</th>
        <th>Price</th>
        <th>ProductStatus</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $prd)
         @if( $prd->username != Auth::user()->username)
            <tr>
                <td><img src="{{ $prd->ImageSource }}"  width="304" height="236" alt=""><td>
                <td>{{ $prd->username }}</td>
                <td>{{ $prd->ProductTitle }}</td>
                <td>{{ $prd->ProductType }}</td>
                <td>{{ $prd->ProductDescriptions }}</td>

              @if(Auth::user()->rank == "plat")

                <td>ราคาเดิม{{ $prd->Price }} </br> ลดเหลือ {{ $prd->Price/100*80 }}</td>

              @elseif(Auth::user()->rank == "gold")

                <td>ราคาเดิม{{ $prd->Price }} </br> ลดเหลือ {{ $prd->Price/100*90 }}</td>

              @elseif(Auth::user()->rank == "silver" )

                <td>{{ $prd->Price }}</td>

              @endif

                <td>{{ $prd->ProductStatus }}</td>
                <td><a class="btn btn-success" href="{{ route('products.buybeatindex', $prd->ProductID) }}" type="button">Buy</a></td>
            </tr>
          @elseif($prd->username = Auth::user()->username)
            <tr>
                <td><img src="{{ $prd->ImageSource }}"  width="304" height="236" alt=""><td>
                <td>{{ $prd->username }}</td>
                <td>{{ $prd->ProductTitle }}</td>
                <td>{{ $prd->ProductType }}</td>
                <td>{{ $prd->ProductDescriptions }}</td>
                <td>{{ $prd->Price }}</td>
                <td>{{ $prd->ProductStatus }}</td>
                <td><a class="btn btn-dark text-white"  type="button">สินค้าของคุณ</a></td>
            </tr>
          @endif
        @endforeach
    </tbody>
  </table>
</div>
@endsection
