@extends('front.layouts.main')
@push('title')
  <title>{{ $pro_det->provider_name }}</title>
@endpush
@section('main-section')
  <div id="breadcrumb">
    <div class="container">
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('providers') }}">Provider ({{ $pro_det->provider_name }})</a></li>
        <li>Gallery</li>
      </ul>
    </div>
  </div>



  <main class="theia-exception">
    @include('front.provider-menu');

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-xl-8 col-lg-8">

          <div id="section_1">
            <div id="detail-title">
              <div class="container">Photo Gallery</div>
            </div>
            <div class="box_general_3 pb-3">
              <div class="row">
                @foreach ($photos as $photo)
                  <div class="col-lg-4 mb-3">
                    <a href="{{ asset($photo->photo_path) }}" class="fancybox" data-fancybox="gallery" data-caption="">
                      <img src="{{ asset($photo->photo_path) }}" alt="{{ $pro_det->provider_name }}"
                        class="img-fluid">
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <div id="section_6" class="pb-2">
            <div id="detail-title">
              <div class="container">Video Gallery</div>
            </div>
            <div class="box_general_3 pb-3">
              <div class="row">
                @foreach ($videos as $video)
                  <div class="col-lg-6 mb-3">
                    <iframe width="100%" height="220" src="{{ asset($video->video_path) }}"
                      title="YouTube video player" frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen>
                    </iframe>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

        </div>



        @include('front.right-side-bar-provider')

      </div>
    </div>

  </main>
@endsection
