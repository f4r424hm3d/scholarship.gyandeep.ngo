@php
  use App\Models\ExamPaymentDetails;
  $c_url = request()->path();
@endphp
@extends('backend.layouts.main')
@push('title')
  <title>Applications</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Applications</li>
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

          {{-- {{ printArray($dep) }} --}}
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Applications List</h4>
                <div style="float:right;" class="mb-0">
                  <input class="form-control" onkeyup="myNewF()" type="text" id="search" placeholder="Search">
                </div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th colspan="2">
                          <input style="opacity: 9;left:30px" type="checkbox" name="check_all" id="check_all"
                            value="" />
                        </th>
                        <th>Sr. No.</th>
                        <th>Student</th>
                        <th>Scholarship</th>
                        <th>Applied For</th>
                        <th>Asigned Exam</th>
                        <th>Payment Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        // printArray($rows->toArray());
                        // die;
                      @endphp
                      @foreach ($rows as $row)
                        @php
                          $cr = ExamPaymentDetails::where('application_id', $row->id)->count();
                        @endphp
                        <tr id="row{{ $row->id }}">
                          <td colspan="2">
                            <input style="opacity:9;left:30px" type="checkbox" name="selected_id[]" class="checkbox"
                              value="{{ $row->id }}" />
                          </td>
                          <td>{{ $i }}</td>
                          <td>
                            {{ $row->getStudent->name ?? '' }}
                          </td>
                          <td>
                            {{ $row->getScholarship->name ?? '' }}
                          </td>
                          <td>
                            Level - <b>{{ $row->getLevel->name }}</b><br>
                            Category - <b>{{ $row->getCat->category }}</b><br>
                            Subject - <b>{{ $row->getSubject->specialization ?? '' }}</b><br>
                            Exam Date - <b>{{ getFormattedDate($row->exam_date, 'd M Y') }}</b><br>
                            Mode Of Exam - <b>{{ $row->mode_of_exam }}</b><br>
                          </td>
                          <td>
                            Category - <b>{{ $row->getAsignExam->getExamDet->getCourseCategory->category }}</b><br>
                            Exam Date -
                            <b>{{ getFormattedDate($row->getAsignExam->getExamDet->exam_date, 'd M Y') }}</b><br>
                            Start Time
                            -
                            <b>{{ getFormattedDate($row->getAsignExam->getExamDet->start_time, 'd M Y - h:i A') }}</b><br>
                            End Time
                            - <b>{{ getFormattedDate($row->getAsignExam->getExamDet->end_time, 'd M Y - h:i A') }}</b>
                          </td>
                          <td>
                            @if ($row->getScholarship->exam_type == 'Free')
                              {{ $row->getScholarship->exam_type }}
                            @elseif ($row->getScholarship->exam_type == 'Paid')
                              <a href="javascript:void()" onclick="changePaymentStatus('{{ $row->id }}')"
                                data-toggle="modal" data-target="#changeAppStatusModel" class="text-primary">
                                {{ $row->payment_status }}
                              </a>
                              @if ($row->payment_status == 'Pending')
                                |<a href="javascript:void()"
                                  onclick="submitPaymentDetail('{{ $row->id }}','{{ $row->getStudent->id }}')"
                                  data-toggle="modal" data-target="#paymentFormModel" class="text-info">
                                  Pay Now
                                </a>
                              @endif
                              @if ($cr > 0)
                                |<a href="javascript:void()" onclick="viewPaymentDetail('{{ $row->id }}')"
                                  data-toggle="modal" data-target="#paymentDetailModel" class="text-info">
                                  View
                                </a>
                              @endif
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
                  <a title="Move to trash" data-toggle="tooltip" onclick="bulkDelete()" href="javascript:void()"
                    class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  {{-- <a title="Move to trash" data-toggle="tooltip" onclick="bulkExamAsign()" href="javascript:void()"
                  class="btn btn-success btn-sm">Asign Exam</a> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  @include('backend.payment-form')
  @include('backend.view-payment-detail')
  <script>
    function submitPaymentDetail(id, student_id) {
      $('#payment_application_id').val(id);
      $('#payment_student_id').val(student_id);
    }

    function viewPaymentDetail(id) {
      $.ajax({
        url: "{{ url('admin/applications/view-payment-detail') }}",
        type: 'get',
        data: {
          id: id
        },
        success: function(data) {
          //alert(data);
          $('#payDetTbl').html(data);
        }
      });
    }

    function bulkDelete() {
      var deleteConfirm = confirm("Are you sure?");
      if (deleteConfirm == true) {
        var users_arr = [];
        $(".checkbox:checked").each(function() {
          var userid = $(this).val();
          users_arr.push(userid);
        });
        //alert(users_arr);
        $.ajax({
          url: "{{ url('admin/applications/bulk-delete') }}",
          type: 'get',
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
          url: "{{ url('admin/scholarship/delete') }}" + "/" + id,
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
  </script>
@endsection
