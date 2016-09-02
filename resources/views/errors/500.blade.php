@extends('layouts.error')

@section('htmlheader_title')
    Server error
@endsection

@section('contentheader_title')
    500 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('content')

    <div class="error-page">
        <h2 class="headline text-red" style="margin-top:-20px;">500</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
            <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href='{{ url('/home') }}'>return to dashboard</a> or try using the search form.
            </p>
        </div>
    </div><!-- /.error-page -->
@endsection
