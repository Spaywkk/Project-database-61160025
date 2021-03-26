@extends('layouts.app')
@foreach($productsbuy as $prd)
@endforeach
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
        <a type="button" href="{{ route('home') }}" class="btn btn-info">กลับหน้าหลัก</a>
        <a type="button" href="" class="btn btn-secondary">ประวัติการซื้อขาย</a>
    </div>   
    <br/>  
  <div class="container">
        <form action="{{ route('products.buybeat',$prd->ProductID) }}" method="POST">
        @csrf
        @method("POST")
              <table class="table">
              <center>
                  <img src="{{ $prd->ImageSource }}" width="304" height="236" alt="">
              </center>
                <div class="form-group">
                  <label for="username">ผู้ขาย:</label>
                  <input type="text" class="form-control" placeholder="Enter username" value="{{ $prd->username }}" name="username" id="username" readonly>
                </div>
                <div class="form-group">
                  <label for="ProductTitle">ชื่อ Beat:</label>
                  <input type="text" class="form-control" placeholder="Enter ProductTitle" value="{{ $prd->ProductTitle  }}" name="ProductTitle" id="ProductTitle" readonly>
                </div>
                <div class="form-group">
                  <label for="ProductType">Type Beat:</label>
                  <input type="text" class="form-control" placeholder="Enter ProductType" value="{{ $prd->ProductType  }}" name="ProductType" id="ProductType" readonly>
                </div>
                <div class="form-group">
                  <label for="ProductDescriptions">รายละเอียด:</label>
                  <input type="text" class="form-control" placeholder="Enter ProductDescriptions" value="{{ $prd->ProductDescriptions  }}" name="ProductDescriptions" id="ProductDescriptions" readonly>
                </div>
                <div class="form-group">
                  <label for="Price">ราคา:</label>
                  <input type="text" class="form-control" placeholder="Enter Price" 
                  
                  value=" @if(Auth::user()->rank == 'plat'){{ $prd->Price/100*80 }}@elseif(Auth::user()->rank == 'gold'){{ $prd->Price/100*90 }}@elseif(Auth::user()->rank == 'silver'){{ $prd->Price }}@endif " name="Price" id="Price" readonly>
                          
                </div>

                  <input type="hidden" class="form-control" value="{{ date('Y-m-d H:i:s') }}" name="timenow" id="timenow" readonly>
                  <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="userbuy" id="userbuy" readonly>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">ยืนยันการซื้อ</button>
                        <a href="{{ route('home',Auth::user()->id) }}" class="btn btn-danger">ยกเลิก</a>
                    </div>
              </table>

              
                
          </form>
  </div>
</div>
@endsection