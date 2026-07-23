<option value="0">--- Select Sub-Head ---</option>
@if(!empty($states))
  @foreach($states as $key => $value)
    <option value="{{ $value }}">{{ $value }}</option>
  @endforeach
@endif