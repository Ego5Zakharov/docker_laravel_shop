<?php

namespace App\Http\Controllers;

use App\Actions\Tags\CreateTagAction;
use App\Actions\Tags\TagData;
use App\Actions\Tags\UpdateTagAction;
use App\Http\Requests\Tag\IndexTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(IndexTagRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Tag::class);

        $data = $request->validated();

        $perPage = 5;

        $tags = Tag::query()->paginate($perPage, ['*'], 'page', $data['page']);

        return TagResource::collection($tags);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateTagRequest $request): TagResource
    {
        $this->authorize('create', Tag::class);

        $validatedData = $request->validated();

        return TagResource::make(
            (new CreateTagAction)->run(new TagData(title: $validatedData['title']))
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Tag $tag): TagResource
    {
        $this->authorize('show', Tag::class);

        return TagResource::make($tag);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Tag $tag, UpdateTagRequest $request): TagResource
    {
        $this->authorize('update', Tag::class);

        $validatedData = $request->validated();
        return TagResource::make(
            (new UpdateTagAction)->run(new TagData(title: $validatedData['title']), $tag)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Tag $tag): JsonResponse
    {
        $this->authorize('delete', Tag::class);

        $tag->delete();

        return response()->json(['message' => 'deleted'], 204);
    }
}
