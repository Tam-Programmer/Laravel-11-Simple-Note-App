<x-app-layout>
    <div>
        <h2 class="text-3xl">Hello {{Auth::user()->name}}</h2>
        <p>Sorry, this note does not belong to you!</p>
        <br>
        <a href="/note">Go Back to your note?</a>
    </div>
</x-app-layout>
