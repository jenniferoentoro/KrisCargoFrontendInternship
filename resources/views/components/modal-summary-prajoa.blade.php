<div>
    <div id="summaryModal" class="modal">
        <div class="modal-content animate__animated">
            <div class="modal-header">
                <h3 class="text-2xl font-bold">Summary</h3>
                <button id="closeSummary" type="button" class="close" aria-label="Close"
                    style="font-size: 24px; padding: 8px;">
                    <span aria-hidden="true" style="">&times;</span>
                </button>
            </div>

            {{-- reset button --}}
            <div class="modal-body">

                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>SEAL</b></label>
                            <input type="text" class="form-control" id="s-seal" placeholder="SEAL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>OCEAN FREIGHT</b></label>
                            <input type="text" class="form-control" id="s-ocean-freight" placeholder="OCEAN FRIEGHT"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>OPS</b></label>
                            <input type="text" class="form-control" id="s-ops" placeholder="OPS" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>FREIGHT SURCHARGE</b></label>
                            <input type="text" class="form-control" id="s-freight-surcharge"
                                placeholder="FREIGHT SURCHARGE" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>KARANTINA</b></label>
                            <input type="text" class="form-control" id="s-karantina" placeholder="KARANTINA"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>THC POL</b></label>
                            <input type="text" class="form-control" id="s-thc-pol" placeholder="THC POL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>CASHBACK</b></label>
                            <input type="text" class="form-control" id="s-cashback" placeholder="CASHBACK" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>LOLO POL</b></label>
                            <input type="text" class="form-control" id="s-lolo-pol" placeholder="LOLO POL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>CLAIM</b></label>
                            <input type="text" class="form-control" id="s-claim" placeholder="CLAIM" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>THC POD</b></label>
                            <input type="text" class="form-control" id="s-thc-pod" placeholder="THC POD" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>ASURANSI</b></label>
                            <input type="text" class="form-control" id="s-asuransi" placeholder="ASURANSI" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>LOLO POD</b></label>
                            <input type="text" class="form-control" id="s-lolo-pod" placeholder="LOLO POD" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>LAIN-LAIN</b></label>
                            <input type="text" class="form-control" id="s-lain-lain" placeholder="LAIN-LAIN"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>BL</b></label>
                            <input type="text" class="form-control" id="s-bl" placeholder="BL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>DO</b></label>
                            <input type="text" class="form-control" id="s-do" placeholder="DO" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>JPT/FEE AGENT POL</b></label>
                            <input type="text" class="form-control" id="s-jpt-pol"
                                placeholder="JPT/FEE AGENT POL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>APBS</b></label>
                            <input type="text" class="form-control" id="s-apbs" placeholder="APBS" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>TRUCK MUAT</b></label>
                            <input type="text" class="form-control" id="s-truck-muat" placeholder="TRUCK MUAT"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>CLEANING</b></label>
                            <input type="text" class="form-control" id="s-cleaning" placeholder="CLEANING"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>BURUH MUAT</b></label>
                            <input type="text" class="form-control" id="s-buruh-muat" placeholder="BURUH MUAT"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>ADMIN/DOC</b></label>
                            <input type="text" class="form-control" id="s-admin" placeholder="ADMIN/DOC"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>TOESLAG</b></label>
                            <input type="text" class="form-control" id="s-toeslag" placeholder="TOESLAG"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>JPT/FEE AGENT POD</b></label>
                            <input type="text" class="form-control" id="s-jpt-pod"
                                placeholder="JPT/FEE AGENT POD" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>REWORK</b></label>
                            <input type="text" class="form-control" id="s-rework" placeholder="REWORK" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>TRUCK BONGKAR</b></label>
                            <input type="text" class="form-control" id="s-truck-bongkar"
                                placeholder="TRUCK BONGKAR" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>ALAT BERAT POL</b></label>
                            <input type="text" class="form-control" id="s-alat-berat-pol"
                                placeholder="ALAT BERAT POL" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>BURUH STRIPPING</b></label>
                            <input type="text" class="form-control" id="s-buruh-stripping"
                                placeholder="BURUH STRIPPING" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>ALAT BERAT POD</b></label>
                            <input type="text" class="form-control" id="s-alat-berat-pod"
                                placeholder="ALAT BERAT POD" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><b>BURUH BONGKAR</b></label>
                            <input type="text" class="form-control" id="s-buruh-bongkar"
                                placeholder="BURUH BONGKAR" disabled>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>TOTAL COST</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-total-cost" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>TRUCK POL</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-total-truck-pol" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>FREIGHT</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-total-freight" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>TRUCK POD</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-total-truck-pod" disabled>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>HARGA JUAL</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-harga-jual" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>EST. MARGIN</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-est-margin" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="" class="col-form-label"><b>PERSENTASE</b></label>

                    </div>
                    <div class="col-sm-12 d-flex align-items-center">
                        <input type="text" class="form-control" id="s-persentase" disabled>
                    </div>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <div class="modal-footer-buttons">
                        <button type="button" id="closeSummary2" class="btn btn-danger">Close</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
