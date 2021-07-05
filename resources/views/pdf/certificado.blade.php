<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne&display=swap" rel="stylesheet"> --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne&display=swap');
    body{
        font-family: 'Syne', sans-serif;
    }
    .container{
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .text-white{
        color: white;
    }
    .text-blue{
        color: #002060
    }
    .margin-right-5{
        margin-right: 5px;
    }
    .margin-right-10{
        margin-right: 10px;
    }
    .margin-right-20{
        margin-right: 20px;
    }
    .margin-top-0{
        margin-top: 0px
    }
    .margin-bottom-0{
        margin-bottom: 0px
    }
    .margin-top-5{
        margin-top: 5px;
    }
    .margin-top-10{
        margin-top: 10px;
    }
    .margin-top-20{
        margin-top: 20px;
    }
    .margin-0{
        margin: 0px;
    }
    .border-pdf{
        border-right: 2.5px solid;
        border-top: 18.5px solid;
        border-bottom: 2.5px solid;
        border-left: 2.5px solid;
        border-color: #8090b0;
    }
    .border-footer{
        border-top: 18.5px solid;
        border-color: #8090b0;
    }
    .border-number{
        border-right: 1.5px solid;
        border-top: 1.5px solid;
        border-bottom: 1.5px solid;
        border-left: 1.5px solid;
        border-color: #909cb2;
        padding-right: 20px;
        padding-left: 20px;
        /* padding: 10px */
    }
    .border-solid{
        border: 1px solid;
        margin-top: 0px;
    }
    .liston-hb{
        width: 55%;
        height: 60px;
    }
    .liston-backgroun{
        align-items: center;
        background-image:url('{{asset("assets/img/liston-sf-hb.png")}}');
        background-repeat: no-repeat;
        height: 60px;
        width:601px;
        margin-left: 45px;
    }
    .padding-top-liston{
        padding-top: 7px;
    }
    .padding-top-firma{
        /* padding-top: 135px; */
    }
    .padding-bottom-firma{
        padding-bottom: 100px;
    }
    .firma{
        /* position: absolute;
        right: 250px;
        top: 630px; */
    }
    .sello{
        /* position: absolute;
        right: 140px;
        top: 607px; */
    }
    .float-text{
        /* position: absolute;
        right: 250px;
        top: 630px; */
    }
    .sello-white{
        /* position: absolute;
        top: 750px;
        left: 65px; */
        border-radius: 100px;
        opacity: 0.8;
    }
    #img-pdf{
        align-items: center;
        background-image:url('{{asset("assets/img/fondo-hb.png")}}');
        background-size: cover;
        /* background-repeat: no-repeat; */
    }
    .font-size-12{
        font-size: 12px !important,
    }
    .padding-white{
        padding-bottom: 55px;
    }
    .td-img-sello-whited{
        padding-right: 110px;
        padding-top: 90px;
    }

</style>
<body>
    <div class="container">
        <div id="img-pdf" class="border-pdf">
            <div class="text-right margin-top-10"><span class="border-number margin-right-20">N&deg;: {{$json['number']}}</span></div>
            <div class="text-center"><img src="{{asset('assets/img/logo_snc.png')}}" width="100"></div>
            <div class="text-center"><h3 class="margin-0">HB GROUP PERU</h3></div>
            <div class="liston-backgroun">
                <h1 class="text-white text-center padding-top-liston margin-bottom-0">CERTIFICADO</h1>
            </div>
            <div class="text-center"><h3 class="margin-top-0">OTORGADO A:</h3></div>
            <div class="text-center"><h2 class="margin-0 text-blue">{{$json['last_name'].' '.$json['name']}}</h2></div>
            <div class="text-center"><h2 class="margin-0">DNI N&deg; {{$json['document']}}</h2></div>
            <div class="text-center"><h3>Por haber aprobado satisfactoriamente el curso:</h3></div>
            <div class="text-center"><h2 class="text-blue">"{{$json['description']}}"</h2></div>
            <div class="text-center"><h3 class="margin-0">{{$json['date_1']}}</h3></div>
            <div class="text-center"><h3 class="margin-0">{{$json['date_2']}}</h3></div>



            {{-- firma --}}

            {{-- <div class="text-center padding-top-firma">
                <span class="sello-white"></span>
                <img src="data:image;base64,{{$img_sello_whitw}}" width="150" class="sello-white">
                <img src="data:image;base64,{{$img_firma}}" width="200" class="firma">
                <img src="data:image;base64,{{$img_sello}}" width="150" class="sello">
                <hr size="1" width="150" class="border-solid">
            </div> --}}

            {{-- <div class="float-text">
                <div class="text-center font-size-12">
                    {{$json['name_firm']}}
                </div>
                <div class="text-center font-size-12">
                    {{$json['cargo_firm']}}
                </div>
                <div class="text-center  font-size-12">
                    {{$json['business_firm']}}
                </div>
            </div> --}}

            <div>
                <table>
                    <tbody>
                        <tr>
                            <td class="td-img-sello-whited"><img src="{{asset('assets/img/sello-fondo-hb.png')}}" width="150" class="sello-white"></td>
                            <td class="text-center font-size-12">
                                <img src="{{asset('assets/img/firma-hb.png')}}" width="200" class="firma">
                                <hr size="1" width="100" class="border-solid">
                                <div>{{$json['name_firm']}}</div>
                                <div>{{$json['cargo_firm']}}</div>
                                <div>{{$json['business_firm']}}</div>
                            </td>
                            <td ><img src="{{asset('assets/img/sello-hb.png')}}" width="150" class="sello"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- ---- --}}
            {{-- footer del pdf  --}}
            <div class="text-center border-footer" style="font-size: 14px;">
                <span>{{$json['name_business']}}</span> | <img src="{{asset('assets/img/telephone-cetificado.png')}}" width="15" class="firma"><span> {{$json['telephone']}}</span> |
                <span>{{$json['cell']}}</span> | <img src="{{asset('assets/img/message-certificado.png')}}" width="15" class="firma"> <span>{{$json['email']}}</span> | <img src="{{asset('assets/img/web-certificado.png')}}" width="15" class="firma"> <span>{{$json['web']}}</span>
            </div>
            {{-- --- --}}
        </div>


    </div>


</body>
</html>
