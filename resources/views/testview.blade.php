@foreach($request as $key => $e)
    {{ $key }}:{{ $e }}
    <br>
@endforeach

@foreach($files as $key =>$file)
    {{ $key }}:{{ $file->getClientOriginalName() }}
    <br>
@endforeach
