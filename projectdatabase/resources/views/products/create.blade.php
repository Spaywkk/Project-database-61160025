@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Stacked form</h2>
        <form action="{{ route('products.store') }}" method="POST">
        @csrf  
        @method('POST')
            <div class="form-group">
                <label for="UserProduct_id">USERID:</label>
                <input type="text" class="form-control" id="UserProduct_id" placeholder="Enter USERID" name="UserProduct_id" value="{{ Auth::user()->id }}"readonly>
            </div>

            <div class="form-group">
                <label for="ProductTitle">ProductTitle:</label>
                <input type="text" class="form-control" id="ProductTitle" placeholder="Enter ProductTitle"  name="ProductTitle" required>
            </div>

            <div class="form-group">
                <label for="ProductType">ProductType:</label>
                <select name="ProductType" id="ProductType" required>
                    <option value="none">none</option>
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
                <label for="ProductDescriptions">ProductDescriptions:</label>
                <input type="text" class="form-control" id="ProductDescriptions" placeholder="Enter ProductDescriptions"  name="ProductDescriptions" required>
            </div>

            <div class="form-group">
                <label for="Price">Price:</label>
                <input type="number" class="form-control" id="Price" placeholder="Enter Price"  name="Price" required>
            </div>

            <div class="form-group">
                <label for="ProductStatus">ProductStatus:</label>
                <select name="ProductStatus" id="ProductStatus" required>
                    <option value="on">On</option>
                    <option value="on">Off</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Image">Image url:</label>
                <input type="text" class="form-control" id="ImageSource" placeholder="Enter Image" name="ImageSource" required>
            </div>


        

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
</div>
@endsection
