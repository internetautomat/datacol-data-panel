<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<style>
    .page-break
    {
        page-break-after: always;
    }
</style>


<body class="">
<div class="wrapper">
    <section class="content">
        @yield('content')
    </section><!-- /.content -->

</div><!-- ./wrapper -->

@section('scripts')
    @include('layouts.partials.scripts')
    <script>
        $(function () {
            window.print();
        });
    </script>
@show

</body>
</html>
