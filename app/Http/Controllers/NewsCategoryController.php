<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::latest()->paginate(10);
        return view('admin.news.categories.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('admin.news.categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        NewsCategory::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
        ]);


        return redirect()
            ->route('news_categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    // Tampilkan detail kategori
    public function show($id)
    {
        $category = NewsCategory::findOrFail($id);
        return view('admin.news.categories.show', compact('category'));
    }

    // Form edit kategori
    public function edit($id)
    {
        $category = NewsCategory::findOrFail($id);
        return view('admin.news.categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $category->update($data);

        return redirect()
            ->route('news_categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = NewsCategory::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('news_categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
