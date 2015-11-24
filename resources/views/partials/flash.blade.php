@if ( Session::has('flash_message') )
    <div class="alert alert-success alert-dismissible {{ Session::has('flash_message_important')? 'alert-important' : '' }}" role="alert">
        @if( Session::has('flash_message_important'))
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @endif

        {{-- Session::get('flash_message') --}}
        {{ session('flash_message') }}
    </div>
@endif