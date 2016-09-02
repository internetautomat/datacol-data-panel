<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', t('users.fields.name') ) !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Login Field -->
<div class="form-group">
    {!! Form::label('login', t('users.fields.username') )  !!}
    <p>{!! $user->login !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', t('users.fields.email')) !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', t('users.fields.phone')) !!}
    <p>{!! $user->phone !!}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', t('users.fields.active')) !!}
    <p>{!! $user->active ? '+':'-' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', t('users.fields.created_at')) !!}
    <p>{!! $user->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', t('users.fields.updated_at')) !!}
    <p>{!! $user->updated_at !!}</p>
</div>

