<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use App\Http\Models\AppModel;

class UsernameController extends Controller{   
      
    public function search(){   
        $name = Request::input('search');
        $data = [];
        if ($name){
            $model = new AppModel();
            $data = $model->getUserProfile($name);           
        }
        return view('youtube')->with("username",$name)->with("data",$data);
    }
}
