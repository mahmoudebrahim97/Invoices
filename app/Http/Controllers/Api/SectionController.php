<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class SectionController extends Controller
{
    use apiResponseTrait;
    public function sections()
    {
        $sections = Section::all();
        return $this->apiResponseTrait($sections, 'response success', 200);
    }
    public function get_section($id)
    {
        $section = Section::where('id', $id)->first();
        if ($section) {
            return $this->apiResponseTrait($section, 'response success', 200);
        } else {
            return $this->apiResponseTrait($section, 'no section found', 401);
        }
    }
    public function insert_section(Request $request)
    {
        $section = Section::create([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "created_by" => auth()->user()->name,
        ]);
        return $this->apiResponseTrait($section, 'data inserted', 200);
    }

}
