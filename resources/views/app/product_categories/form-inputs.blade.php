@php $editing = isset($productCategory) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $productCategory->name : '')) }}"
            maxlength="50"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
