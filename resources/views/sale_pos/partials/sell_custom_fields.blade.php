@php
    $custom_labels = json_decode(session('business.custom_labels'), true);

    $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';
    $is_custom_field_1_required = !empty($custom_labels['sell']['is_custom_field_1_required']) && $custom_labels['sell']['is_custom_field_1_required'] == 1 ? true : false;

    $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';
    $is_custom_field_2_required = !empty($custom_labels['sell']['is_custom_field_2_required']) && $custom_labels['sell']['is_custom_field_2_required'] == 1 ? true : false;

    $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';
    $is_custom_field_3_required = !empty($custom_labels['sell']['is_custom_field_3_required']) && $custom_labels['sell']['is_custom_field_3_required'] == 1 ? true : false;

    $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
    $is_custom_field_4_required = !empty($custom_labels['sell']['is_custom_field_4_required']) && $custom_labels['sell']['is_custom_field_4_required'] == 1 ? true : false;
@endphp

@if(!empty($custom_field_1_label) || !empty($custom_field_2_label) || !empty($custom_field_3_label) || !empty($custom_field_4_label))
    <div class="row mb-12">
        <div class="col-md-12 tw-pt-0 tw-mb-14">
            <div class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-p-4">
                <div class="row">
                    @if(!empty($custom_field_1_label))
                        @php
                            $label_1 = $custom_field_1_label . ':';
                            if ($is_custom_field_1_required) {
                                $label_1 .= '*';
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('custom_field_1', $label_1) !!}
                                {!! Form::text('custom_field_1', !empty($transaction) ? $transaction->custom_field_1 : null, ['class' => 'form-control', 'placeholder' => $custom_field_1_label, 'required' => $is_custom_field_1_required]) !!}
                            </div>
                        </div>
                    @endif

                    @if(!empty($custom_field_2_label))
                        @php
                            $label_2 = $custom_field_2_label . ':';
                            if ($is_custom_field_2_required) {
                                $label_2 .= '*';
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('custom_field_2', $label_2) !!}
                                {!! Form::text('custom_field_2', !empty($transaction) ? $transaction->custom_field_2 : null, ['class' => 'form-control', 'placeholder' => $custom_field_2_label, 'required' => $is_custom_field_2_required]) !!}
                            </div>
                        </div>
                    @endif

                    @if(!empty($custom_field_3_label))
                        @php
                            $label_3 = $custom_field_3_label . ':';
                            if ($is_custom_field_3_required) {
                                $label_3 .= '*';
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('custom_field_3', $label_3) !!}
                                {!! Form::text('custom_field_3', !empty($transaction) ? $transaction->custom_field_3 : null, ['class' => 'form-control', 'placeholder' => $custom_field_3_label, 'required' => $is_custom_field_3_required]) !!}
                            </div>
                        </div>
                    @endif

                    @if(!empty($custom_field_4_label))
                        @php
                            $label_4 = $custom_field_4_label . ':';
                            if ($is_custom_field_4_required) {
                                $label_4 .= '*';
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('custom_field_4', $label_4) !!}
                                {!! Form::text('custom_field_4', !empty($transaction) ? $transaction->custom_field_4 : null, ['class' => 'form-control', 'placeholder' => $custom_field_4_label, 'required' => $is_custom_field_4_required]) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
