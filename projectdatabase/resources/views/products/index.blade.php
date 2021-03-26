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
        <a type="button" href="{{ route('products.createproduct',Auth::user()->id) }}" class="btn btn-success">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
          </svg> Createproduct
        </a>
        <a type="button" href="{{ route('backpack.index',Auth::user()->id) }}" class="btn btn-secondary">ประวัติการซื้อขาย</a>
        <a type="button" href="{{ route('home') }}" class="btn btn-info">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
          </svg> กลับหน้าหลัก
        </a>

    </div>
    </br>
  <div class="card-header"><h5>Beat ของคุณ</h5></div>        
  <table class="table table-striped">
    <thead>
      <tr>
        <th>image</th>
        <th></th>
        <th>title</th>
        <th>type</th>
        <th>Descriptions</th>
        <th>Price</th>
        <th>ProductStatus</th>
      </tr>
    </thead>
    <tbody>

      
        @foreach($products as $prd)
        
          @if( $prd->ProductStatus == "off" || $prd->ProductStatus == "on")
            <tr>
                <td><img src="{{ $prd->ImageSource }}"  width="304" height="236" alt=""><td>
                <td>{{ $prd->ProductTitle }}</td>
                <td>{{ $prd->ProductType }}</td>
                <td>{{ $prd->ProductDescriptions }}</td>
                <td>{{ $prd->Price }}</td>
                <td>{{ $prd->ProductStatus }}</td>
                <td>
                  <a class="btn btn-primary text-white" href="{{ route('products.editpostview',$prd->ProductID) }}" type="button">Edit</a>
                  <a class="btn btn-success" href="{{ route('products.setsoldout',$prd->ProductID) }}" type="button">Apply</a>
                </td>
            </tr>
          @elseif( $prd->ProductStatus == "soldout" )

            <tr>
                <td><img src="{{ $prd->ImageSource }}"  width="304" height="236" alt=""><td>
                <td>{{ $prd->ProductTitle }}</td>
                <td>{{ $prd->ProductType }}</td>
                <td>{{ $prd->ProductDescriptions }}</td>
                <td>{{ $prd->Price }}</td>
                <td>{{ $prd->ProductStatus }}</td>
                <td>
                     <button class="btn btn-light" >สินค้า soldout </button>
                </td>
            </tr>

          @endif
          
        @endforeach
      


    </tbody>
  </table>
</div>
@endsection