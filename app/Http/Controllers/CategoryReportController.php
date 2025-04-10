<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryReportController extends Controller
{
    public function index()
    {
        return view('reports.categories');
    }
}
