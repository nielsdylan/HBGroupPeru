@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Examenes</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Examenes</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Nuevo pregunta</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Nueva pregunta</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" data-form="save-question">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="question">Pregunta: </label>
                                    <input id="question" class="form-control" type="text" name="question" value="{{$question_exam->question}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type_question">Tipo de pregunta: </label>
                                    <select id="type_question" name="type_question" class="form-control" data-action="type-question">
                                        <option value="">Seleccione...</option>
                                        @foreach ($types_inputs as $item )
                                            <option value="{{$item->type_question_id}}" {{ ($item->type_question_id == $question_exam->type_question_id ? 'selected' : '')}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" data-action="answer">

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="#" class="btn btn-primary btn-round d-none" data-action="plus-answer"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center d-none" data-action="show">
        <div class="col-12 col-lg-10 col-xl-9">
            <div class="card card-invoice">
                <div class="card-body">
                    {{-- <div class="row" data-action="answer">

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="#" class="btn btn-primary btn-round" data-action="plus-answer"><i class="fa fa-plus"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var order_answer = 1 ;
    $(document).on('change','[data-action="type-question"]',function () {
        var type_question = $(this).val(),
            html = '';
        order_answer = 1;
        if (type_question) {
            $('[data-action="show"]').removeClass('d-none');
            $('[data-action="plus-answer"]').removeClass('d-none');
            html = switchAnswers(type_question);
        }else{
            $('[data-action="plus-answer"]').addClass('d-none');
            $('[data-action="show"]').addClass('d-none');
            $('[data-action="answer"]').html('');
        }

        $('[data-action="answer"]').html(html);
    });
    $(document).on('click','[data-action="plus-answer"]',function (e) {
        e.preventDefault()
        var type_question = $('[data-action="type-question"]').val(),
            html = '';
            html = switchAnswers(type_question);

        $('[data-action="answer"]').append(html);
    });
    $(document).on('click','[data-action="delete"]',function (e) {
        e.preventDefault()
        var unique = $(this).attr('data-unique');

        $('[data-id="'+unique+'"]').remove();

    });
    function switchAnswers(number) {
        var html = '';
        switch (number) {
            case '1':
                html = unique();
                break;

            case '2':
                html = multiple();
                break;
        }
        return html;
    }
    function multiple() {
        var uniqueId = uniqid();
        var html =''+
        '<div class="col-md-10" data-id="'+uniqueId+'">'+
            '<div class="form-check form-check-inline custom-checkbox-textarea">'+
                '<div class="custom-control custom-checkbox custom-checkbox-textarea">'+
                    '<input type="checkbox" class="custom-control-input" id="'+uniqueId+'" name="answer_check['+uniqueId+'][]">'+
                    '<textarea class="form-control" name="answer['+uniqueId+'][]" ></textarea>'+
                    '<label class="custom-control-label" for="'+uniqueId+'"></label>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-md-2" data-id="'+uniqueId+'">'+
            '<div class="form-group">'+
                '<a href="#" data-unique="'+uniqueId+'" title="Eliminar" data-action="delete">'+
                    '<i class="fa fa-trash-alt icon-categories pt-2"></i>'+
                '</a>'+
            '</div>'+
        '</div>'+


        '';
        return html;
    }
    function unique() {
        var uniqueId = uniqid();
        var html =''+
            '<div class="col-md-10" data-id="'+uniqueId+'">'+
                '<div class="form-check form-check-inline custom-checkbox-textarea">'+
                    '<div class="custom-control custom-radio custom-checkbox-textarea">'+
                        '<input type="radio" id="answer_check'+uniqueId+'" name="answer_check" class="custom-control-input" value="'+order_answer+'">'+

                        '<textarea id="answer'+uniqueId+'" class="form-control" name="answer['+order_answer+'][]" rows="3"></textarea>'+
                        '<label class="custom-control-label" for="answer_check'+uniqueId+'"></label>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2" data-id="'+uniqueId+'">'+
                '<div class="form-group">'+
                    '<a href="#" data-unique="'+uniqueId+'" title="Eliminar" data-action="delete">'+
                        '<i class="fa fa-trash-alt icon-categories pt-2"></i>'+
                    '</a>'+
                '</div>'+
            '</div>'+
        '';
        order_answer = order_answer+1;
        return html;
    }
    $(document).on('submit','[data-form="save-question"]',function (e) {
        e.preventDefault()
        var data = $(this).serialize();
        var route = $(this).attr('action');
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            // processData: false,
            // contentType: false,
            data: data,
            beforeSend: function()
            {
                // $('[data-form="save-add"] button[type="submit"]').addClass('is-loading');
                // $('[data-form="save-add"] button[type="submit"]').attr('disabled','');
            },
        }).done(function (response) {
            // $('[data-form="save-add"] button[type="submit"]').removeClass('is-loading');
            if (response.status == 200) {

            }else{

            }
            console.log(response);
        }).fail(function () {
        // alert("Error");
        });

    });
</script>

@endsection
