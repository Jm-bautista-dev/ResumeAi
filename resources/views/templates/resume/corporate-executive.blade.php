@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .exec-container { font-family: Georgia, serif; color: #1e293b; line-height: 1.6; font-size: 10pt; }
        .exec-header { text-align: center; border-bottom: 2px double #0f172a; padding-bottom: 15px; margin-bottom: 25px; }
        .exec-name { font-size: 26pt; font-weight: bold; color: #0f172a; margin: 0; font-family: Georgia, serif; }
        .exec-title { font-size: 11pt; color: #475569; font-weight: normal; margin-top: 5px; text-transform: uppercase; letter-spacing: 2px; }
        .exec-contact { font-size: 8.5pt; color: #475569; margin-top: 8px; font-family: Arial, sans-serif; }
        .exec-section-title { font-size: 12pt; font-weight: bold; text-transform: uppercase; color: #0f172a; border-bottom: 1px solid #94a3b8; padding-bottom: 3px; margin-top: 25px; margin-bottom: 12px; letter-spacing: 1px; }
        .exec-job { margin-bottom: 15px; }
        .exec-job-header { font-weight: bold; color: #0f172a; font-size: 10.5pt; }
        .exec-job-meta { color: #475569; font-size: 9.5pt; font-style: italic; margin-bottom: 4px; }
        .exec-desc { font-size: 9.5pt; color: #334155; margin: 0; white-space: pre-line; text-align: justify; }
        .exec-skill { display: inline-block; color: #0f172a; margin-right: 15px; margin-bottom: 5px; font-size: 9.5pt; font-family: Arial, sans-serif; }
    </style>
    <div class="exec-container">
        <div class="exec-header">
            <h1 class="exec-name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <div class="exec-title">{{ $resume->job_role }}</div>
            @endif
            <div class="exec-contact">
                @if ($data['personalInfo']['email'] ?? '')
                    {{ $data['personalInfo']['email'] }}
                @endif
                @if ($data['personalInfo']['phone'] ?? '')
                    &nbsp;&bull;&nbsp; {{ $data['personalInfo']['phone'] }}
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    &nbsp;&bull;&nbsp; {{ $data['personalInfo']['location'] }}
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    &nbsp;&bull;&nbsp; {{ $data['personalInfo']['website'] }}
                @endif
            </div>
        </div>

        @if ($data['summary'] ?? '')
            <div class="exec-section-title">Executive Summary</div>
            <p class="exec-desc" style="line-height: 1.6;">{{ $data['summary'] }}</p>
        @endif

        @if (count($data['experience'] ?? []) > 0)
            <div class="exec-section-title">Professional Experience</div>
            @foreach ($data['experience'] as $job)
                <div class="exec-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="exec-job-header" style="text-align: left;">{{ $job['position'] ?? 'Position' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #475569; font-family: Arial, sans-serif;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="exec-job-meta">{{ $job['company'] ?? 'Company' }}</td>
                        </tr>
                    </table>
                    @if ($job['description'] ?? '')
                        <p class="exec-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['education'] ?? []) > 0)
            <div class="exec-section-title">Education & Credentials</div>
            @foreach ($data['education'] as $school)
                <div class="exec-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="exec-job-header" style="text-align: left;">{{ $school['school'] ?? 'School' }}</td>
                            <td style="text-align: right; font-size: 9.5pt; color: #475569; font-family: Arial, sans-serif;">{{ $school['year'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="exec-job-meta" style="color: #475569;">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif

        @if (count($data['projects'] ?? []) > 0)
            <div class="exec-section-title">Key Initiatives & Projects</div>
            @foreach ($data['projects'] as $proj)
                <div class="exec-job">
                    <div class="exec-job-header">
                        {{ $proj['title'] ?? 'Project Title' }}
                        @if ($proj['link'] ?? '')
                            <span style="font-size: 8.5pt; font-weight: normal; color: #475569; font-family: Arial, sans-serif;">({{ $proj['link'] }})</span>
                        @endif
                    </div>
                    @if ($proj['description'] ?? '')
                        <p class="exec-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['skills'] ?? []) > 0)
            <div class="exec-section-title">Core Competencies</div>
            <div style="margin-top: 5px;">
                @foreach ($data['skills'] as $skill)
                    <span class="exec-skill">&bull;&nbsp;{{ $skill }}</span>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="p-8 md:p-12 text-slate-800 font-serif max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-slate-100">
        <!-- Header -->
        <div class="text-center border-b-2 border-double border-slate-900 pb-8 mb-8">
            <h1 class="text-3xl md:text-5xl font-bold text-slate-950 tracking-tight">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <p class="text-sm md:text-base font-semibold text-slate-500 uppercase tracking-widest mt-3">{{ $resume->job_role }}</p>
            @endif
            <div class="flex flex-wrap justify-center gap-x-4 gap-y-1 text-slate-500 text-xs md:text-sm mt-4 font-sans font-medium">
                @if ($data['personalInfo']['email'] ?? '')
                    <span>{{ $data['personalInfo']['email'] }}</span>
                @endif
                @if ($data['personalInfo']['phone'] ?? '')
                    <span>&bull; {{ $data['personalInfo']['phone'] }}</span>
                @endif
                @if ($data['personalInfo']['location'] ?? '')
                    <span>&bull; {{ $data['personalInfo']['location'] }}</span>
                @endif
                @if ($data['personalInfo']['website'] ?? '')
                    <a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="hover:text-slate-900 transition underline">&bull; Portfolio</a>
                @endif
            </div>
        </div>

        <!-- Summary -->
        @if ($data['summary'] ?? '')
            <section class="mb-8">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-300 pb-1 mb-3 uppercase tracking-wider">Executive Summary</h2>
                <p class="text-slate-600 leading-relaxed text-sm md:text-base font-light text-justify">{{ $data['summary'] }}</p>
            </section>
        @endif

        <!-- Experience -->
        @if (count($data['experience'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-300 pb-1 mb-4 uppercase tracking-wider">Professional Experience</h2>
                <div class="space-y-6">
                    @foreach ($data['experience'] as $job)
                        <div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between font-bold text-slate-800 text-sm md:text-base">
                                <h3>{{ $job['position'] ?? 'Position' }}</h3>
                                <span class="font-normal text-slate-500 text-xs md:text-sm font-sans">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                            </div>
                            <div class="text-slate-500 text-xs font-semibold uppercase tracking-wider mt-0.5 font-sans">{{ $job['company'] ?? 'Company' }}</div>
                            @if ($job['description'] ?? '')
                                <p class="text-slate-600 text-sm mt-2 leading-relaxed whitespace-pre-line font-light text-justify">{{ $job['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Education -->
        @if (count($data['education'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-300 pb-1 mb-4 uppercase tracking-wider">Education & Credentials</h2>
                <div class="space-y-4">
                    @foreach ($data['education'] as $school)
                        <div>
                            <div class="flex justify-between font-bold text-slate-800 text-sm md:text-base">
                                <h3>{{ $school['school'] ?? 'School' }}</h3>
                                <span class="font-normal text-slate-500 text-xs md:text-sm font-sans">{{ $school['year'] ?? '' }}</span>
                            </div>
                            <p class="text-slate-500 text-xs mt-0.5 font-sans font-light">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects -->
        @if (count($data['projects'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-300 pb-1 mb-4 uppercase tracking-wider">Key Initiatives & Projects</h2>
                <div class="space-y-4">
                    @foreach ($data['projects'] as $proj)
                        <div>
                            <h3 class="font-bold text-slate-800 text-sm md:text-base flex items-center justify-between">
                                {{ $proj['title'] ?? 'Project Title' }}
                                @if ($proj['link'] ?? '')
                                    <a href="{{ $proj['link'] }}" target="_blank" class="hover:text-slate-900 transition text-xs font-light underline font-sans">Link ↗</a>
                                @endif
                            </h3>
                            @if ($proj['description'] ?? '')
                                <p class="text-slate-600 text-sm mt-1.5 leading-relaxed font-light text-justify">{{ $proj['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Skills -->
        @if (count($data['skills'] ?? []) > 0)
            <section class="mb-6">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-300 pb-1 mb-3 uppercase tracking-wider">Core Competencies</h2>
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-slate-700 text-sm font-medium font-sans">
                    @foreach ($data['skills'] as $skill)
                        <span>&bull;&nbsp;{{ $skill }}</span>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endif
