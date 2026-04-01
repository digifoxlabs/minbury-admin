@php
    $shipping_addresses = collect(old('shipping_addresses', isset($contact) ? $contact->shippingAddresses->map(function ($address) {
        return [
            'label' => $address->label,
            'shipping_address' => $address->shipping_address,
            'position' => $address->position,
            'is_default' => $address->is_default,
        ];
    })->toArray() : []));

    if ($shipping_addresses->isEmpty() && !empty(old('shipping_address'))) {
        $shipping_addresses = collect([
            [
                'label' => 'Default',
                'shipping_address' => old('shipping_address'),
                'position' => old('position'),
                'is_default' => true,
            ],
        ]);
    }

    if ($shipping_addresses->isEmpty() && !empty($contact) && !empty($contact->shipping_address)) {
        $shipping_addresses = collect([
            [
                'label' => 'Default',
                'shipping_address' => $contact->shipping_address,
                'position' => $contact->position,
                'is_default' => true,
            ],
        ]);
    }

    if ($shipping_addresses->isEmpty()) {
        $shipping_addresses = collect([
            [
                'label' => 'Default',
                'shipping_address' => null,
                'is_default' => true,
            ],
        ]);
    }

    $default_shipping_index = old('shipping_addresses_default');
    if ($default_shipping_index === null) {
        $default_shipping_index = $shipping_addresses->search(function ($address) {
            return !empty($address['is_default']);
        });
        $default_shipping_index = $default_shipping_index === false ? 0 : $default_shipping_index;
    }
@endphp

<div class="col-md-12 shipping_addr_div"><hr></div>
<div class="col-md-12 shipping_addr_div">
    <div class="clearfix mb-10">
        <strong>{{ __('lang_v1.shipping_address') }}</strong>
        <button type="button" class="btn btn-xs btn-primary add_shipping_address_row pull-right">@lang('messages.add')</button>
    </div>

    <div class="contact_shipping_addresses" data-next-index="{{ $shipping_addresses->count() }}">
        @foreach($shipping_addresses->values() as $index => $shipping_address)
            <div class="row contact_shipping_address_row mb-10">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label("shipping_addresses_{$index}_label", 'Label:') !!}
                        {!! Form::text("shipping_addresses[{$index}][label]", $shipping_address['label'] ?? null, ['class' => 'form-control', 'placeholder' => 'Home / Office / Warehouse']) !!}
                        {!! Form::hidden("shipping_addresses[{$index}][position]", $shipping_address['position'] ?? null, ['class' => 'shipping_address_position']) !!}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        {!! Form::label("shipping_addresses_{$index}_address", __('lang_v1.shipping_address') . ':') !!}
                        {!! Form::textarea("shipping_addresses[{$index}][shipping_address]", $shipping_address['shipping_address'] ?? null, ['class' => 'form-control shipping_address_value', 'rows' => 2, 'placeholder' => __('lang_v1.shipping_address')]) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="margin-top: 25px;">
                        <div class="radio">
                            <label>
                                <input type="radio" name="shipping_addresses_default" value="{{ $index }}" @checked((string) $default_shipping_index === (string) $index)>
                                Default
                            </label>
                        </div>
                        <button type="button" class="btn btn-xs btn-danger remove_shipping_address_row">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
