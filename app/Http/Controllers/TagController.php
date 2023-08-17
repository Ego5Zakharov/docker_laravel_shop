<?php

namespace App\Http\Controllers;

use App\Actions\Tags\CreateTagAction;
use App\Actions\Tags\TagData;
use App\Actions\Tags\UpdateTagAction;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TagResource::collection(Tag::query()->get());
    }

    public function store(CreateTagRequest $request): TagResource
    {
        $validatedData = $request->validated();

        return TagResource::make(
            (new CreateTagAction)->run(new TagData(title: $validatedData['title']))
        );
    }

    public function show(Tag $tag): TagResource
    {
        return TagResource::make($tag);
    }

    public function update(Tag $tag, UpdateTagRequest $request): TagResource
    {
        $validatedData = $request->validated();
        return TagResource::make(
            (new UpdateTagAction)->run(new TagData(title: $validatedData['title']), $tag)
        );
    }

    public function delete(Tag $tag): JsonResponse
    {
        $tag->delete();

        return response()->json(['message' => 'deleted'], 204);
    }
}
