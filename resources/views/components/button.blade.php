@if ($type == 'success')  
<a href="{{ route('posts.show',[$href ]) }}" class="btn btn-success">{{ $content }}</a>
@endif
@if ($type == 'secondary')  
<a class="btn btn-secondary">{{ $content }}</a>
@endif
@if ($type == 'danger')  
<a class="btn btn-danger">{{ $content }}</a>
@endif