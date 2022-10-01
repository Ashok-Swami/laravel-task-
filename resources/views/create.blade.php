<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">

                <h3 class="text-center text-danger"><b>Add New Product</b> </h3>
                <div class="form-group">
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="floatingInput"
                                placeholder="Enater Name">
                            <label for="floatingInput">Product Name</label>
                        </div>

                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="description" id="floatingInput"
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
                                    <option value="{{ $value }}"> {{ $label }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Product Catogory</label>
                        </div>

                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="price" id="price"
                                placeholder="price">
                            <label for="price">Product Price</label>
                        </div>


                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="quantity" id="quantity"
                                placeholder="product Quantity">
                            <label for="quantity">Product Quantity</label>
                        </div>

                        @if ($errors->has('images'))
                            <span class="text-danger">{{ $errors->first('images') }}</span>
                        @endif
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload product Images</label>
                            <input class="form-control" type="file" id="floatingInput" name="images[]" multiple
                                id="formFile">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#price,#quantity").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                // $('#number-message').addClass('d-block').removeClass('d-none');
                return false;
            } else {
                // $('#number-message').addClass('d-none').removeClass('d-block');
            }
        });
    });
</script>