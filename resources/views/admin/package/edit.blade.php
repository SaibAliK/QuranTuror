@extends('layouts.admin')
@section('title', 'Edit Package')
@section('nav-title', 'Edit Package')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.package.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $package->id }}">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <h5 class="card-title">Edit Package</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-control" for="gender">Package Type</label>
                                        <select class="form-control select2 position-relative @error('type') is-invalid @enderror" id="type" name="type" required="true">
                                            <option value="" disabled>Select</option>
                                            <option value="1">Basic</option>
                                            <option value="2">Profession</option>
                                            <option value="3">Ultimate</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name"> Percentage *</label>
                                        <input type="number" class="form-control @error('percentage') is-invalid @enderror" id="hours" required="true" name="percentage">
                                        @error('percentage')
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
        function EditmapDataToFields(data)
        {
            $.map(data, function(value, index){
                var input = $('[name="'+index+'"]');
                if($(input).length && $(input).attr('type') !== 'file')
                {
                  if(($(input).attr('type') == 'radio' || $(input).attr('type') == 'checkbox') && value == $(input).val())
                    $(input).prop('checked', true);
                  else
                      $(input).val(value).change();
                }
            });
        }
        var edit_data = <?php echo json_encode($package); ?>;
        EditmapDataToFields(edit_data);
    </script>

@endsection
