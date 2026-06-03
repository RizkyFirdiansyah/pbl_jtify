<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <span>Aktivitas Terbaru</span>
        </x-slot>

        @php
            $activities = $this->getActivities();
        @endphp

    
        @if ($activities->isEmpty())
            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 0; text-align:center; color:#6b7280;">
                <p style="font-size:14px;">Belum ada aktivitas.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:13.5px;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(156,163,175,0.2);">
                            <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; color:#6b7280; white-space:nowrap;">
                                Nama User
                            </th>
                            <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; color:#6b7280;">
                                Aktivitas
                            </th>
                            <th style="text-align:right; padding:10px 12px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; color:#6b7280; white-space:nowrap;">
                                Waktu
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr style="border-bottom: 1px solid rgba(156,163,175,0.1); transition: background 0.15s;"
                                onmouseover="this.style.background='rgba(156,163,175,0.05)'"
                                onmouseout="this.style.background='transparent'">

                                {{-- Kolom: Nama User --}}
                                <td style="padding:12px; white-space:nowrap; vertical-align:middle;">
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        {{-- Avatar inisial --}}
                                        <div style="
                                            width:34px; height:34px;
                                            border-radius:50%;
                                            background: {{ $activity['badgeColor'] }}22;
                                            border: 1.5px solid {{ $activity['badgeColor'] }}66;
                                            display:flex; align-items:center; justify-content:center;
                                            font-size:13px; font-weight:700;
                                            color: {{ $activity['badgeColor'] }};
                                            flex-shrink:0;
                                        ">
                                            {{ strtoupper(substr($activity['userName'], 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:600; font-size:13.5px;">
                                                {{ $activity['userName'] }}
                                            </div>
                                            <div style="font-size:11px; color:#9ca3af; text-transform:capitalize; margin-top:1px;">
                                                {{ $activity['userRole'] }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom: Aktivitas --}}
                                <td style="padding:12px; vertical-align:middle;">
                                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                        {{-- Badge tipe --}}
                                        <span style="
                                            display:inline-flex; align-items:center;
                                            padding:2px 8px;
                                            border-radius:9999px;
                                            font-size:11px; font-weight:600;
                                            background: {{ $activity['badgeColor'] }}22;
                                            color: {{ $activity['badgeColor'] }};
                                            white-space:nowrap;
                                        ">
                                            {{ $activity['badge'] }}
                                        </span>
                                        {{-- Teks aktivitas --}}
                                        <span style="color:inherit; font-size:13px;">
                                            {{ $activity['activity'] }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Kolom: Waktu --}}
                                <td style="padding:12px; text-align:right; vertical-align:middle; white-space:nowrap;">
                                    <span style="font-size:12px; color:#9ca3af; font-weight:500;">
                                        {{ $activity['time']?->diffForHumans() }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
