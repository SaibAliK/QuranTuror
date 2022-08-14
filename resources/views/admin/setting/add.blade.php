@extends('layouts.admin')
@section('title', 'Add setting')
@section('nav-title', 'Add setting')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form class="validate-form" action="{{route('admin.setting.store')}}" method="POST">
                @csrf                    
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">add</i>
                        </div>
                        <h5 class="card-title">Settings</h5>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name"> General Price</label>
                                    <input type="number" class="form-control"  name="general_price" placeholder="General Price" value="{{$setting['general_price'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name"> Percentage For Basic</label>
                                    <input type="number" class="form-control"  name="basic_percentage" placeholder="Percentage For Basic" value="{{$setting['basic_percentage'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name"> Percentage For Profession</label>
                                    <input type="number" class="form-control"  name="ultimate_percentage" placeholder="Percentage For Profession" value="{{$setting['ultimate_percentage'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name"> Percentage For Ultimate</label>
                                    <input type="number" class="form-control"  name="profession_percentage" placeholder="Percentage For Ultimate" value="{{$setting['profession_percentage'] ?? ''}}">
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

