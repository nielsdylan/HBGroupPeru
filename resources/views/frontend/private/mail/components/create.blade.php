@extends('frontend.private.mail.index_mail')
@section('title','HB Group Perú')
@section('mail_content')
    <div class="email-head">
        <h3>
            <i class="flaticon-pen mr-1"></i>
            Compose new message
        </h3>
    </div>
    <div class="email-compose-fields">
        <form>
            <div class="form-group row">
                <label for="to" class="col-form-label col-md-1">To :</label>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="to" name="to">
                </div>
            </div>
            <div class="form-group row">
                <label for="cc" class="col-form-label col-md-1">Cc :</label>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="cc" name="cc">
                </div>
            </div>
            <div class="form-group row">
                <label for="subject" class="col-form-label col-md-1">Subject :</label>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>
            </div>
            <div class="form-group row">
                <label for="cours" class="col-form-label col-md-1">Select :</label>
                <div class="col-md-2">
                    <label class="custom-checkbox custom-control checkbox-primary">
                        <input type="checkbox" class="custom-control-input checkbox-click" name="cours" value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </div>
                {{-- <label for="asignature" class="col-form-label col-md-1 mr-3">Asignatura :</label>
                <div class="col-md-3">
                    <select class="form-control" name="asignature" select-cours="get-cours" data-select="get-course" required>
                        <option value="">Seleccione...</option>
                        @foreach ($asignatures as $item)
                            <option value="{{$item->asignature_id}}">{{$item->name}} ({{$item->abbreviation}})</option>
                        @endforeach
                    </select>
                </div>
                <label for="cours" class="col-form-label col-md-1">Curso :</label>
                <div class="col-md-3">
                    <select class="form-control" name="course" data-course="get-course" required>
                        <option value="">Seleccione...</option>
                    </select>
                </div> --}}
            </div>
            <div class="form-group row select-cours">

            </div>
        </form>
    </div>
    <div class="email-editor">
        <div id="editor"></div>
        <div class="email-action">
            <button class="btn btn-primary">Send</button>
            <button class="btn btn-danger">Cancel</button>
        </div>
    </div>
@endsection
