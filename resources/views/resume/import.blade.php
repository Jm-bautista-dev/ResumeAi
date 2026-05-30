@extends('layouts.app')

@section('title', 'Import Resume - AI Resume Builder')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-100 py-16 px-6">
    <div class="max-w-xl mx-auto">
        <a href="{{ route('resume.templates') }}" class="text-slate-400 hover:text-white transition inline-block mb-6">&larr; Back to Templates</a>

        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white mb-3">AI-Powered Resume Import</h1>
            <p class="text-slate-400 text-sm font-light leading-relaxed">
                Upload your existing PDF or plain text resume. Our custom AI parser will extract all your experience, education, skills, and projects in seconds.
            </p>
        </div>

        <form action="{{ route('resume.import.store') }}" method="POST" enctype="multipart/form-data" id="import-form" class="space-y-6">
            @csrf
            
            <div id="drop-zone" class="border-2 border-dashed border-slate-800 hover:border-blue-500 rounded-3xl p-10 text-center cursor-pointer transition bg-slate-900/10 hover:bg-slate-900/30 group relative">
                <input type="file" id="resume_file" name="resume_file" accept=".txt,.pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                
                <div class="space-y-4 pointer-events-none">
                    <div class="text-5xl group-hover:scale-110 transition duration-300">📥</div>
                    <h3 class="text-lg font-bold text-white">Drag & drop your resume file here</h3>
                    <p class="text-slate-400 text-xs font-light">or click to browse your local computer files</p>
                    <div class="flex justify-center gap-2 pt-2">
                        <span class="text-[10px] px-2 py-0.5 bg-slate-800 rounded text-slate-400 font-bold uppercase font-mono">PDF</span>
                        <span class="text-[10px] px-2 py-0.5 bg-slate-800 rounded text-slate-400 font-bold uppercase font-mono">TXT</span>
                    </div>
                </div>
            </div>

            <!-- Selected File Indicator -->
            <div id="file-indicator" class="hidden p-4 bg-slate-900 border border-slate-800 rounded-2xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">📄</span>
                    <div>
                        <p id="file-name" class="text-sm font-bold text-white"></p>
                        <p id="file-size" class="text-[10px] text-slate-500"></p>
                    </div>
                </div>
                <button type="button" onclick="clearFile()" class="text-xs text-rose-400 hover:text-rose-300 font-semibold">Remove</button>
            </div>

            <!-- Loader / Processing State -->
            <div id="loading-state" class="hidden p-8 border border-slate-850 rounded-3xl bg-slate-900/40 text-center space-y-4">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
                <h3 class="text-lg font-bold text-white">Analyzing & Parsing Resume...</h3>
                <p class="text-slate-400 text-xs font-light">We are extracting skills, structuring experience blocks, and organizing formatting details. Please hold on.</p>
            </div>

            <button type="submit" id="submit-btn" class="w-full py-4 bg-gradient-to-r from-blue-500 via-indigo-500 to-rose-500 text-white font-bold rounded-2xl hover:opacity-95 active:scale-[0.99] transition shadow-lg shadow-blue-500/10 flex items-center justify-center gap-2">
                <span>⚡</span> Run AI Parser &rarr;
            </button>
        </form>
    </div>
</div>

<script>
const fileInput = document.getElementById('resume_file');
const dropZone = document.getElementById('drop-zone');
const fileIndicator = document.getElementById('file-indicator');
const fileName = document.getElementById('file-name');
const fileSize = document.getElementById('file-size');
const importForm = document.getElementById('import-form');
const submitBtn = document.getElementById('submit-btn');
const loadingState = document.getElementById('loading-state');

fileInput.addEventListener('change', handleFile);

function handleFile() {
    const file = fileInput.files[0];
    if (file) {
        fileName.textContent = file.name;
        fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
        dropZone.classList.add('hidden');
        fileIndicator.classList.remove('hidden');
    }
}

function clearFile() {
    fileInput.value = '';
    dropZone.classList.remove('hidden');
    fileIndicator.classList.add('hidden');
}

importForm.addEventListener('submit', () => {
    submitBtn.classList.add('hidden');
    fileIndicator.classList.add('hidden');
    loadingState.classList.remove('hidden');
});
</script>
@endsection
