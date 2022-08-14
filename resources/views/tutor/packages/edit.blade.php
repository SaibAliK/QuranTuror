@extends('layouts.tutor')
@section('title', 'Edit Package')

@section('content')

    <div class="card ">
        <div class="card-body">
            <div class="col-lg-12 mb-3 text-center  ">
                <h2 class="text-center has-line text-dark line-primary">Edit Package</h2>
            </div>
            <div class="col-lg-12 p-3">
                <form  method="post" enctype="multipart/form-data" action="{{route('tutor.packages.save')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $package->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control shadow-none rounded-sm @error('name') is-invalid @enderror" placeholder="Package name" required value="{{ $package->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Hours</label>
                                <input type="text" name="hours" class="form-control shadow-none rounded-sm @error('hours') is-invalid @enderror no_of_hours" placeholder="Hours" required value="{{ $package    ->hours }}">
                                @error('hours')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Amount/Hour ($)</label>
                                <input type="text" name="per_hour_amount" class="form-control shadow-none rounded-sm @error('per_hour_amount') is-invalid @enderror per_hour_amount" placeholder="Rate per hour" required value="{{ $package->per_hour_amount }}">
                                @error('per_hour_amount')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Total Amount ($)</label>
                                <input type="text" name="total_amount" class="form-control shadow-none rounded-sm @error('total_amount') is-invalid @enderror total_amount" placeholder="Total Amount" required value="{{ $package->total_amount }}" readonly>
                                @error('total_amount')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Package Type</label>
                            <select name="type" class="form-control  w-100  mb-0 shadow-none rounded-sm @error('type') is-invalid @enderror" >
                                <option value="1" @if($package->type=='1') selected @endif>Basic</option>
                                <option value="2" @if($package->type=='2') selected @endif>Profession</option>
                                <option value="3" @if($package->type=='3') selected @endif>Ultimate</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" maxlength="100" rows="2">{{ $package->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary shadow rounded-pill ">Submit</button>
                    </div>
                </form>
            </div>        
        </div>
    </div>

@endsection
@section('js')

    <script>
        $(document).on("keyup", ".per_hour_amount,.no_of_hours", function(e){
            e.preventDefault();
            var elm = $(this).closest('.row');
            calculateTotalAmount(elm);
        });

        function calculateTotalAmount(elm)
        {
            var per_hour_amount = parseFloat($(elm).find(".per_hour_amount").val());
            var no_of_hours = parseFloat($(elm).find(".no_of_hours").val());

            if(isNaN(per_hour_amount))
            {
                per_hour_amount=0;
            }
            if(isNaN(no_of_hours))
            {
                no_of_hours=0;
            }
            var total_amount = no_of_hours*per_hour_amount;
            var total_amount = Number(total_amount);
            if(total_amount=="Infinity")
            {
                total_amount=0;
            }else
            if(isNaN(total_amount))
            {
                total_amount=0;
            }
            $(elm).find(".total_amount").val(total_amount);
        }
    </script>
    
@endsection
