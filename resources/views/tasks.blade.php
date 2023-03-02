<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do List</title>
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />

    <style>
        @font-face {
            font-family: 'Press Start 2P';
            font-style: normal;
            font-weight: 400;
            src: local('Press Start 2P Regular'), local('PressStart2P-Regular'), url('https://fonts.gstatic.com/s/pressstart2p/v8/e3t4euO8T-267oIAQAu6jDQyK3nVivNm4I81.woff2') format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }


        body {
            width: 100%;
            min-height: 100vh;
            font-family: 'Press Start 2P', cursive;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .my-3 {
            margin-bottom: 3rem;
            margin-top: 3rem;
        }

        .container {
            max-width: 720px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .w-full {
            width: 100%;
        }
    </style>
</head>

<body class="container">
    <div class="nes-container with-title is-centered w-full">
        <p>Devo ricordarmi di...</p>
        <form method="POST" class="nes-field is-inline" action="{{ route('tasks.store')}}">
            @csrf
            <input type="text" id="description" name="description"
                class="@error('description') is-error @enderror nes-input">
            <button type="submit" class="nes-btn is-primary">+</button>
        </form>
        @error('description')
        <span class="nes-text is-error">
            <span>{{ $message }}</span>
        </span>
        @enderror
    </div>

    @forelse($tasks as $task)

    <div class="nes-container with-title is-centered my-3 w-full">
        <p class="title">Attività {{$loop->remaining + 1}}</p>
        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
            <div class="is-inline flex justify-between items-center max-w-md">
                <p class="pr-4">{{$task->description}}</p>
                @csrf
                @method('DELETE')
                <button type="submit" class="nes-btn is-success ml-1 h-12">Fatto
                </button>
            </div>
        </form>
    </div>
    @empty
    <div class="nes-container is-centered my-3 w-full">
        <p>Ti stai annoiando? Inserisci qualche Tasks!</p>
        <i class="nes-icon coin is-medium"></i>
        <i class="nes-icon coin is-medium"></i>
        <i class="nes-icon coin is-medium"></i>
        <i class="nes-icon coin is-medium"></i>
        <i class="nes-icon coin is-medium"></i>
    </div>
    @endforelse
</body>

</html>