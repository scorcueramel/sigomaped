<div class="alert alert-{{ $type??'info' }} alert-dismissible {{ $textcolor??'' }} mb-4">
    @if ($btndismiss??false)
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif
    @if ($withTitle ?? true)
    <h4><i class="icon fa fa-{{ $icontype??'info' }}"></i> {{$title??'Título'}}</h4>
    @endif
    @if ($withTag ?? true)
    {!! $message??'Mensaje' !!}
    @else
        $message
    @endif
</div>
