</div>
<script>
  // // Check if the browser supports the Page Visibility API
  // if (typeof document.hidden !== "undefined") {
  //   var hidden, visibilityChange;
  //   if (typeof document.hidden !== "undefined") { // Opera 12.10 and Firefox 18 and later support
  //     hidden = "hidden";
  //     visibilityChange = "visibilitychange";
  //   }

  //   // Function to handle visibility change
  //   function handleVisibilityChange() {
  //     if (document[hidden]) {
  //       // The page is hidden, submit the exam
  //       submitExam();
  //     }
  //   }

  //   // Add event listener for visibility change
  //   document.addEventListener(visibilityChange, handleVisibilityChange, false);
  // }

  // // Function to submit the exam
  // function submitExam() {
  //   // Add your logic to submit the exam here
  //   alert("Exam submitted because you left the page or changed tabs.");
  // }
</script>
<!-- Vendor JS -->
<script src="{{ url('testapp/') }}/assets/js/vendors.min.js"></script>
<script src="{{ url('testapp/') }}/assets/js/pages/chat-popup.js"></script>
<script src="{{ url('testapp/') }}/assets/icons/feather-icons/feather.min.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/iCheck/icheck.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="{{ url('testapp/') }}/assets/js/pages/mailbox.js"></script>
<script src="{{ url('testapp/') }}/assets/js/pages/form-compose.js"></script>
<!-- Popup Form -->
<script src="{{ url('testapp/') }}/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js">
</script>
<script src="{{ url('testapp/') }}/assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js">
</script>
<!-- Joblly App -->
<script src="{{ url('testapp/') }}/assets/js/jquery.smartmenus.js"></script>
<script src="{{ url('testapp/') }}/assets/js/menus.js"></script>
<script src="{{ url('testapp/') }}/assets/js/template.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script
  src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js">
</script>
<script src="{{ url('testapp/') }}/assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_components/moment/min/moment.min.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script
  src="{{ url('testapp/') }}/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
</script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{ url('testapp/') }}/assets/vendor_plugins/iCheck/icheck.min.js"></script>
<script src="{{ url('testapp/') }}/assets/js/pages/advanced-form-element.js"></script>
<!-- Right Click Disable -->
<script type="text/javascript">
  $(document).bind("contextmenu", function(e) {
    return false;
  });
  // Disable specific key combinations
  document.addEventListener('keydown', function(e) {
    if (
      (e.ctrlKey && e.key.toLowerCase() === 'u') || // Ctrl+U
      (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'i') || // Ctrl+Shift+I
      (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'j') || // Ctrl+Shift+J
      (e.ctrlKey && e.key.toLowerCase() === 's') || // Ctrl+S
      (e.key === 'F12') // F12
    ) {
      e.preventDefault();
      alert("This action is disabled on this page.");
    }
  });
</script>
</body>

</html>
