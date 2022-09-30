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
                {{-- {!! dd($products->image_name) !!} --}}


                {{-- @if (count($products->image_name) > 0) --}}
                <p>Images:</p>
                @foreach ($products as $img)
                    <form action="/deleteimage/{{ $products->img_id }}" method="post">
                        <button class="btn text-danger">X</button>
                        @csrf
                        @method('delete')
                    </form>
                    <img src="/images/{{ $products->image_name }}" class="img-responsive"
                        style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                @endforeach
                {{-- @endif --}}
            </div>
            {{-- @dd($products->id); --}}
            <div class="col-lg-6">
                <h3 class="text-center text-danger"><b>Update product</b> </h3>
                <div class="form-group">
                    {{-- <form action="/update/{{ $products->img_id }}" method="post" enctype="multipart/form-data"> --}}
                    @csrf
                    @method('put')
                    <input type="text" name="name" class="form-control m-2" value="{{ $products->name }}"
                        placeholder="enter name ">
                    <input type="text" name="description" class="form-control m-2"
                        value="{{ $products->description }}" placeholder="enter description">
                    <input type="text" name="category" class="form-control m-2" value="{{ $products->category }}"
                        placeholder="enter category">
                    <input type="text" name="price" class="form-control m-2" value="{{ $products->price }}"
                        placeholder="enter price">
                    <input type="text" name="quantity" class="form-control m-2" value="{{ $products->quantity }}"
                        placeholder="enter quantity">


                    <label class="m-2">Images</label>
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]"
                        multiple>

                    <button type="submit" class="btn btn-danger mt-3 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
