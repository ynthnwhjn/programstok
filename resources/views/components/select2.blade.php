@props([
   'id' => 'select2-' . uniqid(),
   'name',
   'url' => null,
   'selected' => null,
   'placeholder' => 'Select an option',
   'multiple' => false,
])

<div
    x-data
    x-init="
        const select = $('#' + '{{ $id }}');
        select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            theme: 'bootstrap'
        });

        @if ($url)
        axios.get('{{ $url }}')
            .then(response => {
               const data = response.data;

               Object.entries(data.output).forEach(([value, label]) => {
                  const option = new Option(label, value, false, value == '{{ $selected }}');
                  select.append(option).trigger('change');
               });
            });
        @endif

        @if ($selected && !$url)
        select.val('{{ $selected }}').trigger('change');
        @endif
    "
>
    <select
        id="{{ $id }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        class="form-control"
        {{ $multiple ? 'multiple' : '' }}
    >
        @if (!$selected && $placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
    </select>
</div>
