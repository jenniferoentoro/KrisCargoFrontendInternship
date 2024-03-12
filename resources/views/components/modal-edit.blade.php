<div id="editDataModal" class="modal">
    <div class="modal-content animate__animated ">
        <div class="modal-header">
            <h3 class="text-2xl font-bold">Edit Data</h3>
            <button id="closemodalButton2" type="button" class="close closemodal" aria-label="Close"
                style="font-size: 24px; padding: 8px;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route($submit_route_name) }}" method="POST" id="edit-data-form">
            <div class="modal-body">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            @if (isset($prajoa))
                                <label for="NOMOR" class="form-label"><b>NOMOR</b></label>
                                <input type="text" class="form-control" id="NOMOR" placeholder="NOMOR"
                                    name="NOMOR" disabled>
                            @else
                                <label for="KODE" class="form-label"><b>KODE</b></label>
                                <input type="text" class="form-control" id="KODE" placeholder="KODE"
                                    name="KODE" @if (!isset($kode_enabled)) disabled @endif>
                            @endif
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

                @if (isset($reset_password))
                    <button class="btn btn-warning btn-sm mr-1" id="btn-reset" type="button"><i
                            class="fa-solid fa-arrow-rotate-left"></i> Reset Password</button>
                @endif
            </div>
            <div class="modal-footer modal-footer--sticky">
                <div class="modal-footer-buttons">
                    <button id="closeModalButton2" type="button" class="btn btn-danger closemodal">Close</button>
                    <button class="btn btn-info ml-1" id="editData" type="submit">Save<i
                            class="pl-1 fa-solid fa-pencil"></i></button>
                </div>

            </div>
        </form>
    </div>
</div>
