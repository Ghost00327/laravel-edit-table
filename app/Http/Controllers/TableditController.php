<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TableditController extends Controller
{
    function index()
    {
    	$data = DB::table('users')->get();
    	return view('table_edit', compact('data'));
    }

    function suspend(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
    			$data = array(
    				'suspend_user'	=>	$request->suspend_user,
    				// 'last_name'		=>	$request->last_name,
    				// 'gender'		=>	$request->gender
    			);
    			DB::table('users')
    				->where('id', $request->id)
    				->update($data);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('users')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
    }
}
