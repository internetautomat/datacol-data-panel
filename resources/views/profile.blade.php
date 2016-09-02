@extends('layouts.app')

@section('title', t('profile.profile') )

@section('content')

    <div class="row">

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        @lang('profile.profile')
                    </h3>
                    <div class="box-tools pull-right">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                {{ Form::model( auth()->user() ) }}

                <!-- Name Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', t('users.fields.name')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        @foreach($errors->get('name') as $message)
                            <span class='help-inline text-danger'>{{ $message }}</span>
                        @endforeach
                    </div>

                    <!-- Phone Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('phone') ? 'has-error' : '' }}">
                        {!! Form::label('phone', t('users.fields.phone')) !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        @foreach($errors->get('phone') as $message)
                            <span class='help-inline text-danger'>{{ $message }}</span>
                        @endforeach
                    </div>

                    <!-- Password Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('password', t('users.fields.password')) !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    @foreach($errors->get('password') as $message)
                        <span class='help-inline text-danger'>{{ $message }}</span>
                    @endforeach

                <!-- Password Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('new_password') ? 'has-error' : '' }}">
                        {!! Form::label('new_password', t('users.fields.new_password')) !!}
                        {!! Form::password('new_password', ['class' => 'form-control']) !!}
                    </div>
                    @foreach($errors->get('new_password') as $message)
                        <span class='help-inline text-danger'>{{ $message }}</span>
                    @endforeach

                <!-- Password Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                        {!! Form::label('new_password_confirmation', t('users.fields.new_password_confirmation')) !!}
                        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    @foreach($errors->get('new_password_confirmation') as $message)
                        <span class='help-inline text-danger'>{{ $message }}</span>
                    @endforeach

                <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit(t('common.save'), ['class' => 'btn btn-primary']) !!}
                    </div>


                    {{ Form::close() }}

                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->

        </div>


    </div>





@endsection
