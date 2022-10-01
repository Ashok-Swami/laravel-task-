<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD </title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
            <div class="col-lg-3">
                @if (isset($products->image) && !empty($products->image))
                    @if (count($products->image) > 0)
                        <p>Images:</p>

                        @foreach ($products->image as $img)
                            <div class="card" style="max-height: 200px; max-width: 250px;">
                                <img src="/images/{{ $img->image_name }}" class="card-img-top" alt="...">
                            </div>
                            <form action="/deleteimage/{{ $img->id }}" method="post">
                                <button class="btn text-danger">X</button>
                                @csrf
                                @method('delete')
                            </form>
                            <br>
                        @endforeach
                    @endif
                @endif
            </div>

            <div class="col-lg-6">
                <h3 class="text-center text-danger"><b>Update Product</b> </h3>
                <div class="form-group">
                    <form action="/update/{{ $products->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" value="{{ $products->name }}" id="floatingInput"
                                placeholder="Enater Name">
                            <label for="floatingInput">Product Name</label>
                        </div>

                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="description"  value="{{ $products->description }}" id="floatingInput"
                                placeholder="description">
                            <label for="floatingInput">Product Description</label>
                        </div>


                        @if ($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                        @php
                            $catogory = ['Books', 'Electronics', 'Furniture', 'Beauty', 'Mobile', 'shoes ', 'Clothing'];
                        @endphp
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="category"
                                aria-label="Floating label select example">
                                <option value="-1"> Select Catogory</option>
                                @foreach ($catogory as $value => $label)
                                    @if ($products->catogory== $value)
                                    <option value="{{ $value }}" selected> {{ $label }}</option>
                                    @endif
                                    <option value="{{ $value }}" > {{ $label }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Catogory</label>
                        </div>

                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="price" value="{{ $products->price }}"  id="floatingInput"
                                placeholder="price">
                            <label for="floatingInput">Product Price</label>
                        </div>


                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="quantity" value="{{ $products->quantity }}" id="floatingInput"
                                placeholder="product Quantity">
                            <label for="floatingInput">Product Quantity</label>
                        </div>

                        @if ($errors->has('images'))
                            <span class="text-danger">{{ $errors->first('images') }}</span>
                        @endif
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload product Images</label>
                            <input class="form-control" type="file" id="floatingInput" name="images[]" multiple
                                id="formFile">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3 ">Update</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
