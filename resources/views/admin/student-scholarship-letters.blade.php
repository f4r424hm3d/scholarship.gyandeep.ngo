@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <div class="d-inline-block align-items-center">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="row">
          <div class="col-xl-12">
            <!-- NOTIFICATION FIELD START -->
            <x-result-notification-field />
            <!-- NOTIFICATION FIELD END -->
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">
                  {{ $title }} Record
                </h4>
              </div>
              <div class="box-body" id="tblCDiv">
                <form id="{{ $ft == 'add' ? 'dataForm' : 'editForm' }}" {{ $ft == 'edit' ? 'action=' . $url : '' }}
                  class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                  @csrf
                  <input type="hidden" name="company_id" value="{{ $company_id }}">
                  <div class="row">
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-select-field label="Student" name="student_id" id="student_id" :ft="$ft"
                        :sd="$sd" :list="$students" savev="id" showv="name" />
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-select-field label="Select Template" name="template_id" id="template_id" :ft="$ft"
                        :sd="$sd" :list="$templates" savev="id" showv="template_name" />
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <div class="checkbox checkbox-success">
                          <input id="checkbox2" type="checkbox" name="signature" value="1"
                            {{ $ft == 'edit' && $sd->signature == 1 ? 'checked' : '' }}>
                          <label for="checkbox2"> Signature </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <div class="form-group">
                        <div class="checkbox checkbox-success">
                          <input id="checkbox3" type="checkbox" name="stamped" value="1"
                            {{ $ft == 'edit' && $sd->stamped == 1 ? 'checked' : '' }}>
                          <label for="checkbox3"> Stamp </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-textarea-field label="Letter Description" name="letter_description" id="letter_description"
                        :ft="$ft" :sd="$sd" />
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
            <!-- end box -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive" id="trdata">

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script>
    function setEditorBlank() {
      CKEDITOR.instances.letter_description.setData('');
    }

    $(function() {
      var $letter_description = CKEDITOR.replace('letter_description');

      $letter_description.on('change', function() {
        $letter_description.updateElement();
      });
    });
  </script>
  <script>
    getData();

    function getData(page) {
      if (page) {
        page = page;
      } else {
        var page = '{{ $page_no }}';
      }
      var company_id = '{{ $company_id }}';
      return new Promise(function(resolve, reject) {
        //$("#migrateBtn").text('Migrating...');
        setTimeout(() => {
          $.ajax({
            url: "{{ aurl($page_route . '/get-data') }}",
            method: "GET",
            data: {
              page: page,
              company_id: company_id,
            },
            success: function(data) {
              $("#trdata").html(data);
            }
          });
        });
      });
    }

    $(document).ready(function() {
      $('#template_id').on('change', function(event) {
        var template_id = $('#template_id').val();
        $.ajax({
          url: "{{ url('admin/get-template') }}",
          method: "GET",
          data: {
            template_id: template_id
          },
          success: function(result) {
            CKEDITOR.instances['letter_description'].setData(result.output);
          }
        })
      });
    });
  </script>

  @include('admin.js.common-form-submit')
  @include('admin.js.common-delete-data')
@endsection
