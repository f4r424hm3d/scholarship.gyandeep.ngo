@extends('front.layouts.main')
@push('title')
  <title>Events - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Events</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title mb-4">
        <h2><strong>Overseas Education Webinars, Seminars, AMA Sessions</strong></h2>
      </div>
      <div class="row">
        @foreach ($rows as $row)
          <div class="col-md-4">
            <div class="box_list wow fadeIn animated animated">
              <figure style="height:auto">
                <img src="{{ asset($row->image_path) }}" class="img-fluid" alt="{{ $row->title }}">
              </figure>
              <div class="wrapper pb-0">
                <p class="mb-3">
                  <i class="icon-clock"></i> {{ getFormattedDate($row->event_date, 'd M Y') }} <span
                    class="float-end">{{ ucwords($row->post_by) }}</span>
                </p>
                <h6 class="mb-3">{{ ucwords($row->title) }}</h6>
              </div>
              <ul>
                <li class="d-inline-block">
                  {{-- <i class="icon_pin_alt"></i> Webinar, India --}}
                </li>
                <li class="btn-bdr d-flex" style="margin-top:-5px;">
                  <a target="_blank" href="{{ url('event/' . $row->id . '/' . $row->slug) }}"
                    style="padding-top:7px">Event Details</a>
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
