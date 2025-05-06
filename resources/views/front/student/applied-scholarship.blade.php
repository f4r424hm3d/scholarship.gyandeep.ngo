@php
  $c_url = request()->path();
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Applications - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
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
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px">
              <i class="icon-info-circled"></i> Applications
            </div>
            <div class="box_general_3">
              <table class="table">
                <thead>
                  <tr>
                    <th>Scholarship</th>
                    <th>Applied For</th>
                    <th>Exam Detail</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($as as $as)
                    <tr>
                      <td>
                        {{ $as->getScholarship->name }}
                      </td>
                      <td>
                        Level - <b>{{ $as->getLevel->name }}</b><br>
                        Category - <b>{{ $as->getCat->category }}</b><br>
                        {{-- Subject - <b>{{ $as->getSubject->specialization }}</b><br> --}}
                      </td>
                      <td>
                        Exam Date - <b>{{ getFormattedDate($as->exam_date, 'd M Y') }}</b><br>
                        Mode Of Exam - <b>{{ $as->mode_of_exam }}</b><br>
                      </td>
                      <td>
                        @if ($as->getScholarship->exam_type == 'Free')
                          {{ $as->getScholarship->exam_type }}
                        @elseif ($as->getScholarship->exam_type == 'Paid')
                          {{ $as->payment_status }}
                          @if ($as->payment_status == 'Pending')
                            <br>
                            <br>
                            <a target="_blank" class="text-danger"
                              href="{{ url('student/scholarship/exam/payment?token=' . $as->token . '&id=' . $as->id . '&url=' . $c_url) }}">Pay
                              Now</a>
                          @endif
                        @endif
                      </td>
                      <td></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
@endsection
