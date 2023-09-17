<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function  insert(Request $request)
    {
        $validatedData=$request->validate([
            'section_name'=>'required|unique:sections,section_name'
        ],[
            "section_name.required"=>'اسم القسم فارغ',
            "section_name.unique"=>'اسم القسم موجود بالفعل'
        ]);
        Section::create([
            "section_name"=>$request->section_name,
            "description"=>$request->description,
            "created_by"=>auth()->user()->name
        ]);
        return redirect()->back();
    }

    public function edit($id){
        $section=DB::table('sections')->where('id',$id)->first();
        return view('sections.edit',compact('section'));
    }

    public function update($id,Request $request)
    {
            $validatedData=$request->validate([
            'section_name'=>'required|unique:sections,section_name'
            ],[
            "section_name.required"=>'اسم القسم فارغ',
            "section_name.unique"=>'اسم القسم موجود بالفعل'
            ]);
            DB::table('sections')->where('id',$id)->update([
                "section_name"=>$request->section_name,
                "description"=>$request->description
            ]);
            return redirect()->route('sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_1( $id)
    {
        $section=DB::table('sections')->where('id',$id)->first();
        return view('sections.delete',compact('section'));
    }
    public function delete_2( $id)
    {
        DB::table('sections')->where('id',$id)->delete();
        return redirect()->route('sections');
    }
}
