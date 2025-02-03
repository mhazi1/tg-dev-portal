<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- CSS dependencies -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
        
        <!-- JavaScript dependencies - Add these before your app.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>TechGuard Dev Portal</title>
    </head>
<body class="bg-slate-200/30 dark:bg-gray-800">
    <!-- Add this right after opening body tag -->
    <div id="loading-overlay" class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-900/50">
        <div class="relative">
            <!-- Outer ring -->
            <div class="w-16 h-16 border-4 border-blue-100 rounded-full border-t-blue-500 animate-spin"></div>
            <!-- Inner ring -->
            {{-- <div class="absolute border-4 border-transparent rounded-full top-1 left-1 w-14 h-14 border-t-blue-300 animate-spin"></div> --}}
        </div>
    </div>
    <main> 
    {{$slot}}
    </main>
    
</body>

</html>