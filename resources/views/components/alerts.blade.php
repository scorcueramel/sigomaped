<div class="alert alert-{{ $type??'info' }} alert-dismissible {{ $textcolor??'' }}">
    @if ($btndismiss??false)
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif
    <h4><i class="icon fa fa-{{ $icontype??'info' }}"></i> {{$title??'Título'}}</h4>
    {!! $message??'Mensaje' !!}
</div>
