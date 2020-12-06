<!doctype html>
<html lang="en">
    <head>
        <title>Food blog - @yield('title')</title>
    </head>
    <body>
        <h1>Food blog - @yield('title')</h1>

        @if ($errors->any())
            <div>
                Errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            @yield('content')
        </div>
    </body>
</html>