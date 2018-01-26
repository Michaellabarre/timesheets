<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  @include('layouts.partials.head')

  <body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">

      @include('layouts.partials.header')
      @include('layouts.partials.sidebar')
      
      <div class="content-wrapper">
        @include('layouts.partials.content')
      </div>
      
      @include('layouts.partials.footer')
    </div>
  </body>
</html>
