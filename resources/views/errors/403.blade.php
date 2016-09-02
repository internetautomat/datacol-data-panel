@extends('layouts.error')

@section('htmlheader_title')
    Forbidden
@endsection

@section('contentheader_title')
    403 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('content')

    <div class="error-page">
        <h2 class="headline text-red" style="margin-top:-20px;">403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Action not allowed.</h3>
            <p>
                Right now we are reporting to the Police. Stay where you are.
            </p>
        </div>
    </div><!-- /.error-page -->
@endsection
