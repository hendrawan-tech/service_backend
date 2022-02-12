@php $editing = isset($categoryProduct) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $categoryProduct->name : '')) }}"
            maxlength="80"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
