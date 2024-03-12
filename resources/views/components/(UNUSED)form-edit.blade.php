<div class="row">
    @foreach ($input_fields as $index => $input_field)
        <div class="col-md-6">
            <div class="mb-3">
                @if ($input_field[0] == 'textarea')
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b></label>
                    <textarea class="form-control" id="{{ $input_field[3] }}" rows="3" style="height:100%;"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}" {{ $input_field[4] }}></textarea>
                @elseif ($input_field[0] == 'dropdown')
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b></label>
                    <select class="form-control" id="{{ $input_field[3] }}"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }}>
                        @foreach ($input_field[2] as $option_value => $option_label)
                            @if (
                                $input_field[3] === 'AKTIF' ||
                                    $input_field[3] === 'KODE_NEGARA' ||
                                    $input_field[3] === 'KODE_PROVINSI' ||
                                    $input_field[3] === 'KODE_KOTA')
                                <option value="{{ $option_value }}">{{ $option_label }}</option>
                            @else
                                <option value="{{ $option_label }}">{{ $option_label }}</option>
                            @endif
                        @endforeach
                    </select>
                @elseif ($input_field[0] == 'file')
                    @php
                        $inputId = '' . $input_field[1];
                        $previewId = 'image-preview-' . $input_field[1];
                    @endphp
                    <label for="{{ $inputId }}" class="form-label"><b>{{ $input_field[1] }}</b></label>
                    <input type="file" class="form-control" id="{{ $inputId }}"
                        data-preview="{{ $previewId }}" onchange="previewImage(event)"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }}>
                    <div class="image-preview" style="max-height: 200px;">
                        <img id="{{ $previewId }}" src="#" alt="Image Preview"
                            style="height: 100%; width:auto">
                    </div>
                @else
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b></label>
                    <input type="{{ $input_field[0] }}" class="form-control" id="{{ $input_field[3] }}"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }}>
                @endif
            </div>
        </div>

        @if (($index + 1) % 2 == 0)
</div>
<div class="row">
    @endif
    @endforeach
</div>
