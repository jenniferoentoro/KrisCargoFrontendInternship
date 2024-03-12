@extends('layouts.app')

@section('title', 'Slide')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <br/>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center;">Slide</h1>
                <div style="margin-top: 15px;">{{ Breadcrumbs::render('slide') }}</div>
                
            </div>
        </div>
        <div class="row justify-content-center">
            
            @include('components.form-input', [
                'input_fields' => [
                    ['text', 'Judul', [], 'title'],
                    ['text', 'Deskripsi', [], 'description'],
                    ['text', 'Link', [], 'link'],
                    ['file', 'Gambar3', [], 'image'],
                ],
                'form_data' => isset($slide) ? $slide : null,
                // 'form_action' => isset($slide) ? route('slide.update', $slide->id) : route('slide.store'),
                'form_method' => isset($slide) ? 'PUT' : 'POST',
                'submit_button_label' => isset($slide) ? 'Update' : 'Create'
            ])
            @include('components.form-input', [
                'input_fields' => [
                    ['text', 'Judul', [], 'title'],
                    ['text', 'Deskripsi', [], 'description'],
                    ['text', 'Link', [], 'link'],
                    ['file', 'Gambar', [], 'image'],
                ],
                'form_data' => isset($slide) ? $slide : null,
                // 'form_action' => isset($slide) ? route('slide.update', $slide->id) : route('slide.store'),
                'form_method' => isset($slide) ? 'PUT' : 'POST',
                'submit_button_label' => isset($slide) ? 'Update' : 'Create'
            ])

            @include('components.form-input', [
                'input_fields' => [
                    ['text', 'Judul', [], 'title'],
                    ['text', 'Deskripsi', [], 'description'],
                    ['text', 'Link', [], 'link'],
                    ['file', 'Gambar2', [], 'image'],
                ],
                'form_data' => isset($slide) ? $slide : null,
                // 'form_action' => isset($slide) ? route('slide.update', $slide->id) : route('slide.store'),
                'form_method' => isset($slide) ? 'PUT' : 'POST',
                'submit_button_label' => isset($slide) ? 'Update' : 'Create'
            ])
            
        
        </div>
    
    </div>
    </div>



           
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
