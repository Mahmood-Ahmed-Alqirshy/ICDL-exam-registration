@props(['name', 'id' ,'value'])

<div {{$attributes}}>
    <input type="radio" {{$attributes}} name="{{ $name }}" id="{{ $id }}" value="{{$value}}"
        class="appearance-none border-2 border-white outline outline-sky-400 rounded-full w-4 h-4 checked:bg-sky-500">
    <label for="{{ $id }}" class="text-xl mr-3">{{ $slot }}</label>
</div>
