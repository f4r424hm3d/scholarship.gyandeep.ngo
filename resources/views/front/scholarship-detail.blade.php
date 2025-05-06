@php
use App\Models\AppliedScholarship;

//$current_url = Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(2);
$current_url = Request::path();
@endphp
@extends('front.layouts.main')
@push('title')
  <title>{{ $schdet->name }}</title>
@endpush
@section('main-section')
  <main class="theia-exception">

    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('scholarships') }}">Scholarship</a></li>
          <li>{{ $schdet->name }}</li>
        </ul>
      </div>
    </div>


    <div class="container mt-4">

      <div class="row">

        <div class="col-lg-9">
          <div id="notificationDiv">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
          </div>
          <div class="strip_list wow fadeIn">
            <div class="row">
              <div class="col-md-2 col-6 mb-sm-15">
                <img src="{{ asset($provider->logo_path) }}" alt="{{ $schdet->name }}" class="img-fluid">
              </div>
              <div class="col-md-2 col-6 mb-sm-15 d-lg-none d-md-none d-xl-none d-sm-block d-xs-block">
                <div class="expire-box">
                  {!! $dl !!}
                </div>
              </div>
              <div class="col-md-8">
                <p class="mt-0 mb-0 fs20">
                  <a href="#">{{ $schdet->name }}</a>
                </p>
                <p>
                  <i class="icon-graduation-cap" data-bs-toggle="tooltip" data-bs-placement="top" title="To study"></i>
                  {{ $lvls }}
                </p>
                <p>
                  <i class="icon-book-open-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Subject"></i>
                  {{ $subjects }}
                </p>
                <p>
                  <i class="icon-flag-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Eligible countries"></i>
                  {{ $schdet->eligibility }}
                </p>
                <p>
                  <i class="icon-building" data-bs-toggle="tooltip" data-bs-placement="top" title="Provider"></i>
                  {{ $provider->provider_name }}
                </p>
                <p>
                  <i class="icon-calendar-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Deadline"></i>
                  {{ getFormattedDate($schdet->deadline, 'd M Y') }}
                </p>
                <p>
                  <i class="icon-money-1" data-bs-toggle="tooltip" data-bs-placement="top" title="What it covers"></i>
                  {{ $schdet->covers }} {{ $schdet->covers_notes != '' ? ', ' . $schdet->covers_notes : '' }}
                </p>
              </div>
              <div class="col-md-2 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
                <div class="expire-box" style="height:60%;">
                  {!! $dl !!}
                </div>
              </div>
              @if ($dtexp==false)
              <ul>
                <li class="btn" id="addShortlistBtn">
                  @if (session()->get('student_id'))
                    @php
                      $chk = AppliedScholarship::where('std_id', '=', session()->get('student_id'))
                          ->where('scholarship_id', '=', $schdet->id)
                          ->first();
                    @endphp
                    @if ($chk != false)
                      <a href="javascript:void()">
                        <i class="icon-star-2"></i>Shortlisted
                      </a>
                    @else
                      <a href="javascript:void()" onclick="shortlistScholarship({{ $schdet->id }})">
                        <i class="icon-star-2"></i>Shortlist
                      </a>
                    @endif
                  @else
                    <a href="{{ url('login?url=' . $current_url) }}">
                      <i class="icon-star-2"></i>Shortlist
                    </a>
                  @endif
                </li>
                <li class="btn-bdr">
                  @if (session()->get('student_id'))
                    @php
                      $chk = AppliedScholarship::where('std_id', '=', session()->get('student_id'))
                          ->where('scholarship_id', '=', $schdet->id)
                          ->where('status', '=', '1')
                          ->first();
                    @endphp
                    @if ($chk != false)
                      <a href="javascript:void()">
                        <i class="icon-edit"></i> Applied
                      </a>
                    @else
                      <a href="{{ url('scholarship/' . $schdet->id . '/' . $schdet->slug . '/instruction') }}">
                        <i class="icon-edit"></i> Apply
                      </a>
                    @endif
                  @else
                    <a href="{{ url('login?url=' . $current_url) }}">
                      <i class="icon-edit"></i> Apply
                    </a>
                  @endif
                </li>
              </ul>
              @endif
            </div>
          </div>

          <div class="strip_list wow fadeIn">
            {!! $schdet->description !!}
          </div>
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

          <div class="pb-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
            <img src="{{ url('front') }}/img/ieltsAd.jpg" class="img-fluid">
          </div>
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
    function shortlistScholarship(id) {
      var std_id = '{{ session()->get('student_id') }}';
      //alert(std_id + '  , ' + id);
      if (id != '') {
        $.ajax({
          url: "{{ url('scholarship/shortlist') }}",
          method: "GET",
          data: {
            scholarship_id: id,
            std_id: std_id
          },
          success: function(result) {
            if (result == 'success') {
              $('#addShortlistBtn').html('<a href="javascript:void()"><i class="icon-star-2"></i>Shortlisted </a>');
              $('#notificationDiv').html(
                '<div class="alert alert-success alert-dismissable">Scholarship shortlisted succesfully</div>');
            } else if (result == 'shortlisted') {
              $('#notificationDiv').html(
                '<div class="alert alert-danger alert-dismissable">Scholarship already added to shortlist</div>');
            }
          }
        });
      }
    }
  </script>
@endsection
