<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function onissue()
    {
    	return view('issue.onissue');
    }
    public function resolveissue()
    {
    	return view('issue.resolveissue');
    }
}
