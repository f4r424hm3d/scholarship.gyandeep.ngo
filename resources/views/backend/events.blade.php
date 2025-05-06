@extends('backend.layouts.main')
@push('title')
  <title>Events - Gyandeep NGO</title>
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
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('emsg') }}
              </div>
            @endif
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <form action="{{ $url }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <h4 class="box-title text-info"> {{ $title }} Record</h4>
                  <hr class="my-15">
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Post By</label>
                        <input name="post_by" type="text" class="form-control" placeholder="Enter Name"
                          value="{{ $ft == 'edit' ? $sd->post_by : old('post_by') }}">
                        <span class="text-danger">
                          @error('post_by')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Event Date</label>
                        <input name="event_date" type="date" class="form-control" placeholder="Enter event date"
                          value="{{ $ft == 'edit' ? $sd->event_date : old('event_date') }}" required>
                        <span class="text-danger">
                          @error('event_date')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Event Time Start</label>
                        <input name="time_start" type="time" class="form-control" placeholder="Enter Start Time"
                          value="{{ $ft == 'edit' ? $sd->time_start : old('time_start') }}" required>
                        <span class="text-danger">
                          @error('time_start')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Event Time End</label>
                        <input name="time_end" type="time" class="form-control" placeholder="Enter End Time"
                          value="{{ $ft == 'edit' ? $sd->time_end : old('time_end') }}" required>
                        <span class="text-danger">
                          @error('time_end')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name="file" id="file" class="form-control">
                        <span class="text-danger">
                          @error('file')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <div class="form-group">
                        <label>Youtube Video Link</label>
                        <input type="text" name="video_link" id="video_link" class="form-control"
                          placeholder="Enter Video Link"
                          value="{{ $ft == 'edit' ? $sd->video_link : old('video_link') }}">
                        <span class="text-danger">
                          @error('video_link')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Title / Heading</label>
                        <input type="text" name="title" id="title" class="form-control"
                          placeholder="Enter title/heading" value="{{ $ft == 'edit' ? $sd->title : old('title') }}">
                        <span class="text-danger">
                          @error('title')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control mb-2 mr-sm-2" id="description" name="description" placeholder="Enter description">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  @if ($ft == 'add')
                    <button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
                      <i class="ti-trash"></i> Reset
                    </button>
                  @endif
                  @if ($ft == 'edit')
                    <a href="{{ url('admin/levels') }}" class="btn btn-rounded btn-primary btn-outline">
                      <i class="ti-trash"></i> Cancel
                    </a>
                  @endif
                  <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> Save
                  </button>
                </div>
              </form>
            </div>
          </div>
          {{-- {{ printArray($dep) }} --}}
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Event List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Post By</th>
                        <th>Image</th>
                        <th>Video</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        <tr id="row{{ $row->id }}">
                          <td>{{ $i }}</td>
                          <td>{{ $row->title }}</td>
                          <td>{{ $row->event_date == null ? '' : getFormattedDate($row->event_date, 'd-M-Y') }}</td>
                          <td>{{ $row->time_start }} - {{ $row->time_end }}</td>
                          <td>{{ $row->post_by }}</td>
                          <td>
                            @if ($row->image_path != '')
                              <a href="{{ asset($row->image_path) }}" alt="{{ $row->title }}" target="_blank">
                                <img src="{{ asset($row->image_path) }}" alt="{{ $row->title }}" height="50"
                                  width="50">
                              </a>
                            @else
                              No file uploaded
                            @endif
                          </td>
                          <td>
                            @if ($row->video_link != '')
                              <iframe width="75%" height="150" src="{{ $row->video_link }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                              </iframe>
                            @else
                              No file uploaded
                            @endif
                          </td>
                          <td>
                            @if ($row->description != '')
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                title="Click to view" data-target="#description<?php echo $row->id; ?>">
                                view
                              </button>
                              <div class="modal" id="description{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Description</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body m-3">
                                      <p class="mb-0">{!! $row->description !!}</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            @else
                              Not available
                            @endif
                          </td>
                          <td>
                            <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/event/update/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
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
  <script>
    CKEDITOR.replace('description');

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/event/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              $('#row' + id).remove();
              var h = 'Success';
              var msg = 'Record deleted successfully';
              var type = 'success';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function showToastr(h, msg, type) {
      $.toast({
        heading: h,
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3000,
        stack: 6
      });
    }
  </script>
@endsection
