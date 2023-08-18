@extends('layout')
@section('content')

<main>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content p-3">
                    <form method="post" action="{{ route('update.friends', $friends->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label"><strong>Friends Name </strong> </label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $friends->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label"> <strong> Friends Address</strong> </label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        value="{{ $friends->address }}">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="imageNew" class="form-label"><strong>Friends New Image</strong></label>
                                    <input type="file" name="newImage" class="form-control" id="imageNew"
                                        onchange="readURL(this);">
                                    @error('newImage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img class="mt-4" src="" id="newImageOne" alt="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="imageNew" class="form-label"><strong>Friends Old Image</strong></label>
                                    <br>
                                    <input type="hidden" name="oldImage" value="{{ $friends->image }}">
                                    <img src="{{ asset($friends->image) }}" style="width:80px;">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    function readURL(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#newImageOne')
              .attr('src', e.target.result)
              .width(80);
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
</script>

@endsection
