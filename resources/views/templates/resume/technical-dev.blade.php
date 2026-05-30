@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .tech-container { font-family: Courier, monospace; color: #047857; line-height: 1.4; font-size: 9.5pt; }
        .tech-header { border: 1px solid #10b981; padding: 15px; margin-bottom: 20px; background-color: #f0fdf4; }
        .tech-name { font-size: 22pt; font-weight: bold; color: #065f46; margin: 0; }
        .tech-title { font-size: 11pt; color: #047857; font-weight: bold; margin-top: 5px; }
        .tech-contact { font-size: 8.5pt; color: #065f46; margin-top: 8px; }
        .tech-section-title { font-size: 11pt; font-weight: bold; color: #065f46; border-bottom: 2px dashed #10b981; padding-bottom: 3px; margin-top: 20px; margin-bottom: 10px; }
        .tech-job { margin-bottom: 12px; }
        .tech-job-header { font-weight: bold; color: #065f46; font-size: 10pt; }
        .tech-job-meta { color: #047857; font-size: 9pt; margin-bottom: 3px; }
        .tech-desc { font-size: 9pt; color: #0f172a; margin: 0; white-space: pre-line; }
        .tech-skill { display: inline-block; border: 1px solid #10b981; padding: 2px 6px; margin-right: 5px; margin-bottom: 5px; font-size: 8.5pt; background-color: #f0fdf4; color: #047857; }
    </style>
    <div class="tech-container">
        <div class="tech-header">
            <h1 class="tech-name">./{{ str_replace(' ', '_', strtolower($data['personalInfo']['fullName'] ?? 'your_name')) }}</h1>
            @if ($resume->job_role)
                <div class="tech-title">// {{ $resume->job_role }}</div>
            @endif
            <div class="tech-contact">
                [email] {{ $data['personalInfo']['email'] ?? 'n/a' }}
                @if ($data['personalInfo']['phone'] ?? '')
                    | [phone] {{ $data['personalInfo']['phone'] }}
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    | [loc] {{ $data['personalInfo']['location'] }}
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    | [web] {{ $data['personalInfo']['website'] }}
                @endif
            </div>
        </div>

        @if ($data['summary'] ?? '')
            <div class="tech-section-title"># 01. executive_summary</div>
            <p class="tech-desc" style="line-height: 1.5;">{{ $data['summary'] }}</p>
        @endif

        @if (count($data['experience'] ?? []) > 0)
            <div class="tech-section-title"># 02. work_experience</div>
            @foreach ($data['experience'] as $job)
                <div class="tech-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="tech-job-header" style="text-align: left;">&gt; {{ $job['position'] ?? 'Position' }}</td>
                            <td style="text-align: right; font-size: 9pt; color: #047857;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tech-job-meta">@ {{ $job['company'] ?? 'Company' }}</td>
                        </tr>
                    </table>
                    @if ($job['description'] ?? '')
                        <p class="tech-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['education'] ?? []) > 0)
            <div class="tech-section-title"># 03. education_history</div>
            @foreach ($data['education'] as $school)
                <div class="tech-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="tech-job-header" style="text-align: left;">&gt; {{ $school['school'] ?? 'School' }}</td>
                            <td style="text-align: right; font-size: 9pt; color: #047857;">{{ $school['year'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tech-job-meta">{{ $school['degree'] ?? '' }} // {{ $school['field'] ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif

        @if (count($data['projects'] ?? []) > 0)
            <div class="tech-section-title"># 04. featured_projects</div>
            @foreach ($data['projects'] as $proj)
                <div class="tech-job">
                    <div class="tech-job-header">
                        &gt; {{ $proj['title'] ?? 'Project Title' }}
                        @if ($proj['link'] ?? '')
                            <span style="font-size: 8pt; font-weight: normal; color: #047857;">[{{ $proj['link'] }}]</span>
                        @endif
                    </div>
                    @if ($proj['description'] ?? '')
                        <p class="tech-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['skills'] ?? []) > 0)
            <div class="tech-section-title"># 05. tech_stack</div>
            <div style="margin-top: 5px;">
                @foreach ($data['skills'] as $skill)
                    <span class="tech-skill">[{{ $skill }}]</span>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="p-8 md:p-12 text-emerald-400 font-mono max-w-4xl mx-auto bg-slate-950 shadow-2xl rounded-2xl border border-emerald-900/30 overflow-hidden">
        <!-- Header -->
        <div class="border border-emerald-500/20 bg-slate-900/50 p-6 rounded-xl mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-white flex items-center gap-2">
                    <span class="text-emerald-500">&gt;_</span> {{ str_replace(' ', '_', strtolower($data['personalInfo']['fullName'] ?? 'your_name')) }}
                </h1>
                <span class="text-xs px-2 py-1 border border-emerald-500/30 text-emerald-500 rounded bg-emerald-950/20">v1.0.0</span>
            </div>
            @if ($resume->job_role)
                <p class="text-sm font-semibold text-emerald-300 mt-2">// {{ $resume->job_role }}</p>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-slate-400 text-xs md:text-sm mt-4 pt-4 border-t border-emerald-950">
                @if ($data['personalInfo']['email'] ?? '')
                    <div><span class="text-emerald-500">[email]</span> {{ $data['personalInfo']['email'] }}</div>
                @endif
                @if ($data['personalInfo']['phone'] ?? '')
                    <div><span class="text-emerald-500">[phone]</span> {{ $data['personalInfo']['phone'] }}</div>
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    <div><span class="text-emerald-500">[location]</span> {{ $data['personalInfo']['location'] }}</div>
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    <div><span class="text-emerald-500">[website]</span> <a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="hover:text-white transition underline">{{ $data['personalInfo']['website'] }}</a></div>
                @endif
            </div>
        </div>

        <!-- Summary -->
        @if ($data['summary'] ?? '')
            <section class="mb-8">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-300 border-b border-emerald-900/40 pb-1 mb-3"># 01. summary()</h2>
                <p class="text-slate-300 leading-relaxed text-sm md:text-base font-light">{{ $data['summary'] }}</p>
            </section>
        @endif

        <!-- Experience -->
        @if (count($data['experience'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-300 border-b border-emerald-900/40 pb-1 mb-4"># 02. work_experience()</h2>
                <div class="space-y-6">
                    @foreach ($data['experience'] as $job)
                        <div class="border-l border-emerald-900/40 pl-4">
                            <div class="flex flex-col md:flex-row md:items-center justify-between font-medium text-emerald-100 text-sm md:text-base">
                                <h3>&gt; {{ $job['position'] ?? 'Position' }}</h3>
                                <span class="font-normal text-emerald-600 text-xs md:text-sm">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                            </div>
                            <div class="text-emerald-500 text-xs mt-0.5">@ {{ $job['company'] ?? 'Company' }}</div>
                            @if ($job['description'] ?? '')
                                <p class="text-slate-400 text-sm mt-2 leading-relaxed whitespace-pre-line font-light">{{ $job['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Education -->
        @if (count($data['education'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-300 border-b border-emerald-900/40 pb-1 mb-4"># 03. education()</h2>
                <div class="space-y-4">
                    @foreach ($data['education'] as $school)
                        <div class="border-l border-emerald-900/40 pl-4">
                            <div class="flex justify-between font-medium text-emerald-100 text-sm md:text-base">
                                <h3>&gt; {{ $school['school'] ?? 'School' }}</h3>
                                <span class="font-normal text-emerald-600 text-xs md:text-sm">{{ $school['year'] ?? '' }}</span>
                            </div>
                            <p class="text-slate-400 text-xs font-light">{{ $school['degree'] ?? '' }} // {{ $school['field'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects -->
        @if (count($data['projects'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-300 border-b border-emerald-900/40 pb-1 mb-4"># 04. side_projects()</h2>
                <div class="space-y-4">
                    @foreach ($data['projects'] as $proj)
                        <div class="p-4 bg-slate-900 border border-emerald-900/20 rounded-lg">
                            <h3 class="font-medium text-emerald-100 text-sm flex items-center justify-between">
                                &gt; {{ $proj['title'] ?? 'Project Title' }}
                                @if ($proj['link'] ?? '')
                                    <a href="{{ $proj['link'] }}" target="_blank" class="text-emerald-500 hover:text-emerald-300 transition text-xs underline">[{ $proj['link'] }]</a>
                                @endif
                            </h3>
                            @if ($proj['description'] ?? '')
                                <p class="text-slate-400 text-xs mt-1.5 leading-relaxed font-light">{{ $proj['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Skills -->
        @if (count($data['skills'] ?? []) > 0)
            <section class="mb-6">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-300 border-b border-emerald-900/40 pb-1 mb-3"># 05. tech_stack()</h2>
                <div class="flex flex-wrap gap-2 text-emerald-400 text-xs font-medium">
                    @foreach ($data['skills'] as $skill)
                        <span class="px-2 py-1 bg-emerald-950/20 border border-emerald-800/30 rounded">[{{ $skill }}]</span>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endif
