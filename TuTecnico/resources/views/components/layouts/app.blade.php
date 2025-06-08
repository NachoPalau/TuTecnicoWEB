<!DOCTYPE html>
<html>
<head>
    <title>Tu Técnico</title>
    
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>
