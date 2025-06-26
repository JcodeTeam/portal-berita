<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Author;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $author = $user->author;

        $posts = News::with(['category'])
            ->where('author_id', $author->id)
            ->latest()
            ->paginate(10);

        $categories = NewsCategory::all();

        return view('redaksi.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = NewsCategory::all();
        return view('redaksi.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:news,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:news_categories,id',
        ],
        [
            'title.unique' => 'Judul sudah digunakan. Silakan gunakan judul lain.',
        ]);

        $author = $request->user()->author;

        $randomId = str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT);

        $slug = Str::slug($request->title);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts/', $image->hashName());
        }

        News::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'news_id'     => $randomId,
            'content'     => $request->content,
            'image'       => $image->hashName(),
            'author_id'   => $author->id,
            'category_id' => $request->category_id,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('redaksi.index')->with('success', 'Berita berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $redaksi)
    {
        $categories = NewsCategory::all();
        return view('redaksi.edit-modal', [
            'redaksi' => $redaksi,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $news_id)
    {
        // Find the news by news_id
        $news = News::where('news_id', $news_id)->firstOrFail();

        // Validate input
        $request->validate([
            'title' => 'required|string|max:255|unique:news,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:news_categories,id',
            'is_published' => 'sometimes|boolean',
        ],
        [
            'title.unique' => 'Judul sudah digunakan. Silakan gunakan judul lain.',
        ]);

        // Prepare data for update
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_published' => $request->boolean('is_published'),
        ];

        // If image is uploaded, handle it
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();
            $image->storeAs('public/posts', $filename);

            // Delete old image
            if ($news->image) {
                Storage::delete('public/posts/' . $news->image);
            }

            $data['image'] = $filename;
        }

        // Update the news entry
        $news->update($data);

        return redirect()
            ->route('redaksi.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $news = News::findOrFail($id);

        Storage::delete('public/posts/' . $news->image);

        $news->delete();

        return redirect()->route('redaksi.index')->with('success', 'News deleted successfully.');
    }

    public function togglePublish($id)
    {
        $news = News::findOrFail($id);
        $news->is_published = ! $news->is_published;
        $news->save();

        return redirect()
            ->route('redaksi.news.index')
            ->with('success', 'Status publikasi berhasil diperbarui.');
    }
}
