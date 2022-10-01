<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD With Multiple Image Upload</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-3">
                @if (isset($products->image) && !empty($products->image))
                    @if (count($products->image) > 0)
                        <p>Images:</p>
                        @foreach ($products->image as $img)
                            <div class="card" style="max-height: 200px; max-width: 250px;">
                                <img src="/images/{{ $img->image_name }}" class="card-img-top" alt="...">
                            </div>
                            <br>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="col-lg-6">
                <h3 class="text-center text-danger"><b>View Product Details</b> </h3>
                <div class="form-group">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" value="{{ $products->name }}" readonly
                            id="floatingInput" placeholder="Enater Name">
                        <label for="floatingInput">Product Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="description"
                            value="{{ $products->description }}" readonly id="floatingInput" placeholder="description">
                        <label for="floatingInput">Product Description</label>
                    </div>
                    @php
                        $catogory = ['Books', 'Electronics', 'Furniture', 'Beauty', 'Mobile', 'shoes ', 'Clothing'];
                    @endphp
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect" name="category"
                            aria-label="Floating label select example">
                            @foreach ($catogory as $val => $value)
                                @if ($products->category == $val)
                                    <option value="{{ $val }}"> {{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Product Catogory</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="price" value="{{ $products->price }}"
                            readonly id="floatingInput" placeholder="price">
                        <label for="floatingInput">Product Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="quantity" value="{{ $products->quantity }}"
                            readonly id="floatingInput" placeholder="product Quantity">
                        <label for="floatingInput">Product Quantity</label>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload product Images</label>
                        <input class="form-control" type="file" disabled id="floatingInput" name="images[]" multiple
                            id="formFile">
                    </div>
                    <a href="{{ url()->previous() }}"> <button class="btn btn-danger mt-3 ">Back</button></a>
                </div>
            </div>
        </div>
</body>

</html>
