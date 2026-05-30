<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #1f2937;
            margin: 0;
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .header {
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .name {
            font-size: 24pt;
            font-weight: bold;
            color: #111827;
            margin: 0 0 5px 0;
        }

        .contact-info {
            font-size: 9pt;
            color: #4b5563;
        }

        .section-title {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1e3a8a;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 3px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .item {
            margin-bottom: 12px;
        }

        .item-header {
            font-weight: bold;
            color: #111827;
        }

        .item-meta {
            font-size: 9.5pt;
            color: #4b5563;
            font-style: italic;
            margin-bottom: 4px;
        }

        .description {
            font-size: 10pt;
            color: #374151;
            margin: 0;
            white-space: pre-line;
        }

        .skills-container {
            font-size: 10pt;
            color: #374151;
            font-weight: 500;
        }

        .row {
            width: 100%;
            display: block;
            clear: both;
        }

        .col-left {
            float: left;
            width: 70%;
        }

        .col-right {
            float: right;
            width: 30%;
            text-align: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header text-center">
        <h1 class="name">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
        <div class="contact-info">
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

    <!-- Summary Section -->
    @if ($data['summary'] ?? '')
        <div class="section-title">Professional Summary</div>
        <p class="description">{{ $data['summary'] }}</p>
    @endif

    <!-- Work Experience Section -->
    @if (count($data['experience'] ?? []) > 0)
        <div class="section-title">Work Experience</div>
        @foreach ($data['experience'] as $exp)
            <div class="item">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="item-header" style="text-align: left; font-size: 11pt;">{{ $exp['position'] ?? 'Position' }}</td>
                        <td style="text-align: right; font-size: 9.5pt; color: #4b5563;">{{ $exp['startDate'] ?? '' }} - {{ $exp['endDate'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="item-meta" style="text-align: left; padding-top: 2px;">{{ $exp['company'] ?? 'Company' }}</td>
                    </tr>
                </table>
                @if ($exp['description'] ?? '')
                    <p class="description" style="margin-top: 5px;">{{ $exp['description'] }}</p>
                @endif
            </div>
        @endforeach
    @endif

    <!-- Education Section -->
    @if (count($data['education'] ?? []) > 0)
        <div class="section-title">Education</div>
        @foreach ($data['education'] as $edu)
            <div class="item">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="item-header" style="text-align: left; font-size: 11pt;">{{ $edu['school'] ?? 'School' }}</td>
                        <td style="text-align: right; font-size: 9.5pt; color: #4b5563;">{{ $edu['year'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="item-meta" style="text-align: left; padding-top: 2px;">{{ $edu['degree'] ?? '' }} in {{ $edu['field'] ?? '' }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    @endif

    <!-- Projects Section -->
    @if (count($data['projects'] ?? []) > 0)
        <div class="section-title">Featured Projects</div>
        @foreach ($data['projects'] as $proj)
            <div class="item">
                <div class="item-header">
                    {{ $proj['title'] ?? 'Project Title' }}
                    @if ($proj['link'] ?? '')
                        <span style="font-size: 8.5pt; font-weight: normal; color: #3b82f6;">({{ $proj['link'] }})</span>
                    @endif
                </div>
                @if ($proj['description'] ?? '')
                    <p class="description" style="margin-top: 3px;">{{ $proj['description'] }}</p>
                @endif
            </div>
        @endforeach
    @endif

    <!-- Skills Section -->
    @if (count($data['skills'] ?? []) > 0)
        <div class="section-title">Core Skills</div>
        <div class="skills-container">
            {{ implode(' • ', $data['skills']) }}
        </div>
    @endif

    <!-- Languages Section -->
    @if (count($data['languages'] ?? []) > 0)
        <div class="section-title">Languages</div>
        <div class="skills-container">
            {{ implode(', ', $data['languages']) }}
        </div>
    @endif

</body>
</html>
