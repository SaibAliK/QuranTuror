@extends('layouts.student')
@section('title', 'Rate your session')

@section('content')

<div class="card ">
    <div class="card-body">
        <div class="col-lg-12 mb-3 text-center  ">
            <h2 class="text-center has-line text-dark line-primary">Rate your session</h2>
        </div>
        <div class="col-md-12">
            <form action="{{route('student.review.save')}}" method="POST">
                @csrf
                <input type="hidden" name="meeting_session_id" value="{{ $id }}">
                <fieldset class="rating-stars">
                    <input type="radio" id="star5" name="rating" value="5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4.5"/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="3.5"/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3"/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2half" name="rating" value="2.5"/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1half" name="rating" value="1.5"/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    @error('rating')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea name="review" id="review" rows="5" class="form-control"></textarea>
                    @error('review')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary shadow rounded-pill ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
