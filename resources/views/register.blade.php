<x-guest-layout title="Register">
    @auth
        @if (auth()->user())
            <script>
                window.location.href = "{{ route('admin.dashboard') }}";
            </script>
        @endif
    @else
      <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endauth
</x-guest-layout>
