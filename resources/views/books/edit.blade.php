<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <main>
        <h1>Edit Book</h1>

        <p>
            <a href="{{ route('books.index') }}">Back to reading list</a>
        </p>

        @if ($errors->any())
            <div>
                <p>Please fix the following errors:</p>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <p>
                <label for="title">Title</label><br>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $book->title) }}"
                    maxlength="255"
                >

                @error('title')
                    <br>
                    <span>{{ $message }}</span>
                @enderror
            </p>

            <p>
                <label for="author">Author</label><br>
                <input
                    type="text"
                    id="author"
                    name="author"
                    value="{{ old('author', $book->author) }}"
                    maxlength="255"
                >

                @error('author')
                    <br>
                    <span>{{ $message }}</span>
                @enderror
            </p>

            <p>
                <label for="status">Status</label><br>
                <select id="status" name="status">
                    <option
                        value="to-read"
                        @selected(old('status', $book->status) === 'to-read')
                    >
                        To read
                    </option>
                    <option
                        value="reading"
                        @selected(old('status', $book->status) === 'reading')
                    >
                        Reading
                    </option>
                    <option
                        value="finished"
                        @selected(old('status', $book->status) === 'finished')
                    >
                        Finished
                    </option>
                </select>

                @error('status')
                    <br>
                    <span>{{ $message }}</span>
                @enderror
            </p>

            <button type="submit">Save changes</button>
        </form>
    </main>
</body>
</html>