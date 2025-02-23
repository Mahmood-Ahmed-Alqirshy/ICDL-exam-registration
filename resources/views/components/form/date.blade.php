@props(['name', 'id'])

<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>
<input type="date" name="{{ $name }}" id="{{ $id }}" {{$attributes}}
             {{ $attributes->merge(['class' => 'transition shadow-lg hover:shadow-md bg-sky-400 rounded-md  py-3 px-8 text-white text-lg accent-white ']) }} >
            
