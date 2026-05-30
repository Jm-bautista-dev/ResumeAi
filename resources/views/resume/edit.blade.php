@extends('layouts.app')

@section('title', 'Edit Resume - ' . $resume->title)

@section('content')
<script>
    window.initialResumeContent = @json($resume->content);
</script>

<div class="min-h-screen bg-slate-950 text-slate-100" 
     x-data="resumeBuilder({{ $resume->id }}, window.initialResumeContent, '{{ addslashes($resume->title) }}')">
    
    <!-- Top Control Bar -->
    <div class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-[73px] z-30 px-6 py-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4 w-full md:w-auto">
                <a href="{{ route('resume.index') }}" class="text-slate-400 hover:text-white transition">
                    &larr; Back
                </a>
                <input type="text" x-model="title" 
                       class="text-xl font-bold bg-transparent border-b border-transparent hover:border-slate-700 focus:border-blue-500 focus:outline-none px-2 py-1 w-full md:w-80 text-white">
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <span x-show="saving" x-transition class="text-xs text-slate-400">Saving...</span>
                <span x-show="!saving && lastSaved" x-transition class="text-xs text-slate-500">Last saved <span x-text="lastSaved"></span></span>
                
                <button @click="saveResume()" 
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-lg shadow-blue-500/20">
                    Save Changes
                </button>
                <a href="{{ route('resume.export-pdf', $resume) }}" 
                   class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition shadow-lg shadow-emerald-500/20">
                    Export PDF
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- EDITOR PANEL (Left) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Vertical Section Tabs -->
                <div class="flex flex-wrap gap-2 p-1.5 bg-slate-900 border border-slate-800 rounded-2xl overflow-x-auto">
                    <template x-for="tab in tabs" :key="tab.id">
                        <button @click="activeTab = tab.id"
                                :class="activeTab === tab.id ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800'"
                                class="px-4 py-2 rounded-xl text-sm font-semibold transition whitespace-nowrap"
                                x-text="tab.name">
                        </button>
                    </template>
                </div>

                <!-- FORM CONTROLS CONTAINER -->
                <div class="bg-slate-900/40 border border-slate-800 backdrop-blur-md p-6 rounded-2xl space-y-6">
                    
                    <!-- 1. PERSONAL INFO TAB -->
                    <div x-show="activeTab === 'personal'" class="space-y-6" x-transition>
                        <h2 class="text-xl font-bold text-slate-100 border-b border-slate-800 pb-3">Personal Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text" x-model="content.personalInfo.fullName" class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                                <input type="email" x-model="content.personalInfo.email" class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Phone Number</label>
                                <input type="text" x-model="content.personalInfo.phone" class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Location</label>
                                <input type="text" x-model="content.personalInfo.location" class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Portfolio/Website URL</label>
                                <input type="url" x-model="content.personalInfo.website" class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- 2. SUMMARY TAB -->
                    <div x-show="activeTab === 'summary'" class="space-y-6" x-transition>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                            <h2 class="text-xl font-bold text-slate-100">Professional Summary</h2>
                            <button @click="generateAISummary()" :disabled="aiLoading"
                                    class="px-3.5 py-1.5 bg-purple-600 hover:bg-purple-700 disabled:bg-purple-800/40 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1.5 shadow-lg shadow-purple-500/10">
                                <span x-show="aiLoading" class="animate-spin mr-1">⌛</span>
                                <span x-show="!aiLoading">✨ AI Generate Summary</span>
                                <span x-show="aiLoading">Generating...</span>
                            </button>
                        </div>
                        <div>
                            <textarea x-model="content.summary" rows="6" placeholder="Write a short summary of your background, career path, and primary goals..." 
                                      class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-slate-500"></textarea>
                        </div>
                    </div>

                    <!-- 3. SKILLS TAB -->
                    <div x-show="activeTab === 'skills'" class="space-y-6" x-transition>
                        <h2 class="text-xl font-bold text-slate-100 border-b border-slate-800 pb-3">Skills</h2>
                        <div class="flex gap-2">
                            <input type="text" x-model="newSkill" @keydown.enter.prevent="addSkill()" placeholder="e.g. React, Docker, PHP" 
                                   class="flex-grow px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button @click="addSkill()" class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">
                                Add
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-4">
                            <template x-for="(skill, index) in content.skills" :key="index">
                                <span class="px-3.5 py-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-300 rounded-xl text-sm font-medium flex items-center gap-2">
                                    <span x-text="skill"></span>
                                    <button @click="removeSkill(index)" class="text-blue-400 hover:text-white">&times;</button>
                                </span>
                            </template>
                            <template x-if="content.skills.length === 0">
                                <p class="text-slate-500 text-sm">No skills added yet.</p>
                            </template>
                        </div>
                    </div>

                    <!-- 4. WORK EXPERIENCE TAB -->
                    <div x-show="activeTab === 'experience'" class="space-y-6" x-transition>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                            <h2 class="text-xl font-bold text-slate-100">Work Experience</h2>
                            <button @click="addExperience()" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                + Add Experience
                            </button>
                        </div>

                        <div class="space-y-6">
                            <template x-for="(exp, index) in content.experience" :key="index">
                                <div class="p-5 bg-slate-800/25 border border-slate-800 rounded-xl space-y-4 relative">
                                    <button @click="removeExperience(index)" class="absolute top-4 right-4 text-slate-500 hover:text-rose-400 text-sm transition">
                                        Remove
                                    </button>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Company</label>
                                            <input type="text" x-model="exp.company" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Position</label>
                                            <input type="text" x-model="exp.position" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Start Date</label>
                                            <input type="text" x-model="exp.startDate" placeholder="e.g. Jan 2022" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">End Date</label>
                                            <input type="text" x-model="exp.endDate" placeholder="e.g. Present" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div class="md:col-span-2">
                                            <div class="flex justify-between items-center mb-1">
                                                <label class="block text-xs font-semibold text-slate-400">Description</label>
                                                <button @click="improveDescription(index)" :disabled="aiLoading" 
                                                        class="text-xs text-purple-400 hover:text-purple-300 font-medium transition flex items-center gap-1">
                                                    <span>✨ Improve with AI</span>
                                                </button>
                                            </div>
                                            <textarea x-model="exp.description" rows="3" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="content.experience.length === 0">
                                <p class="text-slate-500 text-sm text-center py-6">No experience added yet.</p>
                            </template>
                        </div>
                    </div>

                    <!-- 5. EDUCATION TAB -->
                    <div x-show="activeTab === 'education'" class="space-y-6" x-transition>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                            <h2 class="text-xl font-bold text-slate-100">Education</h2>
                            <button @click="addEducation()" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                + Add Education
                            </button>
                        </div>

                        <div class="space-y-6">
                            <template x-for="(edu, index) in content.education" :key="index">
                                <div class="p-5 bg-slate-800/25 border border-slate-800 rounded-xl space-y-4 relative">
                                    <button @click="removeEducation(index)" class="absolute top-4 right-4 text-slate-500 hover:text-rose-400 text-sm transition">
                                        Remove
                                    </button>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">School / Institution</label>
                                            <input type="text" x-model="edu.school" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Degree</label>
                                            <input type="text" x-model="edu.degree" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Field of Study</label>
                                            <input type="text" x-model="edu.field" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Year</label>
                                            <input type="text" x-model="edu.year" placeholder="e.g. 2021" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="content.education.length === 0">
                                <p class="text-slate-500 text-sm text-center py-6">No education history added yet.</p>
                            </template>
                        </div>
                    </div>

                    <!-- 6. PROJECTS TAB -->
                    <div x-show="activeTab === 'projects'" class="space-y-6" x-transition>
                        <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                            <h2 class="text-xl font-bold text-slate-100">Projects</h2>
                            <button @click="addProject()" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                + Add Project
                            </button>
                        </div>

                        <div class="space-y-6">
                            <template x-for="(proj, index) in content.projects" :key="index">
                                <div class="p-5 bg-slate-800/25 border border-slate-800 rounded-xl space-y-4 relative">
                                    <button @click="removeProject(index)" class="absolute top-4 right-4 text-slate-500 hover:text-rose-400 text-sm transition">
                                        Remove
                                    </button>

                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Project Name</label>
                                            <input type="text" x-model="proj.title" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Link</label>
                                            <input type="url" x-model="proj.link" placeholder="e.g. github.com/..." class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-400 mb-1">Description</label>
                                            <textarea x-model="proj.description" rows="2" class="w-full px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="!content.projects || content.projects.length === 0">
                                <p class="text-slate-500 text-sm text-center py-6">No projects added yet.</p>
                            </template>
                        </div>
                    </div>

                    <!-- 7. OTHER SECTIONS -->
                    <div x-show="activeTab === 'other'" class="space-y-6" x-transition>
                        <h2 class="text-xl font-bold text-slate-100 border-b border-slate-800 pb-3">Additional Details</h2>
                        
                        <!-- Languages -->
                        <div class="space-y-3">
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Languages (comma separated)</label>
                            <input type="text" x-bind:value="content.languages ? content.languages.join(', ') : ''" 
                                   @input="content.languages = $event.target.value.split(',').map(s => s.trim()).filter(s => s.length > 0)"
                                   placeholder="e.g. English, Spanish, Japanese" 
                                   class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Awards -->
                        <div class="space-y-3 pt-4 border-t border-slate-800">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Awards & Achievements</label>
                                <button @click="addAward()" class="text-xs text-blue-400 hover:text-blue-300 font-semibold">+ Add Award</button>
                            </div>
                            <div class="space-y-3">
                                <template x-for="(award, idx) in content.awards" :key="idx">
                                    <div class="flex gap-2">
                                        <input type="text" x-model="content.awards[idx]" class="flex-grow px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        <button @click="removeAward(idx)" class="text-rose-400 hover:text-rose-300 px-2">&times;</button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Certifications -->
                        <div class="space-y-3 pt-4 border-t border-slate-800">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Certifications</label>
                                <button @click="addCertification()" class="text-xs text-blue-400 hover:text-blue-300 font-semibold">+ Add Cert</button>
                            </div>
                            <div class="space-y-3">
                                <template x-for="(cert, idx) in content.certifications" :key="idx">
                                    <div class="flex gap-2">
                                        <input type="text" x-model="content.certifications[idx]" class="flex-grow px-3 py-2 rounded-lg bg-slate-850 border border-slate-700 text-white text-sm">
                                        <button @click="removeCertification(idx)" class="text-rose-400 hover:text-rose-300 px-2">&times;</button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- LIVE PREVIEW PANEL (Right) -->
            <div class="lg:col-span-5">
                <div class="sticky top-[150px] space-y-4">
                    <h2 class="text-lg font-semibold text-slate-300 flex items-center gap-2">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Live Preview
                    </h2>
                    
                    <!-- Paper Styled Sheet -->
                    <div class="bg-white text-slate-900 shadow-2xl rounded-2xl p-8 min-h-[700px] text-xs font-sans border border-slate-200 overflow-y-auto max-h-[80vh]">
                        <!-- Name & Contact -->
                        <div class="text-center pb-5 border-b border-slate-300 mb-5">
                            <h3 class="text-2xl font-bold tracking-tight text-slate-900" x-text="content.personalInfo.fullName || 'Your Name'"></h3>
                            <div class="text-slate-600 mt-1.5 flex flex-wrap justify-center gap-x-2 gap-y-1">
                                <span x-show="content.personalInfo.email" x-text="content.personalInfo.email"></span>
                                <span x-show="content.personalInfo.phone">| <span x-text="content.personalInfo.phone"></span></span>
                                <span x-show="content.personalInfo.location">| <span x-text="content.personalInfo.location"></span></span>
                                <span x-show="content.personalInfo.website">| <a :href="content.personalInfo.website" target="_blank" class="text-blue-600" x-text="content.personalInfo.website"></a></span>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="mb-5" x-show="content.summary">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-1.5 border-b border-slate-200 pb-1">Professional Summary</h4>
                            <p class="text-slate-700 leading-relaxed" x-text="content.summary"></p>
                        </div>

                        <!-- Experience -->
                        <div class="mb-5" x-show="content.experience.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2 border-b border-slate-200 pb-1">Work Experience</h4>
                            <div class="space-y-3">
                                <template x-for="exp in content.experience">
                                    <div>
                                        <div class="flex justify-between font-bold text-slate-800">
                                            <span x-text="exp.position || 'Position'"></span>
                                            <span class="font-normal text-slate-600" x-text="(exp.startDate || '') + ' - ' + (exp.endDate || '')"></span>
                                        </div>
                                        <div class="text-slate-600 italic font-medium" x-text="exp.company || 'Company'"></div>
                                        <p class="text-slate-700 mt-1 leading-relaxed whitespace-pre-line" x-text="exp.description"></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="mb-5" x-show="content.education.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2 border-b border-slate-200 pb-1">Education</h4>
                            <div class="space-y-2">
                                <template x-for="edu in content.education">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-bold text-slate-800" x-text="edu.school || 'School'"></div>
                                            <div class="text-slate-600" x-text="(edu.degree || '') + ' in ' + (edu.field || '')"></div>
                                        </div>
                                        <span class="text-slate-600" x-text="edu.year"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Projects -->
                        <div class="mb-5" x-show="content.projects && content.projects.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2 border-b border-slate-200 pb-1">Featured Projects</h4>
                            <div class="space-y-2">
                                <template x-for="proj in content.projects">
                                    <div>
                                        <div class="font-bold text-slate-800">
                                            <span x-text="proj.title || 'Project Title'"></span>
                                            <a x-show="proj.link" :href="proj.link" target="_blank" class="text-blue-600 text-[10px] ml-1.5 font-normal">Link</a>
                                        </div>
                                        <p class="text-slate-700 mt-0.5" x-text="proj.description"></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="mb-5" x-show="content.skills.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-1.5 border-b border-slate-200 pb-1">Core Skills</h4>
                            <p class="text-slate-700 font-medium" x-text="content.skills.join(' • ')"></p>
                        </div>

                        <!-- Languages -->
                        <div class="mb-4" x-show="content.languages && content.languages.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-1 border-b border-slate-200 pb-1">Languages</h4>
                            <p class="text-slate-700" x-text="content.languages.join(', ')"></p>
                        </div>

                        <!-- Certifications -->
                        <div class="mb-4" x-show="content.certifications && content.certifications.length > 0">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-1.5 border-b border-slate-200 pb-1">Certifications</h4>
                            <ul class="list-disc list-inside text-slate-700 space-y-0.5">
                                <template x-for="c in content.certifications">
                                    <li x-text="c"></li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function resumeBuilder(resumeId, initialContent, initialTitle) {
    return {
        id: resumeId,
        title: initialTitle,
        content: Object.assign({
            personalInfo: { fullName: '', email: '', phone: '', location: '', website: '', jobTitle: '' },
            summary: '',
            skills: [],
            experience: [],
            education: [],
            projects: [],
            certifications: [],
            socialLinks: [],
            awards: [],
            languages: []
        }, initialContent || {}, {
            // Always ensure these are arrays even if the stored data has them as non-array
            skills: Array.isArray((initialContent || {}).skills) ? initialContent.skills : [],
            experience: Array.isArray((initialContent || {}).experience) ? initialContent.experience : [],
            education: Array.isArray((initialContent || {}).education) ? initialContent.education : [],
            projects: Array.isArray((initialContent || {}).projects) ? initialContent.projects : [],
            certifications: Array.isArray((initialContent || {}).certifications) ? initialContent.certifications : [],
            socialLinks: Array.isArray((initialContent || {}).socialLinks) ? initialContent.socialLinks : [],
            awards: Array.isArray((initialContent || {}).awards) ? initialContent.awards : [],
            languages: Array.isArray((initialContent || {}).languages) ? initialContent.languages : [],
            personalInfo: Object.assign(
                { fullName: '', email: '', phone: '', location: '', website: '', jobTitle: '' },
                (initialContent || {}).personalInfo || {}
            ),
        }),
        tabs: [
            { id: 'personal', name: 'Personal Details' },
            { id: 'summary', name: 'Summary' },
            { id: 'skills', name: 'Skills' },
            { id: 'experience', name: 'Experience' },
            { id: 'education', name: 'Education' },
            { id: 'projects', name: 'Projects' },
            { id: 'other', name: 'More' }
        ],
        activeTab: 'personal',
        newSkill: '',
        saving: false,
        lastSaved: '',
        aiLoading: false,

        addSkill() {
            const skill = this.newSkill.trim();
            if (skill && !this.content.skills.includes(skill)) {
                this.content.skills.push(skill);
            }
            this.newSkill = '';
        },

        removeSkill(index) {
            this.content.skills.splice(index, 1);
        },

        addExperience() {
            if (!this.content.experience) this.content.experience = [];
            this.content.experience.push({ company: '', position: '', startDate: '', endDate: '', description: '' });
        },

        removeExperience(index) {
            this.content.experience.splice(index, 1);
        },

        addEducation() {
            if (!this.content.education) this.content.education = [];
            this.content.education.push({ school: '', degree: '', field: '', year: '' });
        },

        removeEducation(index) {
            this.content.education.splice(index, 1);
        },

        addProject() {
            if (!this.content.projects) this.content.projects = [];
            this.content.projects.push({ title: '', description: '', link: '' });
        },

        removeProject(index) {
            this.content.projects.splice(index, 1);
        },

        addAward() {
            if (!this.content.awards) this.content.awards = [];
            this.content.awards.push('');
        },

        removeAward(idx) {
            this.content.awards.splice(idx, 1);
        },

        addCertification() {
            if (!this.content.certifications) this.content.certifications = [];
            this.content.certifications.push('');
        },

        removeCertification(idx) {
            this.content.certifications.splice(idx, 1);
        },

        async saveResume(silent = false) {
            if (!silent) this.saving = true;
            try {
                const response = await fetch(`/resume/${this.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        title: this.title,
                        content: JSON.stringify(this.content)
                    })
                });
                
                if (!response.ok) throw new Error('Save failed');
                
                const time = new Date().toLocaleTimeString();
                this.lastSaved = time;
                if (!silent) showToast('Resume saved successfully!', 'success');
            } catch (err) {
                console.error(err);
                if (!silent) showToast('Could not save changes.', 'error');
            } finally {
                if (!silent) this.saving = false;
            }
        },

        async generateAISummary() {
            if (!this.content.skills || this.content.skills.length === 0) {
                showToast('Please add some skills first to generate a summary.', 'warning');
                return;
            }
            this.aiLoading = true;
            try {
                const res = await makeRequest('/api/ai/generate-summary', 'POST', {
                    resume_id: this.id,
                    skills: this.content.skills,
                    experience: this.content.experience.map(e => `${e.position} at ${e.company}`).join(', ')
                });

                if (res && res.success) {
                    this.content.summary = res.result;
                    showToast('AI Summary generated!', 'success');
                } else {
                    throw new Error();
                }
            } catch (err) {
                showToast('Could not generate AI summary.', 'error');
            } finally {
                this.aiLoading = false;
            }
        },

        async improveDescription(index) {
            const exp = this.content.experience[index];
            if (!exp.description.trim()) {
                showToast('Please write some description first.', 'warning');
                return;
            }
            this.aiLoading = true;
            try {
                const res = await makeRequest('/api/ai/improve-description', 'POST', {
                    resume_id: this.id,
                    section: 'experience',
                    text: exp.description
                });

                if (res && res.success) {
                    exp.description = res.result;
                    showToast('Description improved with AI!', 'success');
                } else {
                    throw new Error();
                }
            } catch (err) {
                showToast('AI optimization failed.', 'error');
            } finally {
                this.aiLoading = false;
            }
        }
    };
}
</script>
@endsection
