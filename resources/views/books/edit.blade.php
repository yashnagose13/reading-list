<x-layouts.app title="Edit Book">
    <section class="form-wrap">
        <a class="back-link" href="{{ route('books.index') }}">
            ← Back to reading list
        </a>

        <div class="form-card">
            <p class="eyebrow">Update entry</p>
            <h1>Edit Book</h1>
            <p class="intro">Update the details or move this book to its next chapter.</p>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Please fix the following errors:</strong>

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

                <div class="field">
                    <label for="title">Title</label>
                    <input
                        class="input @error('title') input-error @enderror"
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $book->title) }}"
                        maxlength="255"
                    >

                    @error('title')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="author">Author</label>
                    <input
                        class="input @error('author') input-error @enderror"
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author', $book->author) }}"
                        maxlength="255"
                    >

                    @error('author')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select class="input" id="status" name="status">
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
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button class="button button-primary" type="submit">Save changes</button>
                    <a class="button button-secondary" href="{{ route('books.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>