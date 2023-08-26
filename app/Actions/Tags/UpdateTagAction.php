<?php

namespace App\Actions\Tags;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UpdateTagAction
{
    public function run(TagData $data, Tag $tag): Model|Collection|Builder|array|null
    {
        $tag->update(['title' => $data->title]);

        return Tag::query()->find($tag->id);
    }
}
