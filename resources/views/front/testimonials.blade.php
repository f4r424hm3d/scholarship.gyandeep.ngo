@extends('front.layouts.main')
@push('title')
  <title>Testimonial - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="#">Home</a></li>
          <li>Testimonials</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title">
        <h2>What user says about us</h2>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
      </div>
      <div class="row">

        @foreach ($rows as $row)
          <div class="col-md-4">
            <div class="about-review bg_color_1">
              <div class="rating">
                @for ($i = 1; $i <= $row->rating; $i++)
                  <i class="icon_star voted"></i>
                @endfor
                <strong>{{ $row->title }}!</strong>
              </div>
              <p>
                "
                {{ $row->review }}
                "
              </p>
              <div class="user_review">
                <figure>
                  <img src="{{ asset($row->image_path) }}">
                </figure>
                <h4>
                  {{ $row->name }}
                  <span>{{ $row->designation }}</span>
                </h4>
              </div>
            </div>
          </div>
        @endforeach
        {!! $rows->links('pagination::bootstrap-5') !!}
      </div>
    </div>

  </main>
@endsection
