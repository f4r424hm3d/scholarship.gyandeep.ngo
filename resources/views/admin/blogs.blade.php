@extends('admin.layouts.main')
@push('title')
  <title>Blogs - Gyandeep NGO</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Category</label>
                        <select name="category_slug" id="category_slug" class="form-control" required>
                          <option value="">Select</option>
                          @foreach ($bc as $bc)
                            <option value="{{ $bc->category_slug }}"
                              {{ ($ft == 'edit' && $sd->category_slug == $bc->category_slug) || $bc->category_slug == old('category_slug') ? 'selected' : '' }}>
                              {{ $bc->category_name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('category_slug')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                      <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Enter Title"
                          value="{{ $ft == 'edit' ? $sd->title : old('title') }}">
                        <span class="text-danger">
                          @error('title')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
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
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Short Note</label>
                        <input type="text" name="short_note" id="short_note" class="form-control"
                          placeholder="Enter short note"
                          value="{{ $ft == 'edit' ? $sd->short_note : old('short_note') }}">
                        <span class="text-danger">
                          @error('short_note')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control mb-2 mr-sm-2" id="description" name="description" placeholder="Enter description">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                      <span class="text-danger">
                        @error('description')
                          {{ $message }}
                        @enderror
                      </span>
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
                <h4 class="box-title">Blog List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Short Note</th>
                        <th>Image</th>
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
                          <td>{{ $row->category_slug }}</td>
                          <td>{{ $row->title }}</td>
                          <td>{{ $row->short_note }}</td>
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
                            <a href="{{ url('admin/blog/update/' . $row->id) }}"
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
          url: "{{ url('admin/blog/delete') }}" + "/" + id,
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
