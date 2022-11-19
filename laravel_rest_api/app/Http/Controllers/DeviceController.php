<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function list($id=null)
    {
        return $id?Device::find($id):Device::all();
    }

    public function addDevice(Request $req)
    {
        $device = new Device();

        $device->name = $req->name;
        $device->member_id = $req->member_id;

        $result = $device->save();

        if($result)
        {
            return ["message"=>"Data inserted successfully"];
        }
        else
        {
            return ["message"=>"Operation failed"];
        }
    }

    public function update(Request $request)
    {
        $device = Device::find($request->id);
        $device->name = $request->name;
        $device->member_id = $request->member_id;

        $result = $device->save();

        if($result)
        {
            return ["message"=> "Updated successfully"];
        }
        else
        {
            return ["message"=> "Operation Failed"];
        }
    }

    public function search($name)
    {
        return $name==""?["message"=>"Please enter a keyword for search"]:Device::WHERE('name', 'like', "%{$name}%")->get();
    }

    public function delete($id)
    {
        $device = Device::find($id);
        $result = $device->delete();
        if($result)
        {
            return ["message"=>"Successfull"];
        }
        else{
            return ["message"=>"Operation Failed"];
        }
    }

    public function saveData(Request $req)
    {
        $rules = array(
            "member_id"=>"required|max:4"
        );

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
            $device = new Device();

            $device->name = $req->name;
            $device->member_id = $req->member_id;

            $result = $device->save();

            if($result)
            {
                return ["message"=>"Data inserted successfully"];
            }
            else
            {
                return ["message"=>"Operation failed"];
            }
        }
    }
}
