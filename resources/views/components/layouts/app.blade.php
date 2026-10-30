<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Reading List' }}</title>

    <style>
        :root {
            --ink: #1d2939;
            --muted: #667085;
            --line: #e4e7ec;
            --canvas: #f6f7fb;
            --surface: #ffffff;
            --navy: #17324d;
            --teal: #0f766e;
            --teal-dark: #115e59;
            --teal-light: #ccfbf1;
            --red: #b42318;
            --red-light: #fef3f2;
            --gold: #a15c00;
            --gold-light: #fff7e6;
            --shadow: 0 12px 30px rgba(16, 24, 40, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background: var(--canvas);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.55;
        }

        a {
            color: var(--teal-dark);
        }

        .site-header {
            background: var(--navy);
            color: white;
        }

        .header-content,
        .page-shell {
            width: min(1120px, calc(100% - 2rem));
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 84px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .brand-mark {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border-radius: 10px;
            color: var(--navy);
            background: #e5faf5;
            font-family: Georgia, serif;
            font-size: 1.3rem;
        }

        .brand-subtitle {
            display: block;
            margin-top: -0.1rem;
            color: #b9d3df;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .page-shell {
            padding: 3rem 0 4rem;
        }

        .page-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        h1,
        h2,
        p {
            margin-top: 0;
        }

        h1 {
            margin-bottom: 0.35rem;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: -0.04em;
            line-height: 1.1;
        }

        h2 {
            margin-bottom: 0.25rem;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.35rem;
            line-height: 1.25;
        }

        .eyebrow {
            margin-bottom: 0.4rem;
            color: var(--teal);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .intro,
        .muted {
            color: var(--muted);
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0.65rem 1rem;
            border: 1px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            font: inherit;
            font-size: 0.9rem;
            font-weight: 750;
            text-decoration: none;
            transition: transform 0.15s ease, background 0.15s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-primary {
            color: white;
            background: var(--teal);
        }

        .button-primary:hover {
            background: var(--teal-dark);
        }

        .button-secondary {
            color: var(--ink);
            border-color: var(--line);
            background: white;
        }

        .button-secondary:hover {
            background: #f9fafb;
        }

        .button-danger {
            color: var(--red);
            border-color: #fecdca;
            background: var(--red-light);
        }

        .button-danger:hover {
            background: #fee4e2;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-link {
            padding: 0.45rem 0.8rem;
            border: 1px solid var(--line);
            border-radius: 999px;
            color: var(--muted);
            background: white;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
        }

        .filter-link:hover,
        .filter-link.is-active {
            border-color: var(--teal);
            color: var(--teal-dark);
            background: var(--teal-light);
        }

        .alert {
            margin-bottom: 1.5rem;
            padding: 0.9rem 1rem;
            border: 1px solid;
            border-radius: 8px;
            font-weight: 650;
        }

        .alert-success {
            border-color: #a6f4c5;
            color: #067647;
            background: #ecfdf3;
        }

        .alert-error {
            border-color: #fecdca;
            color: var(--red);
            background: var(--red-light);
        }

        .alert ul {
            margin: 0.5rem 0 0;
            padding-left: 1.2rem;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1rem;
        }

        .book-card,
        .form-card,
        .empty-state {
            border: 1px solid var(--line);
            border-radius: 14px;
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .book-card {
            display: flex;
            flex-direction: column;
            min-height: 220px;
            padding: 1.35rem;
        }

        .book-card-top {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .book-author {
            color: var(--muted);
        }

        .status-pill {
            flex: 0 0 auto;
            padding: 0.3rem 0.6rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: capitalize;
        }

        .status-to-read {
            color: var(--gold);
            background: var(--gold-light);
        }

        .status-reading {
            color: #175cd3;
            background: #eff8ff;
        }

        .status-finished {
            color: #067647;
            background: #ecfdf3;
        }

        .book-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            margin-top: auto;
            padding-top: 1.25rem;
        }

        .inline-form {
            margin: 0;
        }

        .form-wrap {
            width: min(680px, 100%);
            margin: 0 auto;
        }

        .form-card {
            padding: clamp(1.25rem, 4vw, 2rem);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.25rem;
            font-weight: 700;
            text-decoration: none;
        }

        .field {
            margin-bottom: 1.2rem;
        }

        label {
            display: inline-block;
            margin-bottom: 0.45rem;
            font-size: 0.9rem;
            font-weight: 800;
        }

        .input {
            width: 100%;
            min-height: 44px;
            padding: 0.65rem 0.75rem;
            border: 1px solid #cfd4dc;
            border-radius: 8px;
            outline: none;
            color: var(--ink);
            background: white;
            font: inherit;
        }

        .input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.13);
        }

        .input-error {
            border-color: var(--red);
        }

        .field-error {
            display: block;
            margin-top: 0.35rem;
            color: var(--red);
            font-size: 0.85rem;
            font-weight: 650;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
            margin-top: 1.5rem;
        }

        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .empty-icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            margin: 0 auto 1rem;
            border-radius: 16px;
            color: var(--teal-dark);
            background: var(--teal-light);
            font-family: Georgia, serif;
            font-size: 2rem;
        }

        .site-footer {
            padding: 1.5rem 1rem;
            color: var(--muted);
            text-align: center;
            font-size: 0.85rem;
        }

        @media (max-width: 560px) {
            .header-content,
            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-content {
                justify-content: center;
                padding: 1rem 0;
            }

            .page-shell {
                padding-top: 2rem;
            }

            .header-content .button {
                width: 100%;
            }

            .book-actions .button,
            .book-actions .inline-form,
            .book-actions .inline-form .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="header-content">
            <a class="brand" href="{{ route('books.index') }}">
                <span class="brand-mark">R</span>
                <span>
                    Reading List
                    <span class="brand-subtitle">Your next great read</span>
                </span>
            </a>

            <a class="button button-primary" href="{{ route('books.create') }}">
                Add book
            </a>
        </div>
    </header>

    <main class="page-shell">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="site-footer">
        Keep track of every chapter of your reading journey.
    </footer>
</body>
</html>