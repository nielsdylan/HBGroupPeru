
<table style="">
    <thead>
    <tr>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">DNI</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;"> APELLIDOS </th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">NOMBRE</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">EMAIL</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">CELULAR</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">SEXO</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">VALIDACION DE TELEFONO</th>
        <th style="text-align:center; border: 1px solid rgb(0, 0, 0);font-weight: 700;">VALIDACION DE EMAIL</th>
    </tr>
    </thead>
    <tbody style="border: 1px solid rgb(0, 0, 0);">
    @foreach($results as $item)
        <tr>
            <td>{{ $item->dni }}</td>
            <td>{{ $item->last_name }}</td>
            <td>{{ $item->name }}</td>
            <td style="padding: 20px;">{{ $item->email }}</td>
            <td>{{ $item->telephone }}</td>
            <td>{{ $item->sexo }}</td>
            <td>{{ $item->confirme_telephone ==1 ? 'VALIDADO':'INVALIDADO' }}</td>
            <td>{{ $item->confirme_email ==1 ? 'VALIDADO':'INVALIDADO'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<style>
    table {
        margin: 15px 0;
        border: 1px solid black;
        table-layout: fixed;
        width: 100%; /* must have this set */
    }
</style>
