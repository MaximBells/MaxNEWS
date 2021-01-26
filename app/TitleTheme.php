<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleTheme extends Model
{
    public function title()
    {
        return $this->belongsToMany(Title::class, 'item_categories', 'category_id');
    }

    public function item()
    {
        return $this->belongsToMany(Item::class, 'item_categories', 'item_id');
    }
}
