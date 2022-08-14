@extends('layouts.admin')
@section('title', 'Add Revew')
@section('nav-title', 'Add Review')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin_theme/assets/css/star_rating.css')}}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="validate-form" action="{{ route('admin.tutor.review.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="tutor">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <h5 class="card-title">Add Review</h5>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-control" for="student_id">Select Student</label>
                                        <select class="form-control select2 position-relative @error('gender') is-invalid @enderror" id="student_id" name="student_id" required="true">
                                            <option value="" disabled>Select Student</option>
                                            @foreach($student_list as $item)
                                                <option value="{{ $item->id }}">{{ $item->FullName ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-control" for="show_tutor">Tutor</label>
                                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                        <input type="hidden" name="list_url" value="{{ url()->previous() }}">
                                        <input type="text" class="form-control" id="tutor_id" required="true" value="{{ $tutor->FullName ?? '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Rating</label><br>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    @if($errors->has('rating'))
                                        <br>
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('rating')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Review</label>
                                        <textarea class="form-control" name="review" placeholder="Leave a review for tutor"></textarea>
                                        @error('review')
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

