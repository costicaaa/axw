<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = "skills";
    public $guarded = [];

    public function category()
    {
        return $this->belongsTo("App\Models\SkillCategories");
    }

    public static function createNewSkill($input)
    {
        $new_skill = new Skill();
        $new_skill->name = $input['name'];
        $new_skill->category_id = $input['category'];
        $new_skill->save();

        return $new_skill->id;
    }
}
