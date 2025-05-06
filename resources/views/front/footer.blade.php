<footer>
  <div class="container margin_60_35">
    <!--div class="row">
      <div class="col-lg-2 col-md-4">
        <h5>By subject</h5>
        <ul class="links">
          <li><a href="">Arts Scholarships</a></li>
          <li><a href="">Architecture Scholarships</a></li>
          <li><a href="">Sports Scholarships</a></li>
          <li><a href="">Engineering Scholarships</a></li>
          <li><a href="">Law Scholarships</a></li>
          <li><a href="">MBA scholarships</a></li>
          <li><a href="">Undergraduate Scholarships</a></li>
          <li><a href="">Masters Scholarships</a></li>
          <li><a href="">PhD Scholarships</a></li>
          <li><a href="">Post-Doc Fellowships</a></li>
          <li><a href="">Scholarships for women</a></li>
          <li><a href="">Postgraduate scholarships</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5>By nationality</h5>
        <ul class="links">
          <li><a href="">International Scholarships</a></li>
          <li><a href="">Scholarships for India</a></li>
          <li><a href="">Scholarships for Pakistani</a></li>
          <li><a href="">Scholarships for China</a></li>
          <li><a href="">Scholarships for UK</a></li>
          <li><a href="">Scholarships for Malaysia</a></li>
          <li><a href="">Scholarships for Canada</a></li>
          <li><a href="">Scholarships for School</a></li>
          <li><a href="">Scholarships for African</a></li>
          <li><a href="">Fulbright Scholarships</a></li>
          <li><a href="">Commonwealth Scholarship</a></li>
          <li><a href="">Inspire fellowship</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5>By subject</h5>
        <ul class="links">
          <li><a href="">Arts Scholarships</a></li>
          <li><a href="">Architecture Scholarships</a></li>
          <li><a href="">Sports Scholarships</a></li>
          <li><a href="">Engineering Scholarships</a></li>
          <li><a href="">Law Scholarships</a></li>
          <li><a href="">MBA scholarships</a></li>
          <li><a href="">Undergraduate Scholarships</a></li>
          <li><a href="">Masters Scholarships</a></li>
          <li><a href="">PhD Scholarships</a></li>
          <li><a href="">Post-Doc Fellowships</a></li>
          <li><a href="">Scholarships for women</a></li>
          <li><a href="">Postgraduate scholarships</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5>By nationality</h5>
        <ul class="links">
          <li><a href="">International Scholarships</a></li>
          <li><a href="">Scholarships for India</a></li>
          <li><a href="">Scholarships for Pakistani</a></li>
          <li><a href="">Scholarships for China</a></li>
          <li><a href="">Scholarships for UK</a></li>
          <li><a href="">Scholarships for Malaysia</a></li>
          <li><a href="">Scholarships for Canada</a></li>
          <li><a href="">Scholarships for School</a></li>
          <li><a href="">Scholarships for African</a></li>
          <li><a href="">Fulbright Scholarships</a></li>
          <li><a href="">Commonwealth Scholarship</a></li>
          <li><a href="">Inspire fellowship</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5>By subject</h5>
        <ul class="links">
          <li><a href="">Arts Scholarships</a></li>
          <li><a href="">Architecture Scholarships</a></li>
          <li><a href="">Sports Scholarships</a></li>
          <li><a href="">Engineering Scholarships</a></li>
          <li><a href="">Law Scholarships</a></li>
          <li><a href="">MBA scholarships</a></li>
          <li><a href="">Undergraduate Scholarships</a></li>
          <li><a href="">Masters Scholarships</a></li>
          <li><a href="">PhD Scholarships</a></li>
          <li><a href="">Post-Doc Fellowships</a></li>
          <li><a href="">Scholarships for women</a></li>
          <li><a href="">Postgraduate scholarships</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-4">
        <h5>By nationality</h5>
        <ul class="links">
          <li><a href="">International Scholarships</a></li>
          <li><a href="">Scholarships for India</a></li>
          <li><a href="">Scholarships for Pakistani</a></li>
          <li><a href="">Scholarships for China</a></li>
          <li><a href="">Scholarships for UK</a></li>
          <li><a href="">Scholarships for Malaysia</a></li>
          <li><a href="">Scholarships for Canada</a></li>
          <li><a href="">Scholarships for School</a></li>
          <li><a href="">Scholarships for African</a></li>
          <li><a href="">Fulbright Scholarships</a></li>
          <li><a href="">Commonwealth Scholarship</a></li>
          <li><a href="">Inspire fellowship</a></li>
        </ul>
      </div>
    </div>
    <hr /-->
    <div class="row">
      <div class="col-md-8">
        <ul id="additional_links">
          <li> <a target="_blank" href="{{ url('eligibility-criteria') }}">Eligibility Criteria</a> </li>
          <li> <a target="_blank" href="{{ url('terms-conditions') }}">Terms and Conditions</a> </li>
          <li><a target="_blank" href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
          <li><a target="_blank" href="{{ url('disclaimer') }}">Disclaimer</a></li>
          <li><a target="_blank" href="{{ url('copyright-policy') }}">Copyright Policy</a></li>
          <li> <a target="_blank" href="{{ url('cancellation-refund') }}">Cancellation and Refund</a> </li>
        </ul>
      </div>
      <div class="col-md-4">
        <div id="copy">Copyright © 2022 all rights reserved</div>
      </div>
    </div>
  </div>
