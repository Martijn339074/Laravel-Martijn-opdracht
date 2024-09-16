<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
        <li>
            <a href="
            {{ $job['title']}}: Pays {{$job['salary']}} per year
            "></a>
        </li>
        @endforeach
    </ul>

</x-layout>