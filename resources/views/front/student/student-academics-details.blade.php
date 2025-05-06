@php
  use App\Models\Country;
  use App\Models\State;
  use App\Models\Level;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Student Academics Details - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container margin_60_35">
      <div class="main_title">
        <h1>Application Form</h1>
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @include('front.student.application-form-steps')

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
      <div class="row setup-content" id="step-3">
        <div class="col-xl-12 col-lg-12">
          <div class="pb-2">
            <div id="detail-title" style="padding-left: 15px">
              <i class="icon-book-open"></i> Academic's Details
            </div>
            <div class="box_general_3">
              <form action="{{ url('scholarship/academics-details') }}" method="post" role="form">
                @csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Class/Standard</label>
                      {{-- <input name="class" type="text" class="form-control" placeholder="eg: 12th , graduation etc"
                        value="{{ old('class') }}" /> --}}
                      <select name="class" type="text" class="form-control" placeholder="eg: 12th , graduation etc">
                        <option value="">Select</option>
                        @php
                          $level = Level::all();
                        @endphp
                        @foreach ($level as $level)
                          <option value="{{ $level->id }}" {{ old('class') == $level->id ? 'Selected' : '' }}>
                            {{ $level->name }}</option>
                        @endforeach
                      </select>
                      @error('class')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Board/University</label>
                      <input name="board" type="text" class="form-control" placeholder="eg: CBSE"
                        value="{{ old('board') }}" />
                      @error('board')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Passing Year</label>
                      <input name="passing_year" type="number" class="form-control" placeholder="eg: 2010"
                        value="{{ old('passing_year') }}" />
                      @error('passing_year')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Maximum Marks</label>
                      <input name="max_marks" type="number" class="form-control" placeholder="eg: 500"
                        value="{{ old('max_marks') }}" />
                      @error('max_marks')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Obtained Marks</label>
                      <input name="obtained_marks" type="number" class="form-control" placeholder="eg: 423"
                        value="{{ old('obtained_marks') }}" />
                      @error('obtained_marks')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>% / Grade</label>
                      <input name="score" type="number" class="form-control" placeholder="eg: 10"
                        value="{{ old('score') }}" />
                      @error('score')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div></div>
                  <div class="offset-md-10 col-md-2 col-6 d-flex align-items-center">
                    <button class="btn_1 medium w-100" type="submit">Add</button>
                  </div>
                </div>
              </form>
            </div>
            @foreach ($sad as $sad)
              <div class="box_general_3">
                <form action="{{ url('scholarship/academics-details/update') }}" method="post" role="form">
                  @csrf
                  <input type="hidden" name="id" value="{{ $sad->id }}">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Class/Standard</label>
                        <select name="class" type="text" class="form-control"
                          placeholder="eg: 12th , graduation etc">
                          <option value="">Select</option>
                          @php
                            $level = Level::all();
                          @endphp
                          @foreach ($level as $level)
                            <option value="{{ $level->id }}" {{ $sad->class == $level->id ? 'Selected' : '' }}>
                              {{ $level->name }}</option>
                          @endforeach
                        </select>
                        @error('class')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Board/University</label>
                        <input name="board" type="text" class="form-control" placeholder="eg: CBSE"
                          value="{{ $sad->board }}" />
                        @error('board')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Passing Year</label>
                        <input name="passing_year" type="number" class="form-control" placeholder="eg: 2010"
                          value="{{ $sad->passing_year }}" />
                        @error('passing_year')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Maximum Marks</label>
                        <input name="max_marks" type="number" class="form-control" placeholder="eg: 500"
                          value="{{ $sad->max_marks }}" />
                        @error('max_marks')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Obtained Marks</label>
                        <input name="obtained_marks" type="number" class="form-control" placeholder="eg: 423"
                          value="{{ $sad->obtained_marks }}" />
                        @error('obtained_marks')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>% / Grade</label>
                        <input name="score" type="number" class="form-control" placeholder="eg: 10"
                          value="{{ $sad->score }}" />
                        @error('score')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div></div>
                    <div class="offset-md-10 col-md-2 col-6 d-flex align-items-center">
                      <button class="btn_1 medium w-100" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            @endforeach
            @if ($csad > 0)
              <div></div>
              <div class="offset-md-10 col-md-2 col-6 d-flex align-items-center">
                <a href="{{ url('scholarship/documents') }}" class="btn_1 medium w-100">Save & Continue</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    $(document).ready(function() {
      $('#hq').on('change', function(event) {
        var hq = $('#hq').val();
        //alert(hq);
        if (hq == 'pg') {
          $('#pg,#ug,#12th,#10th').show();
        }
        if (hq == 'ug') {
          $('#ug,#12th,#10th').show();
          $('#pg').hide();
        }
        if (hq == '12th') {
          $('#12th,#10th').show();
          $('#pg,#ug').hide();
        }
        if (hq == '10th') {
          $('#10th').show();
          $('#pg,#ug,#12th').hide();
        }
      });
    });
  </script>
@endsection
