<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Developer Portfolio</title>

    <link rel="icon" href="/favicon.ico" sizes="any">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui']
                }
            }
        }
    </script>
</head>

<body class="bg-zinc-50 text-zinc-900 min-h-screen flex items-center justify-center px-6">

    <main class="max-w-4xl w-full bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">

        <div class="p-8 md:p-12">

            <!-- Header -->
            <h1 class="text-3xl md:text-4xl font-semibold leading-tight mb-4">
                Build your short developer portfolio in minutes
            </h1>

            <p class="text-zinc-600 text-lg mb-8 max-w-2xl">
                The app helps developers create clean, shareable portfolios —
                perfect for resumes, freelancing, and quick introductions.
            </p>

            <!-- Features -->
            <ul class="space-y-3 text-sm text-zinc-700 mb-10">
                <li class="flex items-start gap-3">
                    <span class="mt-2 h-2 w-2 rounded-full bg-green-600"></span>
                    <span><strong>Quick setup</strong> — add your bio, skills, and links in minutes</span>
                </li>

                <li class="flex items-start gap-3">
                    <span class="mt-2 h-2 w-2 rounded-full bg-green-600"></span>
                    <span><strong>Short & focused</strong> — ideal for resumes, LinkedIn & GitHub</span>
                </li>

                <li class="flex items-start gap-3">
                    <span class="mt-2 h-2 w-2 rounded-full bg-green-600"></span>
                    <span>
                        <strong>Custom URL</strong> —
                        https://{{ request()->getHost() }}/your-name
                    </span>
                </li>

                <li class="flex items-start gap-3">
                    <span class="mt-2 h-2 w-2 rounded-full bg-green-600"></span>
                    <span><strong>Developer-first</strong> — projects, tech stack & links</span>
                </li>
            </ul>

            <!-- CTA -->
            @if (Route::has('login'))
                <div class="flex flex-wrap gap-4">
                    @auth
                        <a href="{{ url('/portfolio/edit') }}"
                            class="px-6 py-2.5 bg-black text-white rounded-md text-sm font-medium hover:opacity-90 transition">
                            Edit Portfolio
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 border border-black rounded-md text-sm font-medium hover:bg-black hover:text-white transition">
                            Log in
                        </a>

                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 bg-black text-white rounded-md text-sm font-medium hover:opacity-90 transition">
                            Create Portfolio
                        </a>
                    @endauth
                </div>
            @endif

        </div>

        <!-- Footer -->
        <div class="border-t border-zinc-200 px-8 py-4 text-sm text-zinc-500">
            © {{ date('Y') }} {{ config('app.name') }}
        </div>

    </main>

</body>

</html>
