<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
 * Display a listing of the books.
 */
public function index(Request $request): View
{
    $status = $request->query('status');
    $allowedStatuses = ['to-read', 'reading', 'finished'];

    $books = Book::query()
        ->when(
            in_array($status, $allowedStatuses, true),
            fn ($query) => $query->where('status', $status)
        )
        ->latest()
        ->get();

    return view('books.index', [
        'books' => $books,
        'status' => $status,
    ]);
}

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:to-read,reading,finished'],
        ]);

        Book::create($validated);

        return to_route('books.index')
            ->with('success', 'Book added to your reading list.');
    }

    /**
     * Show the form for editing a book.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:to-read,reading,finished'],
        ]);

        $book->update($validated);

        return to_route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Delete the specified book.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return to_route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}