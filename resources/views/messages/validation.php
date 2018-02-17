<?php /** @var \League\Plates\Template\Template $this */ ?>
<ul>
    <?php foreach ($errors as $key => $error): ?>
        <li>Field "<?= $this->e($key) ?>":
            <ul>
                <?php foreach ($error->getMessages() as $message): ?>
                    <li>
                        <?= $this->e($message) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>