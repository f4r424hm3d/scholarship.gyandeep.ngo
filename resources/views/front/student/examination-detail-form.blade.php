@php
  use App\Models\CourseCategory;
  use App\Models\Specialization;
  use App\Models\Level;
  use App\Models\CreateExams;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Examination Detail - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container margin_60_35">
      <div class="main_title">
        <h1>Application Form</h1>
      </div>
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
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-primary btn-circle">1</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
          </div>
        </div>
      </div>

      <form method="post" action="{{ url('scholarship/apply') }}" role="form">
        @csrf
        <input type="hidden" name="scholarship_id" value="{{ Request::segment(2) }}">
        <input type="hidden" id="exam_id" name="exam_id" value="">
        <div class="row setup-content" id="step-2">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-edit"></i> Examination Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Level<span class="text-danger">*</span></label>
                      <select class="form-control" name="level" required>
                        <option value="">Select</option>
                        @foreach ($slvl as $lvl)
                          <option value="{{ $lvl->getLevel->id }}">{{ $lvl->getLevel->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('level')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Applying For<span class="text-danger">*</span></label>
                      <select class="form-control" name="category" id="course_id" required>
                        <option value="">Select</option>
                        @php
                          $cat = CourseCategory::all();
                        @endphp
                        @foreach ($scat as $cat)
                          <option value="{{ $cat->getCourse->id }}">{{ $cat->getCourse->category }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('category')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4 hide-this">
                    <div class="form-group">
                      <label>Subject Group<span class="text-danger">*</span></label>
                      <select class="form-control" name="subject" id="spc_id">
                        <option value="">Select Subject</option>
                      </select>
                      <span class="text-danger">
                        @error('subject')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Date<span class="text-danger">*</span></label>
                      <select class="form-control" name="exam_date" id="exam_date" required>
                        <option value="">Select</option>
                        {{-- @php
                          $today = date('Y-m-d');
                          $ed = CreateExams::where('exam_date', '>', $today)->get();
                        @endphp
                        @foreach ($ed as $ed)
                          <option value="{{ $ed->exam_date }}">{{ $ed->exam_date }}</option>
                        @endforeach --}}
                      </select>
                      <span class="text-danger">
                        @error('exam_date')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mode of Exam<span class="text-danger">*</span></label>
                      <select class="form-control" name="mode_of_exam" required>
                        <option value="Online" selected>Online</option>
                        <option value="Offline" disabled>Offline</option>
                      </select>
                      <span class="text-danger">
                        @error('mode_of_exam')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div></div>
                  <div class="offset-md-8 col-md-2 col-6 d-flex align-items-center">
                    <button class="btn_1 medium w-100 nextBtn" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#course_id').change(function() {
        var course_id = $('#course_id').val();
        var scholarship_id = '{{ Request::segment(2) }}';
        //alert(course_id);
        if (course_id != '') {
          $.ajax({
            url: "{{ url('student/scholarship/get-spc-by-cat-sch') }}",
            method: "get",
            data: {
              course_id: course_id,
              scholarship_id: scholarship_id,
            },
            success: function(data) {
              //alert(data);
              $('#spc_id').html(data);
            }
          });
        }
      });
      $('#course_id').change(function() {
        var course_id = $('#course_id').val();
        var scholarship_id = '{{ Request::segment(2) }}';
        //alert(course_id);
        if (course_id != '') {
          $.ajax({
            url: "{{ url('student/scholarship/get-exam-date-schedule') }}",
            method: "get",
            data: {
              course_id: course_id,
              scholarship_id: scholarship_id,
            },
            success: function(data) {
              //alert(data);
              $('#exam_date').html(data);
            }
          });
        }
      });
      $('#exam_date').change(function() {
        var course_id = $('#course_id').val();
        var scholarship_id = '{{ Request::segment(2) }}';
        var exam_date = $('#exam_date').val();
        //alert(course_id + ' , ' + scholarship_id + ' , ' + exam_date);
        if (course_id != '') {
          $.ajax({
            url: "{{ url('student/get-exam-id-for-student') }}",
            method: "get",
            data: {
              course_id: course_id,
              scholarship_id: scholarship_id,
              exam_date: exam_date,
            },
            success: function(data) {
              //alert(data);
              $('#exam_id').val(data);
            }
          });
        }
      });
    });
  </script>
@endsection
