@php
  use App\Models\Country;
  use App\Models\CourseCategory;
  use App\Models\Specialization;
  use App\Models\Level;
  use App\Models\Student;

  $clt = Request::segment(3) ?? 'new';

  unset($_GET['page']);
  $url_arr = array_filter($_GET);
  $qs = http_build_query($url_arr);
@endphp
@extends('admin.layouts.main')
@push('title')
  <title>Students</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <div class="d-inline-block align-items-center">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('emsg') }}
              </div>
            @endif
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body" id="tblCDiv">
                <form class="needs-validation" method="get" enctype="multipart/form-data" novalidate>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Search Student by Name</label>
                        <input name="search" id="search" type="text" class="form-control"
                          placeholder="Search Student by Name" value="{{ $_GET['search'] ?? '' }}" required>
                        <span class="text-danger" id="search-err">
                          @error('search')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                      <button class="btn btn-sm btn-primary setBtn" type="submit">Search</button>
                      <a href="{{ aurl('students') }}" class="btn btn-sm btn-warning setBtn"><i class="ti-trash"></i>
                        Reset</a>
                      <a href="javascript:void(0)" class="btn btn-sm btn-info setBtn" id="advSearchBtn">
                        <i class="ti-trash"></i> Advance Search
                      </a>
                    </div>
                  </div>
                </form>
                <div class="{{ $filterApplied == true ? '' : 'hide-thi' }}" id="advSearchForm">
                  <hr>
                  <form method="get" class="form" enctype="multipart/form-data">
                    <hr class="my-15">
                    <div class="row">
                      <div class="form-group col-md-3 col-sm-12">
                        <label>Nationality</label>
                        <select name="nationality" id="nationality" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterNationalities as $na)
                            <option value="{{ $na->nationality }}"
                              {{ isset($_GET['nationality']) && $_GET['nationality'] == $na->nationality ? 'Selected' : '' }}>
                              {{ $na->nationality }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>country</label>
                        <select name="country" id="country" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterCountries as $row)
                            <option value="{{ $row->country }}"
                              {{ isset($_GET['country']) && $_GET['country'] == $row->country ? 'Selected' : '' }}>
                              {{ $row->country }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>state</label>
                        <select name="state" id="state" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterStates as $row)
                            <option value="{{ $row->state }}"
                              {{ isset($_GET['state']) && $_GET['state'] == $row->state ? 'Selected' : '' }}>
                              {{ $row->state }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>city</label>
                        <select name="city" id="city" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterCities as $row)
                            <option value="{{ $row->city }}"
                              {{ isset($_GET['city']) && $_GET['city'] == $row->city ? 'Selected' : '' }}>
                              {{ $row->city }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>Level</label>
                        <select name="level" id="level" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterLevels as $l)
                            <option value="{{ $l->current_qualification_level }}"
                              {{ isset($_GET['level']) && $_GET['level'] == $l->current_qualification_level ? 'Selected' : '' }}>
                              {{ $l->getLevel->name ?? '' }}</option>
                          @endforeach
                        </select>
                      </div>
                      {{-- <div class="form-group col-md-3 col-sm-12">
                        <label>Course</label>
                        <select name="course" id="course" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($filterCourseCategories as $c)
                            <option value="{{ $c->intrested_course_category }}"
                              {{ isset($_GET['course']) && $_GET['course'] == $c->intrested_course_category ? 'Selected' : '' }}>
                              {{ $c->getCourse->category ?? '' }}</option>
                          @endforeach
                        </select>
                      </div> --}}
                      {{-- <div class="form-group col-md-3 col-sm-12">
                        <label>Asigned</label>
                        <select name="asign" id="asign" class="form-control select2">
                          <option value="">Select</option>
                          @foreach ($counsellor as $row)
                            <option value="{{ $row->id }}"
                              {{ isset($_GET['asign']) && $_GET['asign'] == $row->id ? 'Selected' : '' }}>
                              {{ $row->name ?? '' }}</option>
                          @endforeach
                        </select>
                      </div> --}}
                      <div class="form-group col-md-3 col-sm-12">
                        <label>From</label>
                        <input type="date" name="from" id="from"
                          value="{{ isset($_GET['from']) ? $_GET['from'] : '' }}" class="form-control">
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>To</label>
                        <input type="date" name="to" id="to"
                          value="{{ isset($_GET['to']) ? $_GET['to'] : '' }}" class="form-control">
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>Application Submitted</label>
                        <select name="application_submitted" id="application_submitted" class="form-control select2">
                          <option value="">Select</option>
                          <option value="1"
                            {{ isset($_GET['application_submitted']) && $_GET['application_submitted'] == 1 ? 'Selected' : '' }}>
                            Yes</option>
                          <option value="0"
                            {{ isset($_GET['application_submitted']) && $_GET['application_submitted'] == 0 ? 'Selected' : '' }}>
                            No</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3 col-sm-12">
                        <label>Exam Attended</label>
                        <select name="exam_attended" id="exam_attended" class="form-control select2">
                          <option value="">Select</option>
                          <option value="1"
                            {{ isset($_GET['exam_attended']) && $_GET['exam_attended'] == 1 ? 'Selected' : '' }}>
                            Yes</option>
                          <option value="0"
                            {{ isset($_GET['exam_attended']) && $_GET['exam_attended'] == 0 ? 'Selected' : '' }}>
                            No</option>
                        </select>
                      </div>
                      {{-- <div class="form-group col-md-3">
                        <label>Lead Status <span class="text-danger">*</span></label>
                        <select name="lead_status" id="f_lead_status" class="form-control select2">
                          <option value="">Select...</option>
                          @foreach ($ls as $row)
                            <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                          @endforeach
                        </select>
                      </div>
                      <div class=" form-group col-md-3">
                        <label>Lead Sub Status</label>
                        <select name="lead_sub_status" id="f_lead_sub_status" class="form-control select2">
                          <option value="">Select...</option>
                        </select>
                      </div> --}}
                      <div class="form-group col-md-3 col-sm-12">
                        <button type="submit" class="btn btn-sm  btn-primary ">Apply</button>
                        &nbsp;
                        <a href="{{ url('admin/students') }}" class="btn btn-sm  btn-info ">
                          <i class="ti-trash"></i> Clear All
                        </a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                @foreach ($lt as $lt)
                  @php
                    $ltc = Student::with('getLevel', 'getCourse', 'getLastFup', 'getAC');

                    if (isset($_GET['nationality']) && $_GET['nationality'] != '') {
                        $ltc = $ltc->where('nationality', $_GET['nationality']);
                    }
                    if (isset($_GET['country']) && $_GET['country'] != '') {
                        $ltc = $ltc->where('country', $_GET['country']);
                    }
                    if (isset($_GET['state']) && $_GET['state'] != '') {
                        $ltc = $ltc->where('state', $_GET['state']);
                    }
                    if (isset($_GET['city']) && $_GET['city'] != '') {
                        $ltc = $ltc->where('city', $_GET['city']);
                    }
                    if (isset($_GET['level']) && $_GET['level'] != '') {
                        $ltc = $ltc->where('current_qualification_level', $_GET['level']);
                    }
                    if (isset($_GET['application_submitted']) && $_GET['application_submitted'] != '') {
                        $ltc = $ltc->where('submit_application', $_GET['application_submitted']);
                    }
                    if (isset($_GET['exam_attended']) && $_GET['exam_attended'] != '') {
                        $ltc = $ltc->whereHas('lastAttendedExam');
                    }
                    if (isset($_GET['from']) && $_GET['from'] != '') {
                        $from = date('Y-m-d', strtotime($_GET['from'] . '-1 days'));
                        $ltc = $ltc->whereDate('created_at', '>', $from);
                    }
                    if (isset($_GET['to']) && $_GET['to'] != '') {
                        $to = date('Y-m-d', strtotime($_GET['to'] . '+1 days'));
                        $ltc = $ltc->whereDate('created_at', '<', $to);
                    }

                    $ltc = $ltc->where('lead_type', $lt->slug)->count();
                  @endphp
                  <a href="{{ url('admin/students/' . $lt->slug . '?' . $qs) }}"
                    class="btn btn-sm btn-{{ $clt == $lt->slug ? 'success' : 'info btn-outline' }}">
                    {{ $lt->title }} <span
                      class="badge bg-{{ $ltc == 0 ? 'secondary' : 'info' }}">{{ $ltc }}</span>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <div style="float:left;">
                  <label>
                    Show
                    <select name="limit_per_page" id="limit_per_page" class="">
                      @foreach ($lpp as $lpp)
                        <option value="{{ $lpp }}" {{ $limit_per_page == $lpp ? 'selected' : '' }}>
                          {{ $lpp }}</option>
                      @endforeach
                    </select>
                    entries
                  </label>
                  <select name="order_by" id="order_by">
                    @foreach ($orderColumns as $key => $value)
                      <option value="{{ $value }}" <?php echo $order_by == $value ? 'selected' : ''; ?>>{{ $key }}</option>
                    @endforeach
                  </select>
                  <select name="order_in" id="order_in">
                    <option value="ASC" {{ $order_in == 'ASC' ? 'selected' : '' }}>ASC</option>
                    <option value="DESC" {{ $order_in == 'DESC' ? 'selected' : '' }}>DESC</option>
                  </select>
                </div>
                <div style="float:right;" class="mb-0">
                  <input class="form-control" onkeyup="myNewF()" type="text" id="search" placeholder="Search">
                </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          <input style="opacity: 9;left:30px" type="checkbox" name="check_all" id="check_all"
                            value="" />
                        </th>
                        <th>Sr. No.</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Follow Up</th>
                        <th>Contact</th>
                        <th>Qualification Level</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      @endphp
                      @foreach ($rows as $row)
                        <tr id="row{{ $row->id }}">
                          <td>
                            <input style="opacity: 9;left:30px" type="checkbox" name="selected_id[]" class="checkbox"
                              value="{{ $row->id }}" />
                          </td>
                          <td>
                            {{ $i }}
                          </td>
                          <td>
                            {{ getFormattedDate($row->created_at, 'd M Y h:i A') }}
                          </td>
                          <td>
                            @if ($row->getAC->count() > 0)
                              @php
                                $alto = '';
                              @endphp
                              @foreach ($row->getAC as $ac)
                                @php
                                  $alto .= $ac->getUser->name . ' , ';
                                @endphp
                              @endforeach
                              <span class="badge badge-primary" title="{{ $alto }}">{{ $row->getAC->count() }}
                              </span>
                            @endif
                            <a href="{{ url('admin/student/' . $row->id . '/profile') }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info" target="_blank">
                              <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            @if ($row->called == 1)
                              <span class="permCalled" title="Called" data-toggle="tooltip">
                                <i class="fa fa-phone text-success" aria-hidden="true"></i>
                              </span>
                            @endif
                            <span class="tempCalled hide-this" title="Called" data-toggle="tooltip">
                              <i class="fa fa-phone text-success" aria-hidden="true"></i>
                            </span>
                            @if ($row->wapp == 1)
                              <span class="permWapp" title="Whatsapp" data-toggle="tooltip">
                                <i class="fa fa-whatsapp text-success" aria-hidden="true"></i>
                              </span>
                            @endif
                            <span class="tempWapp hide-this" title="Whatsapp" data-toggle="tooltip">
                              <i class="fa fa-whatsapp text-success" aria-hidden="true"></i>
                            </span>

                          </td>
                          <td>
                            <div id="followupDiv{{ $row->id }}">
                              @if ($row->lead_status != null)
                                <span>
                                  <span class="text-danger"
                                    title="{{ $row->getLastFup->getUser->name }}"><b>{{ Str::limit($row->getLastFup->getUser->name, 5) }}</b></span>
                                  <span
                                    class="float-right">{{ getFormattedDate($row->getLastFup->created_at, 'd M Y | h:i A') }}</span>
                                </span>
                                <hr class="chr">
                                <span class="text-info">{{ $row->getLastFup->getLS->title ?? '' }} |
                                  {{ $row->getLastFup->getLSS->sub_status ?? '' }}</span>
                                <hr class="chr">
                                <b>{{ getFormattedDate($row->getLastFup->next_followup_date, 'd M Y') }}</b>
                                @if ($row->getLastFup->followup_type != '' && $row->getLastFup->followup_status != '')
                                  <br>
                                  <span class="text-info">{{ $row->getLastFup->followup_type }} |
                                    {{ $row->getLastFup->followup_status }}</span>
                                  <br>
                                @endif
                                <p style="width:200px">{{ $row->getLastFup->remark }}</p>
                                <hr class="chr">
                                <p style="width:200px">{{ $row->getLastFup->comment }}</p>
                                <hr class="chr">
                              @endif
                            </div>
                            <small>
                              <a href="javascript:void()" onclick="changeStatusModelFunc('<?php echo $row->id; ?>')"
                                class="btn btn-xs btn-info" data-toggle="modal"
                                data-target="#changeStatusModel">Update</a>
                              <a onclick="viewCompleteFollowup('<?php echo $row->id; ?>')" href="javascript:void()"
                                data-toggle="modal" data-target="#commentListModel" class="btn btn-xs btn-danger"
                                title="Comments">View
                                All</a>
                            </small>
                          </td>
                          <td>
                            Name : {{ $row->name }}<br>
                            Contact : {{ $row->c_code . ' ' . $row->mobile }} <br>
                            Email : {{ $row->email }}<br>
                            Gender : {{ $row->gender }}<br>
                            DOB : {{ $row->dob }}<br>
                            Referred By : <b>{{ $row->referred_by }}</b><br>
                            <b>Password</b> : {{ $row->password }}
                          </td>
                          <td>{{ $row->getLevel->name ?? '' }}</td>
                          <td>
                            Application : {!! $row->submit_application == true
                                ? '<span class="badge bg-success">Submitted</span>'
                                : '<span class="badge bg-danger">Not Submitted</span>' !!} <br>
                            @if ($row->lastAttendedExam)
                              Exam : <a
                                href="{{ url('admin/student/' . $row->id . '/exams/' . $row->lastAttendedExam->id) }}"
                                class="btn btn-xs btn-primary" target="_blank">View Result</a> <br>
                              {{-- <button class="btn btn-xs btn-info" type="button"
                                onclick="sendResultToStudent('{{ $row->id }}','{{ $row->lastAttendedExam->id }}')">
                                Send Result
                              </button> --}}
                            @endif
                          </td>
                        </tr>
                        @php
                          $i++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                  {!! $rows->links('pagination::bootstrap-5') !!}
                </div>
                <hr>
                <div class="hide-this" id="submitBtn">
                  <a onclick="showLtypeBtnDiv()" href="javascript:void()" data-toggle="tooltip"
                    class="btn btn-sm btn-info" title="Move To" value="moveto">
                    Move To
                  </a>
                  <a onclick="showTeam()" href="javascript:void()" data-toggle="tooltip" class="btn btn-sm btn-info"
                    title="Asign" value="moveto">
                    Asign
                  </a>
                  <a onclick="showTeam2()" href="javascript:void()" data-toggle="tooltip"
                    class="btn btn-sm btn-primary" title="Un Asign" value="moveto">
                    Un Asign
                  </a>
                  <a title="Move to trash" data-toggle="tooltip" onclick="bulkSoftDelete()" href="javascript:void()"
                    class="btn btn-danger btn-sm">
                    Delete
                  </a>
                  <a title="Mark as Called" data-toggle="tooltip" onclick="ajaxBulkUpdate('called','1')"
                    href="javascript:void()" class="btn btn-success btn-sm">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                  </a>
                  <a title="Unmark as Called" data-toggle="tooltip" onclick="ajaxBulkUpdate('called','0')"
                    href="javascript:void()" class="btn btn-danger btn-sm">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                  </a>
                  <a title="Mark as whatsapp" data-toggle="tooltip" onclick="ajaxBulkUpdate('wapp','1')"
                    href="javascript:void()" class="btn btn-success btn-sm">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                  </a>
                  <a title="Unmark as whatsapp" data-toggle="tooltip" onclick="ajaxBulkUpdate('wapp','0')"
                    href="javascript:void()" class="btn btn-danger btn-sm">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                  </a>
                </div>
                <div class="hide-this" id="ltypeBtnDiv">
                  <hr>
                  @foreach ($alt as $lt2)
                    <a onclick="ajaxBulkUpdate('lead_type','{{ $lt2->slug }}')" href="javascript:void()"
                      data-toggle="tooltip" class="btn btn-sm btn-warning btn-outline">{{ ucwords($lt2->title) }}</a>
                  @endforeach
                </div>
                <div class="hide-this" id="CnslrBtnDiv">
                  <hr>
                  <h5>Counsellor</h5>
                  @foreach ($counsellor as $row)
                    <a onclick="asignLeads('{{ $row->id }}')" href="javascript:void()" id="{{ $row->id }}"
                      class="btn btn-sm btn-warning btn-outline">
                      {{ ucwords($row->name) }}</a>
                  @endforeach
                </div>
                <div class="hide-this" id="CnslrBtnDiv2">
                  <hr>
                  <h5>Counsellor</h5>
                  @foreach ($counsellor as $row)
                    <a onclick="unAsignLeads('{{ $row->id }}')" href="javascript:void()"
                      id="{{ $row->id }}" class="btn btn-sm btn-warning btn-outline">
                      {{ ucwords($row->name) }}</a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      @include('common.change-status-model')
      @include('common.view-all-follow-up')
    </div>
  </div>
  <script>
    function sendResultToStudent(studentId, examId) {
      //alert(studentId);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('common/send-result-to-student') }}" + "/" + studentId + "/" + examId,
          success: function(result) {
            if (result == '1') {
              var h = 'Success';
              var msg = 'Mail has been sent successfully';
              var type = 'success';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function showToastr(h, msg, type) {
      $.toast({
        heading: h,
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3000,
        stack: 6
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      $('#nationality').on('change', function(event) {
        var nationality = $('#nationality').val();
        $.ajax({
          url: "{{ url('common/get-country') }}",
          method: "GET",
          data: {
            nationality: nationality
          },
          success: function(result) {
            $('#country').html(result);
          }
        })
      });
      $('#country').on('change', function(event) {
        var nationality = $('#nationality').val();
        var country = $('#country').val();
        $.ajax({
          url: "{{ url('common/get-state') }}",
          method: "GET",
          data: {
            country: country,
            nationality: nationality
          },
          success: function(result) {
            $('#state').html(result);
          }
        })
      });
      $('#state').on('change', function(event) {
        var nationality = $('#nationality').val();
        var country = $('#country').val();
        var state = $('#state').val();
        $.ajax({
          url: "{{ url('common/get-city') }}",
          method: "GET",
          data: {
            country: country,
            nationality: nationality,
            state: state
          },
          success: function(result) {
            $('#city').html(result);
          }
        })
      });
      $('#city').on('change', function(event) {
        var nationality = $('#nationality').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        $.ajax({
          url: "{{ url('common/get-level') }}",
          method: "GET",
          data: {
            country: country,
            nationality: nationality,
            state: state,
            city: city
          },
          success: function(result) {
            $('#level').html(result);
          }
        })
      });
      // $('#level').on('change', function(event) {
      //   var nationality = $('#nationality').val();
      //   var country = $('#country').val();
      //   var state = $('#state').val();
      //   var city = $('#city').val();
      //   var level = $('#level').val();
      //   $.ajax({
      //     url: "{{ url('common/get-course') }}",
      //     method: "GET",
      //     data: {
      //       country: country,
      //       nationality: nationality,
      //       state: state,
      //       city: city,
      //       level: level
      //     },
      //     success: function(result) {
      //       $('#course').html(result);
      //     }
      //   })
      // });



      $('#f_lead_status').on('change', function(event) {
        var status_id = $('#f_lead_status').val();
        $.ajax({
          url: "{{ url('common/get-lead-sub-status-by-status') }}",
          method: "GET",
          data: {
            status_id: status_id
          },
          success: function(result) {
            $('#f_lead_sub_status').html(result);
          }
        })
      });
    });

    function unAsignLeads(user_id) {
      //alert(user_id);
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var student_id = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          student_id.push(userid);
        });
        //alert(student_id);
        $.ajax({
          url: "{{ url('common/unasign-leads') }}",
          type: 'GET',
          data: {
            student_id: student_id,
            user_id: user_id,
          },
          success: function(response) {
            //alert(response);
            if (response > 0) {
              location.reload(true);
            } else {
              var h = 'Danger';
              var msg = 'No data found';
              var type = 'danger';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function asignLeads(user_id) {
      var users_arr = [];
      $(".checkbox:checked").each(function() {
        var userid = $(this).val();
        users_arr.push(userid);
      });
      $.ajax({
        url: "{{ url('common/asign-leads') }}",
        type: 'get',
        data: {
          ids: users_arr,
          user_id: user_id
        },
        success: function(response) {
          if (response == 0) {
            var h = 'Danger';
            var msg = 'Leads already asigned';
            var type = 'danger';
            showToastr(h, msg, type);
          } else if (response > 0) {
            var h = 'Success';
            var msg = response + ' leads has been asigned successfully';
            var type = 'success';
            showToastr(h, msg, type);
            $("#" + user_id).attr("class", "btn btn-sm btn-success");
          }
          //location.reload(true);
        }
      });
    }

    function changeStatusModelFunc(id) {
      $('#leadStatusForm')[0].reset();
      $('#csId').val(id);
      var user_id = "{{ session()->get('adminLoggedIn')['user_id'] }}";
      $('#user_id').val(user_id);
    }

    function viewCompleteFollowup(id) {
      //alert(id);
      if (id != '') {
        $.ajax({
          url: "{{ url('common/get-all-follow-up') }}",
          method: "GET",
          data: {
            student_id: id
          },
          success: function(data) {
            //alert(data);
            $('#allcommentsmodelid').html(data);
          }
        });
      }
    }

    function showTeam() {
      $('#CnslrBtnDiv').toggle();
    }

    function showTeam2() {
      $('#CnslrBtnDiv2').toggle();
    }

    function showLtypeBtnDiv() {
      $('#ltypeBtnDiv').toggle();
    }

    function ajaxBulkUpdate(col, val) {
      //   var deleteConfirm = confirm("Are you sure?");
      //   if (deleteConfirm == true) {
      var tbl = 'students';
      var users_arr = [];
      $(".checkbox:checked").each(function() {
        var userid = $(this).val();
        users_arr.push(userid);
      });
      //alert(users_arr);
      $.ajax({
        url: "{{ url('common/update-bulk-field') }}",
        type: 'GET',
        data: {
          ids: users_arr,
          val: val,
          col: col,
          tbl: tbl
        },
        success: function(response) {
          if (response > '0') {
            var h = 'Success';
            var msg = response + ' rows updated successfully';
            var type = 'success';
            showToastr(h, msg, type);
          }
          if (col == 'called' && val == 1) {
            $('tr.selectedRow span.tempCalled').show();
            $('tr.selectedRow span.permCalled').hide();
          } else if (col == 'called' && val == 0) {
            $('tr.selectedRow span.tempCalled').hide();
            $('tr.selectedRow span.permCalled').hide();
          } else if (col == 'wapp' && val == 1) {
            $('tr.selectedRow span.tempWapp').show();
            $('tr.selectedRow span.permWapp').hide();
          } else if (col == 'wapp' && val == 0) {
            $('tr.selectedRow span.tempWapp').hide();
            $('tr.selectedRow span.permWapp').hide();
          } else {
            location.reload(true);
          }
        }
      });
      //}
    }

    $("#search").keyup(function() {
      var value = this.value.toLowerCase().trim();
      $("table tr").each(function(index) {
        if (!index) return;
        $(this).find("td").each(function() {
          var id = $(this).text().toLowerCase().trim();
          var not_found = (id.indexOf(value) == -1);
          $(this).closest('tr').toggle(!not_found);
          return not_found;
        });
      });
    });

    $(document).ready(function() {
      $('#check_all').on('click', function() {
        if (this.checked) {
          $('.checkbox').each(function() {
            this.checked = true;
            $(this).closest('tr').addClass('selectedRow');
          });
        } else {
          $('.checkbox').each(function() {
            this.checked = false;
            $(this).closest('tr').removeClass('selectedRow');
          });
        }
      });
      $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
          $('#check_all').prop('checked', true);
        } else {
          $('#check_all').prop('checked', false);
        }
      });
      $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length > 0) {
          $('#submitBtn').show();
        } else {
          $('#submitBtn').hide();
        }
      });
      $('#check_all').on('click', function() {
        if ($('.checkbox:checked').length > 0) {
          $('#submitBtn').show();
        } else {
          $('#submitBtn').hide();
        }
      });
      $('.checkbox').click(function() {
        if ($(this).is(':checked')) {
          $(this).closest('tr').addClass('selectedRow');
        } else {
          $(this).closest('tr').removeClass('selectedRow');
        }
      });
    });

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/student/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              $('#row' + id).remove();
              var h = 'Success';
              var msg = 'Record deleted successfully';
              var type = 'success';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function showToastr(h, msg, type) {
      $.toast({
        heading: h,
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3000,
        stack: 6
      });
    }

    function bulkSoftDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        //alert(users_arr);
        $.ajax({
          url: "{{ url('admin/student/bulk-delete') }}",
          type: 'GET',
          data: {
            ids: users_arr
          },
          success: function(response) {
            //alert(response);
            if (response > 0) {
              location.reload(true);
            }
          }
        });
      }
    }
    // ORDER BY, LIMIT PER PAGE
    $(document).ready(function() {
      $('#limit_per_page').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'limit_per_page' query parameter
        searchParams.set('limit_per_page', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#order_by').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'order_by' query parameter
        searchParams.set('order_by', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#order_in').change(function() {
        var selectedValue = $(this).val(); // Get the selected value
        var currentUrl = new URL(window.location.href); // Get the current URL
        var searchParams = currentUrl.searchParams;
        // Update or set the 'order_in' query parameter
        searchParams.set('order_in', selectedValue);
        // Update the URL by replacing the existing query string
        currentUrl.search = searchParams.toString();
        // Reload the page with the updated URL
        window.location.href = currentUrl.href;
      });
      $('#advSearchBtn').click(function() {
        $('#advSearchForm').toggle();
      });
    });
  </script>
@endsection
