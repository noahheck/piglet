<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Category;
use App\Http\Controllers\Controller;
use App\Http\Response\AjaxResponse;
use Illuminate\Http\Request;

use function App\flashSuccess;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        return view('family.categories.home', [
            'family'     => $family,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $category = new Category();
        $category->active = true;

        return view('family.categories.new', [
            'family'   => $family,
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family)
    {
        $request->validate(Category::getValidations());

        $category = new Category();

        $category->fill($request->only($category->getFillable()));

        $category->active  = $request->has('active');

        $category->sub_categories = $request->has('sub_categories') ? $request->get('sub_categories') : [];

        $category->d_order = Category::max('d_order') + 1;

        $category->save();

        flashSuccess('categories.category-created');

        return redirect()->route('family.categories.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, Category $category)
    {
        return view('family.categories.show', [
            'family'   => $family,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, Category $category)
    {
        return view('family.categories.edit', [
            'family'   => $family,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, Category $category)
    {
        $request->validate(Category::getValidations());

        $category->fill($request->only($category->getFillable()));

        $category->active = $request->has('active');

        $category->sub_categories = $request->has('sub_categories') ? $request->get('sub_categories') : [];

        $category->save();

        flashSuccess('categories.category-updated');

        return redirect()->route('family.categories.index', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }



    /**
     * Updates the d_order for the categories
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        $response = new AjaxResponse();

        $orderedCategories = $request->get('orderedCategories');

        $flipped = array_flip($orderedCategories);

        $categories = Category::find($orderedCategories);

        foreach ($categories as $category) {
            $category->d_order = $flipped[$category->id] + 1;
            $category->save();
        }

        return response()->json($response->success(true)->set('orderedCategories', $orderedCategories));
    }
}
