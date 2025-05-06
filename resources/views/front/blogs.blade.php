@php

  use App\Models\Blog;

@endphp

@extends('front.layouts.main')

@push('title')
  <title>Blogs - Gyandeep NGO</title>
@endpush

@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Blog</li>
        </ul>
      </div>
    </div>
    <div class="container margin_60">
      <div class="main_title">
        <h1>Blog</h1>
      </div>
      <div class="row">
        <div class="col-lg-9">
          @foreach ($rows as $row)
            <article class="blog  fadeIn">
              <div class="row g-0">
                <div class="col-lg-4">
                  <figure> <a target="_blank" href="{{ url('blog/' . $row->id . '/' . $row->slug) }}"> <img
                        src="{{ asset($row->image_path) }}" alt="{{ $row->title }}">
                      <div class="preview"><span>Read more</span></div>
                    </a> </figure>
                </div>
                <div class="col-lg-8">
                  <div class="post_info"> <small>{{ getformattedDate($row->created_at, 'd , M Y') }}</small>
                    <h3> <a href="{{ url('blog/' . $row->id . '/' . $row->slug) }}">{{ $row->title }}</a> </h3>
                    <p>{{ $row->short_note }}</p>
                    <!--ul>
                          <li>
                            <div class="thumb"> {{-- <img src="{{ url('front') }}/img/thumb_blog.jpg" alt=""> --}} </div>
                            {{-- Jessica

                    Hoops --}} </li>
                          <li> {{-- <i class="icon_comment_alt"></i> 20 --}} </li>
                        </ul-->
                  </div>
                </div>
              </div>
            </article>
          @endforeach

          {!! $rows->links('pagination::bootstrap-5') !!}
        </div>
        <aside class="col-lg-3">
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
                    <span>({{ $count }})</span></a> </li>
              @endforeach
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </main>
@endsection
