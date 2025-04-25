@props([
   'id' => 'choices-' . uniqid(),
   'name',
   'options' => [],
   'url' => null,
   'selected' => null,
   'placeholder' => 'Select an option...',
   'multiple' => false,
   'search' => true,
])

<select
   id="{{ $id }}"
   name="{{ $name }}{{ $multiple ? '[]' : '' }}"
   {{ $multiple ? 'multiple' : '' }}
   class="form-control">
   @if (!$multiple && $placeholder)
   <option value="">{{ $placeholder }}</option>
   @endif
</select>

@push('scripts')
<script>
   document.addEventListener("DOMContentLoaded", function() {
      console.log('test')

      const choices = new Choices('#{{ $id }}', {
         searchEnabled: {{ $search ? 'true' : 'false' }},
         removeItemButton: {{ $multiple ? 'true' : 'false' }},
         shouldSort: false,
      });

      @if($url)
         axios.get('{{ $url }}')
            .then(function (response) {
               const result = response.data;
               console.log(result)

               const mapped = Object.keys(result.choices).map(key => ({
                  value: key,
                  label: result.choices[key]
               }));
               console.log(mapped)
               choices.setChoices(mapped);
            })
            .catch(function (error) {
               console.error("Error fetching data for Choices.js:", error);
            });
      @endif
   });
</script>
@endpush
