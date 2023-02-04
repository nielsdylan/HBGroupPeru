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
        $array_json = array();

        foreach ($array[0] as $key => $value) {
            if ($key!=0) {
                if ($value[1]!=='' || $value[1]!==null||$value[9]!=='' || $value[9]!==null||$value[10]!=='' || $value[10]!==null ||$value[21]!=='' || $value[21]!==null) {
                    $user = User::where('active',1)->where('dni',$value[9])->first();
                    if (!$user) {
                        $user = new User();
                        $user->name             = $value[5];
                        $user->password         = sha1($value[9]);
                        $user->dni              = $value[9];
                        $user->last_name        = $value[6]." ".$value[7];
                        $user->create_by        = session('hbgroup')['user_id'];
                        $user->save();
                    }
                    $user_group = UsersGroup::where('active',1)->where('user_id',$user->id)->where('group_id',4)->first();
                        if (!$user_group) {
                            $user_group = new UsersGroup();
                            $user_group->user_id    = $user->id;
                            $user_group->group_id   = 4;
                            $user_group->create_by  = session('hbgroup')['user_id'];
                            $user_group->save();
                        }
                    UsersBusiness::where('user_id', $user->id)->update([
                        'active'    => 0,
                        'deleted_at'=>date('Y-m-d H:i:s'),
                        'delete_by' =>session('hbgroup')['user_id']
                    ]);
                    $user_business = new UsersBusiness();
                    $user_business->name    = $value[8];
                    $user_business->user_id = $user->id;
                    $user->create_by        = session('hbgroup')['user_id'];
                    $user_business->save();

                    $certificado = 503;
                    // $certificado = Certificado::where('active',1)->where('code',$value[10])->first();
                    $status=0;
                    $instrucor = User::where('active',1)->where('dni',$value[21])->first();
                    $instrucor = Instructor::where('active',1)->where('user_id',503)->first();

                    if (!$certificado) {
                        if (date("Y-m-d",strtotime((gmdate("Y-m-d", (($value[11] - 25569) * 86400)))."+ 1 year"))<date('Y-m-d')) {
                            $status=2;
                        }else{
                            $status=1;
                        }
                        $certificado = new Certificado();
                        $certificado->description_cours = $value[2]." ".$value[3];
                        $certificado->date              = gmdate("Y-m-d", (($value[11] - 25569) * 86400));
                        $certificado->hour              = $value[15];
                        $certificado->code              = $value[10];
                        $certificado->user_id           = $user->id;
                        $certificado->status            = $status;
                        $certificado->user_business_id  = $user_business->user_business_id;
                        $certificado->instructor_id     = $instrucor->instructor_id;
                        $certificado->create_by         = session('hbgroup')['user_id'];
                        $certificado->save();
                    }
                }


            }

        }


        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
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
        return DataTables::of($data)
        ->addColumn('accion', function ($data) { return
            '<div class="btn-group" role="group">
                <button type="button" class="btn btn-xs btn-okc editar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar">
                    <span class="fas fa-edit"></span>
                </button>
                <button type="button" class="btn btn-xs btn-okc eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <span class="fas fa-trash-alt"></span>
                </button>
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
}
