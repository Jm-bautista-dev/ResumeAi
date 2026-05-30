<?php
    $data = $data ?? $resume->getStructuredData();
    $isPdf = $isPdf ?? false;
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPdf): ?>
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
            <h1 class="modern-name"><?php echo e($data['personalInfo']['fullName'] ?? 'Your Name'); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($resume->job_role): ?>
                <div class="modern-title"><?php echo e($resume->job_role); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="modern-contact">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['email'] ?? ''): ?>
                    <?php echo e($data['personalInfo']['email']); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['phone'] ?? ''): ?>
                    &nbsp;|&nbsp; <?php echo e($data['personalInfo']['phone']); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['location'] ?? ''): ?>
                    &nbsp;|&nbsp; <?php echo e($data['personalInfo']['location']); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['website'] ?? ''): ?>
                    &nbsp;|&nbsp; <span style="color: #2563eb;"><?php echo e($data['personalInfo']['website']); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['summary'] ?? ''): ?>
            <div class="modern-section-title">Professional Summary</div>
            <p class="modern-desc" style="font-size: 10pt;"><?php echo e($data['summary']); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['experience'] ?? []) > 0): ?>
            <div class="modern-section-title">Work Experience</div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modern-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="modern-job-header" style="text-align: left;"><?php echo e($job['position'] ?? 'Position'); ?></td>
                            <td style="text-align: right; font-size: 9.5pt; color: #64748b;"><?php echo e($job['startDate'] ?? ''); ?> - <?php echo e($job['endDate'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="modern-job-meta"><?php echo e($job['company'] ?? 'Company'); ?></td>
                        </tr>
                    </table>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job['description'] ?? ''): ?>
                        <p class="modern-desc" style="margin-top: 4px;"><?php echo e($job['description']); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['education'] ?? []) > 0): ?>
            <div class="modern-section-title">Education</div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modern-job">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="modern-job-header" style="text-align: left;"><?php echo e($school['school'] ?? 'School'); ?></td>
                            <td style="text-align: right; font-size: 9.5pt; color: #64748b;"><?php echo e($school['year'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="modern-job-meta"><?php echo e($school['degree'] ?? ''); ?> in <?php echo e($school['field'] ?? ''); ?></td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['projects'] ?? []) > 0): ?>
            <div class="modern-section-title">Projects</div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modern-job">
                    <div class="modern-job-header">
                        <?php echo e($proj['title'] ?? 'Project Title'); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['link'] ?? ''): ?>
                            <span style="font-size: 8.5pt; font-weight: normal; color: #2563eb;">(<?php echo e($proj['link']); ?>)</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['description'] ?? ''): ?>
                        <p class="modern-desc" style="margin-top: 3px;"><?php echo e($proj['description']); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['skills'] ?? []) > 0): ?>
            <div class="modern-section-title">Skills</div>
            <div style="margin-top: 5px;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['skills']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="modern-skill-tag"><?php echo e($skill); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php else: ?>
    <!-- Web/Preview Layout (Tailwind Styled) -->
    <div class="p-8 md:p-12 text-slate-800 font-sans max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-slate-100">
        <!-- Header -->
        <div class="border-b-4 border-blue-600 pb-6 mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight"><?php echo e($data['personalInfo']['fullName'] ?? 'Your Name'); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($resume->job_role): ?>
                <p class="text-lg font-bold text-blue-600 uppercase tracking-widest mt-1"><?php echo e($resume->job_role); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-slate-500 text-sm mt-3 font-medium">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['email'] ?? ''): ?>
                    <span class="flex items-center gap-1">✉ <?php echo e($data['personalInfo']['email']); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['phone'] ?? ''): ?>
                    <span class="flex items-center gap-1">📞 <?php echo e($data['personalInfo']['phone']); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['location'] ?? ''): ?>
                    <span class="flex items-center gap-1">📍 <?php echo e($data['personalInfo']['location']); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['personalInfo']['website'] ?? ''): ?>
                    <a href="<?php echo e($data['personalInfo']['website']); ?>" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">🌐 Portfolio</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Summary -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['summary'] ?? ''): ?>
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-3 tracking-wide uppercase text-sm">Professional Summary</h2>
                <p class="text-slate-600 leading-relaxed text-sm md:text-base"><?php echo e($data['summary']); ?></p>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Experience -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['experience'] ?? []) > 0): ?>
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Work Experience</h2>
                <div class="space-y-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between font-bold text-slate-800 text-base">
                                <h3><?php echo e($job['position'] ?? 'Position'); ?></h3>
                                <span class="font-normal text-slate-500 text-sm"><?php echo e($job['startDate'] ?? ''); ?> - <?php echo e($job['endDate'] ?? ''); ?></span>
                            </div>
                            <div class="text-blue-600 font-semibold text-sm italic"><?php echo e($job['company'] ?? 'Company'); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job['description'] ?? ''): ?>
                                <p class="text-slate-600 text-sm mt-2 leading-relaxed whitespace-pre-line"><?php echo e($job['description']); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Education -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['education'] ?? []) > 0): ?>
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Education</h2>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <div class="flex justify-between font-bold text-slate-800 text-sm md:text-base">
                                <h3><?php echo e($school['school'] ?? 'School'); ?></h3>
                                <span class="font-normal text-slate-500 text-xs md:text-sm"><?php echo e($school['year'] ?? ''); ?></span>
                            </div>
                            <p class="text-slate-600 text-sm"><?php echo e($school['degree'] ?? ''); ?> in <?php echo e($school['field'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Projects -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['projects'] ?? []) > 0): ?>
            <section class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-4 tracking-wide uppercase text-sm">Featured Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <h3 class="font-bold text-slate-900 text-sm flex items-center justify-between">
                                <?php echo e($proj['title'] ?? 'Project Title'); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['link'] ?? ''): ?>
                                    <a href="<?php echo e($proj['link']); ?>" target="_blank" class="text-blue-600 hover:underline text-xs font-normal">Link ↗</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['description'] ?? ''): ?>
                                <p class="text-slate-600 text-xs mt-1.5 leading-relaxed"><?php echo e($proj['description']); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Skills -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['skills'] ?? []) > 0): ?>
            <section class="mb-6">
                <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2 mb-3 tracking-wide uppercase text-sm">Core Skills</h2>
                <div class="flex flex-wrap gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['skills']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold"><?php echo e($skill); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/templates/resume/modern-professional.blade.php ENDPATH**/ ?>