@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .grad-container { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1e1b4b; line-height: 1.5; font-size: 10pt; }
        .grad-header { background-color: #4c1d95; color: white; padding: 25px; margin-bottom: 25px; border-bottom: 6px solid #db2777; border-radius: 8px; }
        .grad-name { font-size: 26pt; font-weight: bold; color: white; margin: 0; }
        .grad-title { font-size: 13pt; color: #f472b6; font-weight: bold; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .grad-contact { font-size: 9pt; color: #e9d5ff; margin-top: 10px; }
        .grad-section-title { font-size: 11pt; font-weight: bold; text-transform: uppercase; color: #4c1d95; border-bottom: 2px solid #db2777; padding-bottom: 3px; margin-top: 22px; margin-bottom: 10px; letter-spacing: 0.5px; }
        .grad-job { margin-bottom: 12px; }
        .grad-job-header { font-weight: bold; color: #1e1b4b; font-size: 10.5pt; }
        .grad-job-meta { color: #db2777; font-size: 9pt; font-weight: bold; margin-bottom: 3px; }
        .grad-desc { font-size: 9.5pt; color: #4c1d95; margin: 0; white-space: pre-line; }
        .grad-skill-tag { display: inline-block; background-color: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; padding: 4px 8px; border-radius: 6px; margin-right: 5px; margin-bottom: 5px; font-size: 8.5pt; font-weight: bold; }
    </style>
    <div class="grad-container">
        <div class="grad-header">
            <h1 class="grad-name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <div class="grad-title">{{ $resume->job_role }}</div>
            @endif
            <div class="grad-contact">
                @if ($data['personalInfo']['email'] ?? '')
                    {{ $data['personalInfo']['email'] }}
                @endif
                @if ($data['personalInfo']['phone'] ?? '')
                    &nbsp;|&nbsp; {{ $data['personalInfo']['phone'] }}
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    &nbsp;|&nbsp; {{ $data['personalInfo']['location'] }}
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    &nbsp;|&nbsp; <span style="color: #f472b6;">{{ $data['personalInfo']['website'] }}</span>
                @endif
            </div>
        </div>

        @if ($data['summary'] ?? '')
            <div class="grad-section-title">About Me</div>
            <p class="grad-desc" style="font-size: 10pt;">{{ $data['summary'] }}</p>
        @endif

        @if (count($data['experience'] ?? []) > 0)
            <div class="grad-section-title">Experience</div>
            @foreach ($data['experience'] as $job)
                <div class="grad-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="grad-job-header" style="text-align: left;">{{ $job['position'] ?? 'Position' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #701a75;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="grad-job-meta">{{ $job['company'] ?? 'Company' }}</td>
                        </tr>
                    </table>
                    @if ($job['description'] ?? '')
                        <p class="grad-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['education'] ?? []) > 0)
            <div class="grad-section-title">Education</div>
            @foreach ($data['education'] as $school)
                <div class="grad-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="grad-job-header" style="text-align: left;">{{ $school['school'] ?? 'School' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #701a75;">{{ $school['year'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="grad-job-meta" style="color: #701a75;">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif

        @if (count($data['projects'] ?? []) > 0)
            <div class="grad-section-title">Projects</div>
            @foreach ($data['projects'] as $proj)
                <div class="grad-job">
                    <div class="grad-job-header">
                        {{ $proj['title'] ?? 'Project Title' }}
                        @if ($proj['link'] ?? '')
                            <span style="font-size: 8.5pt; font-weight: normal; color: #db2777;">({{ $proj['link'] }})</span>
                        @endif
                    </div>
                    @if ($proj['description'] ?? '')
                        <p class="grad-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['skills'] ?? []) > 0)
            <div class="grad-section-title">Core Skills</div>
            <div style="margin-top: 5px;">
                @foreach ($data['skills'] as $skill)
                    <span class="grad-skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="text-slate-800 font-sans max-w-4xl mx-auto bg-white shadow-2xl rounded-2xl border border-purple-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-700 via-pink-600 to-rose-500 text-white p-8 md:p-12 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 top-0 w-1/3 bg-white/5 skew-x-12 translate-x-12"></div>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight relative z-10">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <p class="text-base md:text-lg font-bold text-pink-200 uppercase tracking-widest mt-2 relative z-10">{{ $resume->job_role }}</p>
            @endif
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-purple-100 text-xs md:text-sm mt-4 font-medium relative z-10">
                @if ($data['personalInfo']['email'] ?? '')
                    <span class="flex items-center gap-1">✉ {{ $data['personalInfo']['email'] }}</span>
                @endif
                @if ($data['personalInfo']['phone'] ?? '')
                    <span class="flex items-center gap-1">📞 {{ $data['personalInfo']['phone'] }}</span>
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    <span class="flex items-center gap-1">📍 {{ $data['personalInfo']['location'] }}</span>
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    <a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="text-pink-200 hover:text-white hover:underline transition flex items-center gap-1">🌐 Portfolio</a>
                @endif
            </div>
        </div>

        <div class="p-8 md:p-10 space-y-8">
            <!-- About Me -->
            @if ($data['summary'] ?? '')
                <section>
                    <h2 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest border-b-2 border-pink-500 pb-1 mb-3">About Me</h2>
                    <p class="text-slate-600 leading-relaxed text-sm md:text-base">{{ $data['summary'] }}</p>
                </section>
            @endif

            <!-- Experience -->
            @if (count($data['experience'] ?? []) > 0)
                <section>
                    <h2 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest border-b-2 border-pink-500 pb-1 mb-4">Experience</h2>
                    <div class="space-y-6">
                        @foreach ($data['experience'] as $job)
                            <div>
                                <div class="flex flex-col md:flex-row md:items-center justify-between font-bold text-slate-800 text-sm md:text-base">
                                    <h3>{{ $job['position'] ?? 'Position' }}</h3>
                                    <span class="font-normal text-slate-500 text-xs md:text-sm">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                                </div>
                                <div class="text-pink-600 font-bold text-xs uppercase tracking-wider mt-0.5">{{ $job['company'] ?? 'Company' }}</div>
                                @if ($job['description'] ?? '')
                                    <p class="text-slate-600 text-sm mt-2 leading-relaxed whitespace-pre-line">{{ $job['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Education -->
            @if (count($data['education'] ?? []) > 0)
                <section>
                    <h2 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest border-b-2 border-pink-500 pb-1 mb-4">Education</h2>
                    <div class="space-y-4">
                        @foreach ($data['education'] as $school)
                            <div>
                                <div class="flex justify-between font-bold text-slate-800 text-sm md:text-base">
                                    <h3>{{ $school['school'] ?? 'School' }}</h3>
                                    <span class="font-normal text-slate-500 text-xs md:text-sm">{{ $school['year'] ?? '' }}</span>
                                </div>
                                <p class="text-slate-500 text-xs mt-0.5 font-medium">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Projects -->
            @if (count($data['projects'] ?? []) > 0)
                <section>
                    <h2 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest border-b-2 border-pink-500 pb-1 mb-4">Featured Projects</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($data['projects'] as $proj)
                            <div class="p-4 bg-slate-50 rounded-xl border border-purple-50/50 hover:border-purple-100 hover:shadow-md transition">
                                <h3 class="font-bold text-slate-900 text-sm flex items-center justify-between">
                                    {{ $proj['title'] ?? 'Project Title' }}
                                    @if ($proj['link'] ?? '')
                                        <a href="{{ $proj['link'] }}" target="_blank" class="text-pink-600 hover:underline text-xs font-normal">Link ↗</a>
                                    @endif
                                </h3>
                                @if ($proj['description'] ?? '')
                                    <p class="text-slate-600 text-xs mt-1.5 leading-relaxed">{{ $proj['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Skills -->
            @if (count($data['skills'] ?? []) > 0)
                <section>
                    <h2 class="text-xs font-extrabold text-purple-700 uppercase tracking-widest border-b-2 border-pink-500 pb-1 mb-3">Skills & Abilities</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($data['skills'] as $skill)
                            <span class="px-3 py-1.5 bg-gradient-to-r from-purple-50 to-pink-50 text-purple-700 border border-purple-100/50 rounded-lg text-xs font-semibold hover:shadow-sm transition cursor-default">{{ $skill }}</span>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
@endif
