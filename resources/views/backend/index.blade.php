@extends('backend.layouts.main')
@push('title')
  <title>Gyandeep NGO : Admin Dashboard</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="row">
              <div class="col-lg-4 col-12">
                <div class="box">
                  <div class="box-body py-0">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5 class="text-fade">Applications</h5>
                        <h2 class="font-weight-500 mb-0">132.0K</h2>
                      </div>
                      <div>
                        <div id="revenue1"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-12">
                <div class="box">
                  <div class="box-body py-0">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5 class="text-fade">Shortlisted</h5>
                        <h2 class="font-weight-500 mb-0">10.9k</h2>
                      </div>
                      <div>
                        <div id="revenue2"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-12">
                <div class="box">
                  <div class="box-body py-0">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h5 class="text-fade">On Hold</h5>
                        <h2 class="font-weight-500 mb-0">03.1k</h2>
                      </div>
                      <div>
                        <div id="revenue3"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <a href="javascript:void()" onclick="changeUrl()" class="btn btn-sm btn-success">change url</a> --}}
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <script>
    function changeUrl() {
      window.history.pushState("Hello World", "Title", "http://127.0.0.1:8000/admin/faraz");
    }
  </script>
@endsection
