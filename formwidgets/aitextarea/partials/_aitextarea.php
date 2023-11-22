<?php if ($this->previewMode): ?>
    <div class="form-control">
        <?= e($value) ?>
    </div>
<?php else: ?>
    <div class="position-relative" id="<?= $this->getId() ?>">
        <textarea name="<?= $name ?>" id="<?= $this->getId('textarea') ?>" cols="30" rows="10" class="form-control" style="padding-right: 50px;" placeholder="Write something here..." autocomplete="off"><?= e(trim($value)) ?></textarea>
        <div class="position-absolute top-0 end-0" style="display: block; padding: 5px;">
            <button class="btn btn-sm btn-primary <?= $this->getId('textarea') ?>ai-toggle" data-toggle="dropdown" type="button">
                <i class="icon-magic"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-request-update="{ aitextarea: '#<?= $this->getId() ?>' }" data-request="<?= $eventHandlerRewrite ?>" data-request-loading=".<?= $this->getId('textarea') ?>is-regenerating">Rewrite</a>
                <a class="dropdown-item" href="#" data-request-update="{ aitextarea: '#<?= $this->getId() ?>' }" data-request="<?= $eventHandlerComplete ?>" data-request-loading=".<?= $this->getId('textarea') ?>is-regenerating">Complete Text</a>
                <a class="dropdown-item" href="#" data-request-update="{ aitextarea: '#<?= $this->getId() ?>' }" data-request="<?= $eventHandlerSummarize ?>" data-request-loading=".<?= $this->getId('textarea') ?>is-regenerating">Summarize</a>
                <a class="dropdown-item" href="#" data-request-update="{ aitextarea: '#<?= $this->getId() ?>' }" data-request="<?= $eventHandlerElaborate ?>" data-request-loading=".<?= $this->getId('textarea') ?>is-regenerating">Elaborate</a>
                
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitextarea: '#<?= $this->getId() ?>' }"
                    data-request="<?= $eventHandlerPrompt ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Execute as Prompt</a>
            </div>
        </div> 
        <div class="position-absolute top-0 end-0" style="display: block; padding: 5px;">
            <button class="btn btn-sm btn-primary <?= $this->getId('textarea') ?>is-regenerating" type="button" style="display: none;">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            </button>
        </div> 
    </div>
<?php endif ?>