<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading List</title>
</head>
<body>
    <main>
        <h1>My Reading List</h1>

        <p>
            <a href="{{ route('books.create') }}">Add book</a>
        </p>

        <nav aria-label="Filter books by status">
            <a href="{{ route('books.index') }}">All</a>
            ·
            <a href="{{ route('books.index', ['status' => 'to-read']) }}">To read</a>
            ·
            <a href="{{ route('books.index', ['status' => 'reading']) }}">Reading</a>
            ·
            <a href="{{ route('books.index', ['status' => 'finished']) }}">Finished</a>
        </nav>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @forelse ($books as $book)
            <article>
                <h2>{{ $book->title }}</h2>
                <p>By {{ $book->author }}</p>
                <p>Status: {{ $book->status }}</p>

                <p>
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                </p>

                <form
                    action="{{ route('books.destroy', $book) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </article>
        @empty
            <p>No books yet.</p>
        @endforelse
    </main>
</body>
</html>