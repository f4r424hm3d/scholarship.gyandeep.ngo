@extends('front.layouts.main')
@push('title')
  <title>{{ ucwords($row->title) }} - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a target="_top" href="{{ url('/events') }}">Events</a></li>
          <li>{{ ucwords($row->title) }}</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-1"></div>

        <div class="col-lg-10">
          <div class="strip_list fadeIn">

            <div class="row">

              <div class="col-md-8">
                <img src="{{ asset($row->image_path) }}" class="img-fluid" alt="{{ ucwords($row->title) }}">
                <div class="row d-flex align-items-center mt-3 mb-2 border-bottom pb-3">
                  <div class="col-md-8">
                    <div class="wrapper pb-0">
                      <h6>{{ ucwords($row->title) }}</h6>
                    </div>
                  </div>
                  <div class="col-md-4">
                    @if ($row->video_link != null)
                      <a href="#MyModal" class="btn_1 text-center pt-3 pb-3 w-100 event-popup-btn">Watch Video</a>
                    @endif
                  </div>
                </div>

                <div class="row event-strip mb-4 d-flex align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <img src="{{ asset($row->image_path) }}" class="event-thumb" alt="{{ ucwords($row->title) }}">
                    <div class="name">{{ ucwords($row->post_by) }}<br>
                      <span>{{ getFormattedDate($row->event_date, 'd , M Y') }}&nbsp; <br>
                        {{ getFormattedDate($row->time_start, 'h:i A') }} -
                        {{ getFormattedDate($row->time_end, 'h:i A') }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="event-social d-flex align-items-center">
                      {{-- <div class="share"><span>2.9K</span><br><b>SHARES</b></div>
                      <a href="#" class="fb"><i class="social_facebook"></i></a>
                      <a href="#" class="twit"><i class="social_twitter"></i></a>
                      <a href="#" class="linkd"><i class="social_linkedin"></i></a>
                      <a href="#" class="yt"><i class="social_youtube"></i></a>
                      <a href="#" class="insta"><i class="social_instagram"></i></a> --}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="wrapper pb-0 text-justify">
                      {!! $row->description !!}
                    </div>
                  </div>

                </div>

              </div>

              <div class="col-lg-4">
                <img src="{{ url('/front/') }}/img/ieltsAd.jpg" class="img-fluid" alt="ads">
                <a target="_blank" href="{{ url('/scholarships') }}" class="btn_1 text-center pt-3 pb-3 w-100 mt-2 mb-3"
                  style="color:#fff!important;">Apply Now For
                  Scholarship</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- The Modal -->
  <div class="custom-model-main">
    <div class="custom-model-inner">
      <div class="close-btn">×</div>
      <div class="custom-model-wrap">
        <div class="pop-up-content-wrap">
          <iframe width="100%" height="315" src="{{ $row->video_link }}" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="bg-overlay"></div>
  </div>
  <script>
    $(".event-popup-btn").on('click', function() {
      $(".custom-model-main").addClass('model-open');
    });
    $(".close-btn, .bg-overlay").click(function() {
      $(".custom-model-main").removeClass('model-open');
    });
  </script>
@endsection
