@props([
    'id' => 'datepicker-' . uniqid(),
    'name',
    'placeholder' => 'Select date',
    'value' => null,
])

<div x-data x-init="
    flatpickr($refs.input, {
        altInput: true,
        altFormat: 'd-m-Y',
        dateFormat: 'Y-m-d',
        defaultDate: '{{ $value }}',
        allowInput: true
    });
">
    <input
        x-ref="input"
        id="{{ $id }}"
        name="{{ $name }}"
        type="text"
        class="form-control"
        autocomplete="off"
    >
</div>
