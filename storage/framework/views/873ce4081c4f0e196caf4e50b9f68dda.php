<?php $__env->startSection('title', 'Sign In - Resume AI Builder'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[80vh] flex items-center justify-center px-4 relative overflow-hidden bg-slate-950">
    <!-- Animated background glowing circles -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md z-10" data-aos="fade-up">
        <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800 p-8 rounded-2xl shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                    Welcome Back
                </h2>
                <p class="text-slate-400 mt-2">Sign in to your AI resume builder account</p>
            </div>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required value="<?php echo e(old('email')); ?>"
                           class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="you@example.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-300">Password</label>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-xs text-blue-400 hover:text-blue-300 transition">
                                Forgot password?
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" 
                           class="h-4 w-4 rounded bg-slate-800 border-slate-700 text-blue-500 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 text-sm text-slate-300 select-none">Remember my credentials</label>
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transition-all duration-300">
                    Sign In
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-slate-400">
                    Don't have an account? 
                    <a href="<?php echo e(route('register')); ?>" class="font-semibold text-blue-400 hover:text-blue-300 transition">
                        Sign up for free
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/auth/login.blade.php ENDPATH**/ ?>