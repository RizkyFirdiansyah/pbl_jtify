<header {{ $attributes->merge(['class' => 'relative w-full min-h-[220px] md:min-h-[300px] bg-no-repeat bg-center flex flex-col items-center justify-center overflow-hidden']) }}
        style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">
    <div class="absolute inset-0 bg-white/10"></div>
    {{ $slot }}
</header>
