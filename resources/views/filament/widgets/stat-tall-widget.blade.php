<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display:flex; flex-direction:column; justify-content:space-between; min-height:290px; padding:4px 2px;">

            {{-- Header: Icon + Label --}}
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="
                    width:40px; height:40px;
                    border-radius:10px;
                    background: {{ $color }}22;
                    display:flex; align-items:center; justify-content:center;
                    flex-shrink:0;
                ">
                    <x-filament::icon
                        :icon="$icon"
                        style="width:22px; height:22px; color: {{ $color }};"
                    />
                </div>
                <span style="font-size:14px; font-weight:600; color:#fffff; letter-spacing:0.01em;">
                    {{ $label }}
                </span>
            </div>

            {{-- Nilai Utama --}}
            <div style="text-align:center; padding:16px 0;">
                <div style="
                    font-size:64px;
                    font-weight:800;
                    line-height:1;
                    background: linear-gradient(135deg, {{ $color }}, {{ $color }}99);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                ">
                    {{ $this->getValue() }}
                </div>
            </div>

            {{-- Deskripsi --}}
            <div style="
                display:flex; align-items:center; gap:6px;
                font-size:13px; font-weight:500;
                color: {{ $color }};
                padding:8px 10px;
                background: {{ $color }}11;
                border-radius:8px;
            ">
                <span>{{ $description }}</span>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
