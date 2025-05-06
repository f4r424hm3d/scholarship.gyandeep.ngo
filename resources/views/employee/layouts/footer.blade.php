<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">FAQ</a>
      </li>
    </ul>
  </div>
</footer>
<div class="control-sidebar-bg"></div>
</div>
<!-- Vendor JS -->
<script src="{{ url('backend/main/') }}/js/vendors.min.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/chat-popup.js"></script>
<script src="{{ url('backend/assets/') }}/icons/feather-icons/feather.min.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/datatable/datatables.min.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/moment/min/moment.min.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/fullcalendar/fullcalendar.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script
  src="{{ url('backend/assets/') }}/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js">
</script>
<script src="{{ url('backend/assets/') }}/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/moment/min/moment.min.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script
  src="{{ url('backend/assets/') }}/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script
  src="{{ url('backend/assets/') }}/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
</script>
<script src="{{ url('backend/assets/') }}/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{ url('backend/assets/') }}/vendor_plugins/iCheck/icheck.min.js"></script>
<!-- Joblly App -->
<script src="{{ url('backend/main/') }}/js/jquery.smartmenus.js"></script>
<script src="{{ url('backend/main/') }}/js/menus.js"></script>
<script src="{{ url('backend/main/') }}/js/template.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/data-table.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/dashboard.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/calendar-dash.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/toastr.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/notification.js"></script>
<script src="{{ url('backend/main/') }}/js/pages/advanced-form-element.js"></script>

{{-- CUSTOM JS --}}
<script>
  $(document).ready(function() {
    $("#expandBtn").on('click', function() {
      $(".hideDiv").toggle();
    });
  });
</script>
</body>

</html>
