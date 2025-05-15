@extends('front.layouts.main')
@push('title')
  <title>About Scholarship</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>About</li>
          <li>About Scholarship</li>
        </ul>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h1>About Scholarship</h1>
        </div>
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6">
            <p class="fs18 text-justify">Gyandeep NGO offers wide range of support for the global students in
              accomplishment of their higher educational aspirations. Gyandeep NGO corresponds with global universities
              in accommodating students through Merit based Scholarship Exams as per the criteria’s designated by them.
              Gyandeep NGO has been in collaboration with hundreds of Universities / Colleges, Corporates and
              Individual sponsors dedicatedly working to increase the opportunities for Undergraduate and Postgraduate
              educational aspirants. Gyandeep NGO will organize various scholarship exams depending on courses and
              colleges. All the Exams will be conducted in online format (Home Based Test & Computer Based Test). The
              Mudra Scholarship Exams were created with the goal of providing the best education to the brightest students
              by extending all relevant support for their higher education. All students whose families are experiencing
              financial difficulties and are unable to afford such a large sum for higher education can apply for the
              Mudra Scholarship Examination.</p>
          </div>
          <div class="col-lg-6">
            <figure class="add_bottom_30"><img src="{{ url('front/') }}/img/scholarship.jpg" class="img-fluid"
                alt=""></figure>
          </div>
        </div>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-12">
          <p class="fs18 text-justify">MSE is an inter-national wide merit-based scholarship admission test for Global
            students interested in medical, engineering, and other UG/PG courses. Since its inception, MSE has ignited the
            ambitions of over thousands of exceptional engineering, medical and other Bachelors and Postgraduate aspirants
            across the World through its Scholarship programmes.</p>
          <p class="fs18 text-justify">Students who seek to receive assistance in their higher education can take
            advantage of this programme, which gives benefits for higher education. The test conducting board is
            registered with India's central excise department under the Ministry of Finance Act 1994. Through the Mudra
            Scholarship Exams, the Mudra Scholarship programme aims to provide financial help to deserving engineering,
            medical, and other UG/PG students.</p>
        </div>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="row">
          <div class="col-lg-12">
            <p class="fs18 text-justify">MSE has developed a number of scholarship initiatives, including the MSE 2022
              Scholarship for medical, engineering, and other undergraduate and post graduate degrees. In most cases, the
              MSE will be held all over the year however most of them are in the months of May and June months. The exam
              will be held in online mode exclusively and will be held all throughout India. The scholarships will be
              awarded to the students based on their performance on the MSE examinations or other considering factors of
              the Sponsors / universities.</p>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </main>
@endsection
