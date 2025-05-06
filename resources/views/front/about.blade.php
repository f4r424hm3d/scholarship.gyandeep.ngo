@extends('front.layouts.main')
@push('title')
  <title>About - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="#">Home</a></li>
          <li>About Gyandeep NGO</li>
        </ul>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h1>About Gyandeep NGO</h1>
          <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-6">
            <figure class="add_bottom_30"><img src="{{ url('front') }}/img/about_1.jpg" class="img-fluid" alt="">
            </figure>
          </div>
          <div class="col-lg-6">
            <p>Lorem ipsum dolor sit amet, homero erroribus in cum. Cu eos <strong>scaevola probatus</strong>. Nam atqui
              intellegat ei, sed ex graece essent delectus. Autem consul eum ea. Duo cu fabulas nonumes contentiones,
              nihil voluptaria pro id. Has graeci deterruisset ad, est no primis detracto pertinax, at cum malis vitae
              facilisis.</p>
            <p>Dicam diceret ut ius, no epicuri dissentiet philosophia vix. Id usu zril tacimates neglegentur. Eam id
              legimus torquatos cotidieque, usu decore <strong>percipitur definitiones</strong> ex, nihil utinam recusabo
              mel no. Dolores reprehendunt no sit, quo cu viris theophrastus. Sit unum efficiendi cu.</p>
            <p>Lorem ipsum dolor sit amet, homero erroribus in cum. Cu eos <strong>scaevola probatus</strong>. Nam atqui
              intellegat ei, sed ex graece essent delectus. Autem consul eum ea. Duo cu fabulas nonumes contentiones,
              nihil voluptaria pro id. Has graeci deterruisset ad, est no primis detracto pertinax, at cum malis vitae
              facilisis.</p>
            <p><em>CEO Marc Schumaker</em></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title">
        <h2>Why Choose Gyandeep NGO</h2>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-id"></i>
            <h3>+ 5575 Doctors</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris.</p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-help2"></i>
            <h3>H24 Support</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris. </p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-date"></i>
            <h3>Instant Booking</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris.</p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-headphones"></i>
            <h3>Help Direct Line</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris. </p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-credit"></i>
            <h3>Secure Payments</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris.</p>
          </a>
        </div>
        <div class="col-lg-4 col-md-6">
          <a class="box_feat_about" href="#0">
            <i class="pe-7s-chat"></i>
            <h3>Support via Chat</h3>
            <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option,
              cu sit mazim libris. </p>
          </a>
        </div>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="main_title">
          <h2>What user says about us</h2>
          <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Excellent!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar1.jpg"></figure>
                <h4>Dr. Joseph Luiss<span>Doctor</span></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Superb!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar2.jpg"></figure>
                <h4>Pablo Jemenez<span>User</span></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Very useful!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar3.jpg"></figure>
                <h4>Marc Twain<span>User</span></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Satisfied!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar3.jpg"></figure>
                <h4>Dr. Julia Roberts<span>Doctor</span></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Love it!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar2.jpg"></figure>
                <h4>Dr.John Doe<span>Doctor</span></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-review">
              <div class="rating">
                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i
                  class="icon_star voted"></i><i class="icon_star voted"></i> <strong>Great Support!</strong>
              </div>
              <p>"Lorem ipsum dolor sit amet, ne quas inermis nec, graece postea in nec. Eum propriae eligendi intellegam
                eu. Ius ei tation intellegat."</p>
              <div class="user_review">
                <figure><img src="{{ url('front') }}/img/avatar1.jpg"></figure>
                <h4>Lucas<span>User</span></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title">
        <h2>Our founders</h2>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
      </div>
      <div id="staff" class="owl-carousel owl-theme">
        <div class="item m-3">
          <a href="detail-page.html">
            <div class="title">
              <h4>Julia Holmes<em>CEO</em></h4>
            </div><img src="{{ url('front') }}/img/1_carousel.jpg" alt="">
          </a>
        </div>
        <div class="item m-3">
          <a href="detail-page.html">
            <div class="title">
              <h4>Lucas Smith<em>Marketing</em></h4>
            </div><img src="{{ url('front') }}/img/2_carousel.jpg" alt="">
          </a>
        </div>
        <div class="item m-3">
          <a href="detail-page.html">
            <div class="title">
              <h4>Paul Stephens<em>Business strategist</em></h4>
            </div><img src="{{ url('front') }}/img/3_carousel.jpg" alt="">
          </a>
        </div>
        <div class="item m-3">
          <a href="detail-page.html">
            <div class="title">
              <h4>Pablo Himenez<em>Customer Service</em></h4>
            </div><img src="{{ url('front') }}/img/4_carousel.jpg" alt="">
          </a>
        </div>
        <div class="item m-3">
          <a href="detail-page.html">
            <div class="title">
              <h4>Andrew Stuttgart<em>Admissions</em></h4>
            </div><img src="{{ url('front') }}/img/5_carousel.jpg" alt="">
          </a>
        </div>
      </div>
    </div>

  </main>
@endsection
