<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    h1{
        background-color: blue;
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
</style>
<body>
    <div class="container">
        <div class="text-right">N°: {{$json['number']}}</div>
        <div><img src="data:image;base64,{{$img_logo}}" alt=""></div>
        <table class="text-center">
            <tbody>
                <tr>
                    <td>
                        <h3>HB GROUP PERU</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1>CERTIFICADO</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>OTORGADO A:</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="text-center">
            <tbody>
                <tr>
                    <td>OTORGADO A: {{$json['last_name'].' '.$json['name']}}</td>
                </tr>
                <tr>
                    <td>DNI N°: {{$json['document']}}</td>
                </tr>
                <tr>
                    <td>Por haber aprobado satisfactoriamente el curso:</td>
                </tr>
                <tr>
                    <td>{{$json['description']}}</td>
                </tr>
            </tbody>
        </table>
    </div>


</body>
</html>
