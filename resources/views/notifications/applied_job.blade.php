@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Job Applied
        @endcomponent
    @endslot

{{-- Body --}}
    <h2>Hi, {{$data->name}} </h2>
    Your successfully applied for job
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
