<div class="alert alert-{{ $type??'info' }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-{{ $icontype??'info' }}"></i> {{$title??'Título'}}</h4>
    {!! $message??'Mensaje' !!}
</div>
