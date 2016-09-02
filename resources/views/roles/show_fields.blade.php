<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', t('roles.fields.title') ) !!}
    <p>{!! $role->title !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', t('roles.fields.description')) !!}
    <p>{!! $role->description !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', t('roles.fields.name')) !!}
    <p>{!! $role->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', t('roles.fields.created_at')) !!}
    <p>{!! $role->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', t('roles.fields.updated_at')) !!}
    <p>{!! $role->updated_at !!}</p>
</div>

