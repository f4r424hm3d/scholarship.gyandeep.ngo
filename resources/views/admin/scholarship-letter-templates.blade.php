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
                  <div class="row">
                    <div class="col-md-3 col-sm-12 mb-3">
                      <x-input-field type="text" label="Template Name" name="template_name" id="template_name"
                        :ft="$ft" :sd="$sd" />
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                      <x-textarea-field label="Template" name="template" id="template" :ft="$ft"
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
      CKEDITOR.instances.template.setData('');
    }

    $(function() {
      var $template = CKEDITOR.replace('template');

      $template.on('change', function() {
        $template.updateElement();
      });
    });
  </script>
  @include('admin.js.common-ajax-page')
@endsection
