<form method="GET" action="{{$route}}">
    <button type="submit" {{ $attributes->merge(['class' => 'rounded-md bg-slate-800 p-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none tooltip']) }} type="button">
        <span class="tooltiptext">ADD</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white" class="w-4 h-4">
            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
        </svg>
    </button>
</form>