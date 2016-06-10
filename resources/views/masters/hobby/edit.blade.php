@extends('layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('master/hobby/') }}">Hobby</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Hobby <small>Master data of hobby.</small></h2>
        <a href="{{ action('HobbyController@index') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {!! Form::model($hobby, ['route' => ['master.hobby.update', $hobby], 'method' =>'patch']) !!}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {!! Form::text('hobbyName', $hobby->hobbyName, ['class' => 'form-control fg-input']) !!}
                        {!! Form::label('hobbyName', 'Hobby Name', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="hobbyName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {!! Form::select('hobbySubFrom', [''=>''] + App\Hobby::lists('hobbyName', 'hobbyId')->all(), $hobby->hobbySubFrom, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::label('hobbySubFrom', 'Is Sub Hobby From', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="hobbySubFrom" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <button class="btn btn-primary btn-icon-text btn-sm waves-effect" type="submit">
                    <i class="zmdi zmdi-check"></i> Save
                </button>
            </div>
        </div>
        <br />
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('form').attr('action'),
            data: {
                _method: 'PATCH',
                hobbySubFrom: $('select[name="hobbySubFrom"]').val(),
                hobbyName: $('input[name="hobbyName"]').val()
            },
            success: function () {
                swal({
                    title: 'Success!',
                    text: 'Data Saved.',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            },
            error: function (response) {
                $.each($.parseJSON(response.responseText), function (k, v) {
                    $('#' + k).parents('div.form-group').addClass('has-warning');
                    $('#' + k).text(v);
                });
            }
        });
    });
</script>
@stop