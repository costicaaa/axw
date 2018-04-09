<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SkillCategories;
use App\Models\User;
use App\Models\UserSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("skills.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("skills.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required|between:1,3' // hardcoded check for validating category id TODO :: REMOVE THIS
        ]);

        $new_skill_id = Skill::createNewSkill($request->input());
        Session::flash('message', "Skill saved!");

        return redirect()->route("skills.edit", $new_skill_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skill = Skill::findOrfail($id);
        return view("skills.edit")
            ->with("skill", $skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            'category' => "required"
        ]);
        $skill = Skill::findOrFail($id);
        $skill->name = $request->get("name");
        $skill->category_id = $request->get("category");
        $skill->save();

        Session::flash('message', "Skill updated!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSkillsGroupedByCategories()
    {
        return SkillCategories::parseSkillsGroupedByCategories();
    }

    public function getSkillInfo($skill_id, $user_id)
    {
        $skill = Skill::find($skill_id);
        $skill_value = UserSkills::where("skill_id", $skill_id)
            ->where("user_id", $user_id)
            ->orderBy("id", 'desc')
            ->first();

        $skill->value = $skill_value ? $skill_value->value : 0;

        return json_encode($skill);
    }

    public function getAssignedSkillsForUser($user_id)
    {
        $user_history = UserSkills::where("user_id", $user_id)->get();
        $user_h_grouped_by_skill = $user_history->groupBy("skill_id")->sortBy("id");
        $current_values = [];
        foreach($user_h_grouped_by_skill as $user_history_by_skill)
        {
            $skill_group = $user_history_by_skill->last();
            $skill = Skill::find($skill_group->skill_id);
            $skill->value = $skill_group->value;
            $current_values[] = $skill;
        }

        return json_encode($current_values);

    }

    public function searchBySkillSet(Request $request)
    {
        $skills_ids = $request->input('skill_set');
        return UserSkills::searchSkillSet($skills_ids);

        return json_encode($skills_ids);
    }
}
