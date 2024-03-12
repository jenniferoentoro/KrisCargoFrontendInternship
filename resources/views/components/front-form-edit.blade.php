{{-- reset button --}}
<div id="editDataModal" class="d-none bg-white mb-3 front-form"
    style="max-height: 400px; overflow-y: scroll; border-radius: 10px;">
    <form action="{{ route($submit_route_name) }}" method="POST" id="edit-data-form">
        <div class="modal-body">
            <h2>Edit Data</h2>
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        @if (isset($prajoa))
                            <label for="NOMOR" class="form-label"><b>NOMOR</b></label>
                            <input type="text" class="form-control" id="NOMOR" placeholder="NOMOR" name="NOMOR"
                                disabled>
                        @else
                            <label for="KODE" class="form-label"><b>KODE</b></label>
                            <input type="text" class="form-control" id="KODE" placeholder="KODE" name="KODE"
                                @if (!isset($kode_enabled)) disabled @endif>
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


            <div class="modal-footer modal-footer--sticky">
                <div class="modal-footer-buttons">
                    @if (isset($summary))
                        <button id="summaryButton" type="button" class="btn btn-primary">Summary</button>
                    @endif
                    <button id="closeModalButton2" type="button" class="btn btn-danger">Close</button>
                    <button class="btn btn-info ml-1" type="submit" id="saveData">Save<i
                            class="pl-1 fa-solid fa-pencil"></i></button>
                </div>


            </div>
        </div>


    </form>
</div>
