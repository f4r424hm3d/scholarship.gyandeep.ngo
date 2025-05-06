@extends('front.layouts.main')

@push('title')
  <title>Gyandeep NGO</title>
@endpush

@section('main-section')

  <main>

    <div class="bg_color_1">

      <div class="hero_home version_1">

        <div class="content"> <i class="icon-trophy" style="font-size: 70px; color: #fff"></i>

          <!--h3>Find Scholarships Globally</h3>

                                                                                                    p-->

          <h3>Explore your Scholarship Options</h3>

          <p>Mudra Scholarships, Empowering the world </p>

          <div class="container">

            <div class="row">

              <div class="col-md-10 offset-md-1">

                <div class="scholarsship-search-main">

                  <form action="{{ url('scholarships') }}" method="get" id="scholarship-search-submit">

                    <div class="txtWrap">

                      <div class="select-box">

                        <select name="nationality" id="nationality" class="form-control">

                          <option value="">Select Nationality</option>
                          @foreach ($filter_nationality as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="txtWrap">
                      <div class="select-box">
                        <select name="level_id" id="level_id" class="form-control">
                          <option value="">Select Study Level</option>
                          @foreach ($filter_level as $lvl)
                            <option value="{{ $lvl->id }}">{{ $lvl->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="txtWrap">
                      <div class="select-box">
                        <select name="intrest" id="intrest" class="form-control">
                          <option value="">Select Fields intrested in</option>
                          @foreach ($spc as $spc)
                            <option value="{{ $spc->id }}">{{ $spc->specialization }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="btnWrap">
                      <div class="clearfix"></div>
                      <button type="submit" class="searchbtn"></button>
                    </div>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <!-- <div class="main_title">
                    <h2>How <strong>It Works</strong>!</h2>
                    <p>Learn how Mudra's renowned merit-based scholar programmes come together to create a community of scholars
                      empowering world-wide higher education aspirants.</p>
                  </div> -->
        <div class="row add_bottom_30">
          <div class="col-lg-4">
            <div class="box_feat" id="icon_1"><span></span>
              <h3>Scholarship Search</h3>
              <p class="mb-2">You can search for current opportunities by nationality, field of study, or
                degree. We also offer multidisciplinary scholarships including 100% free education, cash funding on merit
                basis. Search for all the criteria and choose the best.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_feat" id="icon_2"><span></span>
              <h3>Eligibility Check</h3>
              <p>It doesn't matter where you came from; what matters is where you're going. Check the eligibility and
                Register.<i><br /><br /><br /></i></p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_feat" id="icon_3">
              <h3>Registration</h3>
              <p>Apply for scholarships using an easy-to-use form by filling all the relevant fields required. Keep an eye

                out for Gyandeep NGO notifications in your inbox or on your phone for latest updates.</p>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="hero_register">
      <div class="container margin_120_95">
        <div class="row">
          <div class="col-lg-6">
            <div class="wel-content">
              <h2 class="wel-heading">Mudra <strong>Education Trust</strong></h2>
              <p>Welcome to Gyandeep NGO, a beacon of hope and opportunity in the realm of education and
                community development. Founded with a deep-seated commitment to nurturing aspirations and fostering
                leadership, Gyandeep NGO stands as a testament to the transformative power of education. Our
                journey is fueled by the belief that every individual, regardless of background or circumstance, deserves
                access to quality education that can shape a brighter future. At Mudra, we go beyond traditional
                educational paradigms, providing life-changing scholarships and empowering students with the skills and
                qualities needed to lead and contribute meaningfully to society.</p>

              <p>Our vision is rooted in the idea of a world where education is a catalyst for positive change. We strive
                to create an environment where equality flourishes, health is prioritized, and communities thrive. Mudra
                Education Trust actively engages in projects that contribute to holistic community development, aiming for
                sustainability and resilience. As we continue to grow and evolve, our commitment to empowering through
                education, fostering equality, advancing health, and building thriving communities remains unwavering.
                Join us on this journey of empowerment and transformation, and together, let's shape a better tomorrow for
                all.</p>
            </div>
          </div>
          <!-- /col -->
          <div class="col-lg-5 ml-auto">
            <div class="welcome-img">
              <img src="front/img/welcome.jpg">
            </div>
            <!-- /box_form -->
          </div>
          <!-- /col -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <section class="service-sec">
      <div class="container">
        <h2>Our <strong> Services</strong></h2>
        <div class="flex">
          <div class="card">
            <h4>Educational Empowerment Services</h4>
            <p>At Gyandeep NGO, we are dedicated to empowering motivated high school and graduate students to
              continue their education journey. Our core initiative includes providing scholarships to individuals facing
              economic challenges.</p>
            <a class="read-btn">Read More</a>
          </div>
          <div class="card">
            <h4>Equality and Women's Empowerment</h4>
            <p>We believe in fostering equality and empowering women through skill development programs. Tailored to
              enhance their skills, knowledge, and confidence, these programs open up new avenues for personal and
              professional growth.</p>
            <a class="read-btn">Read More</a>
          </div>
          <div class="card">
            <h4>Health Advancement</h4>
            <p>Gyandeep NGO is dedicated to advancing health awareness within communities. Through targeted
              campaigns and initiatives, we strive to educate individuals on health-related issues, preventive measures,
              and the significance of adopting a healthy lifestyle.</p>
            <a class="read-btn">Read More</a>
          </div>
          <div class="card">
            <h4>Thriving Communities:</h4>
            <p>Contributing to the development of thriving communities is a cornerstone of our mission. Gyandeep NGO
              Trust engages in various community development projects, covering aspects such as infrastructure development
              and environmental sustainability.These initiatives aim to enhance the overall well-being of communities,
            </p>
            <a class="read-btn">Read More</a>
          </div>
        </div>
      </div>

    </section>
    <div class="container margin_60_35">
      <div class="main_title">
        <h2>Scholarships by <strong>Degree</strong> Level</h2>
      </div>
      <div id="levelFront" class="owl-carousel owl-theme">
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/graduate.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">Bachelor</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/masters.png" alt="" /></a>
            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">Masters</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/phd.png" alt="" /></a>
            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">PhD</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/post-decorate.png" alt="" /></a>
            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">Post Decorate</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/diploma.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">

              <h3 class="mb-0">Diploma</h3>

            </div>

          </div>

        </div>

        <div class="item p-3">

          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/under-graduate.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">

              <h3 class="mb-0">Training and Short courses</h3>

            </div>

          </div>

        </div>

        <div class="item p-3">

          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/research.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">Research Fellow or Scientist</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/bachelor.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">MBA</h3>
            </div>
          </div>
        </div>
        <div class="item p-3">
          <div class="box_list wow fadeIn animated mb-0 pt-4"> <a href="#"><img
                src="{{ url('front/') }}/img/icon-level/post-decorate.png" alt="" /></a>

            <div class="wrapper p-3 pt-2 text-center">
              <h3 class="mb-0">Other</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="app_section">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-4">
            <h3>Want to study for Free</h3>
            <p class="lead mb-0">Apply for Mudra Scholarships</p>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3"><a href="" class="btn_1 text-center pt-3 pb-3 w-100 mt-2 mb-3 fs-6"
              style=" background:#be1f2c; color:#fff!important;">Apply Now For Scholarship</a></div>
        </div>
      </div>
    </div>
    <div class="container margin_60_35">
      <div class="main_title">
        <h2> Find the best opportunity <strong>Programs/Scholarships</strong> to study in abroad </h2>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/engineering-50.png" width="60"
              height="60" alt="" />
            <h3>Engineering</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/manager-50.png" width="60"
              height="60" alt="" />
            <h3>Management</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/law-50.png" width="60" height="60"
              alt="" />
            <h3>Law</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/art_prices-50.png" width="60"
              height="60" alt="" />
            <h3>Art</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/apartment-50.png" width="60"
              height="60" alt="" />
            <h3>Architecture</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/spade-50.png" width="60"
              height="60" alt="" />
            <h3>Agriculture</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/dna_helix-50.png" width="60"
              height="60" alt="" />
            <h3>Life Sciences</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/pill-50.png" width="60"
              height="60" alt="" />
            <h3>Pharmacy</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/clinic-50.png" width="60"
              height="60" alt="" />
            <h3>Medicine</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/advertising-50.png" width="60"
              height="60" alt="" />
            <h3>Mass Communication</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/3d_glasses_filled-50.png" width="60"
              height="60" alt="" />
            <h3>Fashion</h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
          <div class="box_cat_home"><img src="{{ url('front/') }}/img/icons/design-50.png" width="60"
              height="60" alt="" />
            <h3>Design</h3>
          </div>
        </div>
      </div>
    </div>
    @if (count($providers) > 0)
      <div class="bg_color_1">
        <div class="container margin_60_35">
          <div class="main_title mb-0">
            <h2>Top <strong>Trending Scholarships</strong> Provider</h2>
          </div>
          <div id="reccomended" class="owl-carousel owl-theme mt-4">
            @foreach ($providers as $p)
              <div class="item p-3">
                <div class="box_list wow fadeIn animated mb-0">
                  <a href="{{ url('provider/' . $p->slug) }}">
                    <img src="{{ asset($p->logo_path) }}" alt="{{ $p->provider_name }}" class="img-fluid" />
                  </a>
                  <div class="wrapper p-3 pt-2 text-center">
                    <h3 class="mb-0">{{ $p->provider_name }}</h3>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif
    @if (count($scholarship) > 0)
      <div class="container margin_60_35">
        <div class="main_title mb-0">
          <h2>Popular <strong>Scholarships</strong></h2>
        </div>
        <div id="reccomended" class="owl-carousel owl-theme mt-4">
          @foreach ($scholarship as $s)
            <div class="item mb-4">
              <div class="box_list wow fadeIn animated">
                <figure style="height: inherit">
                  <a href="{{ url('scholarship/' . $s->id . '/' . $s->slug) }}">
                    <img src="{{ asset($s->getProvider->logo_path) }}" class="img-fluid" alt="{{ $s->name }}" />

                  </a>
                </figure>
                <div class="wrapper p-3">
                  <h3 class="mb-0">{{ $s->name }}</h3>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <p class="text-center"> <a href="{{ url('scholarships') }}" class="btn_1 medium">View All Latest
            Scholarships</a> </p>
      </div>
    @endif
    @if (count($blogs) > 0)
      <div class="bg_color_1">
        <div class="container margin_60_35">
          <div class="main_title mb-0">
            <h2><strong>Blog</strong> & News</h2>
          </div>
          <div id="reccomended" class="owl-carousel owl-theme mt-4">

            @foreach ($blogs as $b)
              <div class="item mb-4">

                <a href="{{ url('blog/' . $b->id . '/' . $b->slug) }}">

                  {{-- <div class="views">

                  <i class="icon-eye-7"></i>98

                </div> --}}

                  <div class="title">

                    <h4>{{ $b->title }}</h4>

                  </div>

                  <img src="{{ asset($b->image_path) }}" alt="{{ $b->title }}" />

                </a>

              </div>
            @endforeach

          </div>

        </div>

      </div>
    @endif

  </main>

@endsection
