@php
use App\Models\Provider;
use Illuminate\Database\Eloquent\Builder;
$slug = Request::segment(2);
$toppro = Provider::where('slug', '!=', $slug)
    ->where('status', '=', '1')
    ->paginate(10);
@endphp
<aside class="col-xl-4 col-lg-4">
  <div class="box_general_3 booking pb-4">
    <div class="title">
      <h3>Top Scholarship Provider</h3>
    </div>
    <div class="widget mb-0">
      <ul class="comments-list mb-0">
        @foreach ($toppro as $tp)
          <li>
            <div class="alignleft">
              <a target="_blank" href="{{ url('provider/' . $tp->slug) }}">
                <img src="{{ asset($tp->logo_path) }}" alt="{{ $tp->provider_name }}">
              </a>
            </div>
            <h3>
              <a href="#" title="">{{ $tp->provider_name }}</a>
            </h3>
          </li>
        @endforeach
      </ul>
    </div>
  </div>

</aside>
