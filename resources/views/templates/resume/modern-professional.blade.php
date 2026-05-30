@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .modern-container { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.5; font-size: 10.5pt; }
        .modern-header { border-bottom: 3px solid #2563eb; padding-bottom: 15px; margin-bottom: 20px; }
        .modern-name { font-size: 26pt; font-weight: bold; color: #0f172a; margin: 0; }
        .modern-title { font-size: 13pt; color: #2563eb; font-weight: bold; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .modern-contact { font-size: 9pt; color: #64748b; margin-top: 8px; }
        .modern-section-title { font-size: 12pt; font-weight: bold; text-transform: uppercase; color: #1e3a8a; border-bottom: 1px solid #cbd5e1; padding-bottom: 4px; margin-top: 22px; margin-bottom: 10px; letter-spacing: 0.5px; }
        .modern-job { margin-bottom: 12px; }
        .modern-job-header { font-weight: bold; color: #0f172a; font-size: 11pt; }
        .modern-job-meta { color: #64748b; font-size: 9.5pt; font-style: italic; margin-bottom: 3px; }
        .modern-desc { font-size: 9.5pt; color: #334155; margin: 0; white-space: pre-line; }
        .modern-skill-tag { display: inline-block; background-color: #eff6ff; color: #1d4ed8; padding: 4px 8px; border-radius: 4px; margin-right: 5px; margin-bottom: 5px; font-size: 9pt; font-weight: 500; }
    </style>
    <div class="modern-container">
        <div class="modern-header">
            <h1 class="modern-name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <div class="modern-title">{{ $resume->job_role }}</div>
            @endif
            <div class="modern-contact">
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
                    &nbsp;|&nbsp; <span style="color: #2563eb;">{{ $data['personalInfo']['website'] }}</span>
                @endif
            </div>
        </div>

        @if ($data['summary'] ?? '')
            <div class="modern-section-title">Professional Summary</div>
            <p class="modern-desc" style="font-size: 10pt;">{{ $data['summary'] }}</p>
        @endif

        @if (count($data['experience'] ?? []) > 0)
            <div class="modern-section-title">Work Experience</div>
            @foreach ($data['experience'] as $job)
                <div class="modern-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="modern-job-header" style="text-align: left;">{{ $job['position'] ?? 'Position' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #64748b;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="modern-job-meta">{{ $job['company'] ?? 'Company' }}</td>
                        </tr>
                    </table>
                    @if ($job['description'] ?? '')
                        <p class="modern-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['education'] ?? []) > 0)
            <div class="modern-section-title">Education</div>
            @foreach ($data['education'] as $school)
                <div class="modern-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="modern-job-header" style="text-align: left;">{{ $school['school'] ?? 'School' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #64748b;">{{ $school['year'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="modern-job-meta">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif

        @if (count($data['projects'] ?? []) > 0)
            <div class="modern-section-title">Projects</div>
            @foreach ($data['projects'] as $proj)
                <div class="modern-job">
                    <div class="modern-job-header">
                        {{ $proj['title'] ?? 'Project Title' }}
                        @if ($proj['link'] ?? '')
                            <span style="font-size: 8.5pt; font-weight: normal; color: #2563eb;">({{ $proj['link'] }})</span>
                        @endif
                    </div>
                    @if ($proj['description'] ?? '')
                        <p class="modern-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['skills'] ?? []) > 0)
            <div class="modern-section-title">Skills</div>
            <div style="margin-top: 5px;">
                @foreach ($data['skills'] as $skill)
                    <span class="modern-skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="p-8 md:p-12 text-slate-800 font-sans max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-slate-100">
        <!-- Header -->
        <div class="border-b-4 border-blue-600 pb-6 mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <p class="text-lg font-bold text-blue-600 uppercase tracking-widest mt-1">{{ $resume->job_role }}</p>
            @endif
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-slate-500 text-sm mt-3 font-medium">
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
                    <a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">🌐 Portfolio</a>
                @endif
            </div>
        </div>

        <!-- Summary -->
        @if ($data['summary'] ?? '')
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-3 tracking-wide uppercase text-sm">Professional Summary</h2>
                <p class="text-slate-600 leading-relaxed text-sm md:text-base">{{ $data['summary'] }}</p>
            </section>
        @endif

        <!-- Experience -->
        @if (count($data['experience'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Work Experience</h2>
                <div class="space-y-6">
                    @foreach ($data['experience'] as $job)
                        <div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between font-bold text-slate-800 text-base">
                                <h3>{{ $job['position'] ?? 'Position' }}</h3>
                                <span class="font-normal text-slate-500 text-sm">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                            </div>
                            <div class="text-blue-600 font-semibold text-sm italic">{{ $job['company'] ?? 'Company' }}</div>
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
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Education</h2>
                <div class="space-y-4">
                    @foreach ($data['education'] as $school)
                        <div>
                            <div class="flex justify-between font-bold text-slate-800 text-sm md:text-base">
                                <h3>{{ $school['school'] ?? 'School' }}</h3>
                                <span class="font-normal text-slate-500 text-xs md:text-sm">{{ $school['year'] ?? '' }}</span>
                            </div>
                            <p class="text-slate-600 text-sm">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects -->
        @if (count($data['projects'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Featured Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($data['projects'] as $proj)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center justify-between">
                                {{ $proj['title'] ?? 'Project Title' }}
                                @if ($proj['link'] ?? '')
                                    <a href="{{ $proj['link'] }}" target="_blank" class="text-blue-600 hover:underline text-xs font-normal">Link ↗</a>
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
            <section class="mb-6">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-3 tracking-wide uppercase text-sm">Core Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($data['skills'] as $skill)
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold">{{ $skill }}</span>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endif
