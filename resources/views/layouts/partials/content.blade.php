<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <strong>@yield('page_title')</strong>
  </h1>
  {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Layout</a></li>
    <li class="active">Fixed</li>
  </ol> --}}
</section>

<section class="content">
  @if(count($errors))
    @include('layouts.partials.errors')
  @endif
  @include('flash::message')

  <!-- Default box -->
  <div class="box">
    <div class="box-body">@yield('content')</div>
  </div>

</section>



