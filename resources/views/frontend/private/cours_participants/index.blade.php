@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Academico</h4>
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
                    <a href="#">Lista de participantes</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-profile card-secondary">
                    <div class="card-header" style="background-image: url('{{asset('assets/img/blogpost.jpg')}}">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                @if ($user->image)
                                    <img src="{{asset('assets/img/user/'.$user->image)}}" alt="..." class="avatar-img rounded-circle">
                                @else
                                    <img src="{{asset('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="name">{{$user->last_name}}</div>
                            <div class="job">{{$user->name}}</div>
                            <div class="desc">HB GROUP PERÚ</div>
                            {{-- <div class="social-media">
                                <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                                </a>
                                <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
                                </a>
                                <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                                </a>
                                <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
                                </a>
                            </div> --}}
                            <div class="view-profile">
                                <a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <div class="row user-stats text-center">
                            <div class="col">
                                <div class="number">125</div>
                                <div class="title">Post</div>
                            </div>
                            <div class="col">
                                <div class="number">25K</div>
                                <div class="title">Followers</div>
                            </div>
                            <div class="col">
                                <div class="number">134</div>
                                <div class="title">Following</div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="form-group">
                                <select class="form-control" name="asignature_id" required>
                                    <option value="">Asignaturas...</option>
                                    @foreach ($asignatures as $key=>$type )
                                        <option value="{{$type->asignature_id  }}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control date" name="date">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar-check"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="CODIGO/CURSO..." >
                            </div>
                            <button class="btn btn-primary btn-round ml-auto" data-search="search">
                                <i class="fas fa-search"></i>
                                Buscar
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-pagination">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data ={};
        $(document).ready(function () {
            getCoursPagination();
        });
        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getCoursPagination(page);
        });
        $(document).on('click','[data-search="search"]',function () {

            var asignature_id = $('[name="asignature_id"]').val(),
                date = $('[name="date"]').val(),
                name = $('[name="name"]').val();
                data.asignature_id  =   asignature_id,
                data.date           =   date;
                data.name           =   name;
                getCoursPagination(1);
        });
        function getCoursPagination(page, asignature_id, date, name) {
            var route = '{{ route('get.list.participant')}}';

            data.page = page;

            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                // processData: false,
                // contentType: false,
                data: data,
                beforeSend: function()
                {
                    $('.table-pagination').addClass('is-loading is-loading-lg');
                },
            }).done(function (response) {
                $('.table-pagination').removeClass('is-loading is-loading-lg');
                $('.table-pagination').html(response);

            }).fail(function () {
                alert("Error");
            });
        }
        $(document).on('click','.checkbox-click',function () {
            var id = $(this).val();
            if ($(this).is(':checked')) {
                $(this).parents('td').parents('tr').addClass('line-through');
            }else{
                $(this).parents('td').parents('tr').removeClass('line-through');
            }
        });
        $(document).on('submit','[data-submit="form"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize(),
                id = $('[name="user_id"]').val(),
                route = $(this).attr('action');
            data = data+'&id='+id;
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
                    $('.cours-list').addClass('is-loading is-loading-lg');
                },
            }).done(function (response) {
                $('.cours-list').removeClass('is-loading is-loading-lg');
                if (response.status == 200) {
                    alertDashboard(
                        'top',
                        'center',
                        'success',
                        'withicon',
                        'Se guardo con éxito',
                        'Éxito',
                        'fas fa-check',
                    );
                }else{
                    alertDashboard(
                        'top',
                        'center',
                        'danger',
                        'withicon',
                        'Ocurrio un error comuniquese con el area encargada',
                        'Error',
                        'fas fa-times',
                    );
                }
            }).fail(function () {
                $('.cours-list').removeClass('is-loading is-loading-lg');
            });

        });
        function alertDashboard(
            placementFrom,
            placementAlign,
            state,
            style,
            message,
            title,
            icon
        ) {
            var placementFrom = placementFrom;
            var placementAlign = placementAlign;
            var state = state;
            var style = style;
            var content = {};

            content.message = message;
            content.title = title;
            content.icon = icon;
            content.url = url+'login';
            content.target = '_blank';

            $.notify(content,{
                type: state,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                time: 1000,
                delay: 2,
            });
        }
    </script>
@endsection
