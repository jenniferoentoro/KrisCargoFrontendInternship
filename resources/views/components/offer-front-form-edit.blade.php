<div id="editDataModal" class="d-none bg-white mb-3" style="max-height: 400px; overflow-y: scroll; border-radius: 10px;">
    <form action="{{ route($submit_route_name) }}" method="POST" id="edit-data-form" class="edit-data-form">
        <div class="modal-body">
            <h2>Edit Data</h2>

            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="KODE" class="form-label"><b>KODE</b></label>
                        <input type="text" class="form-control" id="addKode" placeholder="KODE" name="KODE"
                            @if (!isset($kode_enabled)) disabled @endif>
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

                @if ($group == 'Detail Quotation')
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-xl font-bold">{{ $group }}</h4>
                        <button id="addNewDetailEdit" type="button" class="btn btn-success">Add New Detail</button>
                    </div>
                @else
                    <h4 class="text-xl font-bold">{{ $group }}</h4>
                @endif

                <div id="div{{ str_replace(' ', '', $group) }}edit">

                    @include('components.form-input', [
                        'input_fields' => $fields,
                    ])

                    @php
                        $i++;
                    @endphp

                </div>
            @endforeach


            <div class="modal-footer modal-footer--sticky">
                <div class="modal-footer-buttons">
                    <button id="closeModalButton2" type="button" class="btn btn-danger">Close</button>
                    <button class="btn btn-info ml-1" type="submit" id="editData">Save<i
                            class="pl-1 fa-solid fa-pencil"></i></button>
                </div>


            </div>
        </div>


    </form>
</div>
