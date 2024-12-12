<?php

namespace App\Http\Controllers\Api;

use App\Models\BranchOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiBranchOfficeController extends Controller
{
    public function index()
    {
        $offices = BranchOffice::inRandomOrder()->paginate(20);
        return $this->sendResponse($offices);
    }
}
