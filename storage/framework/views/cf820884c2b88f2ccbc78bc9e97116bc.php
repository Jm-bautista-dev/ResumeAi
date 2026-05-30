<?php $__env->startSection('title', 'AI Career Score & ATS Analysis'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-950 text-slate-100 py-12 px-6">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-850 pb-8">
            <div>
                <a href="<?php echo e(route('resume.edit', $resume)); ?>" class="text-slate-400 hover:text-white transition text-sm flex items-center gap-1 mb-2">&larr; Back to Editor</a>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white">AI Resume Analysis & Score</h1>
                <p class="text-slate-400 text-sm mt-1 font-light">Calculated based on ATS compliance, grammar standard, industry keyword match, and role fitness.</p>
            </div>
            <div class="flex gap-3">
                <form action="<?php echo e(route('resume.analyze', $resume)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-5 py-3 bg-slate-900 border border-slate-800 text-slate-200 font-semibold rounded-2xl hover:border-blue-500 hover:text-white transition flex items-center gap-2">
                        🔄 Refresh Analysis
                    </button>
                </form>
                <form action="<?php echo e(route('resume.apply-fixes', $resume)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-5 py-3 bg-gradient-to-r from-blue-500 via-indigo-500 to-rose-500 text-white font-bold rounded-2xl hover:opacity-95 active:scale-[0.98] transition shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                        ✨ One-Click AI Improve
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Panel (Scores & Breakdown) -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Overall Score Gauge -->
                <div class="bg-slate-900/40 border border-slate-850 p-8 rounded-3xl text-center space-y-6">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Overall AI Career Fit</h3>
                    
                    <div class="relative w-48 h-48 mx-auto flex items-center justify-center">
                        <!-- Custom SVG circular gauge meter -->
                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="96" cy="96" r="80" stroke="#1e293b" stroke-width="12" fill="transparent" />
                            <circle cx="96" cy="96" r="80" stroke="url(#blue-grad)" stroke-width="12" fill="transparent" 
                                    stroke-dasharray="502" stroke-dashoffset="<?php echo e(502 - (502 * $analysis->score) / 100); ?>"
                                    stroke-linecap="round" class="transition-all duration-1000 ease-out" />
                            <defs>
                                <linearGradient id="blue-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#3B82F6" />
                                    <stop offset="50%" stop-color="#8B5CF6" />
                                    <stop offset="100%" stop-color="#EC4899" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-5xl font-black tracking-tight text-white"><?php echo e($analysis->score); ?></span>
                            <span class="text-xs text-slate-500 uppercase font-semibold mt-1">out of 100</span>
                        </div>
                    </div>

                    <div class="p-3 bg-slate-900/50 rounded-2xl border border-slate-800/60 inline-block">
                        <span class="text-xs text-emerald-400 font-semibold flex items-center gap-1.5 justify-center">
                            <span>✓</span> Strong score! Standard ATS threshold passed.
                        </span>
                    </div>
                </div>

                <!-- Score Breakdown -->
                <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl space-y-6">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Breakdown Analysis</h3>
                    <div class="space-y-4">
                        <!-- 1. ATS -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-350">ATS Compatibility</span>
                                <span class="font-bold text-white"><?php echo e($analysis->ats_score); ?>%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: <?php echo e($analysis->ats_score); ?>%"></div>
                            </div>
                        </div>

                        <!-- 2. Grammar -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-350">Grammar & Clarity</span>
                                <span class="font-bold text-white"><?php echo e($analysis->grammar_score); ?>%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 rounded-full" style="width: <?php echo e($analysis->grammar_score); ?>%"></div>
                            </div>
                        </div>

                        <!-- 3. Content Quality -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-350">Content Quality</span>
                                <span class="font-bold text-white"><?php echo e($analysis->content_score); ?>%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full" style="width: <?php echo e($analysis->content_score); ?>%"></div>
                            </div>
                        </div>

                        <!-- 4. Keyword Score -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-350">Keyword Matching</span>
                                <span class="font-bold text-white"><?php echo e($analysis->keyword_score); ?>%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-rose-500 rounded-full" style="width: <?php echo e($analysis->keyword_score); ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel (Strengths, Weaknesses, Suggestions) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Actionable Suggestions -->
                <div class="bg-slate-900/40 border border-slate-850 p-8 rounded-3xl space-y-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>💡</span> Actionable Improvements
                    </h3>
                    <div class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $analysis->suggestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 bg-slate-950 border border-slate-900 rounded-2xl flex items-start gap-4 hover:border-slate-850 transition">
                                <span class="text-lg mt-0.5">⚡</span>
                                <div class="flex-grow">
                                    <p class="text-sm font-light text-slate-300"><?php echo e($s); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Strengths & Weaknesses Split Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Strengths -->
                    <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl space-y-4">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-emerald-400 flex items-center gap-2">
                            <span>✓</span> Key Strengths
                        </h3>
                        <ul class="space-y-3 text-sm text-slate-350 font-light">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $analysis->strengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strength): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">&bull;</span>
                                    <span><?php echo e($strength); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </div>

                    <!-- Weaknesses -->
                    <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl space-y-4">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-rose-400 flex items-center gap-2">
                            <span>✗</span> Areas of Concern
                        </h3>
                        <ul class="space-y-3 text-sm text-slate-350 font-light">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $analysis->weaknesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weakness): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-rose-500 font-bold mt-0.5">&bull;</span>
                                    <span><?php echo e($weakness); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Missing Keywords & Suggested Roles Chips -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Missing Keywords -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($analysis->missing_skills) && count($analysis->missing_skills) > 0): ?>
                        <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl space-y-4">
                            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Missing Keywords (ATS Boosters)</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $analysis->missing_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="px-3 py-1.5 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs font-semibold font-mono">
                                        + <?php echo e($skill); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- Suggested Roles -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($analysis->suggested_roles) && count($analysis->suggested_roles) > 0): ?>
                        <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl space-y-4">
                            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">AI Suggested Roles</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $analysis->suggested_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="px-3 py-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-xl text-xs font-semibold">
                                        <?php echo e($role); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Template Recommendations -->
                <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-1">Recommended Template Style</h3>
                        <p class="text-lg font-bold text-white"><?php echo e(str_replace('-', ' ', ucfirst($analysis->recommended_template))); ?></p>
                        <p class="text-slate-400 text-xs mt-1 font-light">Matched dynamically by scanning your tech skill and industry density keywords.</p>
                    </div>
                    <a href="<?php echo e(route('resume.preview-template', ['resume' => $resume, 'template' => $analysis->recommended_template])); ?>"
                       class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-2xl hover:shadow-lg transition">
                        View Mock Template &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/resume/score.blade.php ENDPATH**/ ?>