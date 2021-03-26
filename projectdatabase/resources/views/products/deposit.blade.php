@extends('layouts.app')
@foreach($users as $users)
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
        <a type="button" href="{{ route('products.deposit',Auth::user()->id) }}" class="btn btn-success">เติมเงิน</a>
        <a type="button" href="{{ route('backpack.index',Auth::user()->id) }}" class="btn btn-secondary">ประวัติการซื้อขาย</a>
    </div>
  <div class="card-header">{{ __('Dashboard') }}</div>        

        <form action="{{ route('products.insertdeposit',$users->id ) }}" method="POST">
            @csrf
            @method("POST")
                <input type="hidden" class="form-control" placeholder="Enter iduser" value="{{ $users->id }}" id="iduser" readonly>

            <div class="form-group">
                <label for="BalanceOld">ยอดเงินคงเหลือ:</label>
                <input type="number" class="form-control" placeholder="Enter BalanceOld" value="{{ $users->Balance }}" id="BalanceOld" readonly>
            </div>

            <div class="form-group">
                <label for="Amount">ฝากเงิน:</label>
                <input type="number" class="form-control" name="Amount" placeholder="Enter Amount" id="Amount" required>
            </div>

                <button type="submit" class="btn btn-success">ฝากเงิน</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
        </form>

</div>
@endsection