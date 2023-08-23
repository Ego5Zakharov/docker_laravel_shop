<?php

namespace App\Actions\Tags;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateTagAction
{
    public function run(TagData $data): Model|Builder
    {
        return Tag::query()->create(['title' => $data->title]);
    }
}
