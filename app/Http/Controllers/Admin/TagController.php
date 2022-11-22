<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;

class TagController extends Controller
{
    private Tag $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.tag.index', ['tags' => Tag::orderBy('created_at', 'desc')->paginate(20)]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        /** @var string $name */
        $name = $request->input('name');
        $this->tag->storeTag($name);

        return to_route('admin.tag.index');
    }

    /**
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        return view('admin.tag.edit', ['tag' => Tag::find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var string $name */
        $name = $request->name;

        $this->tag->updateTag($name, $id);
        return to_route('admin.tag.index');
    }
}
