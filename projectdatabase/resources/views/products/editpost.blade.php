@extends('layouts.app')
@foreach($productsedit as $prodEdit )
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
        </br>     

        <form action="{{ route('products.editpostviewupdate') }}" method="POST">
            @csrf
            @method("POST")

            <input type="hidden" class="form-control" placeholder="Enter ProductID" value="{{ $prodEdit->ProductID }}" name="ProductID" id="ProductID" >
            <div class="form-group">
                <label for="ProductTitle">ชื่อบีท:</label>
                <input type="text" class="form-control" placeholder="Enter ProductTitle" value="{{ $prodEdit->ProductTitle }}" name="ProductTitle" id="ProductTitle" >
            </div>
            <div class="form-group">
                <label for="ProductType">ProductType:</label>
                <select class="form-control" name="ProductType" id="ProductType">
                    <option value="{{ $prodEdit->ProductType }}">{{ $prodEdit->ProductType }}</option>
                    <option value="Pop">Pop</option>
                    <option value="IndieRock">IndieRock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="K-pop">K-pop</option>
                    <option value="Metal">Metal</option>
                    <option value="Rap">Rap</option>
                    <option value="R&B">R&B</option>
                    <option value="Rock">Rock</option>
                    <option value="Lofi">Lofi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ProductDescriptions">รายละเอียด:</label>
                <input type="text" class="form-control" placeholder="Enter ProductDescriptions" value="{{ $prodEdit->ProductDescriptions }}" name="ProductDescriptions" id="ProductDescriptions" >
            </div>
            <div class="form-group">
                <label for="Price">ราคา:</label>
                <input type="text" class="form-control" placeholder="Enter Price" value="{{ $prodEdit->Price }}" name="Price" id="Price" >
            </div>
            <div class="form-group">
                <select class="form-control" name="ProductStatus" id="ProductStatus">
                    @if( $prodEdit->ProductStatus == "on" )
                        <option value="on" selected>ลงขายอยู่</option>
                        <option value="off" >ปิดขาย</option>
                    @elseif( $prodEdit->ProductStatus == "off" )
                        <option value="off" selected >ปิดขาย</option>
                        <option value="on" >ลงขายอยู่</option>
                    @endif 
                </select>
            </div>

                <button type="submit" class="btn btn-success">ฝากเงิน</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
        </form>

</div>
@endsection