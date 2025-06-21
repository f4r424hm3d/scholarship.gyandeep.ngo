@extends($role . '.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <div class="d-inline-block align-items-center">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url($role) }}"><i class="mdi mdi-home-outline"></i></a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ url($role . '/students/') }}">Students</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          @include('common.student-profile-header')
          <div class="col-lg-12 col-md-12 col-12">
            <!-- NOTIFICATION FIELD START -->
            <x-result-notification-field />
            <!-- NOTIFICATION FIELD END -->
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <form action="{{ url('common/student/send-mail') }}" class="needs-validation" method="post"
                  enctype="multipart/form-data" novalidate>
                  @csrf
                  <input type="hidden" name="student_id" value="{{ $student->id }}">
                  <input type="hidden" name="role" value="{{ $role }}">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Sent to</label>
                        <input name="sent_to" id="sent_to" type="text" class="form-control"
                          placeholder="Enter recipient email" value="{{ old('sent_to') ?? $student->email }}" required />
                        <span class="text-danger" id="sent_to-err">
                          @error('sent_to')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                      <x-input-field type="text" label="CC" name="cc" id="cc" :ft="$ft"
                        :sd="$sd" value="{{ old('cc') }}" />
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                      <x-input-field type="file" label="Attach File" name="attach" id="attach" :ft="$ft"
                        :sd="$sd" value="{{ old('attach') }}" />
                    </div>
                    <div class="col-md-8 col-sm-12 mb-3">
                      <x-input-field type="text" label="Subject" name="subject" id="subject" :ft="$ft"
                        :sd="$sd" value="{{ old('subject') }}" />
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3">
                      <x-select-field label="Select Template" name="template_id" id="template_id" :ft="$ft"
                        :sd="$sd" :list="$templates" savev="id" showv="template_name" />
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-textarea-field label="Email Description" name="message" id="message" :ft="$ft"
                        :sd="$sd" />
                    </div>

                  </div>
                  @if ($ft == 'add')
                    <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i>
                      Reset</button>
                  @endif
                  @if ($ft == 'edit')
                    <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-info "><i class="ti-trash"></i> Cancel</a>
                  @endif
                  <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive">
                  <table id="exampl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No</th>
                        <th>Date</th>
                        <th>Subject</th>
                        <th>Message</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ getFormattedDate($row->created_at, 'd M Y - h:i A') }}</td>
                          <td>{{ $row->subject }}</td>
                          <td>
                            <x-content-view-modal :row="$row" field="message" title="View Message" />
                          </td>
                        </tr>
                        @php
                          $i++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    CKEDITOR.replace('message');

    $(document).ready(function() {
      $('#template_id').on('change', function(event) {
        var template_id = $('#template_id').val();
        $.ajax({
          url: "{{ url('common/get-template') }}",
          method: "GET",
          data: {
            template_id: template_id
          },
          success: function(result) {
            CKEDITOR.instances['message'].setData(result.output);
          }
        })
      });
    });
  </script>
@endsection
