<!-- Name Field -->
<div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', t('users.fields.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('name') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
    @endforeach
</div>

<!-- Login Field -->
<div class="form-group col-sm-6 {{ $errors->has('login') ? 'has-error' : '' }}">
    {!! Form::label('login', t('users.fields.username')) !!}
    {!! Form::text('login', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('login') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
    @endforeach
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::label('email', t('users.fields.email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('email') as $message)
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


<div class="form-group col-sm-6 {{ $errors->has('role') ? 'has-error' : '' }}">
    {!! Form::label('role', t('roles.role')) !!}
    {!! Form::select('role',\App\Models\Role::all()->map( function ($role){ $role->title = trans('permissions.roles.'.$role->name); return $role; } )->lists( 'title', 'id'),
    ( isset($user) && $user->roles->first() ? $user->roles->first()->id : null )
    , ['class' => 'form-control']) !!}
</div>
@foreach($errors->get('role') as $message)
    <span class='help-inline text-danger'>{{ $message }}</span>
@endforeach

<!-- Password Field -->
<div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }}">
    {!! Form::label('password', t('users.fields.password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
@foreach($errors->get('password') as $message)
    <span class='help-inline text-danger'>{{ $message }}</span>
@endforeach

<div class="form-group col-sm-6 {{ $errors->has('active') ? 'has-error' : '' }}">
    {!! Form::label('active', t('users.fields.active')) !!}
    {!! Form::select('active',[1 => 'Active', 0 => 'Inactive'], (isset($user) ? $user->active : null ), ['class' => 'form-control']) !!}
</div>
@foreach($errors->get('role') as $message)
    <span class='help-inline text-danger'>{{ $message }}</span>
@endforeach

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(t('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default"> {{ t( 'common.cancel' ) }} </a>
</div>
