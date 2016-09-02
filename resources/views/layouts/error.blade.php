<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

{{--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
--}}
<body class="">
<div class="">


    <!-- Content Wrapper. Contains page content -->
    <div class="" style="margin-top: 200px;">

    @include('layouts.partials.contentheader')

    <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @include('flash::message')
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    {{-- @include('layouts.partials.controlsidebar') --}}


</div><!-- ./wrapper -->


</body>
</html>
