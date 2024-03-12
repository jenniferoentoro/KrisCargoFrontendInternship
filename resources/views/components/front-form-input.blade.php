{{-- reset button --}}
<div id="addDataModal" class="d-none bg-white mb-3 front-form"
    style="max-height: 400px; overflow-y: scroll; border-radius: 10px;">
    <form action="{{ route($submit_route_name) }}" method="POST" class="add-data-form">
        <div class="modal-body">
            <h2>Add Data</h2>
            <div class="d-flex justify-content-end mb-3">
                <button id="resetButton" type="button" class="btn btn-danger">Reset</button>
            </div>
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
                    <button id="closeModalButton" type="button" class="btn btn-danger">Close</button>
                    <button class="btn btn-success ml-1" type="submit" id="saveData">Save<i
                            class="pl-1 fa-solid fa-plus"></i></button>
                </div>


            </div>
        </div>


    </form>
</div>
