<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkills extends Model
{
    protected $table = "user_skills";
    public $guarded = [];

    public static function assignNewSkill($user_id, $input)
    {
        self::create([
            'user_id' => $user_id,
            'skill_id' => $input['skill_id'],
            'value' => $input['new_value']
        ]);
    }

    public static function getUserSkillsHistory($user_id, $updated_at = "desc")
    {
        $temp = self::where("user_id", $user_id)
            ->orderBy("updated_at", $updated_at)
            ->get();
        return $temp->groupBy('skill_id');
    }

    public static function searchSkillSet($skills_ids)
    {
        $users_with_skill = [];
        foreach($skills_ids as $skills_id)
        {
            $users_with_skill[] = self::where("skill_id", $skills_id)->groupBy("user_id")->get()->pluck('user_id')->toArray();
        }

        $temp = $users_with_skill[0];
        foreach($users_with_skill as $user_with_skill)
        {
            $temp = array_intersect($temp, $user_with_skill);
        }

        $users = [];

        if(!empty($temp))
        {
            $users = User::whereIn('id', $temp)->get()->toArray();
        }

        return json_encode([
            'found' => !empty($temp),
            'users' => $users,
        ]);
    }



    public static function getUserSkillsHistoryJsFormat($user_id)
    {

        // i know this is messy, but got it working and do not have time to make it look better atm
        // todo:: clean this up
        $max = 0;



        $skills = self::getUserSkillsHistory($user_id, "asc");
        foreach ($skills as $skill_group) {
            if ($skill_group->count() >= $max) {
                $max = $skill_group->count();
            }
        }

        for ($i = 0; $i < $max; $i++) {
            if ($i === 0) {
                $current_row[] = '"' . "nothing"  . '"';
                foreach ($skills as $skill_group) {
                    $current_row[] = '"' .Skill::find($skill_group->first()->skill_id)->name . '"';
                }
                $final_arr[] = $current_row;
            }
            $temp = [];
            $temp[] = $i;
            foreach ($skills as $skill_group) {
                if (!isset($skill_group[$i])) {
                    $temp[] = $skill_group->last()->value;
                } else {
                    $temp[] = $skill_group[$i]->value;
                }
            }
            $final_arr[] = $temp;
        }
        if(empty($final_arr)) return null;
//
        //dump($final_arr);
//        dump($some);
//        dd();
        foreach($final_arr as $key => $row)
        {
            $table_data_tmp = "[";
            foreach($row as $val)
            {
                if($key === 0)
                {
                    $table_data_tmp .=  $val   . ",";
                }
                else
                {
                    $table_data_tmp .= $val . ",";
                }
            }
            $table_data_tmp .= "]";
            $final_format[] = str_replace(",]", ']', $table_data_tmp);;
        }

        $x =  "[" . implode(",", $final_format) . "]";
        //dump($x);

        return $x;


    }

}
