<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;

class UserController extends Controller
{
     //*************** FETCH ALL RECORD *********** *//
     public function showData()
     {
         $data = User::all();
 
         if($data->count() >0)
         {
            return response()->json(['status'=>200,'Data'=>$data]);
         }
         else 
         {
            return response()->json(['status'=>400,'msg'=>'No Data available']);
         }
     }
 
     //*************** ADD NEW RECORD *********** *//
     public function addData(Request $req)
     {
         //return $req;

         try {
                

                $validator = Validator::make($req->all(),[      // <--- VALIDATION CHECK ----<<
                    'name' => 'required|min:3',
                    'email' => 'required|email',
                    'address' => 'required',
                    'mobile' => 'required|min:10',
                    'city' => 'required',
                    'img' => 'required'
                ],[
                    'name.required' => 'Please enter your name',
                    'email.required' => 'Please enter your email',
                    'address.required' => 'Please enter your address',
                    'mobile.required' => 'Please enter your mobile no.',
                    'city.required' => 'Please enter your city',
                    'img.required' => 'Please select image'
                ]);
        
                if($validator->fails())
                {
                    $errs = $validator->errors()->all();
                    return response()->json(['status'=>400,'msg'=>$errs]);
                }
                else 
                {
                    //************ FILE CHECK ********** *//
                    
                    if($req->hasFile('img'))
                    {
                        $imageName = $req->img->getClientOriginalName();
                        $req->file('img')->move(public_path().'/images/', $imageName);

                        $data = new User;
                        $data->name = $req->name;
                        $data->email = $req->email;
                        $data->address = $req->address;
                        $data->mobile = $req->mobile;
                        $data->city = $req->city;
                        $data->avatar = $imageName;
                        $res = $data->save();
            
                        if($res)
                        {
                            return response()->json(['status'=>200,'msg'=>'Data inserted successfully!']);
                        }
                    }
                    else 
                    {
                        return response()->json(['status'=>400,'msg'=>'Image upload Error']);
                    }

                }
        } catch (\Throwable $th) 
        {
            Log::error('Exception caught: ' . $th->getMessage());
            return response()->json(['status'=>400,'msg'=>$th->getMessage()]);
         }
 
     }
 
     //*************** FETCH ALL RECORD *********** *//
 
     public function deleteData(Request $req)
     {
        // return $req;
 
        $data = User::find($req->id);
        if($data)
        {
             $res = $data->delete();
 
             if($res)
             {
                 return response()->json(['status'=>200,'msg'=>'Record deleted successfully!']);
             }
             else 
             {
                 return response()->json(['status'=>400,'msg'=>'Failed to delete']);
             }
        }
        else 
        {
             return response()->json(['status'=>400,'msg'=>'Record not found']);
        }
     }
 
     //************************ EDIT RECORD ****************** *//
 
     public function editData(Request $req)
     {
        // return $req;
 
        $data = User::find($req->id);
 
        if($data)
        {
             return response()->json(['status'=>200,'msg'=>'Record found','Data'=>$data]);
        }
        else 
        {
             return response()->json(['status'=>400,'msg'=>'No record found']);
        }
 
     }
 
     //********************* UPDATE DETAILS ********************* *//
     public function updateData(Request $req)
     {
         $validator = Validator::make($req->all(),[
             'id' => 'required',
             'name' => 'required|min:3',
             'address' => 'required',
             'city' => 'required',
             'mobile' => 'required|min:10',
             'img' => 'required'
         ]);
 
         if($validator->fails())
         {
             $err = $validator->errors()->all();
             return response()->json(['status'=>400,'msg'=>$err]);
         }
         else 
         {
            $data = User::find($req->id);
 
            if($req->hasFile('img'))
            {
                $imageName = $req->img->getClientOriginalName();
                $req->file('img')->move(public_path().'/images/', $imageName);
                $data->avatar = $imageName;
            }

             $data->name = $req->name;
             $data->address = $req->address;
             $data->email = $req->email;
             $data->mobile = $req->mobile;
             $data->city = $req->city;
             $res = $data->save();
 
             if($res)
             {
                 return response()->json(['status'=>200,'msg'=>'record updated','Data'=>$data]);
             }
             else 
             {
                 return response()->json(['status'=>400,'msg'=>'failed to update']);
             }
         }
     }

     public function getDetails(Request $req)
     {
         
        $validator = Validator::make(
            ['id' => $req->input('id')],
            ['id' => 'required']
        );

        if($validator->fails())
        {
            $err = $validator->errors()->all();
            return response()->json(['status'=>400,'msg'=>$err]);
        }
        else 
        {
            $data = User::find($req->id);
            
            if($data)
            {
                return response()->json(['status'=>200,'msg'=>'Record found','Data'=>$data]);
            }
            else 
            {
                return response()->json(['status'=>400,'msg'=>'No record found']);
            }
        }
     }
}
