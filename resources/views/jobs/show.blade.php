<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>
    
    <h2>
        {{$job->title}}
    </h2>
    <p>
        This job pays{{ $job->salary}}
    </p>

    @can('edit', $job)
    <p class="mt-6">
        <x-button href="/jobs/{{$job->id}}/edit">
            Edit Job
        </x-button>
    </p>
    @endcan

</x-layout>