</footer>
</div>
<!-- page -->
<div id="toTop"></div>
<!-- Back to top button -->
<!-- COMMON SCRIPTS -->
<script src="{{ url('front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('front/js/common_scripts.min.js') }}"></script>
<script src="{{ url('front/js/functions.js') }}"></script>
<script>

  (function($) {

    $.fn.countTo = function(options) {

      options = options || {};



      return $(this).each(function() {

        // set options for current element

        var settings = $.extend({},

          $.fn.countTo.defaults, {

            from: $(this).data("from"),

            to: $(this).data("to"),

            speed: $(this).data("speed"),

            refreshInterval: $(this).data("refresh-interval"),

            decimals: $(this).data("decimals"),

          },

          options

        );



        // how many times to update the value, and how much to increment the value on each update

        var loops = Math.ceil(settings.speed / settings.refreshInterval),

          increment = (settings.to - settings.from) / loops;



        // references & variables that will change with each update

        var self = this,

          $self = $(this),

          loopCount = 0,

          value = settings.from,

          data = $self.data("countTo") || {};



        $self.data("countTo", data);



        // if an existing interval can be found, clear it first

        if (data.interval) {

          clearInterval(data.interval);

        }

        data.interval = setInterval(updateTimer, settings.refreshInterval);



        // initialize the element with the starting value

        render(value);



        function updateTimer() {

          value += increment;

          loopCount++;



          render(value);



          if (typeof settings.onUpdate == "function") {

            settings.onUpdate.call(self, value);

          }



          if (loopCount >= loops) {

            // remove the interval

            $self.removeData("countTo");

            clearInterval(data.interval);

            value = settings.to;



            if (typeof settings.onComplete == "function") {

              settings.onComplete.call(self, value);

            }

          }

        }



        function render(value) {

          var formattedValue = settings.formatter.call(

            self,

            value,

            settings

          );

          $self.html(formattedValue);

        }

      });

    };



    $.fn.countTo.defaults = {

      from: 0, // the number the element should start at

      to: 0, // the number the element should end at

      speed: 1000, // how long it should take to count between the target numbers

      refreshInterval: 100, // how often the element should be updated

      decimals: 0, // the number of decimal places to show

      formatter: formatter, // handler for formatting the value before rendering

      onUpdate: null, // callback method for every time the element is updated

      onComplete: null, // callback method for when the element finishes updating

    };



    function formatter(value, settings) {

      return value.toFixed(settings.decimals);

    }

  })(jQuery);



  jQuery(function($) {

    // custom formatting example

    $(".count-number").data("countToOptions", {

      formatter: function(value, options) {

        return value

          .toFixed(options.decimals)

          .replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");

      },

    });



    // start all the timers

    $(".timer").each(count);



    function count(options) {

      var $this = $(this);

      options = $.extend({},

        options || {},

        $this.data("countToOptions") || {}

      );

      $this.countTo(options);

    }

  });

</script>

<script>
  $(".show-more").click(function() {
    if ($(".text").hasClass("show-more-height")) {
      $(this).text("(Show Less)");
    } else {
      $(this).text("(Show More)");
    }
    $(".text").toggleClass("show-more-height");
  });
</script>
</body>
</html>