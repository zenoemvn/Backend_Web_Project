<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // Display the FAQ page
    public function index()
    {
        $categories = FAQCategory::with('faqs')->get();
        return view('components.faq', compact('categories'));
    }

    // Admin: Display the FAQ management page
    public function manage()
    {
        $categories = FAQCategory::all();
        $faqs = FAQ::with('category')->get();
        return view('admin.faq.manage', compact('categories', 'faqs'));
    }

    // Store a new FAQ
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->all());
        return redirect()->route('faq.manage')->with('success', 'FAQ added successfully.');
    }

    // Edit an FAQ
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        $categories = FAQCategory::all();
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    // Update an FAQ
    public function update(Request $request, $id)
    {
        $faq = FAQ::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());
        return redirect()->route('faq.manage')->with('success', 'FAQ updated successfully.');
    }

    // Delete an FAQ
    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();
        return redirect()->route('faq.manage')->with('success', 'FAQ deleted successfully.');
    }
    public function storeCategory(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:faq_categories,name',
    ]);

    FAQCategory::create([
        'name' => $request->name,
    ]);

    return redirect()->route('faq.manage')->with('success', 'Category created successfully.');

}


}

