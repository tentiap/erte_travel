<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    public function index(){
    	$users = Users::all();
    	return view('erte.users.index', ['users' => $users]);

    }

    public function create(){
    	
    }

    public function store(){
    	
    }

    public function edit(){
    	
    }

    public function update(){
    	
    }

 	public function delete(){
    	
    }   
}
