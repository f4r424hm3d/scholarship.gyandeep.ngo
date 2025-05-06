@extends('front.layouts.main')
@push('title')
  <title>{{ $pro_det->provider_name }}</title>
@endpush
@section('main-section')
  <div id="breadcrumb">
    <div class="container">
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('providers') }}">Providers</a></li>
        <li>{{ $pro_det->provider_name }}</li>
      </ul>
    </div>
  </div>
  <main class="theia-exception">

    @include('front.provider-menu');

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-xl-8 col-lg-8">

          <div id="section_2" class="pb-2">
            <div id="detail-title">
              <div class="container">Quick Details</div>
            </div>
            <div class="box_general_3">
              <table class="table table-bordered table-striped mb-0">
                <tbody>
                  <tr>
                    <td><i class="icon-rocket"></i></td>
                    <td>Establisheds</td>
                    <td>:</td>
                    <td>{{ $pro_det->established }}</td>
                  </tr>
                  <tr>
                    <td><i class="icon-building"></i></td>
                    <td>University Type</td>
                    <td>:</td>
                    <td>{{ $pro_det->university_type }}</td>
                  </tr>
                  <tr>
                    <td><i class="icon_globe"></i></td>
                    <td>Global</td>
                    <td>:</td>
                    <td>{{ $pro_det->global_rank }}</td>
                  </tr>
                  <tr>
                    <td><i class="icon-glass-1"></i></td>
                    <td>Accpetance rate</td>
                    <td>:</td>
                    <td>{{ $pro_det->acceptance_rate }}</td>
                  </tr>
                  {{-- <tr>
                    <td><i class="icon_calculator_alt"></i></td>
                    <td>Total Scholarships</td>
                    <td>:</td>
                    <td>40</td>
                  </tr> --}}
                  <tr>
                    <td><i class="icon-link"></i></td>
                    <td>Official Website</td>
                    <td>:</td>
                    <td>{{ $pro_det->website }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>



          <div id="section_1" class="pb-2">
            <div id="detail-title">
              <div class="container">Description</div>
            </div>
            <div class="box_general_3">
              {!! $pro_det->description !!}
            </div>
          </div>

        </div>
        @include('front.right-side-bar-provider')
      </div>
    </div>
  </main>
@endsection
