<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($resume->title); ?></title>
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
        <h1 class="name"><?php echo e($data['personalInfo']['fullName'] ?? 'Your Name'); ?></h1>
        <div class="contact-info">
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
                &nbsp;|&nbsp; <?php echo e($data['personalInfo']['website']); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Summary Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['summary'] ?? ''): ?>
        <div class="section-title">Professional Summary</div>
        <p class="description"><?php echo e($data['summary']); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Work Experience Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['experience'] ?? []) > 0): ?>
        <div class="section-title">Work Experience</div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="item-header" style="text-align: left; font-size: 11pt;"><?php echo e($exp['position'] ?? 'Position'); ?></td>
                        <td style="text-align: right; font-size: 9.5pt; color: #4b5563;"><?php echo e($exp['startDate'] ?? ''); ?> - <?php echo e($exp['endDate'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="item-meta" style="text-align: left; padding-top: 2px;"><?php echo e($exp['company'] ?? 'Company'); ?></td>
                    </tr>
                </table>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($exp['description'] ?? ''): ?>
                    <p class="description" style="margin-top: 5px;"><?php echo e($exp['description']); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Education Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['education'] ?? []) > 0): ?>
        <div class="section-title">Education</div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="item-header" style="text-align: left; font-size: 11pt;"><?php echo e($edu['school'] ?? 'School'); ?></td>
                        <td style="text-align: right; font-size: 9.5pt; color: #4b5563;"><?php echo e($edu['year'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="item-meta" style="text-align: left; padding-top: 2px;"><?php echo e($edu['degree'] ?? ''); ?> in <?php echo e($edu['field'] ?? ''); ?></td>
                    </tr>
                </table>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Projects Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['projects'] ?? []) > 0): ?>
        <div class="section-title">Featured Projects</div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="item-header">
                    <?php echo e($proj['title'] ?? 'Project Title'); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['link'] ?? ''): ?>
                        <span style="font-size: 8.5pt; font-weight: normal; color: #3b82f6;">(<?php echo e($proj['link']); ?>)</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proj['description'] ?? ''): ?>
                    <p class="description" style="margin-top: 3px;"><?php echo e($proj['description']); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Skills Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['skills'] ?? []) > 0): ?>
        <div class="section-title">Core Skills</div>
        <div class="skills-container">
            <?php echo e(implode(' • ', $data['skills'])); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Languages Section -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($data['languages'] ?? []) > 0): ?>
        <div class="section-title">Languages</div>
        <div class="skills-container">
            <?php echo e(implode(', ', $data['languages'])); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</body>
</html>
<?php /**PATH C:\Users\Admin\OneDrive\Desktop\Resume Ai Builder\resources\views/resume/pdf-export.blade.php ENDPATH**/ ?>