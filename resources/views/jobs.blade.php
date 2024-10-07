<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
        <li>
            <a href="/jobs/{{ $job['id']}}" class="block px-4 py-6 border border-gray-200">
                <div class="font-bold font-blue text-smcomposer require barryvdh/laravel-debugbar --dev">
                    {{ $job->employer->name}}
                </div>
                <div>
                    <strong>{{ $job['title']}}</strong>: Pays {{$job['salary']}} per year
                </div>
            </a>
        </li>
        @endforeach
        <div>
            {{$jobs->links()}}
        </div>
    </div>

</x-layout>