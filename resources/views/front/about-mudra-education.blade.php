@extends('front.layouts.main')
@push('title')
  <title>About Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>About</li>
          <li>About Gyandeep NGO</li>
        </ul>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h1>About Gyandeep NGO</h1>
        </div>
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6">
            <p class="fs18">The Gyandeep NGO was created to form a consortium to approach for all students
              seeking financial aid at their schools / from other funding agencies to complete their aspirations of higher
              education. Our mission is to "provide educational possibilities for motivated but economically disadvantaged
              high school / graduate students, with a particular focus on merits." Gyandeep NGO awarded scholarships to
              member schools based on the proposals of the schools / colleges / universities / individual or company
              sponsors.</p>
            <p class="fs18">The Gyandeep NGO was established to encourage, support, and expand educational
              opportunities for ambitious, low-income students across the Globe. Our mission has made a significant impact
              on global students seeking educational opportunities and success.</p>
          </div>
          <div class="col-lg-6">
            <figure class="add_bottom_30"><img src="{{ url('front/') }}/img/about2.jpg" class="img-fluid" alt="">
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title">
        <h2>Why <strong>Choose Mudra</strong> Education</h2>
      </div>
      <div class="row">
        <div class="col-lg-7">
          <div class="box_feat_about text-center">
            <i class="icon-bullseye"></i>
            <h3>Our Mission</h3>
            <p>Is to promote education among the needed and deprived by collaborating, maintaining, supporting or
              organizing Merit and Need based scholarships through successful association of innumerable Universities,
              Colleges and Corporates across the world.</p>
          </div>

          <div class="box_feat_about text-center">
            <i class="icon-eye-6"></i>
            <h3>Our Vision</h3>
            <p>We envision to extend support for innumerable human resources through financial support to outstanding and
              needy students in entering their desired courses irrespective of race, religion, gender, caste, creed or
              economic status every year from various parts of the world.</p>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="box_feat_about">
            <div class="text-center">
              <i class="pe-7s-settings"></i>
              <h3>Our Services</h3>
              <p class="fs16">When any student acquired Merit Scholarship from Mudra program, they receive
                admission counselling and support according to their eligibility criteria and courses offered by our
                associated colleges / universities / others. Gyandeep NGO services includes:</p>
            </div>
            <ul class="fs16">
              <li>Fully funded scholarships</li>
              <li>Cash prizes for higher education</li>
              <li>Tuition Fees waivers starting from 25% up to 100%</li>
              <li>Personalized assistance in finding best scholarship programs</li>
              <li>Complete guidance in submitted all required admission process for enrollment of desired courses</li>
              <li>Assistance in Visa and other relevant processes</li>
              <li>Accommodation guidance</li>
              <li>Comprehensive Travel support</li>
            </ul>
          </div>
        </div>

      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h2>Global <strong>Scholarships at Mudra</strong> Education</h2>
        </div>
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6 text-justify">
            <p class="fs18">Studying abroad and pursuing a higher degree might be costly. However, if you choose
              the proper education for you and your goals, it may be well worth the investment, and Gyandeep NGO is
              committed to assisting you in finding methods to pay for college. A merit-based scholarship is awarded to
              all candidates. Students who maintain good academic standing can renew their merit scholarships.</p>
            <p class="fs18">Scholarship recipients must complete the universities / sponsors eligibility
              conditions and estimates can be included on the financial aid award notice. These mailings typically include
              estimates of any Campus-funded awards and any other financial help that the student may be eligible for.
              During the bill clearance process each term, the Office of Enrollment Services of concerned Universities /
              colleges / sponsors / Gyandeep NGO will compute the precise cash amount of any scholarship/grant award.
            </p>
          </div>
          <div class="col-lg-6">
            <figure class="add_bottom_30"><img src="{{ url('front/') }}/img/about.jpg" class="img-fluid" alt="">
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title">
        <h2>Tips while <strong>applying</strong> for <strong>Scholarships</strong></h2>
      </div>
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
          <figure class="add_bottom_30"><img src="{{ url('front/') }}/img/tips.jpg" class="img-fluid" alt="">
          </figure>
        </div>
        <div class="col-lg-6 text-justify">
          <div class=" tips">
            <ul class="fs18">
              <li>Fully funded scholarships</li>
              <li>Cash prizes for higher education</li>
              <li>Tuition Fees waivers starting from 25% up to 100%</li>
              <li>Personalized assistance in finding best scholarship programs</li>
              <li>Complete guidance in submitted all required admission process for enrollment of desired courses</li>
              <li>Assistance in Visa and other relevant processes</li>
              <li>Accommodation guidance</li>
              <li>Comprehensive Travel support</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h2 class="mb-2">Check for <strong>New Updates</strong></h2>
          <p>Look for scholarships that are tailored to your specific needs. Something that makes you stand out and be
            known for a scholarship, such as your academic merits, sportsmanship’s, NCC achievements, poet, artist,
            linguist, activist, writer, woman, minority, etc. The following list covers all scholarships that Mudra Global
            students have previously applied for and received, as well as a number of new scholarships. This page's
            material will be updated on a regular basis, so check back often to see what's new. </p>
        </div>
      </div>
    </div>
    <hr class="w-100">
  </main>
@endsection
