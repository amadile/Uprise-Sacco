<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function show()
    {
        $members = Members::all(); // Retrieve member data from your database
        $data = [];
        $pack = [];
        ;

        foreach ($members as $member) {
            $data[$member->name] = $member->total_contributions;
            $pack[$member->name] = $member->previous_loan_performance;
        }

        return view('pages.performance', compact('data' , 'pack', 'members'));
    }
}
