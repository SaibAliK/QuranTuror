<option value="">None selected</option>
@foreach($available as $item)
	<option value="{{ $item }}">{{ $item }}</option>
@endforeach
