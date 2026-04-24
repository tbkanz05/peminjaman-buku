<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        
        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            /* Premium Shiny Black Theme v2.0 */
            :root {
                --bg-deep: #020203;
                --card-bg: rgba(18, 18, 20, 0.8);
                --accent-primary: #6366f1;
                --accent-secondary: #a855f7;
                --text-main: #f3f4f6;
                --border-color: rgba(255, 255, 255, 0.08);
            }

            body {
                background-color: var(--bg-deep) !important;
                color: var(--text-main) !important;
                font-family: 'Outfit', 'Figtree', sans-serif;
                overflow-x: hidden;
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: var(--bg-deep); }
            ::-webkit-scrollbar-thumb { 
                background: rgba(255, 255, 255, 0.1); 
                border-radius: 10px;
                border: 2px solid var(--bg-deep);
            }
            ::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

            .min-h-screen { background-color: var(--bg-deep) !important; }

            /* Animations */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }

            /* Premium Glassmorphism Card */
            .bg-white, .dark\:bg-gray-800 {
                background: var(--card-bg) !important;
                backdrop-filter: blur(16px) saturate(180%) !important;
                -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
                border: 1px solid var(--border-color) !important;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5) !important;
                border-radius: 24px !important;
            }

            /* No Hover Elevation (Removed as per request) */

            /* Table Container Padding */
            .overflow-x-auto {
                padding: 1.5rem !important; /* Memberikan ruang agar tabel tidak dempet */
            }

            /* Button Shine Effect (No background override) */
            .btn-shiny {
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
            }
            .btn-shiny:hover {
                transform: scale(1.05) translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5) !important;
                filter: brightness(1.2);
            }

            /* Custom Button Colors */
            .bg-blue-600 { background-color: #0066ff !important; }
            .bg-red-600 { background-color: #ff3333 !important; }
            .bg-indigo-600 { background-color: #6366f1 !important; }

            /* Navigation Styling */
            nav {
                background: rgba(2, 2, 3, 0.7) !important;
                backdrop-filter: blur(20px) !important;
                border-bottom: 1px solid var(--border-color) !important;
                z-index: 50 !important;
                position: relative !important;
            }

            /* Table Refinement */
            table.dataTable { border: none !important; }
            table.dataTable thead th {
                background: rgba(255, 255, 255, 0.02) !important;
                color: var(--accent-primary) !important;
                font-weight: 700 !important;
                border: none !important;
                padding: 15px !important;
            }
            table.dataTable tbody td {
                padding: 15px !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
            }

            /* Labels */
            label {
                color: var(--accent-primary) !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                font-size: 0.65rem !important;
                letter-spacing: 0.5px !important;
                margin-bottom: 0.4rem !important;
                display: block !important;
            }

            /* Forms & Inputs (Compact) */
            input, select, textarea {
                background: rgba(255, 255, 255, 0.04) !important;
                border: 1px solid rgba(255, 255, 255, 0.08) !important;
                border-radius: 12px !important;
                color: white !important;
                padding: 10px 14px !important; /* Smaller padding */
                transition: all 0.3s ease !important;
                width: 100% !important;
                font-size: 0.85rem !important;
            }
            input:focus, select:focus, textarea:focus {
                background: rgba(255, 255, 255, 0.08) !important;
                border-color: var(--accent-primary) !important;
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.2) !important;
                outline: none !important;
                transform: translateY(-2px);
            }

            /* Form Container Padding removed as per request */

            /* Header Glow */
            header {
                background: transparent !important;
                border-bottom: 1px solid var(--border-color) !important;
            }

            /* Catalog & Card Refinements */
            .catalog-container {
                max-width: 1400px !important;
                margin: 0 auto;
            }

            .book-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 20px !important;
            }

            @media (min-width: 640px) {
                .book-grid { grid-template-columns: repeat(2, 1fr) !important; }
            }

            @media (min-width: 768px) {
                .book-grid { grid-template-columns: repeat(3, 1fr) !important; }
            }

            @media (min-width: 1024px) {
                .book-grid { grid-template-columns: repeat(5, 1fr) !important; }
            }

            @media (min-width: 1280px) {
                .book-grid { grid-template-columns: repeat(5, 1fr) !important; }
            }

            .book-card-custom {
                background: var(--card-bg) !important;
                border: 1px solid var(--border-color) !important;
                border-radius: 20px !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
                height: 100% !important;
                transition: all 0.3s ease !important;
            }

            /* Card hover removed as requested */
            /*.book-card-custom:hover {
                transform: translateY(-8px) !important;
                border-color: var(--accent-primary) !important;
                box-shadow: 0 15px 30px rgba(0,0,0,0.5) !important;
            }*/

            .book-img-container {
                position: relative !important;
                width: 100% !important;
                padding-top: 130% !important; /* Fixed ratio for all screens */
                overflow: hidden !important;
                background: #1a1a1a !important;
            }

            .book-img-container img {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
            }

            .book-info-box {
                padding: 15px !important;
                flex-grow: 1 !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
            }

            /* Button Glow Effects */
            .btn-glow-blue:hover {
                box-shadow: 0 0 25px rgba(37, 99, 235, 0.7) !important;
                transform: translateY(-2px) !important;
            }
            .btn-glow-red:hover {
                box-shadow: 0 0 25px rgba(220, 38, 38, 0.7) !important;
                transform: translateY(-2px) !important;
            }
            .btn-glow-indigo:hover {
                box-shadow: 0 0 25px rgba(99, 102, 241, 0.7) !important;
                transform: translateY(-2px) !important;
            }
            .btn-glow-green:hover {
                box-shadow: 0 0 25px rgba(34, 197, 94, 0.7) !important;
                transform: translateY(-2px) !important;
            }
            .btn-glow-purple:hover {
                box-shadow: 0 0 25px rgba(168, 85, 247, 0.7) !important;
                transform: translateY(-2px) !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            $(document).ready(function() {
                // Initialize DataTables
                $('.datatable').DataTable({
                    "order": [],
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "paginate": {
                            "next": "›",
                            "previous": "‹"
                        }
                    }
                });

                // SweetAlert notifications
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 3000,
                        showConfirmButton: false,
                        background: '#1f2937',
                        color: '#fff'
                    });
                @endif

                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "{{ session('error') }}",
                        background: '#1f2937',
                        color: '#fff'
                    });
                @endif

                // Confirmation for forms
                $(document).on('submit', 'form.confirm', function(e) {
                    e.preventDefault();
                    let form = this;
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Tindakan ini akan diproses.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#ef4444',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal',
                        background: '#1f2937',
                        color: '#fff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
