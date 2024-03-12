<div>
    <div id="addnewValueModal" class="modal addnewValueModal {{ $idunique }}">
        <div class="modal-content animate__animated">
            <div class="modal-header">
                <h3 class="text-2xl font-bold">Add Data</h3>
                <button type="button" class="close closeModalValues close{{ $idunique }}" aria-label="Close"
                    style="font-size: 24px; padding: 8px;">
                    <span aria-hidden="true" style="">&times;</span>
                </button>
            </div>

            {{-- reset button --}}
            <form action="{{ route($submit_route_name) }}" data="{{ $idunique }}" method="POST"
                class="add-data-form addData{{ $idunique }}">
                <div class="modal-body">
                    <div class="d-flex justify-content-end mb-3">
                        {{-- <button type="button" class="btn btn-danger" id="reset{{$idunique}}Button"></button>Reset</button> --}}
                        <button id="reset{{ $idunique }}" type="button" class="btn btn-danger">Reset</button>
                    </div>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="KODE" class="form-label"><b>KODE</b></label>
                                <input type="text" class="form-control addKodeValue{{ $idunique }}"
                                    id="" placeholder="KODE" name="KODE" disabled>
                            </div>
                        </div>
                    </div>

                    <hr>


                    @php
                        $i = 0;
                    @endphp

                    @foreach ($input_fields as $group => $fields)
                        @if ($i > 0)
                            <hr>
                        @endif

                        <h4 class="text-xl font-bold">{{ $group }}</h4>

                        @include('components.form-input', [
                            'input_fields' => $fields,
                        ])

                        @php
                            $i++;
                        @endphp
                    @endforeach



                </div>
                <div class="modal-footer modal-footer--sticky">
                    <div class="modal-footer-buttons">
                        <button type="button" class="btn btn-danger close{{ $idunique }}">Close</button>
                        <button class="btn btn-success ml-1" type="submit" id="saveDataValue">Save</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
