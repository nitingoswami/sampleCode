@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        Messages Received
        @endcomponent
    @endslot

{{-- Body --}}
    <h2>Hi, {{$data->name}} </h2>
    You have received messages
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. blacknorth.com
        @endcomponent
    @endslot
@endcomponent
