<?php

namespace App\Http\Controllers;

use App\Imports\CertificadoImport;
use App\Models\Asignature;
use App\Models\Business;
use App\Models\Certificado;
use App\Models\Instructor;
use App\Models\User;
use App\Models\UsersBusiness;
use App\Models\UsersGroup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\Facades\DataTables;

class CertificadoController extends Controller
{
    //
    public function index()
    {
        $results = Certificado::where('certificados.active',1)
            ->where('users.active',1)
            // ->where('participants.active',1)
            ->join("users", "users.id", "=", "certificados.user_id")
            ->select("certificados.certificado_id","certificados.code","certificados.description_cours", "certificados.date", "certificados.status")
            ->get();

        return view('frontend.private.certificados.index', compact('results'));
    }
    public function store(Request $request)
    {
        $file = $request->file('file');
        $array = Excel::toArray(new CertificadoImport, $file);
        $array_invalidos = array();
        // return $array;exit;
        foreach ($array[0] as $key => $value) {
            if ($key!=0) {
                if ($value[0]&&$value[1]&&$value[2]&&$value[3]&&$value[4]&&$value[5]&&$value[6]&&$value[7]&&$value[8]&&$value[9]&&$value[10]) {
                    $certificado = new Certificado();
                    $certificado->codigo                = $value[0];
                    $certificado->dni                   = $value[1];
                    $certificado->description_cours     = $value[5];
                    $certificado->apellido_paterno      = $value[2];
                    $certificado->apellido_materno      = $value[3];
                    $certificado->nombre                = $value[4];
                    $certificado->empresa               = $value[6];
                    $certificado->date                  = gmdate("Y-m-d", (($value[7] - 25569) * 86400));
                    $certificado->hour                  = $value[8];
                    $certificado->nota                  = $value[9];
                    $certificado->duracion              = $value[10];
                    $certificado->save();
                }else{
                    array_push($array_invalidos,array(
                        "codigo"                => $value[0],
                        "dni"                   => $value[1],
                        "description_cours"     => $value[5],
                        "apellido_paterno"      => $value[2],
                        "apellido_materno"      => $value[3],
                        "nombre"                => $value[4],
                        "empresa"               => $value[6],
                        "date"                  => $value[7],
                        "hour"                  => $value[8],
                        "nota"                  => $value[9],
                        "duracion"              => $value[10],
                    ));
                }


            }

        }


        return response()->json([
            'success'=>true,
            'data_excluidos'=>$array_invalidos
        ],200);
    }
    public function destroy(Certificado $certificado)
    {
        Certificado::where('active', 1)->where('certificado_id', $certificado->certificado_id)
        ->update([
            'active' => 0,
            'deleted_at'=>date('Y-m-d H:i:s'),
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
    public function listar(Request $request)
    {
        $data = Certificado::all();
        $data = $data->where('active',1);
        return DataTables::of($data)
        ->addColumn('accion', function ($data) { return
            '<div class="btn-group" role="group">
                <button type="button" class="tn btn-link btn-primary btn-lg editar protip" data-id="'.$data->certificado_id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar">
                    <span class="fas fa-edit"></span>
                </button>
                <button type="button" class="btn btn-link btn-danger eliminar protip" data-id="'.$data->certificado_id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <span class="fas fa-trash-alt"></span>
                </button>
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function guardar(Request $request)
    {
        $certificado = Certificado::find($request->id);
        if (!$certificado) {
            $certificado = new Certificado();
        }

        $certificado->codigo = $request->codigo;
        $certificado->dni = $request->dni;
        $certificado->description_cours = $request->curso;
        $certificado->apellido_paterno = $request->apellido_paterno;
        $certificado->apellido_materno = $request->apellido_materno;
        $certificado->nombre = $request->nombre;
        $certificado->empresa = $request->empresa;
        $certificado->date = $request->date;
        $certificado->hour = $request->hour;
        $certificado->nota = $request->nota;
        $certificado->duracion = $request->duracion;
        $certificado->save();
        return response()->json($succes=true,200);
    }
    public function editar($id) {
        $certificado = Certificado::find($id);
        return response()->json(array("data"=>$certificado,"success"=>true),200);
    }
}
