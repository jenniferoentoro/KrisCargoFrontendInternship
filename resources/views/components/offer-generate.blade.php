<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<style type="text/css" media="print">
    @page {
        size: a4;
        margin: 0mm;
    }
    hr {
  border-top: solid 1px #000 !important;
}

    .no-border {
        border: none;
    }
    body {
    font-family: Arial, sans-serif;
    -webkit-print-color-adjust: exact;
    font-size: 12px;
    font-weight: normal;
}

        .tablefont{
            font-size:10px !important
        }
      
</style>
<body>

    <div class="container-fluid">
        <div  style=" margin-right:10px">
        <div class="row" style="margin-top: 20px">
            <div class="col-12" >
                {{-- <button onclick="generateAndDownloadPDF()" style="float: right" class="btn btn-warning btn-sm mr-1 btn-generate" id="generate-{{ $data['KODE'] }}">
                    Download PDF
                </button>
                <a style="float: right" href="{{ route('penawaran.generateInvoice', ['KODE' => $data['KODE']]) }}" class="btn btn-warning btn-sm mr-1 btn-generate" id="generate-{{ $data['KODE'] }}">
                    Download PDF
                </a> --}}
            </div>
        </div>
        <div class="row align-items-end" style="margin-top: 20px;">
            <div class="col-8">
                <h5>PENAWARAN HARGA</h5>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <img style="height: 36px;" src="{{ URL('images/logo3.png') }}" alt="My image">
            </div>
        </div>   
        <div class="row" style="margin-top: 40px">
            <div class="col-3">
                <p class="mb-0">No. Penawaran</p>
                <p class="mb-0">Tgl. Penawaran</p>
                <p class="mb-0">Rate Status</p>
                <p class="mb-0">Sales</p>
            </div>
            <div class="col-5">
                <p class="mb-0" >: {{ $data['KODE'] }}</p>
                <p class="mb-0">: {{ $data['TANGGAL'] }}</p>
                <p class="mb-0">: {{ $data['RATE_STATUS'] }}</p>
                <p class="mb-0">: {{ $data['NAMA_STAFF'] ." - ". $data['NO_HP_STAFF']}}</p>
            </div>
            <div class="col-4">
                <p class="mb-0" >Kepada Yth</p>
                <p class="mb-0"><b>{{ $data['NAMA_CUSTOMER'] }}</b></p>
                @if($data['HP_CUSTOMER'] != null && $data['HP_CUSTOMER'] != "" && $data['HP_CUSTOMER'] != "-" && $data['CONTACT_PERSON_1'] != null && $data['CONTACT_PERSON_1'] != "" && $data['CONTACT_PERSON_1'] != "-")
                <p class="mb-0">{{ "Up ".$data['CONTACT_PERSON_1'] }} - {{ $data['HP_CUSTOMER'] }}</p>
                @elseif ($data['TELP_CUSTOMER'] == null && $data['TELP_CUSTOMER'] == "" && $data['TELP_CUSTOMER'] == "-" && $data['CONTACT_PERSON_1'] != null && $data['CONTACT_PERSON_1'] != "" && $data['CONTACT_PERSON_1'] != "-")
                <p class="mb-0">{{ "Up ".$data['CONTACT_PERSON_1'] }} - {{ $data['TELP_CUSTOMER'] }}</p>
                @elseif($data['HP_CUSTOMER'] != null && $data['HP_CUSTOMER'] != "" && $data['HP_CUSTOMER'] != "-")
                <p class="mb-0">{{ $data['HP_CUSTOMER'] }}</p>
                @elseif ($data['TELP_CUSTOMER'] == null && $data['TELP_CUSTOMER'] == "" && $data['TELP_CUSTOMER'] == "-")
                <p class="mb-0">{{ $data['TELP_CUSTOMER'] }}</p>
                @endif
                @if(!empty($data['EMAIL_CUSTOMER']) && $data['EMAIL_CUSTOMER'] != null && $data['EMAIL_CUSTOMER'] != "" && $data['EMAIL_CUSTOMER'] != "-")
                <p class="mb-0">{{ $data['EMAIL_CUSTOMER'] }}</p>
                @endif
            </div>
        </div>    

        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <p>Berikut kami sampaikan penawaran harga :</p>
            </div>
        </div>
        <div class="row tablefont" style="margin-left: 20px;">
            <div class="col-12">
                <div class="row pr-0 pl-0 pt-2 pb-2" style="background-color: #fff3cd;">
                    <div style="" class="col-1 d-flex justify-content-center align-items-center">
                        <b>NO</b>
                    </div>
                    <div  class="col-3">
                        <b>RUTE</b>
                    </div>
                    <div style="text-align:center" class="col d-flex justify-content-center align-items-center">
                        <b>CONT</b>
                    </div>
                    <div style="text-align:center" class="col d-flex justify-content-center align-items-center">
                        <b>TERM</b>
                    </div>
                    <div style="text-align:center" class="col d-flex justify-content-center align-items-center">
                        <b>STO</b>
                    </div>
                    <div style="text-align:center" class="col d-flex justify-content-center align-items-center">
                        <b>DEM</b>
                    </div>
                    <div style="text-align:center" class="col d-flex justify-content-center align-items-center">
                        <b>COMMODITY</b>
                    </div>
                    <div style="text-align:center" class="col-2 d-flex justify-content-center align-items-center">
                        <b>HARGA</b>
                    </div>
                </div>

                @foreach ($data['offer_details'] as $detail)
                
                <div class="row" style="margin-top: 5px">
                    <div style="text-align:center" class="col-1">
                        <p class="mb-0">{{ $loop->iteration }}</p>
                    </div>
                    <div  class="col-3">
                        <p class="mb-0">{{ $detail['RUTE'] }}</p>
                    </div>
                    <div style="text-align:center" class="col">
                        <p class="mb-0">{{ $detail['NAMA_UK_KONTAINER']}}</p>
                    </div>
                    <div style="text-align:center" class="col">
                        <p class="mb-0">{{ $detail['NAMA_SERVICE'] }}</p>
                    </div>
                    <div style="text-align:center" class="col">
                        <p class="mb-0">{{ $detail['FREE_TIME_STORAGE'] }}</p>
                    </div>
                    <div style="text-align:center" class="col">
                        <p class="mb-0">{{ $detail['FREE_TIME_DEMURRAGE'] }}</p>
                    </div>
                    <div style="text-align:center" class="col">
                        <p class="mb-0">{{ $detail['NAMA_COMMODITY'] }}</p>
                    </div>
                    <div style="text-align:center" class="col-2">
                        <p class="mb-0">{{ $detail['HARGA'] . " / ".$detail['SATUAN_HARGA']}}</p>
                    </div>
                </div>
            
                
                
                
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-4">
                        @if ($detail['STUFFING'] != "-" )
                            <p class="mb-0">Stuffing - {{ $detail['STUFFING'] }}</p>
                        
                        @endif
                        @if ($detail['STRIPPING'] != "-" )
                            <p class="mb-0">Stuffing - {{ $detail['STRIPPING'] }}</p>
                        @endif
                    </div>
                    <div class="col-4">
                        @if ($detail['BURUH_MUAT'] != "EXCL")
                            <p class="mb-0">Buruh Muat - {{ $detail['BURUH_MUAT'] }}</p>
                        @endif
                        @if ($detail['BURUH_SALIN'] != "EXCL")
                            <p class="mb-0">Buruh Salin - {{ $detail['BURUH_SALIN'] . "(" . $detail['BURUH_SALIN_KET'] . ")" }}</p>
                            
                        @endif
                        @if ($detail['BURUH_BONGKAR'] != "EXCL")
                            <p class="mb-0">Buruh Bongkar - {{ $detail['BURUH_BONGKAR'] . "(" . $detail['BURUH_MUAT_KET'] . ")" }}</p>
                        @endif
                    </div>
                    
                </div>
                <hr>
                @endforeach
                <div class="row" style="margin-top: 20px">
                    <div style="text-align:center" class="col-1">
                    </div>
                    <div  class="col-2">
                    </div>
                    <div style="text-align:center" class="col">
                    </div>
                    <div style="text-align:center" class="col">
                    </div>
                    <div style="text-align:center" class="col">
                    </div>
                    <div style="text-align:center" class="col">
                    </div>
                    <div style="text-align:center" class="col">
                    </div>
                    <div style="text-align:center" class="col">
                        <div class="col" ><b>incl PPN 11%</b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p style="float: right; margin-right: 10px"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                {{-- @if()
                <p></p> --}}
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-12">
                <p class="mb-0"><b>SYARAT & KETENTUAN :</b></p>
                <p class="mb-0">*{{ $data['RATE_STATUS'] }} mengikuti perubahan dari Pelayaran</p>
                <p class="mb-0">* Harap Konfirmasi saat melakukan Stuffing Cargo</p>
                <p class="mb-0">* Pembayaran {{ $data['PAYMENT'] . " ".$data['TOP'] ." ". $data['KETERANGAN_TOP']}}</p>
                @if($data['KETERANGAN_TAMBAHAN'] != null)
                <p class="mb-0">* {{ $data['KETERANGAN_TAMBAHAN'] }}</p>
                
                @endif
            </div>
        </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function generateAndDownloadPDF() {
            // Hide the download button to prevent unnecessary clicks
            const downloadButton = document.querySelector('button');
            downloadButton.style.display = 'none';

            // Trigger the PDF generation using window.print()
            window.print();

            // Show the download button after the print dialog is closed
            window.onafterprint = function () {
                downloadButton.style.display = 'block';
            };
        }
    </script>
</body>
</html>
