@php
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
@endphp
@extends('front.layouts.main')
@push('title')
  <title>{{ $pro_det->provider_name }} - Scholarship</title>
@endpush
@section('main-section')
  <div id="breadcrumb">
    <div class="container">
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('providers') }}">Provider ({{ $pro_det->provider_name }})</a></li>
        <li>Scholarship</li>
      </ul>
    </div>
  </div>



  <main class="theia-exception">
    @include('front.provider-menu');

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-9">
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
          <p class="fs18 mt-4 mb-3">
            <strong>{{ $allsch->total() }} </strong> Scholarships matching your search. <strong>Apply
              today</strong>!
          </p>
          @foreach ($allsch as $row)
            @php
              $today = date('Y-m-d');
              $deadline = $row->deadline;
              if ($today > $deadline) {
                  $dl = 'Expired try next time';
              } else {
                  $dl = 'Expires in ' . dateDiff($today, $deadline) . ' days';
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

            @endphp
            <div class="strip_list fadeIn">
              <div class="row">
                <div class="col-md-2 col-6 mb-sm-15">
                  <img src="{{ asset($pro_det->logo_path) }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-2 col-6 mb-sm-15 d-lg-none d-md-none d-xl-none d-sm-block d-xs-block">
                  <div class="expire-box">
                    {{ $dl }}
                  </div>
                </div>
                <div class="col-md-8">
                  <p class="mt-0 mb-0 fs20"><a target="_blank"
                      href="{{ url('scholarship/' . $row->slug) }}">{{ $row->name }}</a>
                  </p>
                  <p>
                    <i class="icon-graduation-cap" data-bs-toggle="tooltip" data-bs-placement="top" title="To study"></i>
                    {{ $lvls }}
                  </p>
                  <p>
                    <i class="icon-money-1" data-bs-toggle="tooltip" data-bs-placement="top" title="What it covers"></i>
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
                <div class="col-md-2 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">
                  <div class="expire-box">
                    {{ $dl }}
                  </div>
                </div>
                <ul>
                  <li class="btn"><a href=""><i class="icon-star-2"></i> Shortlist</a></li>
                  <li class="btn-bdr"><a href=""><i class="icon-edit"></i> View & Apply</a></li>
                </ul>
              </div>
            </div>
          @endforeach
          {{-- {{ $allsch->links() }} --}}
          {!! $allsch->links('pagination::bootstrap-5') !!}

        </div>



        <div class="col-lg-3">
          <div class="box_general_3 p-3 d-lg-block d-md-block d-xl-block d-sm-none d-xs-none d-none">

            <div class="fiter-title-inside">Filters
              <a href="{{ url('provider/' . $pro_det->slug . '/scholarship') }}" type="button"
                class="ref-btn resetfilter" title="Reset all procedures" name="reset_procedures">
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

            <div class="">
              @php
                $cc = CourseCategory::all();
              @endphp
              @foreach ($cc as $cc)
                <label class="check-filter" data-bs-toggle="collapse" href="#collapse{{ $cc->id }}"
                  role="button">
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

          </div>
        </div>

      </div>
    </div>

  </main>


  <script>
    function AppliedFilterNationality(col, val) {
      //alert(col + ' , faraz , ' + val);
      const element_array = [];
      var n_u = col + '=' + val;
      var l_u = '{{ $l_u }}';
      var int_u = '{{ $int_u }}';
      var p_u = '{{ $p_u }}';
      if (n_u != '') {
        element_array.push(n_u);
      }
      if (l_u != '') {
        element_array.push(l_u);
      }
      if (int_u != '') {
        element_array.push(int_u);
      }
      if (p_u != '') {
        element_array.push(p_u);
      }
      let full_url = element_array.join("&");
      //alert(full_url);
      if (val != '') {
        window.location.replace("{{ url('provider/' . $pro_det->slug . '/scholarship') }}?" + full_url);
      }
    }

    function AppliedFilterLevel(col, val) {
      //alert(col + ' , faraz , ' + val);
      const element_array = [];
      var n_u = '{{ $n_u }}';
      var l_u = col + '=' + val;
      var int_u = '{{ $int_u }}';
      var p_u = '{{ $p_u }}';
      if (n_u != '') {
        element_array.push(n_u);
      }
      if (l_u != '') {
        element_array.push(l_u);
      }
      if (int_u != '') {
        element_array.push(int_u);
      }
      if (p_u != '') {
        element_array.push(p_u);
      }
      let full_url = element_array.join("&");
      // alert(full_url);
      if (val != '') {
        window.location.replace("{{ url('provider/' . $pro_det->slug . '/scholarship') }}?" + full_url);
      }
    }

    function AppliedFilterIntrest(col, val) {
      //alert(col + ' , faraz , ' + val);
      const element_array = [];
      var n_u = '{{ $n_u }}';
      var l_u = '{{ $l_u }}';
      var int_u = col + '=' + val;
      var p_u = '{{ $p_u }}';
      if (n_u != '') {
        element_array.push(n_u);
      }
      if (l_u != '') {
        element_array.push(l_u);
      }
      if (int_u != '') {
        element_array.push(int_u);
      }
      if (p_u != '') {
        element_array.push(p_u);
      }
      let full_url = element_array.join("&");
      //alert(full_url);
      if (val != '') {
        window.location.replace("{{ url('provider/' . $pro_det->slug . '/scholarship') }}?" + full_url);
      }
    }

    function AppliedFilterPayment(col, val) {
      //alert(col + ' , faraz , ' + val);
      const element_array = [];
      var n_u = '{{ $n_u }}';
      var l_u = '{{ $l_u }}';
      var int_u = '{{ $int_u }}';
      var p_u = col + '=' + val;
      if (n_u != '') {
        element_array.push(n_u);
      }
      if (l_u != '') {
        element_array.push(l_u);
      }
      if (int_u != '') {
        element_array.push(int_u);
      }
      if (p_u != '') {
        element_array.push(p_u);
      }
      let full_url = element_array.join("&");
      //alert(full_url);
      if (val != '') {
        window.location.replace("{{ url('provider/' . $pro_det->slug . '/scholarship') }}?" + full_url);
      }
    }

    function removeAppliedFilter(value) {
      //alert(value);
      //die();
      if (value != '') {
        window.location.replace("{{ url('provider/' . $pro_det->slug . '/scholarship') }}");
      }
    }
  </script>
@endsection
