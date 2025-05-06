@php
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Specialization;
use App\Models\Level;
use App\Models\Student;
use App\Models\AsignLeads;
$clt = Request::segment(3) ?? 'new';
unset($_GET['page']);
$url_arr = array_filter($_GET);
$qs = http_build_query($url_arr);
@endphp
@extends('employee.layouts.main')
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
            <div class="box hide-thi hideDiv">
              <div class="box-body">
                <h4 class="box-title text-info"> Filter</h4>
                <form method="get" class="form" enctype="multipart/form-data">
                  <hr class="my-15">
                  {{-- @csrf --}}
                  <div class="row">
                    <div class="form-group col-md-3 col-sm-12">
                      <label>Nationality</label>
                      <select name="nationality" id="nationality" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($nat as $na)
                          <option value="{{ $na->nationality }}"
                            {{ isset($_GET['nationality']) && $_GET['nationality'] == $na->nationality ? 'Selected' : '' }}>
                            {{ $na->nationality }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                      <label>Level</label>
                      <select name="level" id="level" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($lvl as $l)
                          <option value="{{ $l->current_qualification_level }}"
                            {{ isset($_GET['level']) && $_GET['level'] == $l->current_qualification_level ? 'Selected' : '' }}>
                            {{ $l->getLevel->name ?? '' }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                      <label>Course</label>
                      <select name="course" id="course" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($cc as $c)
                          <option value="{{ $c->intrested_course_category }}"
                            {{ isset($_GET['course']) && $_GET['course'] == $c->intrested_course_category ? 'Selected' : '' }}>
                            {{ $c->getCourse->category ?? '' }}</option>
                        @endforeach
                      </select>
                    </div>
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
                    <div class="form-group col-md-3">
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
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-3 col-sm-12">
                      <button type="submit" class="btn btn-sm  btn-primary ">Apply</button>
                      &nbsp;
                      <a href="{{ url('employee/students') }}" class="btn btn-sm  btn-info ">
                        <i class="ti-trash"></i> Clear All
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                @foreach ($lt as $lt)
                  @php
                    $allSi = AsignLeads::where('user_id', session()->get('userLoggedIn')['user_id'])->with('getStudent');
                    $allSi = $allSi->whereHas('getStudent', function ($query) use ($lt) {
                        $query->where('lead_type', $lt->slug);
                    });
                    // if ($_GET['nationality'] && $_GET['nationality'] != '') {
                    //     $nationality = $_GET['nationality'];
                    //     $allSi->whereHas('getStudent', function ($query) use ($nationality) {
                    //         $query->where('nationality', '=', $nationality);
                    //     });
                    // }
                    $allSi = $allSi->count();
                  @endphp
                  <a href="{{ url('employee/students/' . $lt->slug . '?' . $qs) }}"
                    class="btn btn-sm btn-{{ $clt == $lt->slug ? 'success' : 'info btn-outline' }}">{{ $lt->title }}
                    {{ $allSi }}</a>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Students List</h4>
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
                        <th>Action</th>
                        <th>Follow Up</th>
                        <th>Contact</th>
                        <th>Nationality</th>
                        <th>Inernational Id</th>
                        <th>Qualification Level</th>
                        <th>Intrested Course</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      @endphp
                      @foreach ($rows as $row)
                        @php

                        @endphp
                        <tr id="row{{ $row->getStudent->id }}">
                          <td>
                            <input style="opacity: 9;left:30px" type="checkbox" name="selected_id[]" class="checkbox"
                              value="{{ $row->getStudent->id }}" />
                          </td>
                          <td>
                            {{ $i }}&nbsp;&nbsp;
                            @if ($row->getStudent->called == 1)
                              <span class="permCalled" title="Called" data-toggle="tooltip">
                                <i class="fa fa-phone text-success" aria-hidden="true"></i>
                              </span>
                            @endif
                            <span class="tempCalled hide-this" title="Called" data-toggle="tooltip">
                              <i class="fa fa-phone text-success" aria-hidden="true"></i>
                            </span>
                            @if ($row->getStudent->wapp == 1)
                              <span class="permWapp" title="Whatsapp" data-toggle="tooltip">
                                <i class="fa fa-whatsapp text-success" aria-hidden="true"></i>
                              </span>
                            @endif
                            <span class="tempWapp hide-this" title="Whatsapp" data-toggle="tooltip">
                              <i class="fa fa-whatsapp text-success" aria-hidden="true"></i>
                            </span>
                          </td>
                          <td>
                            {{ getFormattedDate($row->created_at, 'd M Y h:i A') }}
                            <br>
                            <a href="{{ url('employee/student/' . $row->getStudent->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                          </td>
                          <td>
                            <div id="followupDiv{{ $row->getStudent->id }}">
                              @if ($row->getStudent->lead_status != null)
                                <span>
                                  <span class="text-danger"
                                    title="{{ $row->getStudent->getLastFup->getUser->name }}"><b>{{ Str::limit($row->getStudent->getLastFup->getUser->name, 5) }}</b></span>
                                  <span
                                    class="float-right">{{ getFormattedDate($row->getStudent->getLastFup->created_at, 'd M Y | h:i A') }}</span>
                                </span>
                                <hr class="chr">
                                <span class="text-info">{{ $row->getStudent->getLastFup->getLS->title }} |
                                  {{ $row->getStudent->getLastFup->getLSS->sub_status }}</span>
                                <hr class="chr">
                                <b>{{ getFormattedDate($row->getStudent->getLastFup->next_followup_date, 'd M Y') }}</b>
                                @if ($row->getStudent->getLastFup->followup_type != '' && $row->getStudent->getLastFup->followup_status != '')
                                  <br>
                                  <span class="text-info">{{ $row->getStudent->getLastFup->followup_type }} |
                                    {{ $row->getStudent->getLastFup->followup_status }}</span>
                                  <br>
                                @endif
                                <p style="width:200px">{{ $row->getStudent->getLastFup->remark }}</p>
                                <hr class="chr">
                                <p style="width:200px">{{ $row->getStudent->getLastFup->comment }}</p>
                                <hr class="chr">
                              @endif
                            </div>
                            <small>
                              <a href="javascript:void()" onclick="changeStatusModelFunc('<?php echo $row->getStudent->id; ?>')"
                                class="btn btn-xs btn-info" data-toggle="modal"
                                data-target="#changeStatusModel">Update</a>
                              <a onclick="viewCompleteFollowup('<?php echo $row->getStudent->id; ?>')" href="javascript:void()"
                                data-toggle="modal" data-target="#commentListModel" class="btn btn-xs btn-danger"
                                title="Comments">View
                                All</a>
                            </small>
                          </td>
                          <td>
                            {{ $row->getStudent->name }}<br>
                            {{ $row->getStudent->c_code . ' ' . $row->getStudent->mobile }} <br>
                            {{ $row->getStudent->email }}<br>
                            {{ $row->getStudent->gender }}<br>
                            {{ $row->getStudent->dob }}<br>
                          </td>
                          <td>{{ $row->getStudent->nationality }}</td>
                          <td>{{ $row->getStudent->aadhar }}</td>
                          <td>{{ $row->getStudent->getLevel->name ?? '' }}</td>
                          <td>{{ $row->getStudent->getCourse->category ?? '' }}</td>
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
    $(document).ready(function() {
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

    function changeStatusModelFunc(id) {
      $('#leadStatusForm')[0].reset();
      $('#csId').val(id);
      var user_id = "{{ session()->get('userLoggedIn')['user_id'] }}";
      $('#user_id').val(user_id);
    }

    function viewCompleteFollowup(id) {
      $('#allcommentsmodelid').html(
        '<center><div class="spinner-border spinner-border-s text-success mr-2" role="status"><span class="sr-only">Loading...</span></div></center>'
      );
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
      $('#UniBtnDiv').toggle();
      $('#frnchsBtnDiv').toggle();
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
        url: "{{ url('common/
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
          url: "{{ url('employee/student/delete') }}" + "/" + id,
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
          url: "{{ url('employee/student/bulk-delete') }}",
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
  </script>
@endsection
