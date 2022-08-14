@extends('layouts.admin')
@section('title', 'Edit Location')
@section('nav-title', 'Edit Location')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.location.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">edit</i>
                            </div>
                            <h5 class="card-title">Edit Location</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name"> Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" required="true" name="name" value="{{ $item->name ?? '' }}">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Flag *</label>
                                        <div class="image_input_div">
                                            <label for="flag_input">
                                                @if(isset($item->flag))
                                                <img src="{{ asset($item->flag) }}" id="flag_img">
                                                @else
                                                <img src="{{ asset('images/default.png') }}" id="flag_img">
                                                @endif
                                            </label>
                                            <input type="file" class="form-control @error('flag') is-invalid @enderror" id="flag_input" required="true" name="flag">
                                        </div>
                                        @error('flag')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-4">
                            <button type="submit" class="btn btn-rose">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#flag_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#flag_input").change(function() {
            readURL(this);
        });
    </script>

@endsection
