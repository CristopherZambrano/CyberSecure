<?php

namespace App\Http\Controllers;

use App\Models\agreement;
use App\Models\issue;
use App\Models\law;
use App\Models\recomendation;
use Exception;
use Faker\Core\File;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\List_;

class issues extends Controller
{
    public function listIssue (){
        $isuess = issue::all();
        return $isuess;
    }

    public function addIssue(Request $request){
        DB::beginTransaction();
        try{
            $issue = new issue();
            $issue->name = $request->input('title');
            $issue->description = $request->input('description');
            $issue->saveOrFail();
            DB::commit();
            return "Register complete";
        }catch(Exception $e){
            DB::rollBack();
            return "Fail register";
        }
    }

    public function ViewDatos (Request $request){
        switch($request->input('recurso')){
            case 1:
                $value = law::where('id_issue', '=', $request->input('id'))->get();
                break;
            case 2:
                $value = agreement::where('idIssue', '=', $request->input('id'))->get();
                break;
            case 3:
                $value = recomendation::where('idIssue','=',$request->input('id'))->get();
            default:
                $value = false;
                break; 
        }
        return $value;
    } 

    public function saveLaw (Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'fullText' => 'required|mimes:pdf|max:5120',
            ]);
            $law = new law();
            $law->number = $request->input('number');
            $law->name = $request->input('name');
            $law->datePromulgation = $request->input('datePromulgation');
            $law->dateStart = $request->input('dateInit');
            $law->id_issue = $request->input('id_issue');
            $archivo = $request->file('fullText');
            $name = false;
            while($name==false){
                $nombreArchivo = 'Archivo'.time().'_'.(count(Storage::allFiles('laws'))+1).'.pdf';
                if(!Storage::exists('laws/'.$nombreArchivo))
                {
                    $name=true;
                }
            }
            $archivo->move(public_path('laws'), $nombreArchivo);
            $law->fullText = $nombreArchivo;
            $law->saveOrFail();
            DB::commit();
            return "Register complete";
        }catch(Exception $e){
            DB::rollBack();
            return "Fail register".$e;
        }
    }

    public function saveAgreement (Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'fullText' => 'required|mimes:pdf|max:5120',
            ]);
            $agreement = new agreement();
            $agreement->name = $request->input('name');
            $agreement->dateSuscription = $request->input('dateSuscription');
            $agreement->dateStar = $request->input('dateInit');
            $agreement->idIssue = $request->input('id_issue');
            $archivo = $request->file('fullText');
            $name = false;
            while($name==false){
                $nombreArchivo = 'Archivo'.time().'_'.(count(Storage::allFiles('laws'))+1).'.pdf';
                if(!Storage::exists('convenios/'.$nombreArchivo))
                {
                    $name=true;
                }
            }
            $archivo->move(public_path('convenios'), $nombreArchivo);
            $agreement->fullText = $nombreArchivo;
            $agreement->saveOrFail();
            DB::commit();
            return "Register complete";
        }catch(Exception $e){
            DB::rollBack();
            return "Fail register".$e;
        }
    }

    public function saveRecomendations (Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'fullText' => 'required|mimes:pdf|max:5120',
            ]);
            $recomendation = new recomendation();
            $recomendation->name = $request->input('name');
            $recomendation->organization = $request->input('organization');
            $recomendation->dateIssue = $request->input('dateIssue');
            $recomendation->idIssue = $request->input('id_issue');
            $archivo = $request->file('fullText');
            $name = false;
            while($name==false){
                $nombreArchivo = 'Archivo'.time().'_'.(count(Storage::allFiles('recomendaciones'))+1).'.pdf';
                if(!Storage::exists('recomendaciones/'.$nombreArchivo))
                {
                    $name=true;
                }
            }
            $archivo->move(public_path('recomendaciones'), $nombreArchivo);
            $recomendation->fullText = $nombreArchivo;
            $recomendation->saveOrFail();
            DB::commit();
            return "Register complete";
        }catch(Exception $e){
            DB::rollBack();
            return "Fail register".$e;
        }
    }

    public function viewpdf(Request $request){
        switch($request->input('recurso')){
            case 1:
                $law = law::where('id', '=', $request->input('id'))->first();
                if($law){
                    $filePath = 'laws/'.$law->fullText;
                    $name = $law->fullText;
                }
                else{
                    return 'No existe el archivo';
                }
                break;
            case 2:
                $agrement = agreement::where('id', '=', $request->input('id'))->first();
                if($agrement){
                    $filePath = 'convenios/'.$agrement->fullText;
                    $name = $agrement->fullText;
                }
                else{
                    return 'No existe el archivo';
                }
                break;
            case 3:
                $recomendations = recomendation::where('id','=',$request->input('id'))->first();
                if($recomendations){
                    $filePath = 'recomendaciones/'.$recomendations->fullText;
                    $name = $recomendations->fullText;
                }
                else{
                    return 'No existe el archivo';
                }
            default:
                $message = 'Ingrese valores validos';
                break;
        }
        if($name){
            return response()->file($filePath, ['Content-Disposition' => 'inline; filename="'.$name.'"']);
            /* $file =file_get_contents($filePath);
            $value = base64_encode($file);
            return response()->json(['base64Content' => $value, 'name'=> $name]); */
        }
        else{
            return $message;
        }
    }
}
