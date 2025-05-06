@php
  $c_url = request()->path();
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Provider Scholarship - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.provider.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
          <div id="notificationDiv">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
          </div>
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px">
              <div>
                <i class="icon-info-circled"></i> Scholarship
                <span>
                  <a class="btn btn-info float-end" href="{{ url('provider/scholarship/add') }}">
                    <i class="icon-plus"></i> Add
                  </a>
                </span>
              </div>
            </div>
            <div class="box_general_3">
              <div class="row">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Eligibility</th>
                      <th>Deadline</th>
                      <th>Covers</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($rows as $row)
                      <tr id="row{{ $row->id }}">
                        <td>{{ $i }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->eligibility }}</td>
                        <td>{{ getFormattedDate($row->deadline, 'd-M-Y') }}</td>
                        <td>
                          {{ $row->covers }}
                          <br>
                          {{ $row->covers_notes != '' ? '(' . $row->covers_notes . ')' : '' }}
                        </td>
                        <td>
                          @if ($row->status == 0)
                            <span class="text-danger">Inactive</span>
                          @elseif ($row->status == 1)
                            <span class="text-success">Active</span>
                          @endif
                        </td>
                        <td>
                          <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                            class="waves-effect waves-light btn btn-sm btn-outline btn-danger" title="delete">
                            <i class="icon-trash" aria-hidden="true"></i>
                          </a>
                          <a title="View full details" href="{{ url('provider/scholarship/' . $row->id) }}"
                            class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                            <i class="icon-eye" aria-hidden="true"></i>
                          </a>
                        </td>
                      </tr>
                      @php
                        $i++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
  <script>
    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('provider/scholarship/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              $('#row' + id).remove();
              $('#notificationDiv').html(
                '<div class="alert alert-success alert-dismissable">Record deleted.</div>');
            }
          }
        });
      }
    }
  </script>
@endsection
