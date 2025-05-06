@php
  use App\Models\AppliedScholarship;
  //$current_url = url()->current();
  //$current_url = Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(3);
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
          <li><a href="{{ url('scholarships/' . $schdet->slug) }}">{{ $schdet->name }}</a></li>
          <li>Instruction</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-12">
          <div class="strip_list fadeIn p-4">
            <div class="row d-flex align-items-center apply-mobile-head">
              <div class="col-md-3">
                <img src="{{ asset($provider->logo_path) }}" class="img-fluid" alt="{{ $schdet->name }}">
              </div>
              <div class="col-md-9">
                <h3 style="color:#292363">{{ $schdet->name }}</h3>
                <h6 class="mb-0">Deadline: {{ getFormattedDate($schdet->deadline, 'd M Y') }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row pb-3">

        <div class="col-md-12 notification-div">
          @if (session()->has('emsg'))
            <div class="alert alert-danger alert-dismissable">
              {{ session()->get('emsg') }}
            </div>
          @endif
        </div>

        <div class="col-md-8">
          <div class="pb-2">
            <div id="detail-title">
              <div class="container">Instructions</div>
            </div>
            <div class="box_general_3 p-4 text-justify">
              {!! $schdet->instruction !!}
            </div>
          </div>
        </div>

        <div class="col-lg-4 strip_list fadeIn d-flex align-items-center justify-content-center"
          style="border-top:6px solid #292363; border-bottom:6px solid #292363">
          <div class="p-1">
            <div class="wrapper pb-0 text-center">
              @if (session()->has('student_id'))
                <h3 style="color:#292363" class="mb-2">{{ session()->get('student_name') }}</h3>
                <h6 class="mb-2">You have logged in successfully.</h6>
                <h6 class="mb-3">Now you can proceed to the application form</h6>
                @if ($totalEligQues > 0)
                  <a href="#MyModal" class="btn_1 text-center pt-3 pb-3 w-100 event-popup-btn mb-3">Start Application</a>
                @else
                  <a href="{{ url('scholarship/' . $schdet->id . '/' . $schdet->slug . '/apply') }}"
                    class="btn_1 text-center pt-3 pb-3 w-100 mb-3">Start Application</a>
                @endif
                <h6 class="mb-2">OR</h6>
                <h6><a href="{{ url('student-logout') }}">Logout</a></h6>
              @else
                <h6><a href="{{ url('login') }}">Login</a></h6>
              @endif
            </div>

          </div>
        </div>

      </div>

  </main>
  <!-- The Apply Modal -->
  <div class="apply-model-main">
    <div class="apply-model-inner">
      <div class="apply-close-btn">×</div>
      <div class="apply-model-wrap">
        <div class="pop-up-content-wrap">
          <div id="detail-title" class="mb-1 text-center" style="bottom:auto">CHECK YOUR ELIGIBILITY - KOTAK KANYA
            SCHOLARSHIP 2021</div>
          <div class="p-3">
            <form action="{{ url('scholarship/check-eligibility') }}" method="post" id="checkEligibilityForm">
              @csrf
              <input type="hidden" name="scholarship_id" value="{{ $schdet->id }}">
              <input type="hidden" name="slug" value="{{ $schdet->slug }}">
              <input type="hidden" name="back_url" value="{{ $current_url }}">
              <div class="row">
                @foreach ($schques as $ques)
                  <div class="form-group col-md-6">
                    <label>{{ $ques->question }}<span class="star-red">*</span></label>
                    <select class="form-select" name="question[]" id="question{{ $ques->id }}" required>
                      <option value="">Select Option</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                @endforeach
                <div class="form-group text-center mt-2 mb-0">
                  <input class="btn_1 medium" type="submit" value="Check Your Eligibility">
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="apply-bg-overlay"></div>
  </div>

  <script>
    $(document).ready(function() {
      $(".event-popup-btn").on('click', function() {
        $(".apply-model-main").addClass('apply-model-open');
      });
      $(".apply-close-btn, .apply-bg-overlay").click(function() {
        $(".apply-model-main").removeClass('apply-model-open');
      });
    });
  </script>
  <script>
    // $(document).ready(function() {
    //   $('#checkEligibilityForm').on('submit', function(event) {
    //     event.preventDefault();
    //     $.ajax({
    //       url: "{{ url('scholarship/check-eligibility') }}",
    //       method: "POST",
    //       data: new FormData(this),
    //       success: function(result) {
    //         alert(result);
    //         $('#checkEligibilityForm')[0].reset();
    //         $(".apply-model-main").removeClass('apply-model-open');
    //       }
    //     })
    //   });
    // });

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
