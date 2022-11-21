<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
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
}
