<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\Cipher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// include('./../../../Helpers/Cryto.php');

class IndexController extends Controller
{
    //Get data User EndPoint
    public function execProcedueSQL(Request $request){
        // dd($request);
        $cipherText= new Cipher();
        // $procedure=$decryptText->decrypt($request->p1);
        // return $request->p1;
        // return 'J¯*¯hola'.$request->p2;
        // return 'call '.$request->nameProcedure.'()'; 
        $data=DB::select('call '.$request->p1.'('.$request->p2.')');
        // $data=DB::select('call sps_all_user(7269)');

        return $data[0]->dm;
        // return $cipherText->encrypt($data[0]->dm);
    }
}
