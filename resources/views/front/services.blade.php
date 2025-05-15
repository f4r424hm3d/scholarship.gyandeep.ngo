@extends('front.layouts.main')
@push('title')
  <title>Events - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Services</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title mb-4">
        <h2><strong>Services</strong></h2>
        <p class=" p-0">A list of all Services</p>
      </div>
      <div class="row">
        @foreach ($rows as $row)
          <div class="col-md-3">
            <div class="box_list wow fadeIn animated animated">
              <figure style="height:auto">
                <a target="_blank" href="{{ url('/service/' . $row->id . '/' . $row->slug) }}">
                  <img src="{{ asset($row->image_path) }}" class="img-fluid" alt="{{ $row->service_name }}">
                </a>
              </figure>
              <div class="wrapper text-center pb-0">
                <h3>{{ $row->service_name }}</h3>
                <p class="mb-3">{{ $row->short_note }}</p>
              </div>
              <ul class="mb-0">
                <li class="btn-bdr float-none d-flex m-auto">
                  <a target="_blank" href="{{ url('/service/' . $row->id . '/' . $row->slug) }}"
                    class="float-none m-auto pt-2 pb-2">Know
                    More</a>
                </li>
              </ul>
            </div>
          </div>
        @endforeach
        {!! $rows->links('pagination::bootstrap-5') !!}
      </div>
    </div>

  </main>
@endsection
