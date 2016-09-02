@extends('layouts.app')

@section('contentheader_title','Dashboard')


@section('content')

    <div class="row">

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Таблицы</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <ul>
                        @forelse( $tables as $table )
                            <li>
                                <a href="{{ url( normalize_data_table( $table)) }}"> {{ normalize_data_table( $table) }} </a>
                            </li>
                        @empty
                            <li>У Вас пока нет таблиц с данными</li>
                        @endforelse
                    </ul>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>

    </div>

@endsection
