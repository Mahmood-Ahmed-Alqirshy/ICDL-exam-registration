@props(['name', 'id'])

<input type="file" name="{{ $name }}" id="{{ $id }}" {{$attributes}}
            class="border border-gray-900 my-3 bg-white rounded-md text-lg outline-none block lg:w-96 w-full file:bg-sky-500 file:text-white file:p-3 file:outline-none file:border-none  file:rounded-r-md">