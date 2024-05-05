<form method="POST" action="{{route('logout')}}" class="mt-2">
    @csrf
    <button type="submit">
        <img src="{{Vite::asset('resources/images/profile/logout.svg')}}"
             alt="logout">
    </button>
</form>
