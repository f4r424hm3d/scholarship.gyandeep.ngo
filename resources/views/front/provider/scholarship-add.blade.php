@extends('front.layouts.main')
@push('title')
  <title>Add Scholarship - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.provider.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px"> Add SCholarship
            </div>
            <div class="box_general_3">
              <form action="{{ url('provider/scholarship/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $provider->id }}">
                <input type="hidden" name="provider_type_id" value="{{ $provider->provider_type_id }}">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label>Scholarship Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Enter scholarship Name"
                        value="{{ $ft == 'edit' ? $sd->name : old('name') }}" required>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label>Eligibility Note</label>
                      <input name="eligibility" type="text" class="form-control" placeholder="Enter eligibility"
                        value="{{ $ft == 'edit' ? $sd->eligibility : old('eligibility') }}" required>
                      <span class="text-danger">
                        @error('eligibility')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                      <label>Deadline</label>
                      <input name="deadline" type="date" class="form-control" placeholder="Enter Deadline"
                        value="{{ $ft == 'edit' ? $sd->deadline : old('deadline') }}" required>
                      <span class="text-danger">
                        @error('deadline')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label>What it covers</label>
                      <select name="covers" type="text" class="form-control select2" required>
                        <option value="">Select</option>
                        <option value="full-funding"
                          {{ $ft == 'edit' && $sd->covers == 'full-funding' ? 'Selected' : '' }}>Full Funding
                        </option>
                        <option value="partial-funding"
                          {{ $ft == 'edit' && $sd->covers == 'partial-funding' ? 'Selected' : '' }}>Partial Funding
                        </option>
                        <option value="only-tution-fees"
                          {{ $ft == 'edit' && $sd->covers == 'only-tution-fees' ? 'Selected' : '' }}>Only Tution Fees
                        </option>
                      </select>
                      <span class="text-danger">
                        @error('covers')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Covers Notes</label>
                      <input name="covers_notes" type="text" class="form-control" placeholder="Enter Covers Notes"
                        value="{{ $ft == 'edit' ? $sd->covers_notes : old('covers_notes') }}">
                      <span class="text-danger">
                        @error('covers_notes')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  {{-- <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label>Exam Type</label>
                      <select onchange="changeExamType(this.value)" name="exam_type" id="exam_type" type="text"
                        class="form-control select2" required>
                        <option value="">Select</option>
                        <option value="Paid">Paid</option>
                        <option value="Free">Free</option>
                      </select>
                      <span class="text-danger">
                        @error('exam_type')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                      <label>Exam Fees</label>
                      <input name="exam_fees" id="exam_fees" type="number" class="form-control" min="0" required>
                      <span class="text-danger">
                        @error('exam_fees')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div> --}}
                  <div class="form-group col-md-12">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control mb-2 mr-sm-2" id="description" name="description" placeholder="Enter description">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="form-label" for="instruction">Instruction</label>
                    <textarea class="form-control mb-2 mr-sm-2" id="instruction" name="instruction" placeholder="Enter instruction">{{ $ft == 'edit' ? $sd->instruction : old('instruction') }}</textarea>
                  </div>
                </div>
                <input type="submit" class="btn_1 medium" value="Save">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
  <script>
    function changeExamType(exam_type) {
      if (exam_type == 'Paid') {
        $('#exam_fees').val('');
        $('#exam_fees').attr('required', true);
        $('#exam_fees').attr('min', '1', true);
      }
      if (exam_type == 'Free') {
        $('#exam_fees').val('0');
        $('#exam_fees').attr('required', false);
        $('#exam_fees').hide();
      }
    }
    CKEDITOR.replace('description');
    CKEDITOR.replace('instruction');
  </script>
@endsection
