@props(['name','id'])

<div {{ $attributes }}>
    <label for="{{ $id }}" class="text-xl">{{$slot}}</label>
    <input type="text" name="{{ $name }}" id="{{ $id }}" {{$attributes}}
        class="text-xl indent-3 mr-3 border-dashed outline-none border-b-2 after:bg-sky-500 checked:after:bg-sky-400 border-slate-500 accent-sky-400">
</div>

{{-- w-64 md:w-96 --}}