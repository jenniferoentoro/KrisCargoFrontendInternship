<div class="row justify-content-center" id="advanceTable">
    <div class="col-12 p-3" style="border-radius: 10px; background-color: #ffffff;">
        <table class="table rounded rounded-3 overflow-hidden w-100" id="advanceList" style="border-radius: 5px; ">
            <thead class="text-center" style="background: #800000; color: white !important; ">

                <tr>
                    @foreach ($columns as $column)
                        <th class="text-white">
                            {{ $column }}
                        </th>
                    @endforeach


                </tr>
            </thead>
            <tbody class="text-center">

                @foreach ($data as $item)
                    <tr class="border-bottom">
                        <td class="edit-column d-flex">
                            <button class="btn btn-info btn-sm mr-1 btn-edit" id="edit2-{{ $item['KODE'] }}"><i
                                    class="fa-solid fa-pen-to-square"></i></button>


                            <button class="btn btn-danger btn-sm btn-delete" id="delete2-{{ $item['KODE'] }}"><i
                                    class="fa-solid fa-trash"></i></button>
                            {{-- <button class="btn btn-danger btn-sm btn-delete" data-itemid="{{ $item['KODE'] }}"><i class="fa-solid fa-trash"></i></button> --}}

                        </td>
                        {{-- for each keys --}}
                        @foreach ($keys as $key)
                            <td>{{ $item[$key] }}</td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
