@props(['name', 'id'])

<div {{$attributes}}>
    <input type="checkbox" name="{{ $name }}" id="{{ $id }}" value="yes" {{$attributes}} class=" rounded-sm outline outline-sky-400 outline-3 outline-offset-2 appearance-none h-4 w-4 checked:bg-sky-500">
    <label for="{{ $id }}" class="text-xl mr-3">{{ $slot }}</label>
</div>