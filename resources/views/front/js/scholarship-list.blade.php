<script>
  function AppliedFilterNationality(col, val) {
    //alert(col + ' , faraz , ' + val);
    const element_array = [];
    var n_u = col + '=' + val;
    var l_u = '{{ $l_u }}';
    var int_u = '{{ $int_u }}';
    var p_u = '{{ $p_u }}';
    var pt_u = '{{ $pt_u }}';
    if (n_u != '') {
      element_array.push(n_u);
    }
    if (l_u != '') {
      element_array.push(l_u);
    }
    if (int_u != '') {
      element_array.push(int_u);
    }
    if (p_u != '') {
      element_array.push(p_u);
    }
    if (pt_u != '') {
      element_array.push(pt_u);
    }
    let full_url = element_array.join("&");
    //alert(full_url);
    if (val != '') {
      window.location.replace("{{ url('scholarships') }}?" + full_url);
    }
  }

  function AppliedFilterLevel(col, val) {
    //alert(col + ' , faraz , ' + val);
    const element_array = [];
    var n_u = '{{ $n_u }}';
    var l_u = col + '=' + val;
    var int_u = '{{ $int_u }}';
    var p_u = '{{ $p_u }}';
    var pt_u = '{{ $pt_u }}';
    if (n_u != '') {
      element_array.push(n_u);
    }
    if (l_u != '') {
      element_array.push(l_u);
    }
    if (int_u != '') {
      element_array.push(int_u);
    }
    if (p_u != '') {
      element_array.push(p_u);
    }
    if (pt_u != '') {
      element_array.push(pt_u);
    }
    let full_url = element_array.join("&");
    // alert(full_url);
    if (val != '') {
      window.location.replace("{{ url('scholarships') }}?" + full_url);
    }
  }

  function AppliedFilterIntrest(col, val) {
    //alert(col + ' , faraz , ' + val);
    const element_array = [];
    var n_u = '{{ $n_u }}';
    var l_u = '{{ $l_u }}';
    var int_u = col + '=' + val;
    var p_u = '{{ $p_u }}';
    var pt_u = '{{ $pt_u }}';
    if (n_u != '') {
      element_array.push(n_u);
    }
    if (l_u != '') {
      element_array.push(l_u);
    }
    if (int_u != '') {
      element_array.push(int_u);
    }
    if (p_u != '') {
      element_array.push(p_u);
    }
    if (pt_u != '') {
      element_array.push(pt_u);
    }
    let full_url = element_array.join("&");
    //alert(full_url);
    if (val != '') {
      window.location.replace("{{ url('scholarships') }}?" + full_url);
    }
  }

  function AppliedFilterPayment(col, val) {
    //alert(col + ' , faraz , ' + val);
    const element_array = [];
    var n_u = '{{ $n_u }}';
    var l_u = '{{ $l_u }}';
    var int_u = '{{ $int_u }}';
    var p_u = col + '=' + val;
    var pt_u = '{{ $pt_u }}';
    if (n_u != '') {
      element_array.push(n_u);
    }
    if (l_u != '') {
      element_array.push(l_u);
    }
    if (int_u != '') {
      element_array.push(int_u);
    }
    if (p_u != '') {
      element_array.push(p_u);
    }
    if (pt_u != '') {
      element_array.push(pt_u);
    }
    let full_url = element_array.join("&");
    //alert(full_url);
    if (val != '') {
      window.location.replace("{{ url('scholarships') }}?" + full_url);
    }
  }

  function AppliedFilterProvider(col, val) {
    //alert(col + ' , faraz , ' + val);
    const element_array = [];
    var n_u = '{{ $n_u }}';
    var l_u = '{{ $l_u }}';
    var int_u = '{{ $int_u }}';
    var p_u = '{{ $p_u }}';
    var pt_u = col + '=' + val;
    if (n_u != '') {
      element_array.push(n_u);
    }
    if (l_u != '') {
      element_array.push(l_u);
    }
    if (int_u != '') {
      element_array.push(int_u);
    }
    if (p_u != '') {
      element_array.push(p_u);
    }
    if (pt_u != '') {
      element_array.push(pt_u);
    }
    let full_url = element_array.join("&");
    //alert(full_url);
    if (val != '') {
      window.location.replace("{{ url('scholarships') }}?" + full_url);
    }
  }

  function removeAppliedFilter(value) {
    //alert(value);
    //die();
    if (value != '') {
      window.location.replace("{{ url('scholarships') }}");
    }
  }
</script>
