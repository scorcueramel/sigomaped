<!-- Modal -->
<div class="modal fade" id="{{ $idModalComponent ?? 'modalComponent'}}" tabindex="-1" aria-labelledby="modalComponentLabel" aria-hidden="true">
    <div class="modal-dialog {{ $widthModal ?? 'modal-md' }}">
        <div class="modal-content">
            <div class="modal-header">
                @if ($withTitleModal ?? true)
                <h5 class="modal-title" id="modalComponentLabel">{{$titleModal ?? 'Modal Title'}}</h5>
                @endif
                @if ($withButtonCloseModal ?? true)
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @endif
            </div>
            @if ($withBodyModal ?? true)
            <div class="modal-body">
                @if ($whitTagsModal ?? false)
                {{ $bodyContentModal ?? '' }}
                @else
                {!! $bodyContentModal ?? '' !!}
                @endif
            </div>
            @endif
            @if ($withFooterModal ?? true)
            <div class="modal-footer {{$buttonUbication ?? ''}}">
                @if ($withButtonCancelModal ?? true)
                <button type="button" class="btn btn-{{ $colorButtonCancel ?? 'secondary' }} {{$heightCancelButton ?? ''}} {{$withCancelButton ?? ''}}" data-dismiss="modal">{{$textCancelButton ?? 'Cancelar'}}</button>
                </button>
                @endif
                @if($withButtonSave ?? false)
                <button type="{{ $typeSaveButton ?? 'button' }}" class="btn btn-{{ $colorButtonSave ?? 'info' }}  {{$heightSaveButton ?? ''}} {{$withSavelButton ?? ''}}" id="{{$buttonId ?? ''}}">{{$textSaveButton ?? 'Gaurdar'}}</button>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
