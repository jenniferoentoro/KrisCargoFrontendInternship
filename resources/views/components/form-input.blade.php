<div class="row">
    @foreach ($input_fields as $indexLuar => $input_field)
        <div class="col-md-6">
            <div class="mb-3">
                @if ($input_field[0] == 'number-master' && isset($input_field[12]))
                    <label for="{{ $input_field[1] }}" class="form-label"><b>{{ $input_field[3] }}</b>
                        @if ($input_field[8] == 'required')
                            <span style="color: red">*</span>
                        @endif
                    </label>
                    <div class="input-group mb-3">
                        <input data="{{ $input_field[7] }}" type="text" class="form-control number-input number"
                            id="{{ $input_field[12] }}" placeholder="{{ 'Input ' . $input_field[3] . '...' }}"
                            name="{{ $input_field[1] }}" oninput="formatNumberInput(this)"
                            aria-describedby="basic-addon2" {{ $input_field[8] }}>
                        <span style="cursor: pointer" class="input-group-text open-master-button" id="basic-addon2"
                            data-search="{{ route($input_field[4]) }}" data-search-2="{{ route($input_field[9]) }}"
                            data-theaders="{{ json_encode($input_field[5]) }}"
                            data-colshown="{{ json_encode($input_field[6]) }}"
                            data-theaders-2="{{ json_encode($input_field[10]) }}"
                            data-colshown-2="{{ json_encode($input_field[11]) }}"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                @elseif ($input_field[0] == 'textarea')
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                        @if ($input_field[4] == 'required')
                            <span style="color: red">*</span>
                        @endif
                    </label>
                    <textarea class="form-control" id="{{ $input_field[3] }}" rows="3" style="height:100%;"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}" {{ $input_field[4] }}></textarea>
                @elseif ($input_field[0] == 'dropdown' && isset($input_field[6]) && !isset($input_field[7]))
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                        @if ($input_field[4] == 'required')
                            <span style="color: red">*</span>
                        @endif
                    </label>
                    <select class="form-control dropdownselect2fix {{ $input_field[6] }}" id="{{ $input_field[5] }}"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }}>
                        @if ($input_field[4] != 'required')
                            {{-- add blank option --}}
                            <option value=""></option>
                        @else
                            {{-- add blank option --}}
                            <option value="" selected>--PLEASE SELECT--</option>
                        @endif
                        @foreach ($input_field[2] as $option_value => $option_label)
                            {{-- @if ($input_field[3] === 'AKTIF' || $input_field[3] === 'KODE_NEGARA' || $input_field[3] === 'KODE_PROVINSI' || $input_field[3] === 'KODE_KOTA' || $input_field[3] === 'KODE_GROUP') --}}
                            <option value="{{ $option_value }}">{{ $option_label }}</option>
                            {{-- @else --}}
                            {{-- <option value="{{ $option_label }}">{{ $option_label }}</option> --}}
                            {{-- @endif --}}
                        @endforeach
                    </select>
                @elseif ($input_field[0] == 'dropdown' && isset($input_field[5]) && !isset($input_field[6]))
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                        @if ($input_field[4] == 'required')
                            <span style="color: red">*</span>
                        @endif
                    </label>
                    <select class="form-control dropdownselect2fix" id="{{ $input_field[5] }}"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }}>
                        @if ($input_field[4] != 'required')
                            {{-- add blank option --}}
                            <option value=""></option>
                        @else
                            {{-- add blank option --}}
                            <option value="" selected>--PLEASE SELECT--</option>
                        @endif
                        @foreach ($input_field[2] as $option_value => $option_label)
                            {{-- @if ($input_field[3] === 'AKTIF' || $input_field[3] === 'KODE_NEGARA' || $input_field[3] === 'KODE_PROVINSI' || $input_field[3] === 'KODE_KOTA' || $input_field[3] === 'KODE_GROUP') --}}
                            <option value="{{ $option_value }}">{{ $option_label }}</option>
                            {{-- @else --}}
                            {{-- <option value="{{ $option_label }}">{{ $option_label }}</option> --}}
                            {{-- @endif --}}
                        @endforeach
                    </select>
                @elseif ($input_field[0] == 'dropdown' && isset($input_field[5]))
                    <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                        @if ($input_field[4] == 'required')
                            <span style="color: red">*</span>
                        @endif
                    </label>
                    @if (isset($input_field[14]) && $input_field[14] == 'addmore')
                        <select class="form-control dropdownselect2fix additionalInputForm {{ $input_field[12] }}"
                            id="{{ $input_field[13] }}" placeholder="{{ 'Input ' . $input_field[1] . '...' }}"
                            name="{{ $input_field[3] }}" {{ $input_field[4] }}
                            data-input-for="{{ $input_field[5] }}">
                            <!-- Use data-input-for to store the input name -->
                            @if ($input_field[4] != 'required')
                                <option value=""></option>
                            @else
                                <option value="" selected>--PLEASE SELECT--</option>
                            @endif
                            @foreach ($input_field[2] as $option_value => $option_label)
                                <option value="{{ $option_value }}">{{ $option_label }}</option>
                            @endforeach
                        </select>
                    @elseif (isset($input_field[17]) && $input_field[17] == 'EDIT')
                        <select class="form-control dropdownselect2fix additionalInputForm" id="{{ $input_field[16] }}"
                            placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                            {{ $input_field[4] }} data-input-for="{{ $input_field[5] }}">
                            <!-- Use data-input-for to store the input name -->
                            @if ($input_field[4] != 'required')
                                <option value=""></option>
                            @else
                                <option value="" selected>--PLEASE SELECT--</option>
                            @endif
                            @foreach ($input_field[2] as $option_value => $option_label)
                                <option value="{{ $option_value }}">{{ $option_label }}</option>
                            @endforeach
                        </select>
                    @else
                        <select class="form-control dropdownselect2fix additionalInputForm" id="{{ $input_field[3] }}"
                            placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                            {{ $input_field[4] }} data-input-for="{{ $input_field[5] }}">
                            <!-- Use data-input-for to store the input name -->
                            @if ($input_field[4] != 'required')
                                <option value=""></option>
                            @else
                                <option value="" selected>--PLEASE SELECT--</option>
                            @endif
                            @foreach ($input_field[2] as $option_value => $option_label)
                                <option value="{{ $option_value }}">{{ $option_label }}</option>
                            @endforeach
                        </select>
                    @endif





                    <!-- Use the input name as the ID for the additional input -->

                    @if ($input_field[3] == 'BIAYA_LAIN_INCL')
                        {{-- give a button to add more additional-input --}}
                        <div id="additionalInputsContainer" class="additional-input biayaLain-input"
                            style="display: none; margin-top: 5px;">
                            <button style="margin-top: 5px" type="button" class="btn btn-primary biaya-lain-btn"
                                id="biayaLain">+ Biaya Lain lainnya</button>
                            <br>
                        @else
                            <div class="additional-input" style="display: none; margin-top: 5px;">
                    @endif
                    @foreach ($input_field[8] as $index => $option_value)
                        <label for="{{ $input_field[7][$index] }}"
                            class="form-label"><b>{{ $input_field[9][$index] }}</b></label>
                        @if ($input_field[7][$index] == 'PPH')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control number-input number{{ $index }}"
                                    value="2" id="{{ $input_field[7][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" aria-describedby="basic-addon2"
                                    readonly="readonly">
                                <span class="input-group-text">%</span>
                            </div>
                        @elseif ($input_field[7][$index] == 'TSI')
                            <div class="input-group mb-3">
                                <input type="number" class="form-control number-input number{{ $index }}"
                                    id="{{ $input_field[7][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" aria-describedby="basic-addon2">

                                <!-- Add "HARI" on the right side -->
                                <span class="input-group-text">%</span>
                            </div>
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'dropdown')
                            @if (isset($input_field[14]) && $input_field[14] == 'addmore')
                                <select class="form-control dropdownselect2fix {{ $input_field[10][$index] }}"
                                    id="{{ $input_field[11][$index] }}" name="{{ $input_field[7][$index] }}">
                                    <option value="" selected>--PLEASE SELECT--</option>
                                    @foreach ($input_field[8][$index] as $option_value => $option_label)
                                        <option value="{{ $option_value }}">{{ $option_label }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select class="form-control dropdownselect2fix" id="{{ $input_field[7][$index] }}"
                                    name="{{ $input_field[7][$index] }}">
                                    <option value="" selected>--PLEASE SELECT--</option>
                                    @foreach ($input_field[8][$index] as $option_value => $option_label)
                                        <option value="{{ $option_value }}">{{ $option_label }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @if (isset($input_field[10]) && !isset($input_field[11][$index]))
                                <button style="margin-top: 10px" type="button"
                                    class="btn btn-primary {{ $input_field[10][$index] }}">Add New
                                    {{ $input_field[9][$index] }}</button>
                            @endif
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'number')
                            @if (isset($input_field[14]) && $input_field[14] == 'addmore')
                                <input type="text"
                                    class="form-control number-input {{ $input_field[10][$index] }}"
                                    id="{{ $input_field[11][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)" />
                            @else
                                <input type="text" class="form-control number-input"
                                    id="{{ $input_field[7][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)" />
                            @endif
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'number-normal')
                            <input type="text" class="form-control" id="{{ $input_field[7][$index] }}"
                                placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                name="{{ $input_field[7][$index] }}" />
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'number-decimal')
                            @if (isset($input_field[14]) && $input_field[14] == 'addmore')
                                <input type="text"
                                    class="form-control number-decimal {{ $input_field[10][$index] }}"
                                    id="{{ $input_field[11][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" />
                            @else
                                <input type="text" class="form-control number-decimal"
                                    id="{{ $input_field[7][$index] }}"
                                    placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                    name="{{ $input_field[7][$index] }}" />
                            @endif
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'number-master')
                            <div class="input-group mb-3">
                                @if (isset($input_field[13]) && isset($input_field[14]))
                                    @if (isset($input_field[15]))
                                        <input data="{{ $input_field[13][$index] }}" type="text"
                                            class="form-control number-input number{{ $index }}"
                                            id="{{ $input_field[15][$index] }}"
                                            placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                            name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)"
                                            aria-describedby="basic-addon2" {{ $input_field[14][$index] }}>
                                    @else
                                        <input data="{{ $input_field[13][$index] }}" type="text"
                                            class="form-control number-input number{{ $index }}"
                                            id="{{ $input_field[7][$index] }}"
                                            placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                            name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)"
                                            aria-describedby="basic-addon2" {{ $input_field[14][$index] }}>
                                    @endif
                                @elseif (isset($input_field[13]))
                                    <input data="{{ $input_field[13][$index] }}" type="text"
                                        class="form-control number-input number{{ $index }}"
                                        id="{{ $input_field[7][$index] }}"
                                        placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                        name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)"
                                        aria-describedby="basic-addon2">
                                @else
                                    <input type="text"
                                        class="form-control number-input number{{ $index }}"
                                        id="{{ $input_field[7][$index] }}"
                                        placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                        name="{{ $input_field[7][$index] }}" oninput="formatNumberInput(this)"
                                        aria-describedby="basic-addon2">
                                @endif

                                <span style="cursor: pointer" class="input-group-text open-master-button"
                                    id="basic-addon2" data-search="{{ route($input_field[10][$index]) }}"
                                    data-theaders="{{ json_encode($input_field[11][$index]) }}"
                                    data-colshown="{{ json_encode($input_field[12][$index]) }}"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                        @elseif (isset($input_field[6][$index]) && $input_field[6][$index] == 'kode-master')
                            <div class="input-group mb-3">
                                {{-- @if (isset($input_field[13]) && isset($input_field[14]))
                                    @if (isset($input_field[15]))
                                        <input data="{{ $input_field[13][$index] }}" type="text"
                                            class="form-control number-input number{{ $index }}"
                                            id="{{ $input_field[15][$index] }}"
                                            placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                            name="{{ $input_field[7][$index] }}" oninput=""
                                            aria-describedby="basic-addon2" {{ $input_field[14][$index] }}>
                                    @else
                                        <input data="{{ $input_field[13][$index] }}" type="text"
                                            class="form-control number-input number{{ $index }}"
                                            id="{{ $input_field[7][$index] }}"
                                            placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                            name="{{ $input_field[7][$index] }}" oninput=""
                                            aria-describedby="basic-addon2" {{ $input_field[14][$index] }}>
                                    @endif --}}
                                @if (isset($input_field[13]))
                                    <select data="{{ json_encode($input_field[13][$index]) }}" type="text"
                                        class="form-control additionalInputFormKode"
                                        id="{{ $input_field[7][$index] }}"
                                        placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                        name="{{ $input_field[7][$index] }}" oninput=""
                                        aria-describedby="basic-addon2"></select>
                                @else
                                    <input type="text"
                                        class="form-control number-input number{{ $index }}"
                                        id="{{ $input_field[7][$index] }}"
                                        placeholder="{{ 'Input ' . $input_field[9][$index] . '...' }}"
                                        name="{{ $input_field[7][$index] }}" oninput=""
                                        aria-describedby="basic-addon2">
                                @endif

                                <span style="cursor: pointer" class="input-group-text open-master-button"
                                    id="basic-addon2" data-search="{{ route($input_field[10][$index]) }}"
                                    data-theaders="{{ json_encode($input_field[11][$index]) }}"
                                    data-colshown="{{ json_encode($input_field[12][$index]) }}"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>

                            </div>
                            <button style="margin-top: 10px" type="button"
                                class="btn btn-primary {{ $input_field[14][$index] }}">Add New
                                {{ $input_field[9][$index] }}</button>
                        @else
                            @if (isset($input_field[14]) && $input_field[14] == 'addmore')
                                <input type="text" class="form-control {{ $input_field[10][$index] }}"
                                    id="{{ $input_field[11][$index] }}" name="{{ $input_field[7][$index] }}"
                                    placeholder="Input additional info...">
                            @else
                                <input type="text" class="form-control" id="{{ $input_field[7][$index] }}"
                                    name="{{ $input_field[7][$index] }}" placeholder="Input additional info...">
                            @endif
                        @endif
                    @endforeach
            </div>
            @if ($input_field[3] == 'CHOOSECUSTOMER')
                <div class="additional-input-lama" style="display: none; margin-top: 5px;">
                    <label for="{{ $input_field[11] }}" class="form-label"><b>{{ $input_field[13] }}</b></label>
                    <select class="form-control dropdownselect2fix" id="{{ $input_field[11] }}"
                        name="{{ $input_field[11] }}">
                        <option value="" selected>--PLEASE SELECT--</option>
                        @foreach ($input_field[12] as $option_value => $option_label)
                            <option value="{{ $option_value }}">{{ $option_label }}</option>
                        @endforeach
                    </select>

                </div>
            @endif
        @elseif ($input_field[0] == 'dropdown')
            <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            <select class="form-control dropdownselect2fix" id="{{ $input_field[3] }}"
                placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                {{ $input_field[4] }}>
                @if ($input_field[4] != 'required')
                    {{-- add blank option --}}
                    <option value=""></option>
                @else
                    <option value="" selected>--PLEASE SELECT--</option>
                @endif
                @foreach ($input_field[2] as $option_value => $option_label)
                    <option value="{{ $option_value }}">{{ $option_label }}</option>
                @endforeach
            </select>
        @elseif ($input_field[0] == 'datalist')
            <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            <input type="text" class="form-control" id="{{ $input_field[3] }}"
                placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                list="{{ $input_field[3] }}-list" {{ $input_field[4] }}>
            <datalist id="{{ $input_field[3] }}-list">
                @foreach ($input_field[2] as $option_value => $option_label)
                    <option value="{{ $option_value }}">{{ $option_label }}</option>
                @endforeach
            </datalist>
        @elseif ($input_field[0] == 'file')
            @php
                $inputId = '' . $input_field[3];
                $previewId = 'image-preview-' . $input_field[3];
                $linkPreviewId = 'link-preview-' . $input_field[3];
            @endphp
            <label for="{{ $inputId }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            <input type="file" class="form-control" id="{{ $inputId }}"
                data-preview="{{ $previewId }}" onchange="previewImage(event)"
                placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                {{ $input_field[4] }}>
            <div class="image-preview mt-2 d-flex justify-content-center" style="max-height: 200px;">
                <img id="{{ $previewId }}" src="#" alt="Image Preview" style="height: 100%; width:auto">
            </div>
            <div class="text-center link-preview">
                <a target="_blank" href="" id="{{ $linkPreviewId }}"></a>

            </div>
        @elseif ($input_field[0] == 'number')
            <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            @if ($input_field[3] == 'TOP')
                <div class="input-group mb-3">
                    <input type="text" class="form-control number-input" id="{{ $input_field[3] }}"
                        placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                        {{ $input_field[4] }} oninput="formatNumberInput(this)" />
                    <!-- Add "HARI" on the right side -->
                    <span class="input-group-text">HARI</span>
                </div>
            @else
                <input type="text" class="form-control number-input" id="{{ $input_field[3] }}"
                    placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                    {{ $input_field[4] }} oninput="formatNumberInput(this)" />
            @endif
            {{-- <input type="hidden" id="{{ $input_field[3] }}_hidden" name="{{ $input_field[3] }}_hidden" /> --}}
        @elseif ($input_field[0] == 'date')
            <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            <input type="text" class="form-control datepicker-input" id="{{ $input_field[3] }}"
                placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                {{ $input_field[4] }}>
        @else
            <label for="{{ $input_field[3] }}" class="form-label"><b>{{ $input_field[1] }}</b>
                @if ($input_field[4] == 'required')
                    <span style="color: red">*</span>
                @endif
            </label>
            @if ($input_field[3] == 'FREE_TIME_DEMURRAGE[]' || $input_field[3] == 'FREE_TIME_STORAGE[]')
                <div class="input-group mb-3">
                    <input value="5" type="{{ $input_field[0] }}" class="form-control"
                        id="{{ $input_field[5] }}" placeholder="{{ 'Input ' . $input_field[1] . '...' }}"
                        name="{{ $input_field[3] }}" {{ $input_field[4] }}>

                    <!-- Add "HARI" on the right side -->
                    <span class="input-group-text">HARI</span>
                </div>
            @else
                <input type="{{ $input_field[0] }}" class="form-control" id="{{ $input_field[3] }}"
                    placeholder="{{ 'Input ' . $input_field[1] . '...' }}" name="{{ $input_field[3] }}"
                    {{ $input_field[4] }}>
            @endif
    @endif
</div>
</div>

@if (($indexLuar + 1) % 2 == 0)
    </div>
    <div class="row">
@endif
@endforeach
</div>
