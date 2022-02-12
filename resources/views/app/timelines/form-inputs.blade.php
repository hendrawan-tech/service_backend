@php $editing = isset($timeline) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="message"
            label="Message"
            value="{{ old('message', ($editing ? $timeline->message : '')) }}"
            maxlength="255"
            placeholder="Message"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="service_id" label="Service" required>
            @php $selected = old('service_id', ($editing ? $timeline->service_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Service</option>
            @foreach($services as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
