  <div>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@200;300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('front/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                container: {
                    padding: '2rem',
                    screen: {
                        '2xl': '1200px'
                    }
                },
                extend: {
                    colors: {
                        'primary': {
                            DEFAULT: '#FDAE4B',
                            50: '#fff9f5',
                            100: '#FFF7EC',
                            200: '#FEE4C4',
                            300: '#FED29C',
                            400: '#FDC073',
                            500: '#FDAE4B',
                            600: '#FC9514',
                            700: '#D57802',
                            800: '#9E5902',
                            900: '#663901',
                            950: '#4B2A01'
                        },
                        'rum': {
                            DEFAULT: '#6C6489',
                            50: '#FFFFFF',
                            100: '#FFFFFF',
                            200: '#F0EFF3',
                            300: '#D9D7E2',
                            400: '#C3C0D1',
                            500: '#ADA8BF',
                            600: '#9790AE',
                            700: '#81799D',
                            800: '#6C6489',
                            900: '#524C69',
                            950: '#464058'
                        },
                    }
                }
            }
        }
    </script>
    @livewireStyles()
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => console.log('✅ AlpineJS đã khởi tạo thành công'));
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>