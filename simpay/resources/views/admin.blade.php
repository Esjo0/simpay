
<x-guest-layout >
    <div class="container text-center">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-2 h-20 fill-current text-gray-500" style="width:200px" />
            </a>
        </x-slot>

        @include('common.alert')

        <form class="" method="POST" action="{{ route('transactions') }}">
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Access Code</label>
                <input name="access_code" type="password" class="form-control" id="" placeholder="Enter the Access Code"/>
            </div>
            <button type="submit" class="btn btn-primary">Proceed</button>
        </form>
    </x-auth-card>
    </div>
</x-guest-layout>

