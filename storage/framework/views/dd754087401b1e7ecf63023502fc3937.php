<?php $__env->startSection('title', 'Edit Portfolio - ' . $portfolio->title); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-950 text-slate-100" 
     x-data="portfolioBuilder(<?php echo e($portfolio->id); ?>, <?php echo e($portfolio->config ? json_encode($portfolio->config) : 'null'); ?>, '<?php echo e($portfolio->title); ?>')">
    
    <!-- Top Control Bar -->
    <div class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-[73px] z-30 px-6 py-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4 w-full md:w-auto">
                <a href="<?php echo e(route('portfolio.index')); ?>" class="text-slate-400 hover:text-white transition">
                    &larr; Back
                </a>
                <input type="text" x-model="title" 
                       class="text-xl font-bold bg-transparent border-b border-transparent hover:border-slate-700 focus:border-purple-500 focus:outline-none px-2 py-1 w-full md:w-80 text-white">
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <span x-show="saving" x-transition class="text-xs text-slate-400">Saving...</span>
                <span x-show="!saving && lastSaved" x-transition class="text-xs text-slate-500">Last saved <span x-text="lastSaved"></span></span>
                
                <button @click="savePortfolio()" 
                        class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-medium transition shadow-lg shadow-purple-500/20">
                    Save Changes
                </button>
                <a href="<?php echo e(route('portfolio.preview', $portfolio)); ?>" 
                   class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-lg shadow-blue-500/20">
                    Live Preview
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- EDITOR PANEL (Left) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Tabs -->
                <div class="flex gap-2 p-1.5 bg-slate-900 border border-slate-800 rounded-2xl">
                    <button @click="activeTab = 'sections'"
                            :class="activeTab === 'sections' ? 'bg-purple-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800'"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold transition">
                        Active Sections
                    </button>
                    <button @click="activeTab = 'theme'"
                            :class="activeTab === 'theme' ? 'bg-purple-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800'"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold transition">
                        Theme Customization
                    </button>
                </div>

                <!-- FORM CONTROLS CONTAINER -->
                <div class="bg-slate-900/40 border border-slate-800 backdrop-blur-md p-6 rounded-2xl space-y-6">
                    
                    <!-- Sections Tab -->
                    <div x-show="activeTab === 'sections'" class="space-y-4" x-transition>
                        <h2 class="text-xl font-bold text-slate-100 mb-4">Toggle Portfolio Sections</h2>
                        
                        <div class="flex items-center justify-between p-4 bg-slate-800/30 border border-slate-800 rounded-xl">
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-200">Hero Header Banner</span>
                                <span class="text-xs text-slate-400">Shows name, bio, and main work call to action.</span>
                            </div>
                            <input type="checkbox" x-model="config.sections.hero.enabled" 
                                   class="w-5 h-5 rounded bg-slate-800 border-slate-700 text-purple-600 focus:ring-purple-500">
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-800/30 border border-slate-800 rounded-xl">
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-200">Featured Projects List</span>
                                <span class="text-xs text-slate-400">Renders projects added to your resume.</span>
                            </div>
                            <input type="checkbox" x-model="config.sections.projects.enabled" 
                                   class="w-5 h-5 rounded bg-slate-800 border-slate-700 text-purple-600 focus:ring-purple-500">
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-800/30 border border-slate-800 rounded-xl">
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-200">Core Skills Badges</span>
                                <span class="text-xs text-slate-400">Shows highlighted expertise tags.</span>
                            </div>
                            <input type="checkbox" x-model="config.sections.skills.enabled" 
                                   class="w-5 h-5 rounded bg-slate-800 border-slate-700 text-purple-600 focus:ring-purple-500">
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-800/30 border border-slate-800 rounded-xl">
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-200">Interactive Contact Form</span>
                                <span class="text-xs text-slate-400">Allows website visitors to drop a message.</span>
                            </div>
                            <input type="checkbox" x-model="config.sections.contact.enabled" 
                                   class="w-5 h-5 rounded bg-slate-800 border-slate-700 text-purple-600 focus:ring-purple-500">
                        </div>
                    </div>

                    <!-- Theme Tab -->
                    <div x-show="activeTab === 'theme'" class="space-y-6" x-transition>
                        <h2 class="text-xl font-bold text-slate-100 mb-4">Color Palette & Typography</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Primary Color</label>
                                <div class="flex gap-2">
                                    <input type="color" x-model="config.theme.primaryColor" class="w-12 h-12 rounded-xl bg-transparent border-0 cursor-pointer">
                                    <input type="text" x-model="config.theme.primaryColor" class="flex-grow px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Accent Color</label>
                                <div class="flex gap-2">
                                    <input type="color" x-model="config.theme.accentColor" class="w-12 h-12 rounded-xl bg-transparent border-0 cursor-pointer">
                                    <input type="text" x-model="config.theme.accentColor" class="flex-grow px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Secondary Background Color</label>
                                <div class="flex gap-2">
                                    <input type="color" x-model="config.theme.secondaryColor" class="w-12 h-12 rounded-xl bg-transparent border-0 cursor-pointer">
                                    <input type="text" x-model="config.theme.secondaryColor" class="flex-grow px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Font Family</label>
                                <select x-model="config.theme.fontFamily" class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="Inter">Inter (Sans-Serif)</option>
                                    <option value="Poppins">Poppins (Modern Rounded)</option>
                                    <option value="JetBrains Mono">JetBrains Mono (Console / Tech)</option>
                                    <option value="Playfair Display">Playfair Display (Elegant Serif)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- VISUAL PREVIEW PANEL (Right) -->
            <div class="lg:col-span-5">
                <div class="sticky top-[150px] space-y-4">
                    <h2 class="text-lg font-semibold text-slate-300 flex items-center gap-2">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-purple-500 animate-pulse"></span>
                        Design Sheet Preview
                    </h2>
                    
                    <!-- Paper Styled Sheet -->
                    <div class="bg-slate-900 border border-slate-800 shadow-2xl rounded-2xl p-6 min-h-[500px] text-xs transition duration-300 overflow-y-auto max-h-[75vh]"
                         :style="{ fontFamily: config.theme.fontFamily }">
                        
                        <!-- Hero Section Preview -->
                        <div class="text-center py-8 rounded-xl bg-slate-950 border border-slate-800/80 mb-4 transition-all"
                             x-show="config.sections.hero.enabled" x-transition>
                            <h3 class="text-xl font-bold tracking-tight text-white" :style="{ color: config.theme.primaryColor }">
                                <?php echo e($portfolio->resume->content ? json_decode($portfolio->resume->content, true)['personalInfo']['fullName'] ?? 'Your Name' : 'Your Name'); ?>

                            </h3>
                            <p class="text-slate-400 mt-1.5 px-4 text-[10px]">Full Stack Professional Portfolio landing view.</p>
                            <button class="mt-4 px-4 py-1.5 text-[10px] font-semibold text-white rounded-lg transition"
                                    :style="{ backgroundColor: config.theme.accentColor }">
                                View Work
                            </button>
                        </div>

                        <!-- Projects Preview -->
                        <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-xl mb-4" 
                             x-show="config.sections.projects.enabled" x-transition>
                            <h4 class="font-bold text-white mb-2 uppercase tracking-wide text-[10px]">Projects</h4>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="p-2 border border-slate-800 rounded bg-slate-900/50">
                                    <div class="w-full h-8 bg-slate-800 rounded mb-1"></div>
                                    <span class="font-semibold text-white block text-[9px]">SaaS Engine</span>
                                </div>
                                <div class="p-2 border border-slate-800 rounded bg-slate-900/50">
                                    <div class="w-full h-8 bg-slate-800 rounded mb-1"></div>
                                    <span class="font-semibold text-white block text-[9px]">App Analytics</span>
                                </div>
                            </div>
                        </div>

                        <!-- Skills Preview -->
                        <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-xl mb-4"
                             x-show="config.sections.skills.enabled" x-transition>
                            <h4 class="font-bold text-white mb-2 uppercase tracking-wide text-[10px]">Technical Skills</h4>
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-0.5 rounded text-[9px]" :style="{ backgroundColor: config.theme.primaryColor + '20', color: config.theme.primaryColor }">PHP</span>
                                <span class="px-2 py-0.5 rounded text-[9px]" :style="{ backgroundColor: config.theme.primaryColor + '20', color: config.theme.primaryColor }">Laravel</span>
                                <span class="px-2 py-0.5 rounded text-[9px]" :style="{ backgroundColor: config.theme.primaryColor + '20', color: config.theme.primaryColor }">Vue.js</span>
                            </div>
                        </div>

                        <!-- Contact Preview -->
                        <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-xl"
                             x-show="config.sections.contact.enabled" x-transition>
                            <h4 class="font-bold text-white mb-2 uppercase tracking-wide text-[10px]">Get in Touch</h4>
                            <div class="space-y-1.5">
                                <div class="w-full h-6 bg-slate-900 border border-slate-850 rounded"></div>
                                <div class="w-full h-6 bg-slate-900 border border-slate-850 rounded"></div>
                                <button class="w-full py-1 bg-slate-800 text-white rounded font-semibold text-[9px] hover:bg-slate-700">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function portfolioBuilder(portfolioId, initialConfig, initialTitle) {
    return {
        id: portfolioId,
        title: initialTitle,
        config: initialConfig || {
            theme: {
                primaryColor: '#3B82F6',
                secondaryColor: '#1E293B',
                accentColor: '#EC4899',
                fontFamily: 'Inter'
            },
            sections: {
                hero: { enabled: true },
                projects: { enabled: true },
                skills: { enabled: true },
                contact: { enabled: true }
            }
        },
        activeTab: 'sections',
        saving: false,
        lastSaved: '',

        async savePortfolio() {
            this.saving = true;
            try {
                const response = await fetch(`/portfolio/${this.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        title: this.title,
                        config: JSON.stringify(this.config)
                    })
                });

                if (!response.ok) throw new Error('Save failed');

                const time = new Date().toLocaleTimeString();
                this.lastSaved = time;
                showToast('Portfolio configuration saved!', 'success');
            } catch (err) {
                console.error(err);
                showToast('Could not save portfolio changes.', 'error');
            } finally {
                this.saving = false;
            }
        }
    };
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/portfolio/edit.blade.php ENDPATH**/ ?>