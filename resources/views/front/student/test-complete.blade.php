@extends('front.layouts.main')
@push('title')
  <title>Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
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
          <div style="clear:both"></div>

        </div>

      </div>
    </div>
  </main>
@endsection
