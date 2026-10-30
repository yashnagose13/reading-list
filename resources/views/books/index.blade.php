<x-layouts.app title="My Reading List">
    <section class="page-heading">
        <div>
            <p class="eyebrow">Personal library</p>
            <h1>My Reading List</h1>
            <p class="intro">A calm place to organise the books waiting on your shelf.</p>
        </div>
    </section>

    <nav class="filters" aria-label="Filter books by status">
        <a
            class="filter-link {{ $status === null ? 'is-active' : '' }}"
            href="{{ route('books.index') }}"
        >
            All
        </a>
        <a
            class="filter-link {{ $status === 'to-read' ? 'is-active' : '' }}"
            href="{{ route('books.index', ['status' => 'to-read']) }}"
        >
            To read
        </a>
        <a
            class="filter-link {{ $status === 'reading' ? 'is-active' : '' }}"
            href="{{ route('books.index', ['status' => 'reading']) }}"
        >
            Reading
        </a>
        <a
            class="filter-link {{ $status === 'finished' ? 'is-active' : '' }}"
            href="{{ route('books.index', ['status' => 'finished']) }}"
        >
            Finished
        </a>
    </nav>

    @if ($books->isNotEmpty())
        <section class="book-grid">
            @foreach ($books as $book)
                <article class="book-card">
                    <div class="book-card-top">
                        <div>
                            <h2>{{ $book->title }}</h2>
                            <p class="book-author">by {{ $book->author }}</p>
                        </div>

                        <span class="status-pill status-{{ $book->status }}">
                            {{ ucfirst(str_replace('-', ' ', $book->status)) }}
                        </span>
                    </div>

                    <div class="book-actions">
                        <a class="button button-secondary" href="{{ route('books.edit', $book) }}">
                            Edit
                        </a>

                        <form
                            class="inline-form"
                            action="{{ route('books.destroy', $book) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="button button-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </section>
    @else
        <section class="empty-state">
            <div class="empty-icon">+</div>
            <h2>No books yet</h2>

            @if ($status)
                <p class="muted">There are no books with the {{ str_replace('-', ' ', $status) }} status.</p>
            @else
                <p class="muted">Your shelves are waiting for their first book.</p>
            @endif

            <a class="button button-primary" href="{{ route('books.create') }}">
                Add your first book
            </a>
        </section>
    @endif
</x-layouts.app>