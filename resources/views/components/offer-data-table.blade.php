<div class="row justify-content-center" id="liteTable">
    <div class="col-12 p-3" style="border-radius: 10px; background-color: #ffffff;">
        <table class="table rounded rounded-3 overflow-hidden w-100" id="clueList" style="border-radius: 5px;">
            <thead class="" style="background: #800000; color: white !important;">
                <tr>
                    @foreach ($columns as $column)
                        <th class="text-white">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="border-bottom" id="{{ $item['KODE'] }}">
                        <td class="edit-column d-flex">
                            <button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-{{ $item['KODE'] }}"><i
                                    class="fa-solid fa-pen-to-square"></i></button>
                            
                            <a href="{{ route('penawaran.viewInvoice', ['KODE' => $item['KODE']]) }}" target="_blank" class="btn btn-warning btn-sm mr-1 btn-view" id="view-{{ $item['KODE'] }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            
                            
                            <button class="btn btn-danger btn-sm btn-delete" id="delete-{{ $item['KODE'] }}"><i
                                    class="fa-solid fa-trash"></i></button>
                        </td>
                        {{-- for each keys --}}
                        @foreach ($keys as $key)
                            @if ($key === 'AKTIF')
                                <td>{{ $item[$key] == 0 ? 'T' : 'Y' }}</td>
                            @else
                                <td>{{ $item[$key] }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
