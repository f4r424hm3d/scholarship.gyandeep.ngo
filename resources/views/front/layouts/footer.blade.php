<footer>
  <div class="container margin_60_35">

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
<script src="{{ url('backend/assets/') }}/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ url('front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('front/js/common_scripts.min.js') }}"></script>
<script src="{{ url('front/js/functions.js') }}"></script>
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
