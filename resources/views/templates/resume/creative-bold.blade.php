@php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
@endphp

@if ($isPdf)
    <!-- PDF Layout (Dompdf Friendly) -->
    <style>
        .creative-container { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #0f172a; line-height: 1.4; font-size: 10pt; }
        .creative-header { background-color: #f43f5e; color: white; padding: 25px; margin-bottom: 25px; border-radius: 8px; }
        .creative-name { font-size: 26pt; font-weight: bold; color: white; margin: 0; }
        .creative-title { font-size: 13pt; color: #ffe4e6; font-weight: bold; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .creative-contact { font-size: 9.5pt; color: #ffe4e6; margin-top: 10px; }
        
        .creative-left-col { float: left; width: 32%; background-color: #f8fafc; padding: 15px; border-radius: 6px; min-height: 500px; }
        .creative-right-col { float: right; width: 63%; }
        .creative-sidebar-title { font-size: 11pt; font-weight: bold; text-transform: uppercase; color: #f43f5e; margin-bottom: 10px; margin-top: 15px; padding-bottom: 3px; border-bottom: 2px solid #e2e8f0; }
        .creative-main-title { font-size: 13pt; font-weight: bold; text-transform: uppercase; color: #0f172a; border-left: 4px solid #f43f5e; padding-left: 8px; margin-top: 20px; margin-bottom: 12px; }
        
        .creative-job { margin-bottom: 12px; }
        .creative-job-header { font-weight: bold; color: #0f172a; font-size: 10.5pt; }
        .creative-job-meta { color: #f43f5e; font-size: 9pt; font-weight: bold; margin-bottom: 3px; }
        .creative-desc { font-size: 9pt; color: #334155; margin: 0; white-space: pre-line; }
        
        .creative-skill-tag { display: inline-block; background-color: #ffe4e6; color: #be123c; padding: 4px 8px; border-radius: 4px; margin-right: 5px; margin-bottom: 5px; font-size: 8.5pt; font-weight: bold; }
        
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
    <div class="creative-container">
        <div class="creative-header">
            <h1 class="creative-name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <div class="creative-title">{{ $resume->job_role }}</div>
            @endif
            <div class="creative-contact">
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
                    &nbsp;|&nbsp; {{ $data['personalInfo']['website'] }}
                @endif
            </div>
        </div>

        <div class="clearfix">
            <!-- Sidebar (Left) -->
            <div class="creative-left-col">
                <div class="creative-sidebar-title" style="margin-top: 0;">Contact Details</div>
                <div style="font-size: 9pt; color: #475569; line-height: 1.6;">
                    @if ($data['personalInfo']['email'] ?? '')
                        <strong>Email:</strong><br>{{ $data['personalInfo']['email'] }}<br><br>
                    @endif
                    @if ($data['personalInfo']['phone'] ?? '')
                        <strong>Phone:</strong><br>{{ $data['personalInfo']['phone'] }}<br><br>
                    @endif
                    @if ($data['personalInfo']['location'] ?? '')
                        <strong>Location:</strong><br>{{ $data['personalInfo']['location'] }}<br><br>
                    @endif
                    @if ($data['personalInfo']['website'] ?? '')
                        <strong>Website:</strong><br><span style="color: #be123c;">{{ $data['personalInfo']['website'] }}</span>
                    @endif
                </div>

                @if (count($data['skills'] ?? []) > 0)
                    <div class="creative-sidebar-title">Core Skills</div>
                    <div style="margin-top: 5px;">
                        @foreach ($data['skills'] as $skill)
                            <span class="creative-skill-tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                @endif

                @if (count($data['languages'] ?? []) > 0)
                    <div class="creative-sidebar-title">Languages</div>
                    <div style="font-size: 9pt; color: #475569; font-weight: bold; line-height: 1.6;">
                        {{ implode(', ', $data['languages']) }}
                    </div>
                @endif
            </div>

            <!-- Main Content (Right) -->
            <div class="creative-right-col">
                @if ($data['summary'] ?? '')
                    <div class="creative-main-title" style="margin-top: 0;">About Me</div>
                    <p class="creative-desc" style="font-size: 9.5pt; line-height: 1.5; margin-bottom: 15px;">{{ $data['summary'] }}</p>
                @endif

                @if (count($data['experience'] ?? []) > 0)
                    <div class="creative-main-title">Experience</div>
                    @foreach ($data['experience'] as $job)
                        <div class="creative-job">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td class="creative-job-header" style="text-align: left;">{{ $job['position'] ?? 'Position' }}</td>
                                    <td style="text-align: right; font-size: 9pt; color: #64748b;">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="creative-job-meta">{{ $job['company'] ?? 'Company' }}</td>
                                </tr>
                            </table>
                            @if ($job['description'] ?? '')
                                <p class="creative-desc" style="margin-top: 4px;">{{ $job['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                @endif

                @if (count($data['education'] ?? []) > 0)
                    <div class="creative-main-title">Education</div>
                    @foreach ($data['education'] as $school)
                        <div class="creative-job">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td class="creative-job-header" style="text-align: left;">{{ $school['school'] ?? 'School' }}</td>
                                    <td style="text-align: right; font-size: 9pt; color: #64748b;">{{ $school['year'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="creative-job-meta" style="color: #64748b;">{{ $school['degree'] ?? '' }} in {{ $school['field'] ?? '' }}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @endif

                @if (count($data['projects'] ?? []) > 0)
                    <div class="creative-main-title">Projects</div>
                    @foreach ($data['projects'] as $proj)
                        <div class="creative-job">
                            <div class="creative-job-header">
                                {{ $proj['title'] ?? 'Project Title' }}
                                @if ($proj['link'] ?? '')
                                    <span style="font-size: 8.5pt; font-weight: normal; color: #be123c;">({{ $proj['link'] }})</span>
                                @endif
                            </div>
                            @if ($proj['description'] ?? '')
                                <p class="creative-desc" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@else
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="text-slate-800 font-sans max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-rose-500 text-white p-8 md:p-12">
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
            @if ($resume->job_role)
                <p class="text-lg font-bold text-rose-100 uppercase tracking-widest mt-2">{{ $resume->job_role }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12">
            <!-- Sidebar (Left) -->
            <div class="md:col-span-4 bg-slate-50 p-8 border-r border-slate-100 space-y-8">
                <!-- Contact Details -->
                <div>
                    <h3 class="text-sm font-bold text-rose-600 uppercase tracking-wider mb-3 pb-1 border-b border-slate-200">Contact</h3>
                    <ul class="space-y-3.5 text-sm text-slate-600">
                        @if ($data['personalInfo']['email'] ?? '')
                            <li class="break-all"><strong class="block text-xs text-slate-400 font-medium">Email</strong>{{ $data['personalInfo']['email'] }}</li>
                        @endif
                        @if ($data['personalInfo']['phone'] ?? '')
                            <li><strong class="block text-xs text-slate-400 font-medium">Phone</strong>{{ $data['personalInfo']['phone'] }}</li>
                        @endif
                        @if ($data['personalInfo']['location'] ?? '')
                            <li><strong class="block text-xs text-slate-400 font-medium">Location</strong>{{ $data['personalInfo']['location'] }}</li>
                        @endif
                        @if ($data['personalInfo']['website'] ?? '')
                            <li><strong class="block text-xs text-slate-400 font-medium">Website</strong><a href="{{ $data['personalInfo']['website'] }}" target="_blank" class="text-rose-600 hover:underline break-all">{{ $data['personalInfo']['website'] }}</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Skills -->
                @if (count($data['skills'] ?? []) > 0)
                    <div>
                        <h3 class="text-sm font-bold text-rose-600 uppercase tracking-wider mb-3.5 pb-1 border-b border-slate-200">Skills</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($data['skills'] as $skill)
                                <span class="px-2.5 py-1 bg-rose-50 text-rose-700 rounded-lg text-xs font-semibold">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Languages -->
                @if (count($data['languages'] ?? []) > 0)
                    <div>
                        <h3 class="text-sm font-bold text-rose-600 uppercase tracking-wider mb-3 pb-1 border-b border-slate-200">Languages</h3>
                        <p class="text-sm text-slate-600 font-semibold leading-relaxed">{{ implode(', ', $data['languages']) }}</p>
                    </div>
                @endif
            </div>

            <!-- Main Content (Right) -->
            <div class="md:col-span-8 p-8 md:p-10 space-y-8">
                <!-- About Me -->
                @if ($data['summary'] ?? '')
                    <section>
                        <h2 class="text-lg font-bold text-slate-900 border-l-4 border-rose-500 pl-3 mb-3 uppercase tracking-wide text-xs">About Me</h2>
                        <p class="text-slate-600 leading-relaxed text-sm md:text-base">{{ $data['summary'] }}</p>
                    </section>
                @endif

                <!-- Experience -->
                @if (count($data['experience'] ?? []) > 0)
                    <section>
                        <h2 class="text-lg font-bold text-slate-900 border-l-4 border-rose-500 pl-3 mb-4 uppercase tracking-wide text-xs">Experience</h2>
                        <div class="space-y-6">
                            @foreach ($data['experience'] as $job)
                                <div>
                                    <div class="flex flex-col md:flex-row md:items-center justify-between font-bold text-slate-800 text-sm md:text-base">
                                        <h3>{{ $job['position'] ?? 'Position' }}</h3>
                                        <span class="font-normal text-slate-500 text-xs md:text-sm">{{ $job['startDate'] ?? '' }} - {{ $job['endDate'] ?? '' }}</span>
                                    </div>
                                    <div class="text-rose-600 font-bold text-xs uppercase tracking-wider mt-0.5">{{ $job['company'] ?? 'Company' }}</div>
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
                        <h2 class="text-lg font-bold text-slate-900 border-l-4 border-rose-500 pl-3 mb-4 uppercase tracking-wide text-xs">Education</h2>
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
                        <h2 class="text-lg font-bold text-slate-900 border-l-4 border-rose-500 pl-3 mb-4 uppercase tracking-wide text-xs">Featured Projects</h2>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($data['projects'] as $proj)
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                    <h3 class="font-bold text-slate-900 text-sm flex items-center justify-between">
                                        {{ $proj['title'] ?? 'Project Title' }}
                                        @if ($proj['link'] ?? '')
                                            <a href="{{ $proj['link'] }}" target="_blank" class="text-rose-600 hover:underline text-xs font-normal">Link ↗</a>
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
            </div>
        </div>
    </div>
@endif
