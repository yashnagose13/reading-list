<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Book</title>
</head>
<body>
    <main>
        <h1>Add a Book</h1>

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

        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <p>
                <label for="title">Title</label><br>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
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
                    value="{{ old('author') }}"
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
                    <option value="to-read" @selected(old('status', 'to-read') === 'to-read')>
                        To read
                    </option>
                    <option value="reading" @selected(old('status') === 'reading')>
                        Reading
                    </option>
                    <option value="finished" @selected(old('status') === 'finished')>
                        Finished
                    </option>
                </select>

                @error('status')
                    <br>
                    <span>{{ $message }}</span>
                @enderror
            </p>

            <button type="submit">Save book</button>
        </form>
    </main>
</body>
</html>