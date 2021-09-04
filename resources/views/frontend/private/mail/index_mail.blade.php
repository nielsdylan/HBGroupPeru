@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner page-inner-fill">
        <div class="page-with-aside mail-wrapper bg-white">
            <div class="page-aside">
                <div class="aside-header">
                    <div class="title">Mail Service</div>
                    <div class="description">Service Description</div>
                    <a class="btn btn-primary toggle-email-nav" data-toggle="collapse" href="#email-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                        <span class="btn-label">
                            <i class="fa fa-bars"></i>
                        </span>
                        Menu
                    </a>
                </div>
                <div class="aside-nav collapse" id="email-nav">
                    <ul class="nav">
                        <li>
                            <a href="{{route('email.index')}}">
                                <i class="flaticon-inbox"></i> Bandeja de entrada
                                <span class="badge badge-primary float-right">8</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{route('email.create')}}">
                                <i class="fa fa-envelope"></i>  Crear mensaje
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="flaticon-exclamation"></i> Important
                                <span class="badge badge-secondary float-right">4</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="flaticon-envelope-3"></i> Drafts
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="flaticon-price-tag"></i> Tags
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="flaticon-interface-5"></i> Trash
                            </a>
                        </li>

                    </ul>

                    <span class="label">Labels</span>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">
                                <i class="flaticon-inbox"></i> Bandeja de entrada
                                <span class="badge badge-primary float-right">8</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                <i class="fa fa-envelope"></i> Crear mensaje
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="flaticon-exclamation"></i> Important
                                <span class="badge badge-secondary float-right">4</span>
                            </a>
                        </li>
                    </ul>
                    <div class="aside-compose"><a href="#" class="btn btn-primary btn-block fw-mediumbold">Compose Email</a></div>
                </div>
            </div>
            <div class="page-content mail-content">
                @yield('mail_content')
            </div>
        </div>
    </div>
    <script>
        $(document).on('change','[select-cours="get-cours"]',function (e) {
            e.preventDefault();
            var this_select = $(this),
                cours_id = $(this).val(),
                data_select = $(this).attr('data-select'),
                select = '[data-course="'+data_select+'"]';
            console.log(data_select);
            getCourseAsignature(cours_id,select);
        });
        function getCourseAsignature(id, select) {
            var html='',
                route   = '{{ route('get.courses.asignature') }}';
            data = {
                id:id
            }
            // get.courses
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
                    $(select).attr('disabled','')
                },
            }).done(function (response) {
                $(select).removeAttr('disabled');
                if (response.status == 200) {
                    html = '<option value="">Seleccione...</option>';
                    $.each(response.results, function (index, element) {
                        html+='<option value="'+element.cours_id+'">'+element.course+' ('+element.code+')</option>';
                    });
                    $(select).html(html);
                }else{
                    var placementFrom = 'top';
                    var placementAlign = 'center';
                    var state = 'danger';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Ingrese correctamente los datos para la session para HB Group Perú';
                    content.title = 'Session';
                    // if (style == "withicon") {
                    //     content.icon = 'fas fa-times';
                    // } else {
                    //     content.icon = 'none';
                    // }
                    content.icon = 'fas fa-times';
                    content.url = url+'hbgroupp_web';
                    content.target = '_blank';

                    $.notify(content,{
                        type: state,
                        placement: {
                            from: 'top',
                            align: 'center'
                        },
                        time: 1000,
                        delay: 0,
                    });

                    setTimeout(function(){
                        $('[data-notify="dismiss"]').click();
                    }, 3000);
                }
            }).fail(function () {
                // alert("Error");
                $(select).removeAttr('disabled');
            });
        }
        $(document).on('click','.checkbox-click',function () {
            if( $(this).is(':checked') ){
                $('.select-cours').html()
            }else{
                console.log('sion click');
            }
        });

    </script>
@endsection
