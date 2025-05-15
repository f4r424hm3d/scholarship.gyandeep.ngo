@php
  use App\Models\Provider;
  use App\Models\Level;
  use App\Models\Country;
  use App\Models\ProviderType;
  use App\Models\CourseCategory;
  use App\Models\Specialization;

  if ($nationality != '') {
      $n_u = 'nationality=' . $nationality;
  } else {
      $n_u = '';
  }

  if ($level_id != '') {
      $l_u = 'level_id=' . $level_id;
  } else {
      $l_u = '';
  }

  if ($intrest != '') {
      $int_u = 'intrest=' . $intrest;
      $actspc = Specialization::find($intrest);
      $act_cat = $actspc->category_id;
  } else {
      $int_u = '';
      $act_cat = 0;
  }

  if ($payment != '') {
      $p_u = 'payment=' . $payment;
  } else {
      $p_u = '';
  }

  if ($provider_type_id != '') {
      $pt_u = 'provider=' . $provider_type_id;
  } else {
      $pt_u = '';
  }
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Scholarship - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Scholarships</li>
        </ul>
      </div>
    </div>
   <section class="scholorship-sections" >
     <div class="container-fluid px-5">
      <div class="main_title text-start mb-4">
        <h2 class="text-start">Study Abroad Scholarships For Internationa  Students
        </h2>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
            <div class="fiter-title-inside">Filters
              <a href="{{ url('scholarships') }}" type="button" class="ref-btn resetfilter" title="Reset all procedures"
                name="reset_procedures">
                <i class="icon-arrows-cw"></i>
              </a>
            </div>
            <p class="mb-0" style="font-size:15px; font-weight:500">
              Nationality
              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
            </p>
            <div class="ps-scrl-bar">
              @php
                $filter_nationality = Country::all();
              @endphp
              @foreach ($filter_nationality as $f_n)
                <label class="check-filter">
                  {{ $f_n->name }} <input type="checkbox" id="nationality_{{ $f_n->id }}"
                    value="{{ $f_n->id }}"
                    onclick="{{ $nationality == $f_n->id ? "removeAppliedFilter('nationality')" : "AppliedFilterNationality('nationality','" . $f_n->id . "')" }}"
                    {{ $nationality == $f_n->id ? 'checked' : '' }}>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            </div>
            <hr style="margin:20px -16px">
            <p class="mb-0" style="font-size:15px; font-weight:500">
              I'm looking for
              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
            </p>
            <div class="ps-scrl-bar">
              @php
                $filter_level = Level::all();
              @endphp
              @foreach ($filter_level as $fl)
                <label class="check-filter">
                  {{ $fl->name }}
                  <input type="checkbox" id="level_id_{{ $fl->id }}" value="{{ $fl->id }}"
                    onclick="{{ $level_id == $fl->id ? "removeAppliedFilter('level_id')" : "AppliedFilterLevel('level_id','" . $fl->id . "')" }}"
                    {{ $level_id == $fl->id ? 'checked' : '' }}>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            </div>
            <div class="hide-this">
              <hr style="margin:20px -16px">
              <p class="mb-0" style="font-size:15px; font-weight:500">
                Countries Interested
                <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
              </p>
              <div class="ps-scrl-bar">
                @php
                  $filter_country = Country::all();
                @endphp
                @foreach ($filter_country as $f_c)
                  <label class="check-filter">
                    {{ $f_c->name }} <input type="checkbox" id="country_{{ $f_c->id }}"
                      value="{{ $f_c->id }}" onclick="<?php echo isset($_GET['country']) && $_GET['country'] == $f_c->id ? "removeAppliedFilter('country')" : "AppliedFilterCountry('country','" . $f_c->id . "')"; ?>" <?php echo isset($_GET['country']) && $_GET['country'] == $f_c->id ? 'checked' : ''; ?>>
                    <span class="checkmark"></span>
                  </label>
                @endforeach
              </div>
            </div>
            <hr style="margin:20px -16px">
            <p class="mb-0" style="font-size:15px; font-weight:500">
              Field of Interest
              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
            </p>
            <div class="ps-scrl-bar">
              @php
                $cc = CourseCategory::all();
              @endphp
              @foreach ($cc as $cc)
                <label class="check-filter" data-bs-toggle="collapse" href="#collapse{{ $cc->id }}" role="button">
                  {{ $cc->category }}
                  <input type="checkbox" name="size_range" value="3"><span class="checkmark"></span>
                  <i class="icon-down-open-1"></i>
                </label>
                @php
                  $spc = Specialization::where('category_id', '=', $cc->id)->get();
                @endphp
                <div class="collapse dd {{ $cc->id == $act_cat ? 'show' : '' }}" id="collapse{{ $cc->id }}">
                  @foreach ($spc as $spc)
                    <label class="check-filter">
                      {{ $spc->specialization }}
                      <input type="checkbox" name="size_range" value="{{ $spc->id }}"
                        onclick="{{ $intrest == $spc->id ? "removeAppliedFilter('intrest')" : "AppliedFilterIntrest('intrest','" . $spc->id . "')" }}"
                        {{ $intrest == $spc->id ? 'checked' : '' }}>
                      <span class="checkmark"></span>
                    </label>
                  @endforeach
                </div>
              @endforeach
            </div>
            <hr style="margin:20px -16px">
            <p class="mb-0" style="font-size:15px; font-weight:500">
              Scholarship Type
              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
            </p>
            <div class="">
              <label class="check-filter">
                Full Funding
                <input type="checkbox" name="size_range" value="full-funding"
                  onclick="{{ $payment == 'full-funding' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','full-funding')" }}"
                  {{ $payment == 'full-funding' ? 'checked' : '' }}>
                <span class="checkmark"></span>
              </label>
              <label class="check-filter">
                Tution Fees Only
                <input type="checkbox" name="size_range" value="only-tution-fees"
                  onclick="{{ $payment == 'only-tution-fees' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','only-tution-fees')" }}"
                  {{ $payment == 'only-tution-fees' ? 'checked' : '' }}>
                <span class="checkmark"></span>
              </label>
              <label class="check-filter">
                Partial Funding
                <input type="checkbox" name="size_range" value="partial-funding"
                  onclick="{{ $payment == 'partial-funding' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','partial-funding')" }}"
                  {{ $payment == 'partial-funding' ? 'checked' : '' }}>
                <span class="checkmark"></span>
              </label>
            </div>
            <hr style="margin:20px -16px">
            <p class="mb-0" style="font-size:15px; font-weight:500">
              Provider
              <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
            </p>
            <div class="">
              @php
                $filter_pt = ProviderType::all();
              @endphp
              @foreach ($filter_pt as $f_pt)
                <label class="check-filter">
                  {{ $f_pt->provider_type }}
                  <input type="checkbox" id="provider_{{ $f_pt->id }}" value="{{ $f_pt->id }}"
                    onclick="{{ $provider_type_id == $f_pt->id ? "removeAppliedFilter('provider')" : "AppliedFilterProvider('provider','" . $f_pt->id . "')" }}"
                    {{ $provider_type_id == $f_pt->id ? 'checked' : '' }}>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          {{-- <div class="row">
          <div class="col-lg-9">
            <form method="post" action="">
              <div id="custom-search-input">
                <div class="input-group">
                  <input type="text" class="search-query shadow-none"
                    placeholder="Search specific keywords only. ex. Microbiology, Commonwealth...."
                    onFocus="this.placeholder = ''"
                    onBlur="this.placeholder = 'Search specific keywords only. ex. Microbiology, Commonwealth....'">
                  <input type="submit" class="btn_search" value="Search">
                </div>
              </div>
            </form>
          </div>
          <div
            class="col-lg-3 align-items-center d-flex text-end d-lg-flex d-md-flex d-xl-flex d-sm-none d-xs-none d-none">
            SORT BY &nbsp;
            <div class="form-group mb-0">
              <select class="form-select" name="country_register" id="country_register">
                <option value="">Date Posted</option>
                <option value="">Deadline</option>
                <option value="">Popularity</option>
              </select>
            </div>
          </div>
        </div> --}}
          <p class="fs18 mb-3">
            <strong>{{ $allsch->total() }} </strong> Scholarships matching your search. <strong>Apply
              today</strong>!
          </p>
          @foreach ($allsch as $row)
            @php
              $today = date('Y-m-d');
              $deadline = $row->deadline;
              if ($today > $deadline) {
                  $dl = '<span class="text-danger">Expired</span><br>Try next time';
                  $dtexp = true;
              } else {
                  $dl = 'Expires in ' . dateDiff($today, $deadline) . ' days';
                  $dtexp = false;
              }
              //$levels = '';
              $levelArray = [];
              foreach ($row->getSchLevel as $lvl) {
                  $levelArray[] = $lvl->getLevel->name;
              }
              $lvls = implode(' , ', $levelArray);
              $subjectArray = [];
              foreach ($row->getSchSubject as $sub) {
                  $subjectArray[] = $sub->getSubject->specialization;
              }
              $subjects = implode(' , ', $subjectArray);
              //$provider = Provider::find($row->provider_id);
            @endphp
            <div class="strip_list fadeIn">
              <div class="row">
                <div class="col-md-3">
                <div class="scholorship-imgs">
                    <img src="{{ asset($row->getProvider->logo_path) }}" alt="" class="img-fluid">
                </div>
                </div>
                
                <div class="col-md-9">
                  <p class=""><a target="_blank"
                      href="{{ url('scholarship/' . $row->id . '/' . $row->slug) }}">{{ $row->name }}</a>
                  </p>
                  <p>
                    <i class="icon-graduation-cap" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="To study"></i>
                    {{ $lvls }}
                  </p>
                  <p>
                    <i class="icon-money-1" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="What it covers"></i>
                    {{ $row->covers }} {{ $row->covers_notes != '' ? ', ' . $row->covers_notes : '' }}
                  </p>
                  <p>
                    <i class="icon-book-open-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Subject"></i>
                    {{ $subjects }}
                  </p>
                  <p>
                    <i class="icon-flag-2" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Eligible countries"></i>
                    {{ $row->eligibility }}
                  </p>
                </div>
                <div class="col-md col-6 mb-sm-15 d-lg-none d-md-none d-xl-none d-sm-block d-xs-block">
                  <div class="expire-box">
                    {!! $dl !!}
                  </div>
                </div>
                <div class="col-md d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
                  <div class="expire-box">
                    {!! $dl !!}
                  </div>
                </div>
                <ul>
                  {{-- <li class="btn">
                    <a href="javascript:void()"><i class="icon-star-2"></i> Shortlist</a>
                  </li> --}}
                  <li class="btn-bdr">
                    <a href="{{ url('scholarship/' . $row->id . '/' . $row->slug) }}"><i class="icon-edit"></i> View
                      &
                      Apply</a>
                  </li>
                </ul>
              </div>
            </div>
          @endforeach
          {{-- {{ $allsch->links() }} --}}
          {!! $allsch->links('pagination::bootstrap-5') !!}

          @foreach ($sc as $row)
            <div class="strip_list wow fadeIn">
              <div class="row">
                <div class="col-md-12">
                  <div class="show-more-box">
                    <div class="text show-more-height">
                      <h1> {{ $row->title }} </h1>
                      {!! $row->description !!}
                    </div>
                    <div class="show-more">(Show More)</div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>
        <div class="col-lg-3">
          <a target="_blank" href="{{ url('provider/profile') }}" class="btn_1 text-center pt-3 pb-3 w-100 mb-3"
            style="color:#fff!important;">Publish a Scholarship</a>
          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
            <p class="mb-2" style="font-size:14px; font-weight:500">Degree Based Scholarships</p>
            <ul style=" list-style:circle; padding-left:15px; margin-bottom:0px">
              @foreach ($filter_level as $fl)
                <li>
                  <a target="_blank" href="{{ url($fl->seo_name_slug . '-scholarships') }}">
                    {{ $fl->seo_name }} Scholarships
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="pb-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none"><img
              src="{{ url('front') }}/img/ieltsAd.jpg" class="img-fluid"></div>
          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none"
            style="display:none!important">
            <p class="mb-2" style="font-size:14px; font-weight:500">Nationality Based Scholarships</p>
            <ul style=" list-style:circle; padding-left:15px; margin-bottom:0px">
              <li><a href="">Bachelors degree Scholarships</a></li>
              <li><a href="">Masters degree Scholarships</a></li>
              <li><a href="">PhD degree Scholarships</a></li>
              <li><a href="">Post Doc degree Scholarships</a></li>
              <li><a href="">Diploma degree Scholarships</a></li>
              <li><a href="">MBA degree Scholarships</a></li>
              <li><a href="">Other degree Scholarships</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
   </section>
  </main>
  <!-- Mobile Filter -->
  <div class="mob-filt-fix d-lg-none d-md-none d-xl-none d-sm-block d-xs-block">
    <div>
      <a href="javascript:void()" class="filter-title" onClick="openFilter()">Filter by <span
          class="mobile-fliter-btn">+</span></a>
      <a href="javascript:void()" class="sort-title" onClick="openSort()">Sort by <span
          class="mobile-fliter-btn">+</span></a>
    </div>
  </div>

  <!-- Mobile Filter -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onClick="closeFilter()" style="right:15px"><i
        class="pe-7s-close-circle"></i></a>
    <div class="box_general_3 p-3 pt-5">
      <div class="fiter-title-inside">Filters
        <a href="{{ url('scholarships') }}" type="button" class="ref-btn resetfilter" title="Reset all procedures"
          name="reset_procedures">
          <i class="icon-arrows-cw"></i>
        </a>
      </div>
      <p class="mb-0" style="font-size:15px; font-weight:500">
        Nationality
        <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
      </p>
      <div class="ps-scrl-bar">
        @php
          $filter_nationality = Country::all();
        @endphp
        @foreach ($filter_nationality as $f_n)
          <label class="check-filter">
            {{ $f_n->name }} <input type="checkbox" id="nationality_{{ $f_n->id }}"
              value="{{ $f_n->id }}"
              onclick="{{ $nationality == $f_n->id ? "removeAppliedFilter('nationality')" : "AppliedFilterNationality('nationality','" . $f_n->id . "')" }}"
              {{ $nationality == $f_n->id ? 'checked' : '' }}>
            <span class="checkmark"></span>
          </label>
        @endforeach
      </div>
      <hr style="margin:20px -16px">
      <p class="mb-0" style="font-size:15px; font-weight:500">
        I'm looking for
        <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
      </p>
      <div class="ps-scrl-bar">
        @php
          $filter_level = Level::all();
        @endphp
        @foreach ($filter_level as $fl)
          <label class="check-filter">
            {{ $fl->name }}
            <input type="checkbox" id="level_id_{{ $fl->id }}" value="{{ $fl->id }}"
              onclick="{{ $level_id == $fl->id ? "removeAppliedFilter('level_id')" : "AppliedFilterLevel('level_id','" . $fl->id . "')" }}"
              {{ $level_id == $fl->id ? 'checked' : '' }}>
            <span class="checkmark"></span>
          </label>
        @endforeach
      </div>
      <div class="hide-this">
        <hr style="margin:20px -16px">
        <p class="mb-0" style="font-size:15px; font-weight:500">
          Countries Interested
          <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
        </p>
        <div class="ps-scrl-bar">
          @php
            $filter_country = Country::all();
          @endphp
          @foreach ($filter_country as $f_c)
            <label class="check-filter">
              {{ $f_c->name }} <input type="checkbox" id="country_{{ $f_c->id }}"
                value="{{ $f_c->id }}" onclick="<?php echo isset($_GET['country']) && $_GET['country'] == $f_c->id ? "removeAppliedFilter('country')" : "AppliedFilterCountry('country','" . $f_c->id . "')"; ?>" <?php echo isset($_GET['country']) && $_GET['country'] == $f_c->id ? 'checked' : ''; ?>>
              <span class="checkmark"></span>
            </label>
          @endforeach
        </div>
      </div>
      <hr style="margin:20px -16px">
      <p class="mb-0" style="font-size:15px; font-weight:500">
        Field of Interest
        <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
      </p>
      <div class="ps-scrl-bar">
        @php
          $cc = CourseCategory::all();
        @endphp
        @foreach ($cc as $cc)
          <label class="check-filter" data-bs-toggle="collapse" href="#collapse{{ $cc->id }}" role="button">
            {{ $cc->category }}
            <input type="checkbox" name="size_range" value="3"><span class="checkmark"></span>
            <i class="icon-down-open-1"></i>
          </label>
          @php
            $spc = Specialization::where('category_id', '=', $cc->id)->get();
          @endphp
          <div class="collapse dd {{ $cc->id == $act_cat ? 'show' : '' }}" id="collapse{{ $cc->id }}">
            @foreach ($spc as $spc)
              <label class="check-filter">
                {{ $spc->specialization }}
                <input type="checkbox" name="size_range" value="{{ $spc->id }}"
                  onclick="{{ $intrest == $spc->id ? "removeAppliedFilter('intrest')" : "AppliedFilterIntrest('intrest','" . $spc->id . "')" }}"
                  {{ $intrest == $spc->id ? 'checked' : '' }}>
                <span class="checkmark"></span>
              </label>
            @endforeach
          </div>
        @endforeach
      </div>
      <hr style="margin:20px -16px">
      <p class="mb-0" style="font-size:15px; font-weight:500">
        Scholarship Type
        <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
      </p>
      <div class="">
        <label class="check-filter">
          Full Funding
          <input type="checkbox" name="size_range" value="full-funding"
            onclick="{{ $payment == 'full-funding' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','full-funding')" }}"
            {{ $payment == 'full-funding' ? 'checked' : '' }}>
          <span class="checkmark"></span>
        </label>
        <label class="check-filter">
          Tution Fees Only
          <input type="checkbox" name="size_range" value="only-tution-fees"
            onclick="{{ $payment == 'only-tution-fees' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','only-tution-fees')" }}"
            {{ $payment == 'only-tution-fees' ? 'checked' : '' }}>
          <span class="checkmark"></span>
        </label>
        <label class="check-filter">
          Partial Funding
          <input type="checkbox" name="size_range" value="partial-funding"
            onclick="{{ $payment == 'partial-funding' ? "removeAppliedFilter('payment')" : "AppliedFilterPayment('payment','partial-funding')" }}"
            {{ $payment == 'partial-funding' ? 'checked' : '' }}>
          <span class="checkmark"></span>
        </label>
      </div>
      <hr style="margin:20px -16px">
      <p class="mb-0" style="font-size:15px; font-weight:500">
        Provider
        <i class="icon-info-circled" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-original-title="Tooltip on top" aria-label="Tooltip on top"></i>
      </p>
      <div class="">
        @php
          $filter_pt = ProviderType::all();
        @endphp
        @foreach ($filter_pt as $f_pt)
          <label class="check-filter">
            {{ $f_pt->provider_type }}
            <input type="checkbox" id="provider_{{ $f_pt->id }}" value="{{ $f_pt->id }}"
              onclick="{{ $provider_type_id == $f_pt->id ? "removeAppliedFilter('provider')" : "AppliedFilterProvider('provider','" . $f_pt->id . "')" }}"
              {{ $provider_type_id == $f_pt->id ? 'checked' : '' }}>
            <span class="checkmark"></span>
          </label>
        @endforeach
      </div>
    </div>

  </div>

  <div id="myBottomnav" class="bottomnav">
    <a href="javascript:void(0)" class="closebtn" onClick="closeSort()" style="right:10px"><i
        class="pe-7s-close-circle"></i></a>
    <div class="box_general_3 p-3">
      <div class="fiter-title-inside">SORT BY</div>
      <label class="check-filter">Date Posted <input type="checkbox" name="size_range" value="3"><span
          class="checkmark"></span></label>
      <label class="check-filter">Deadline <input type="checkbox" name="size_range" value="3"><span
          class="checkmark"></span></label>
      <label class="check-filter">Popularity <input type="checkbox" name="size_range" value="3"><span
          class="checkmark"></span></label>
    </div>
  </div>

  <!-- Mobile filter js start -->
  <script>
    function openFilter() {
      console.log("open");
      document.getElementById("mySidenav").style.width = "350px";
    }

    function closeFilter() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  <!-- filter js end -->

  <!-- Mobile sort js -->
  <script>
    function openSort() {
      document.getElementById("myBottomnav").style.height = "150px";
    }

    function closeSort() {
      document.getElementById("myBottomnav").style.height = "0";
    }
    document.addEventListener("click", function() {
      if (parseInt($('#myBottomnav').css('height')) > 0) {
        document.getElementById("myBottomnav").style.height = "0";
      }
    });
  </script>
  <!-- Mobile sort js end -->
  @include('front.js.scholarship-list')
@endsection
