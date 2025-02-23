@props(['name' => 'input', 'id', 'choices' => [], 'type' => 'text', 'fields' => [], 'grid' => '', 'note' => ''])

@php
    $i = 0;
@endphp

@switch($type)
    @case('radio')
        <x-form.title>{{ $slot }}</x-form.title>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 {{ $grid }}">
            @foreach ($choices as $count => $choice)
                <x-form.radio name="{{ $name }}" id="{{ $id . '-' . $i }}" value="{{ $count }}"
                    {{ $attributes }}>{{ $choice }}</x-form.radio>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    @break

    @case('text')
        <x-form.title>{{ $slot }}</x-form.title>
        @if (count($fields) < 1)
            <x-form.field name="{{ $name }}" id="{{ $id }}" value="{{ old($name) }}" {{ $attributes }} />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 {{ $grid }}">
                @foreach ($fields as $key => $field)
                    <x-form.field name="{{ $name }}[{{ $key }}]" id="{{ $id . '-' . $i++ }} "
                        value="{{ old($name . '.' . $key) }}" {{ $attributes }}>{{ $field }}</x-form.field>
                @endforeach
            </div>
        @endif
    @break

    @case('file')
        <x-form.title>{{ $slot }}</x-form.title>
        <x-form.file name="{{ $name }}" value="{{ old($name) }}" id="{{ $id }}" {{ $attributes }} />
    @break

    @case('time')
        <x-form.title>{{ $slot }}</x-form.title>
        <x-form.time name="{{ $name }}" value="{{ old($name) }}" id="{{ $id }}" {{ $attributes }} />
    @break

    @case('date')
        <x-form.title>{{ $slot }}</x-form.title>
        <x-form.date name="{{ $name }}" value="{{ old($name) }}" id="{{ $id }}" {{ $attributes }} />
    @break

    @case('button')
        <x-form.button {{ $attributes }}>{{ $slot }}</x-form.button>
    @break

    @default
@endswitch

@error($name)
    <p class="m-3 text-red-500">{{ $message }}</p>
@enderror

@if ($note !== '')
    <p class="m-3 text-slate-500">{{ $note }}</p>
@endif

@if ($type !== 'button')
    <x-form.separator />
@endif
