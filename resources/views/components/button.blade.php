@if ($type == 'success')
<a href="{{ route('posts.show',[$href]) }}" class="btn btn-success">{{ $slot }}</a>
@endif
@if ($type == 'secondary')
<a class="btn btn-secondary">{{ $slot }}</a>
@endif
@if ($type == 'danger')
<a class="btn btn-danger">{{ $slot }}</a>
@endif
