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
        <a type="button" href="{{ route('backpack.index',Auth::user()->id) }}" class="btn btn-secondary">ประวัติการซื้อขาย</a>
    </div>
    </br>
    </br>
    </br>
    </br>

    <div class="container">
    <h1>แลก Bonus</h1>
    <p></p>

    <div class="toast" data-autohide="false">
    <div class="toast-header">
        <strong class="mr-auto text-primary">rate</strong>
        <button type="button" class="ml-2 mb-2 close" data-dismiss="toast">&times;</button>
        </div>
            <div class="toast-body">
            <p class="text-success">- 100 Bonus แลกได้ 100 Balane</p>
            <p class="text-primary">- 150 Bonus แลกได้ 150 Balane</p>
            <p class="text-danger">- 300 Bonus แลกได้ 350 Balane</p>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
        $('.toast').toast('show');
        });
    </script>   
  </br>
        <form action="{{ route('backpack.confirmchangebonus') }}" method="POST">
            @csrf
            @method("POST")
                <input type="hidden" class="form-control" name="iduser" placeholder="Enter iduser" value="{{ $users->id }}" id="iduser" readonly>

            <div class="form-group">
                <label for="BonusStar">โบนัสที่มี:</label>
                <input type="number" class="form-control" placeholder="Enter BonusStar" value="{{ $users->BonusStar }}" id="BonusStar" readonly>
            </div>

            <div class="form-group">
                <label for="AmountBonus">จำนวนที่เเลก:</label>
                <select name="AmountBonus" id="AmountBonus" class="custom-select mb-3">
                    <option value="100">100 (ได้ 100 Balane)</option>
                    <option value="150">150 (ได้ 150 Balane)</option>
                    <option value="300">350 (ได้ 350 Balane)</option>
                </select>
            </div>

                <button type="submit" class="btn btn-success">แลก</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
        </form>

</div>


@endsection