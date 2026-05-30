

<?php $__env->startSection('title', 'Create Resume'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-900 dark:to-gray-900">
    <div class="px-4 py-8 mx-auto max-w-4xl">
        <div class="mb-8">
            <a href="<?php echo e(route('resume.index')); ?>" class="text-blue-600 dark:text-blue-400 hover:underline mb-4 inline-block">← Back</a>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Create New Resume</h1>
        </div>

        <form action="<?php echo e(route('resume.store')); ?>" method="POST" class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-8">
            <?php echo csrf_field(); ?>

            <div class="mb-8">
                <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Resume Title</label>
                <input type="text" id="title" name="title" placeholder="e.g., Software Engineer Resume" required class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-red-600 text-sm"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mb-8">
                <label for="template_id" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Choose Template</label>
                <select id="template_id" name="template_id" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                    <option value="1">Modern Professional</option>
                    <option value="2">Creative</option>
                    <option value="3">Classic</option>
                    <option value="4">Minimalist</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                    Create Resume
                </button>
                <a href="<?php echo e(route('resume.index')); ?>" class="flex-1 px-6 py-3 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/resume/create.blade.php ENDPATH**/ ?>