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
        

        return view('frontend.private.certificados.index');
    }
    public function store(Request $request)
    {
        $file = $request->file('file');
        $array = Excel::toArray(new CertificadoImport, $file);
        $array_invalidos = array();
        
        foreach ($array[0] as $key => $value) {
            if ($key!=0) {
                // return gmdate("Y-m-d", (($value[0] - 25569) * 86400));exit;
                // if ($value[14]) {
                //     return gmdate("Y-m-d", (( $value[14] - 25569) * 86400));exit;
                // }else{
                    // return $value[20];exit;
                // }
                
                $certificado = Certificado::firstOrNew(['cod_certificado' => $value[20]]);
                    if ($value[0]!=='' && $value[0]!==null) {
                        // return gmdate("Y-m-d", (( $value[14] - 25569) * 86400));exit;
                        $certificado->fecha_curso    = gmdate("Y-m-d", (((int)$value[0] - 25569) * 86400));
                    }
                    // ($value[0]? $certificado->fecha_curso    = gmdate("Y-m-d", (($value[0] - 25569) * 86400)):null);
                    $certificado->codigo_curso          = ($value[13]?$value[13]:null);
                    $certificado->curso                 = ($value[1]?$value[1]:null);
                    $certificado->tipo_curso            = ($value[2]?$value[2]:null);
                    $certificado->tipo_documento        = ($value[3]?$value[3]:null);
                    $certificado->numero_documento      = ($value[4]?$value[4]:null);
                    $certificado->apellido_paterno      = ($value[5]?$value[5]:null);
                    $certificado->apellido_materno      = ($value[6]?$value[6]:null);
                    $certificado->nombres               = ($value[7]?$value[7]:null);
                    $certificado->empresa               = ($value[8]?$value[8]:null);
                    $certificado->cargo                 = ($value[9]?$value[9]:null);
                    $certificado->email                 = ($value[10]?$value[10]:null);
                    $certificado->supervisor_responsable    = ($value[11]?$value[11]:null);
                    $certificado->observaciones             = ($value[12]?$value[12]:null);
                    // $certificado->acronimos                 = ($value[12]?$value[12]:null);
                    // $certificado->nombre_curso_oficial      = ($value[13]?$value[13]:null);
                    // if ($value[14]!=='' && $value[14]!==null) {
                        // return $value[14];exit;
                        // $certificado->fecha_oficial   =  gmdate("Y-m-d", (( (int)$value[14] - 25569) * 86400));
                    // }
                    // (!empty($value[14])? $certificado->fecha_oficial   =  gmdate("Y-m-d", (( $value[14] - 25569) * 86400)): null );
                    $certificado->nota                      = ($value[19]?$value[19]:null);
                    $certificado->cod_certificado           = ($value[20]?$value[20]:null);
                    // $certificado->descripcion_larga         = ($value[23]?$value[23]:null);
                    // $certificado->descripcion_corta         = ($value[24]?$value[24]:null);
                    if ($value[22]!=='' && $value[22]!==null) {
                        $certificado->fecha_vencimiento = gmdate("Y-m-d", (((int)$value[22] - 25569) * 86400));
                    }
                    // ($value[22]? $certificado->fecha_vencimiento = gmdate("Y-m-d", (($value[22] - 25569) * 86400)):null);
                    $certificado->duracion              = ($value[21]?$value[21]:null);
                    $certificado->aprobado                = 1;
                    $certificado->active                = 1;
                    $certificado->deleted_at            = null;
                    $certificado->create_by             =    session('hbgroup')['user_id'];
                    $certificado->update_by             = session('hbgroup')['user_id'];
                    $certificado->delete_by             = null;
                $certificado->save();
                // $certificado->restore();


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
        ->addColumn('apellidos_nombres', function ($data) { 
            $apellido_paterno = ($data->apellido_paterno?$data->apellido_paterno:'');
            $apellido_materno = ($data->apellido_materno?$data->apellido_materno:'');
            $apellido_nombres = ($data->nombres?$data->nombres:'');

            return ($apellido_paterno.' '.$apellido_materno.' '.$apellido_nombres);
        })
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
        // return $request;exit;
        $certificado = Certificado::firstOrNew(['certificado_id' => $request->id]);
            $certificado->fecha_curso           = $request->fecha_curso;
            $certificado->curso                 = $request->curso;
            $certificado->tipo_curso            = $request->tipo_curso;
            $certificado->tipo_documento        = $request->tipo_documento;
            $certificado->numero_documento      = $request->numero_documento;
            $certificado->apellido_paterno      = $request->apellido_paterno;
            $certificado->apellido_materno      = $request->apellido_materno;
            $certificado->nombres               = $request->nombres;
            $certificado->empresa               = $request->empresa;
            $certificado->cargo                 = $request->cargo;
            $certificado->email                 = $request->email;
            $certificado->supervisor_responsable    = $request->supervisor_responsable;
            $certificado->observaciones             = $request->observaciones ;
            // $certificado->acronimos                 = $request->acronimos;
            // $certificado->nombre_curso_oficial      = $request->nombre_curso_oficial;
            // $certificado->fecha_oficial             = $request->fecha_oficial;
            $certificado->nota                      = $request->nota;
            $certificado->cod_certificado           = $request->cod_certificado;
            // $certificado->descripcion_larga         = $request->descripcion_larga;
            // $certificado->descripcion_corta         = $request->descripcion_corta;
            $certificado->fecha_vencimiento         = $request->fecha_vencimiento;
            $certificado->duracion                  = $request->duracion;
            $certificado->aprobado                  = (!empty($request->aprobado)?$request->aprobado:0);
            // $certificado->active                = 1;
            $certificado->deleted_at                = null;
            $certificado->create_by                 =    session('hbgroup')['user_id'];
            $certificado->update_by                 = session('hbgroup')['user_id'];
            // $certificado->delete_by             = null;
        $certificado->save();
        return response()->json($succes=true,200);
    }
    public function editar($id) {
        $certificado = Certificado::find($id);
        return response()->json(array("data"=>$certificado,"success"=>true),200);
    }
    public function codigoUnico(Request $request) {
        if ((int)$request->id == 0) {
            $certificado = Certificado::where('cod_certificado','=',$request->value)->first();
            if ($certificado) {
                return response()->json(array("success"=>true),200);
            } 
            return response()->json(array("success"=>false),200);
        }
        return response()->json(array("success"=>false),200);

    }
}
