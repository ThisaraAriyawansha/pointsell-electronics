
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tele Tech Electronics | Login</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/styles/common.css">
</head>

<body>
    <div class="bg-[#000000C9] flex items-center justify-center h-dvh">
        <!-- Cover Photo Section -->
        <div
            class="flex flex-col items-center justify-center w-1/2 gap-4 bg-center bg-cover rounded-s-lg max-lg:rounded-none max-lg:rounded-t-lg max-lg:w-full max-lg:h-1/3"
            style="background-image: url('{{ asset('images/cover-photo.jpg') }}');">

            <!-- H1 Tag Above Image -->
            <h1 class="text-3xl font-bold text-[#0086B8]">Welcome Tele Tech Electronics </h1>

            <!-- Logo -->
            <img class="w-75 max-lg:w-[90px]" src="{{ asset('images/logo.png') }}" alt="logo">

            <!-- Login Button -->
            <a href="{{ route('login') }}">
                    <button 
                    class="rounded-full bg-[#0086B8] hover:scale-75 transition-all w-20 max-sm:w-12 max-sm:text-xs aspect-square text-white">Login</button>
            </a>

        </div>       
        </div>
    </div>
</body>
</html>
