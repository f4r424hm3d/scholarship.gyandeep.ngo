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
        <li>Faqs</li>
      </ul>
    </div>
  </div>



  <main class="theia-exception">
    @include('front.provider-menu');

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-xl-8 col-lg-8">

          <div id="section_7" class="pb-2">
            <div id="detail-title">
              <div class="container">Faqs</div>
            </div>
            <div class="box_general_3 p-3">
              <div role="tablist" class="accordion" id="payment">
                @foreach ($faqs as $faq)
                  <div class="card">
                    <div class="card-header" role="tab">
                      <h5 class="mb-0">
                        <a data-bs-toggle="collapse" href="#frame{{ $faq->id }}" aria-expanded="true">
                          <i class="indicator icon_minus_alt2"></i>
                          {{ $faq->question }}
                        </a>
                      </h5>
                    </div>
                    <div id="frame{{ $faq->id }}" class="collapse" role="tabpanel" data-bs-parent="#payment">
                      <div class="card-body">
                        {!! $faq->answer !!}
                      </div>
                    </div>
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
