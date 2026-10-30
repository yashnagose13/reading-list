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

        @forelse ($books as $book)
            <article>
                <h2>{{ $book->title }}</h2>
                <p>By {{ $book->author }}</p>
                <p>Status: {{ $book->status }}</p>
            </article>
        @empty
            <p>No books yet.</p>
        @endforelse
    </main>
</body>
</html>