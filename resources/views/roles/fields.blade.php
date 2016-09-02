<!-- Title Field -->
<div class="form-group col-sm-6 {{ ($errors->has('title') ? 'has-error' : '') }}">
    {!! Form::label('title', t('roles.fields.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('title') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
    @endforeach
</div>

<!-- Name Field -->
<div class="form-group col-sm-6 {{ ($errors->has('name') ? 'has-error' : '') }}">
    {!! Form::label('name', t('roles.fields.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('name') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
    @endforeach
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 {{ ($errors->has('description') ? 'has-error' : '') }}">
    {!! Form::label('description', t('roles.fields.description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    @foreach($errors->get('description') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
    @endforeach
</div>


<div class="col-xs-12">

    @foreach( \App\Models\Ability::all() as $ability)

        <div class="form-group">
            <label>
                {!! Form::checkbox('abilities[]', $ability->id, (isset($role) ? $role->abilities->where('id',$ability->id )->count() : false ) ) !!} {{ $ability->title }}
            </label>
        </div>

    @endforeach


</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!!  Form::submit(t('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">{{ t('common.cancel') }}</a>
</div>
