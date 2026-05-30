@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .minimal-container { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1c1917; line-height: 1.4; font-size: 10pt; }
        .minimal-header { text-align: center; border-bottom: 1px solid #e7e5e4; padding-bottom: 20px; margin-bottom: 20px; }
        .minimal-name { font-size: 24pt; font-weight: bold; color: #1c1917; margin: 0; letter-spacing: -0.5px; }
        .minimal-title { font-size: 12pt; color: #78716c; font-weight: normal; margin-top: 4px; text-transform: uppercase; letter-spacing: 1px; }
        .minimal-contact { font-size: 8.5pt; color: #78716c; margin-top: 8px; }
        .minimal-section-title { font-size: 11pt; font-weight: bold; text-transform: uppercase; color: #1c1917; border-bottom: 1px solid #e7e5e4; padding-bottom: 3px; margin-top: 20px; margin-bottom: 10px; letter-spacing: 1px; }
        .minimal-job { margin-bottom: 12px; }
        .minimal-job-header { font-weight: bold; color: #1c1917; font-size: 10.5pt; }
        .minimal-job-meta { color: #78716c; font-size: 9pt; margin-bottom: 3px; }
        .minimal-desc { font-size: 9pt; color: #44403c; margin: 0; white-space: pre-line; }
        .minimal-skill { display: inline-block; color: #1c1917; margin-right: 15px; margin-bottom: 5px; font-size: 9.5pt; font-weight: bold; }
    </style>
    <div class="minimal-container">
        <div class="minimal-header">
            <h1 class="minimal-name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <div class="minimal-title">{{ $resume->job_role }}</div>
            @endif
            <div class="minimal-contact">
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
            <div class="minimal-section-title">Summary</div>
            <p class="minimal-desc" style="font-size: 9.5pt; line-height: 1.5;">{{ $data['summary'] }}</p>
        @endif

        @if (count($data['experience'] ?? []) > 0)
            <div class="minimal-section-title">Experience</div>
            @foreach ($data['experience'] as $job)
                <div class="minimal-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="minimal-job-header" style="text-align: left;">{{ $job['position'] ?? 'Position' }}</td>
                            <td style="text-align: right; font-size: 9pt; color: #78716c;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="minimal-job-meta">{{ $job['company'] ?? 'Company' }}</td>
                        </tr>
                    </table>
                    @if ($job['description'] ?? '')
                        <p class="minimal-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['education'] ?? []) > 0)
            <div class="minimal-section-title">Education</div>
            @foreach ($data['education'] as $school)
                <div class="minimal-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="minimal-job-header" style="text-align: left;">{{ $school['school'] ?? 'School' }}</td>
                            <td style="text-align: right; font-size: 9pt; color: #78716c;">{{ $school['year'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="minimal-job-meta">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif

        @if (count($data['projects'] ?? []) > 0)
            <div class="minimal-section-title">Projects</div>
            @foreach ($data['projects'] as $proj)
                <div class="minimal-job">
                    <div class="minimal-job-header">
                        {{ $proj['title'] ?? 'Project Title' }}
                        @if ($proj['link'] ?? '')
                            <span style="font-size: 8.5pt; font-weight: normal; color: #78716c;">({{ $proj['link'] }})</span>
                        @endif
                    </div>
                    @if ($proj['description'] ?? '')
                        <p class="minimal-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                    @endif
                </div>
            @endforeach
        @endif

        @if (count($data['skills'] ?? []) > 0)
            <div class="minimal-section-title">Skills</div>
            <div style="margin-top: 5px;">
                @foreach ($data['skills'] as $skill)
                    <span class="minimal-skill">&bull;&nbsp;{{ $skill }}</span>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="p-8 md:p-12 text-stone-800 font-sans max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-stone-100">
        <!-- Header -->
        <div class="text-center border-b border-stone-200 pb-8 mb-8">
            <h1 class="text-3xl md:text-5xl font-light text-stone-900 tracking-tight">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <p class="text-xs md:text-sm font-semibold text-stone-500 uppercase tracking-widest mt-2">{{ $resume->job_role }}</p>
            @endif
            <div class="flex flex-wrap justify-center gap-x-4 gap-y-1 text-stone-500 text-xs md:text-sm mt-4 font-normal">
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
                    <a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="hover:text-stone-900 transition underline">&bull; Portfolio</a>
                @endif
            </div>
        </div>

        <!-- Summary -->
        @if ($data['summary'] ?? '')
            <section class="mb-8">
                <h2 class="text-xs font-bold text-stone-900 uppercase tracking-widest border-b border-stone-200 pb-1 mb-3">Summary</h2>
                <p class="text-stone-600 leading-relaxed text-sm md:text-base font-light">{{ $data['summary'] }}</p>
            </section>
        @endif

        <!-- Experience -->
        @if (count($data['experience'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold text-stone-900 uppercase tracking-widest border-b border-stone-200 pb-1 mb-4">Experience</h2>
                <div class="space-y-6">
                    @foreach ($data['experience'] as $job)
                        <div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between font-medium text-stone-800 text-sm md:text-base">
                                <h3>{{ $job['position'] ?? 'Position' }}</h3>
                                <span class="font-light text-stone-500 text-xs md:text-sm">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                            </div>
                            <div class="text-stone-500 text-xs font-medium uppercase tracking-wider">{{ $job['company'] ?? 'Company' }}</div>
                            @if ($job['description'] ?? '')
                                <p class="text-stone-600 text-sm mt-2 leading-relaxed whitespace-pre-line font-light">{{ $job['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Education -->
        @if (count($data['education'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold text-stone-900 uppercase tracking-widest border-b border-stone-200 pb-1 mb-4">Education</h2>
                <div class="space-y-4">
                    @foreach ($data['education'] as $school)
                        <div>
                            <div class="flex justify-between font-medium text-stone-800 text-sm md:text-base">
                                <h3>{{ $school['school'] ?? 'School' }}</h3>
                                <span class="font-light text-stone-500 text-xs md:text-sm">{{ $school['year'] ?? '' }}</span>
                            </div>
                            <p class="text-stone-500 text-xs font-light">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects -->
        @if (count($data['projects'] ?? []) > 0)
            <section class="mb-8">
                <h2 class="text-xs font-bold text-stone-900 uppercase tracking-widest border-b border-stone-200 pb-1 mb-4">Projects</h2>
                <div class="space-y-4">
                    @foreach ($data['projects'] as $proj)
                        <div>
                            <h3 class="font-medium text-stone-800 text-sm md:text-base flex items-center justify-between">
                                {{ $proj['title'] ?? 'Project Title' }}
                                @if ($proj['link'] ?? '')
                                    <a href="{{ $proj['link'] }}" target="_blank" class="hover:text-stone-900 transition text-xs font-light underline">Link ↗</a>
                                @endif
                            </h3>
                            @if ($proj['description'] ?? '')
                                <p class="text-stone-600 text-sm mt-1.5 leading-relaxed font-light">{{ $proj['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Skills -->
        @if (count($data['skills'] ?? []) > 0)
            <section class="mb-6">
                <h2 class="text-xs font-bold text-stone-900 uppercase tracking-widest border-b border-stone-200 pb-1 mb-3">Skills</h2>
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-stone-700 text-sm font-medium">
                    @foreach ($data['skills'] as $skill)
                        <span>&bull;&nbsp;{{ $skill }}</span>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endif
