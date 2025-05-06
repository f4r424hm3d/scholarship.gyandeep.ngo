@php
  use App\Models\Blog;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>{{ $row->title }} - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">

    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/blogs') }}">Blogs</a></li>
          <li>{{ $row->title }}</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60">
      <div class="row">
        <div class="col-lg-9">
          <div class="bloglist singlepost">
            <p><img alt="{{ $row->title }}" class="img-fluid" src="{{ asset($row->image_path) }}"></p>
            <h1>{{ $row->title }}</h1>
            <div class="postmeta">
              <ul>
                {{-- <li><a href="#"><i class="icon_folder-alt"></i> Collections</a></li>
                <li><a href="#"><i class="icon_clock_alt"></i> 23/12/2015</a></li>
                <li><a href="#"><i class="icon_pencil-edit"></i> Admin</a></li>
                <li><a href="#"><i class="icon_comment_alt"></i> (14) Comments</a></li> --}}
              </ul>
            </div>
            <div class="post-content">
              {!! $row->description !!}
            </div>
          </div>

        </div>

        <aside class="col-lg-3">

          <div class="widget">
            <div class="widget-title">
              <h4>Recent Posts</h4>
            </div>
            <ul class="comments-list">

              @foreach ($rows as $item)
                <li>
                  <div class="alignleft">
                    <a href="{{ url('blog/' . $item->id . '/' . $item->slug) }}">
                      <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}">
                    </a>
                  </div>
                  <small>{{ getFormattedDate($item->created_at, 'd , M Y') }}</small>
                  <h3>
                    <a href="{{ url('blog/' . $item->id . '/' . $item->slug) }}" title="{{ $item->title }}">
                      {{ Str::limit($item->title, 26) }}
                    </a>
                  </h3>
                </li>
              @endforeach

            </ul>
          </div>

          <div class="widget">
            <div class="widget-title">
              <h4>Blog Categories</h4>
            </div>
            <ul class="cats">
              @foreach ($bc as $bc)
                @php
                  $count = Blog::where('category_slug', '=', $bc->category_slug)->count();
                @endphp
                <li><a href="{{ url('blogs/' . $bc->category_slug) }}">{{ $bc->category_name }}
                    <span>({{ $count }})</span></a>
                </li>
              @endforeach
            </ul>
          </div>

        </aside>
      </div>
    </div>

  </main>
@endsection
