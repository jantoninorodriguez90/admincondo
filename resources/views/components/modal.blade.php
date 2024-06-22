{{-- type: sm, lg, xl --}}
@php
    if(empty($class)){
        $class = 'btn btn-default';
    }  

    if(empty($type)){
        $type = 'lg';
    }  

    if(empty($onclick)){
        $onclick = '';
    }  
@endphp

<button type="button" class="{{ $class }}" data-toggle="modal" data-target="#modal-{{ $type }}" onclick="{{ $onclick }}">
    {{ $button }}
</button>

<div class="modal fade" id="modal-{{ $type }}">
    <div class="modal-dialog modal-{{ $type }}">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ strtoupper($title) }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer justify-content-between">
            
            @if (!empty($button_success))
                {{-- <button type="button" class="btn btn-primary">SUCCESS</button>     --}}
                {{ $button_success }}
            @endif
            <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>