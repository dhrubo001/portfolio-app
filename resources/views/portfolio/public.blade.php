<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $portfolio->name }} | Developer Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN (use build version in prod if available) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <div class="max-w-4xl mx-auto px-6 py-12">

        <!-- Header -->
        <!-- Header -->
        <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8 mb-12">
            <div class="flex flex-col gap-4">

                <!-- Name -->
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    {{ $portfolio->name }}
                </h1>

                <!-- Contact Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">

                    @if ($portfolio->email)
                        <span class="flex items-center gap-2">
                            📧 <a href="mailto:{{ $portfolio->email }}" class="hover:underline">
                                {{ $portfolio->email }}
                            </a>
                        </span>
                    @endif

                    @if ($portfolio->mobile)
                        <span class="flex items-center gap-2">
                            📞 <a href="tel:{{ $portfolio->mobile }}" class="hover:underline">
                                {{ $portfolio->mobile }}
                            </a>
                        </span>
                    @endif

                    @if ($portfolio->address)
                        <span class="flex items-center gap-2">
                            📍 {{ $portfolio->address }}
                        </span>
                    @endif
                </div>



            </div>
        </section>


        <!-- Bio -->
        @if ($portfolio->bio)
            <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h2 class="text-xl font-semibold mb-3">About</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $portfolio->bio }}
                </p>
            </section>
        @endif

        <!-- Skills -->
        @if ($portfolio->skills)
            <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Skills</h2>

                <div class="flex flex-wrap gap-2">
                    @foreach (explode("\n", $portfolio->skills) as $skill)
                        <span
                            class="inline-flex items-center px-3 py-1
                                   bg-gray-100 border border-gray-300
                                   rounded-full text-sm font-medium text-gray-800">
                            {{ trim($skill) }}
                        </span>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects -->
        @if (!empty($portfolio->projects))
            <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold mb-4">Live Projects</h2>

                <div class="space-y-3">
                    @foreach ($portfolio->projects as $project)
                        <a href="{{ $project }}" target="_blank"
                            class="block border border-gray-200 rounded-lg p-4
                                   hover:border-black hover:shadow transition">
                            <p class="text-gray-900 font-medium break-all">
                                {{ $project }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                View project →
                            </p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Footer -->
        <footer class="mt-12 text-center text-sm text-gray-500">
            © {{ date('Y') }} {{ $portfolio->name }}
        </footer>

    </div>

</body>

</html>
