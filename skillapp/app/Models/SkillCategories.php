<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillCategories extends Model
{
    protected $table = "skill_categories";
    public $timestamps = false;
    public $guarded = [];


    public function skills()
    {
        return $this->hasMany(Skill::class, 'category_id', 'id');
    }

    public static function parseSkillsGroupedByCategories()
    {
        $formatted = [];
        $categories = SkillCategories::with("skills")->get();
        foreach($categories as $category)
        {
            $temp = new \stdClass();
            $temp->id = $category->name;
            $temp->label = $category->name;
            $temp->children = [];
            foreach($category->skills as $skill)
            {
                $temp2 = new \stdClass();
                $temp2->id = $skill->id;
                $temp2->label = $skill->name;
                $temp->children[] = $temp2;
            }
            $formatted[] = $temp;
        }
        return json_encode($formatted);

    }
}
