@extends('layouts.error')

@section('htmlheader_title')
    Page not found
@endsection

@section('contentheader_title')
    404 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow" style="margin-top:-20px;"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href='{{ url('/home') }}'>return to dashboard</a> or try using the search form.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection
