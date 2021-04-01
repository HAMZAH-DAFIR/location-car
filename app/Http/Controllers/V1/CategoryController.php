<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
    }

    /**
     * @param \App\Http\Requests\CategoryStoreRequest $request
     * @return \App\Http\Resources\CategoryResource
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \App\Http\Resources\CategoryResource
     */
    public function show(Request $request, $id)
    {
        $category = Category::find($id);

        return new CategoryResource($category);
    }

    /**
     * @param \App\Http\Requests\CategoryUpdateRequest $request
     * @param \App\Models\Category $category
     * @return \App\Http\Resources\CategoryResource
     */
    public function update(CategoryUpdateRequest $request,$id)
    {
        $category = Category::find($id);

        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \App\Http\Resources\CategoryResource
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        return new CategoryResource($category);
    }
}
