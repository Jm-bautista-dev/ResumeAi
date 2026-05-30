

<?php $__env->startSection('title', 'My Portfolios'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-900 dark:to-gray-900">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">My Portfolios</h1>
            <a href="<?php echo e(route('portfolio.create')); ?>" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                Create Portfolio
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($portfolios->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 hover:shadow-md transition overflow-hidden">
                        <div class="h-32 bg-gradient-to-br from-purple-400 to-pink-500 group-hover:shadow-lg transition"></div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2"><?php echo e($portfolio->title); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($portfolio->deployed_url): ?>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 truncate">
                                    <a href="<?php echo e($portfolio->deployed_url); ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo e($portfolio->deployed_url); ?></a>
                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Updated <?php echo e($portfolio->updated_at->diffForHumans()); ?></p>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="<?php echo e(route('portfolio.edit', $portfolio)); ?>" class="px-3 py-2 text-center bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded text-sm hover:bg-purple-200 transition">Edit</a>
                                <a href="<?php echo e(route('portfolio.preview', $portfolio)); ?>" class="px-3 py-2 text-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded text-sm hover:bg-blue-200 transition">View</a>
                                <a href="<?php echo e(route('portfolio.export-zip', $portfolio)); ?>" class="px-3 py-2 text-center bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded text-sm hover:bg-green-200 transition">Export</a>
                                <form action="<?php echo e(route('portfolio.destroy', $portfolio)); ?>" method="POST" class="contents">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" onclick="return confirm('Delete this portfolio?')" class="px-3 py-2 text-center bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 rounded text-sm hover:bg-red-200 transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Portfolios Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Create your first portfolio today</p>
                <a href="<?php echo e(route('portfolio.create')); ?>" class="inline-block px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    Create Portfolio
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/portfolio/index.blade.php ENDPATH**/ ?>