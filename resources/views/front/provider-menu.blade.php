<div class="hospital_cover_box"
  style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .1), rgba(0, 0, 0, 0.9)), url({{ url('front/img/provider.png') }})">

  <div class="container">

    <div class="row">

      <div class="col-md-9">

        <div class="row d-flex align-items-center">

          <div class="col-lg-2 col-md-2 col-12">

            <figure class=" mb-0">

              <img src="{{ asset($pro_det->logo_path) }}" alt="" class="rounded-circle img-thumbnail">

            </figure>

          </div>

          <div class="col-lg-10 col-md-10 col-12">

            <h1 class="mt-2 mb-1">{{ $pro_det->provider_name }}</h1>

            {{-- <span class="rating mb-1">

                  <i class="icon_star voted"></i>

                  <i class="icon_star voted"></i>

                  <i class="icon_star voted"></i>

                  <i class="icon_star voted"></i>

                  <i class="icon_star"></i>

                  <small>(145)</small> - (29 Reviews)</span> --}}

            <p class="mb-1">

              <i class="icon-location-outline"></i>

              {{ $pro_det->address }} , {{ $pro_det->city }} , {{ $pro_det->state }} ,

              {{ $pro_det->getCountry->name ?? '' }}

            </p>

            <p class="mb-1"><i class="icon-building"></i> Established in : {{ $pro_det->established }}</p>

          </div>

        </div>

      </div>

      {{-- <div class="col-lg-2 col-12 offset-lg-1 d-flex align-items-center"><a href="write-review.html"

              class="btn_1_w w-100">Write a review</a>

          </div> --}}

    </div>

  </div>

</div>

<nav id="secondary_nav">

  <div class="container">

    <ul class="clearfix vertically-scrollbar">

      <li><a href="{{ url('provider/' . $pro_det->slug) }}"
          class="{{ Request::segment(3) == '' ? 'active' : '' }}">Overview

        </a></li>

      <li><a href="{{ url('provider/' . $pro_det->slug . '/scholarship') }}"
          class="{{ Request::segment(3) == 'scholarship' ? 'active' : '' }}">Scholarships</a></li>

      <li><a href="{{ url('provider/' . $pro_det->slug . '/gallery') }}"
          class="{{ Request::segment(3) == 'gallery' ? 'active' : '' }}">Gallery</a></li>

      <li><a href="{{ url('provider/' . $pro_det->slug . '/faqs') }}"
          class="{{ Request::segment(3) == 'faqs' ? 'active' : '' }}">Faqs</a></li>

    </ul>

  </div>

</nav>
