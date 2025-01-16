<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Display a list of news items
    public function index()
    {
        $newsItems = News::orderBy('publication_date', 'desc')->get();
        return view('admin.news.index', compact('newsItems'));
    }

    // Display the details of a single news item
    public function show(News $news)
{
    // Only show the news if the publication date has passed
    if ($news->publication_date > now()) {
        abort(404);
    }

    $comments = $news->comments()->with('user')->latest()->get();

    return view('news.show', compact('news', 'comments'));
}

public function addComment(Request $request, News $news)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $news->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return redirect()->back()->with('status', 'Comment added successfully!');
}

    


    // Show the form to create a new news item
    public function create()
    {
        return view('admin.news.create');
    }

    // Store a new news item
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'publication_date' => 'required|date',
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('news_images', 'public');
    }

    // Create the news item
    News::create([
        'title' => $request->title,
        'content' => $request->content,
        'image_path' => $imagePath,
        'publication_date' => $request->publication_date,
    ]);

    // Redirect to the admin news index page
    return redirect()->route('admin.news.index')->with('status', 'News item created successfully!');
}



    // Show the form to edit a news item
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    // Update a news item
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publication_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $news->image_path = $imagePath;
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('admin.news.index')->with('status', 'News item updated successfully!');
    }

    // Delete a news item
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('status', 'News item deleted successfully!');
    }
    public function publicIndex()
{
    // Only show news items where the publication date has passed
    $newsItems = News::where('publication_date', '<=', now())
                    ->orderBy('publication_date', 'desc')
                    ->get();

    return view('news.public', compact('newsItems'));
}



}
