@extends('layouts.app')
@foreach($users as $usersrank)
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
        <a type="button" href="" class="btn btn-secondary">ประวัติการซื้อขาย</a>
    </div>
    <br>
  <!-- <div class="card-header">{{ __('Dashboard') }}</div>        -->

  <div class="alert alert-warning text-body">
  <h3><strong>เเจ้ง!</strong> ระดับ rank สามารถได้รับ ส่วนลดพิเศษ เช่น ซื้อรายการถูกขึ้น ได้รับของขวัญ premieum.</h3>
  </div> 

        <form action="{{ route('rank.buyrank') }}" method="POST">
            @csrf
            @method("POST")
                <input type="text" class="form-control" name="iduser" placeholder="Enter iduser" value="{{ $usersrank->id }}" id="iduser" readonly>

            <div class="form-group">
                <label for="rankold">Rank ปัจจุบัน:</label>
                <input type="text" class="form-control" placeholder="Enter rankold" value="{{ $usersrank->rank }}" id="rankold" readonly>
            </div>

            <div class="form-group">
                <label for="rankbuy">ฝากเงิน:</label>
                <select name="rankbuy" id="rankbuy"  class="custom-select mb-3">
                    <option value="silver">silver</option>
                    <option value="gold">gold ราคา 1000</option>
                    <option value="plat">plat ราคา 5000</option>
                </select>
            </div>

                <button type="submit" class="btn btn-success">ฝากเงิน</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
        </form>

</div>


@endsection