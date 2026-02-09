<x-layouts::app>
    <div class="max-w-4xl mx-auto py-10 px-6">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Portfolio @if (Auth::user()->portfolio)
                    - <a href="{{ url(Auth::user()->portfolio->slug) }}" class="text-blue-600 hover:underline"
                        target="_blank">{{ url(Auth::user()->portfolio->slug) }}</a>
                @endif
            </h1>
            <p class="text-gray-500 mt-1">
                This information will be shown on your public profile
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('portfolio.save') }}" class="space-y-8">
            @csrf

            <!-- Basic Info -->
            <div class="bg-white shadow rounded-lg p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Full Name: </label>
                        {{ $portfolio->name ?? auth()->user()->name }}
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        {{ $portfolio->email ?? auth()->user()->email }}
                    </div>

                    <div>
                        <label class="form-label">Mobile <small class="text-gray-500">(*)</small></label>
                        <input name="mobile" class="form-input" value="{{ old('mobile', $portfolio->mobile ?? '') }}">
                        @error('mobile')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Address <small class="text-gray-500">(*)</small></label>
                        <input name="address" class="form-input"
                            value="{{ old('address', $portfolio->address ?? '') }}">
                        @error('address')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <!-- Skills -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Skills</h2>
                <p class="text-sm text-gray-500 mb-3">
                    <b>Add one skill per line</b>
                </p>

                <textarea name="skills" rows="6" class="form-input @error('skills') border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Laravel
Livewire
PHP
AWS">{{ old('skills', $portfolio->skills ?? '') }}</textarea>

                @error('skills')
                    <p class="form-error mt-2">{{ $message }}</p>
                @enderror
            </div>





            <!-- Bio -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Short Bio <small class="text-gray-500">(*)</small>
                </h2>
                <textarea name="bio" rows="4" class="form-input" placeholder="Tell something about yourself">{{ old('bio', $portfolio->bio ?? '') }}</textarea>
                @error('bio')
                    <p class="form-error">{{ $message }}</p>
                @enderror


            </div>


            <!-- Projects -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm" x-data="{ projects: {{ json_encode(old('projects', $portfolio->projects ?? [''])) }} }">

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Live Projects</h2>

                    <!-- Add button -->
                    <button type="button" @click="projects.push('')"
                        class="inline-flex items-center justify-center w-8 h-8
                       rounded-full bg-black text-white hover:bg-gray-800">
                        +
                    </button>
                </div>

                <template x-for="(project, index) in projects" :key="index">
                    <div class="flex items-center gap-3 mb-3">
                        <input type="url" name="projects[]" x-model="projects[index]" class="form-input flex-1"
                            placeholder="https://github.com/username/repo">

                        <!-- Remove button (only if more than 1) -->
                        <button type="button" x-show="projects.length > 1" @click="projects.splice(index, 1)"
                            class="text-red-500 hover:text-red-700 text-sm font-medium">
                            ✕
                        </button>
                    </div>
                </template>

                <p class="text-sm text-gray-500 mt-2">
                    Add links to live apps, GitHub repos, or demos
                </p>

                @error('projects')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>


            <!-- Save -->
            <div class="flex justify-end">
                <button class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                    Save Portfolio
                </button>
            </div>

        </form>
    </div>


</x-layouts::app>
