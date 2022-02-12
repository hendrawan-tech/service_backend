@php $editing = isset($service) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="product_id" label="Timeline" required>
            @php $selected = old('product_id', ($editing ? $service->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product Service</option>
            @foreach($products as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $service->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
