<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->paginate(10);

        return view('admin.skills.index', compact('skills'));
    }

    
    public function create()
    {
        return view('admin.skills.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills,name'
        ]);

        Skill::create([
            'name' => $request->name
        ]);

        return redirect()->route('skills.index')
                         ->with('success', 'Skill Added Successfully');
    }

    
    public function edit($id)
    {
        $skill = Skill::findOrFail(dcrypttId($id));

        return view('admin.skills.edit', compact('skill'));
    }

    
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail(dcrypttId($id));

        $request->validate([
            'name' => 'required|unique:skills,name,'.$skill->id
        ]);

        $skill->update([
            'name' => $request->name
        ]);

        return redirect()->route('skills.index')
                         ->with('success', 'Skill Updated Successfully');
    }

    
    public function delete($id)
    {
        $skill = Skill::findOrFail(dcrypttId($id));

        $skill->delete();

        return redirect()->route('skills.index')
                         ->with('success', 'Skill Deleted Successfully');
    }

}
