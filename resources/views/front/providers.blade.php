@php

  use App\Models\Level;

  use App\Models\Country;

  if ($provider != '') {
      $pt_u = 'provider=' . $provider;
  } else {
      $pt_u = '';
  }

@endphp

@extends('front.layouts.main')

@push('title')
  <title>Providers - Gyandeep NGO</title>
@endpush

@section('main-section')
  <main class="theia-exception">

    <div id="breadcrumb">

      <div class="container-fluid">

        <ul>

          <li><a href="{{ url('/') }}">Home</a></li>

          <li>Providers</li>

        </ul>

      </div>

    </div>

    <div class="container-fluid mt-4">

      <div class="main_title text-start mb-4">

        <h2 class="text-start">Study Abroad <strong>Scholarships </strong>For <strong>International</strong> Students

        </h2>

      </div>

      <div class="row">

        <div class="col-lg-2">

          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">

            <div class="fiter-title-inside">

              Filters

              <a href="{{ url('providers') }}" type="button" class="ref-btn resetfilter" title="Reset all procedures"
                name="reset_procedures">

                <i class="icon-arrows-cw"></i>

              </a>

            </div>

            <p class="mb-0" style="font-size:15px; font-weight:500">

              Provider

              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>

            </p>

            <div class="">

              @foreach ($pt as $f_pt)
                <label class="check-filter">

                  {{ $f_pt->provider_type }}

                  <input type="checkbox" id="provider_{{ $f_pt->id }}" value="{{ $f_pt->id }}"
                    onclick="{{ $provider == $f_pt->id ? "removeAppliedFilter('provider')" : "AppliedFilterProvider('provider','" . $f_pt->id . "')" }}"
                    {{ $provider == $f_pt->id ? 'checked' : '' }}>

                  <span class="checkmark"></span>

                </label>
              @endforeach

            </div>

          </div>

        </div>

        <div class="col-lg-7">

          {{-- <div class="row">

            <div class="col-lg-9">

              <form method="post" action="">

                <div id="custom-search-input">

                  <div class="input-group">

                    <input type="text" class="search-query shadow-none"

                      placeholder="Search specific keywords only. ex. Microbiology, Commonwealth...."

                      onFocus="this.placeholder = ''"

                      onBlur="this.placeholder = 'Search specific keywords only. ex. Microbiology, Commonwealth....'">

                    <input type="submit" class="btn_search" value="Search">

                  </div>

                </div>

              </form>

            </div>

            <div

              class="col-lg-3 align-items-center d-flex text-end d-lg-flex d-md-flex d-xl-flex d-sm-none d-xs-none d-none">

              SORT BY &nbsp;

              <div class="form-group mb-0">

                <select class="form-select" name="country_register" id="country_register">

                  <option value="">Date Posted</option>

                  <option value="">Deadline</option>

                  <option value="">Popularity</option>

                </select>

              </div>

            </div>

          </div> --}}

          <p class="fs18 mt-4 mb-3">

            <strong>{{ $rows->total() }} </strong> Providers matching your search. <strong>Apply

              today</strong>!

          </p>

          @foreach ($rows as $row)
            <div class="strip_list fadeIn">

              <div class="row">

                <div class="col-md-2 col-6 mb-sm-15">

                  <img src="{{ asset($row->logo_path) }}" alt="" class="img-fluid" style="height:125px">

                </div>

                <div class="col-md-2 col-6 mb-sm-15 d-lg-none d-md-none d-xl-none d-sm-block d-xs-block">

                  <div class="expire-box">

                    Global Rank<br>

                    {{ $row->global_rank }}

                  </div>

                </div>

                <div class="col-md-8">

                  <p class="mt-0 mb-0 fs20">

                    <a target="_blank" href="{{ url('provider/' . $row->slug) }}">{{ $row->provider_name }}

                    </a>

                  </p>

                  <p>

                    <i class="icon-graduation-cap" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Established"></i>

                    {{ $row->established }}

                  </p>

                  <p>

                    <i class="icon-money-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Acceptance Rate"></i>

                    {{ $row->acceptance_rate }}

                  </p>

                  <p>

                    <i class="icon-book-open-1" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="University Type"></i>

                    {{ $row->university_type }}

                  </p>

                  <p>

                    <i class="icon-flag-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Official Website"></i>

                    {{ $row->website }}

                  </p>

                </div>

                <div class="col-md-2 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">

                  <div class="expire-box">

                    Global Rank<br>

                    {{ $row->global_rank }}

                  </div>

                </div>

              </div>

            </div>
          @endforeach

          {{-- {{ $rows->links() }} --}}

          {!! $rows->links('pagination::bootstrap-5') !!}

        </div>

        <div class="col-lg-3">

          <a href="publish-scholarship.html" class="btn_1 text-center pt-3 pb-3 w-100 mb-3"
            style="color:#fff!important;">Publish a Scholarship</a>

          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">

            <p class="mb-2" style="font-size:14px; font-weight:500">Degree Based Scholarships</p>

            <ul style=" list-style:circle; padding-left:15px; margin-bottom:0px">

              @foreach ($filter_level as $fl)
                <li><a target="_blank" href="{{ url($fl->slug . '-degree-scholarships') }}">{{ $fl->name }} degree

                    Scholarships</a>

                </li>
              @endforeach

            </ul>

          </div>

          <div class="pb-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none"><img
              src="{{ url('front') }}/img/ieltsAd.jpg" class="img-fluid"></div>

          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none"
            style="display:none!important">

            <p class="mb-2" style="font-size:14px; font-weight:500">Nationality Based Scholarships</p>

            <ul style=" list-style:circle; padding-left:15px; margin-bottom:0px">

              <li><a href="">Bachelors degree Scholarships</a></li>

              <li><a href="">Masters degree Scholarships</a></li>

              <li><a href="">PhD degree Scholarships</a></li>

              <li><a href="">Post Doc degree Scholarships</a></li>

              <li><a href="">Diploma degree Scholarships</a></li>

              <li><a href="">MBA degree Scholarships</a></li>

              <li><a href="">Other degree Scholarships</a></li>

            </ul>

          </div>

        </div>

      </div>

    </div>

  </main>

  <script>
    function AppliedFilterProvider(col, val) {

      //alert(col + ' , faraz , ' + val);

      const element_array = [];

      var pt_u = col + '=' + val;



      if (pt_u != '') {

        element_array.push(pt_u);

      }

      let full_url = element_array.join("&");

      //alert(full_url);

      if (val != '') {

        window.location.replace("{{ url('providers') }}?" + full_url);

      }

    }



    function removeAppliedFilter(value) {

      //alert(value);

      //die();

      if (value != '') {

        window.location.replace("{{ url('providers') }}");

      }

    }
  </script>
@endsection
