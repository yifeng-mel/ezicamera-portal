<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camera;
use DB, Exception, Validator;
use Illuminate\Support\Str;

class APICameraController extends Controller
{
    public function index()
    {
        $pageNum = request()->get('pageNum');
        $pageSize = request()->get('pageSize');
        $search = request()->get('search');

        $cameras = Camera::where('serial_number', 'like', '%'.$search.'%')->paginate($pageSize, ['*'], 'page', $pageNum)->toArray();
        $cameras['cameras'] = $cameras['data'];
        unset($cameras['data']);
        return json_encode($cameras);
    }

    public function add()
    {
        $validator = Validator::make(request()->all(), [
            'serial_number' => 'required|unique:cameras,serial_number',
            'board_name' => 'required',
            'color' => 'required',
            'price' => 'numeric|nullable'
        ]);

        if ($validator->fails()) {
            return json_encode(['error'=>$validator->errors()]);
        }

        try {
            DB::beginTransaction();

            $serial_number = request()->get('serial_number', null);
            $board_name = request()->get('board_name', null);
            $color = request()->get('color', null);
            $price = request()->get('price', null);
            $url = request()->get('url', null);
            $public_key = request()->get('public_key', null);
    
            $camera = new Camera();
            
            $camera->uid = (string) Str::uuid();
            $camera->serial_number = empty($serial_number) ? null : $serial_number ;
            $camera->board_name = empty($board_name) ? null : $board_name ;
            $camera->color = empty($color) ? null : $color ;
            $camera->price = empty($price) ? null : $price ;
            $camera->url = empty($url) ? null : $url ;
            $camera->public_key = empty($public_key) ? null : $public_key ;
    
            $camera->save();
    
            DB::commit();
            return json_encode(['success'=>true]);
        } catch(Exception $e) {
            DB::commit();
        }
    }

    public function edit()
    {
        $validator = Validator::make(request()->all(), [
            'camera_id' => 'required',
            'serial_number' => 'required|unique:cameras,serial_number',
            'board_name' => 'required',
            'color' => 'required',
            'price' => 'numeric'
        ]);

        $camera = Camera::find(request()->get('camera_id'));

        if ($validator->fails()) {
            return json_encode(['error'=>$validator->errors()]);
        }

        if (!$camera) {
            return json_encode(['error'=>'Camera not found']);
        }

        try {
            DB::beginTransaction();

            $serial_number = request()->get('serial_number', null);
            $board_name = request()->get('board_name', null);
            $color = request()->get('color', null);
            $price = request()->get('price', null);
            $url = request()->get('url', null);
            $public_key = request()->get('public_key', null);
        
            $camera->serial_number = empty($serial_number) ? null : $serial_number ;
            $camera->board_name = empty($board_name) ? null : $board_name ;
            $camera->color = empty($color) ? null : $color ;
            $camera->price = empty($price) ? null : $price ;
            $camera->url = empty($url) ? null : $url ;
            $camera->public_key = empty($public_key) ? null : $public_key ;
    
            $camera->save();
    
            DB::commit();
            return json_encode(['success'=>true]);
        } catch(Exception $e) {
            DB::commit();
        }
    }

    public function delete()
    {
        $validator = Validator::make(request()->all(), [
            'camera_id' => 'required'
        ]);

        if ($validator->fails()) {
            return json_encode(['error'=>$validator->errors()]);
        }

        $camera = Camera::find(request()->get('camera_id'));
        
        if (!$camera) {
            return json_encode(['error'=>'camera not found']);
        }

        $camera->delete();
        return json_encode(['success'=>true]);
    }
}
