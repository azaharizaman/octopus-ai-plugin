<?php if ($this->previewMode): ?>

    <div class="form-control">
        <?= $value ?>
    </div>

<?php else: ?>

<div
    class="input-group"
    id="<?= $this->getId() ?>"
>
    <input
        type="text"
        name="<?= $name ?>"
        id="<?= $this->getId('input') ?>"
        value="<?= e($value) ?>"
        autocomplete="off"
        class="form-control"
        placeholder=""
        style="margin-right: 50px;"	
    >
    <div class="align-middle" style="background-color: red;">
        <div style="padding: 5px;" class="position-absolute end-0">
            <button class="btn btn-sm btn-primary <?= $this->getId('input') ?>ai-toggle" data-toggle="dropdown">
                <i class="icon-magic"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitext: '#<?= $this->getId() ?>' }" 
                    data-request="<?= $eventHandlerRewrite ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Rewrite</a>
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitext: '#<?= $this->getId() ?>' }"
                    data-request="<?= $eventHandlerComplete ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Complete Text</a>
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitext: '#<?= $this->getId() ?>' }"
                    data-request="<?= $eventHandlerSummarize ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Summarize
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitext: '#<?= $this->getId() ?>' }"
                    data-request="<?= $eventHandlerElaborate ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Elaborate</a>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#"
                    data-request-update="{ aitext: '#<?= $this->getId() ?>' }"
                    data-request="<?= $eventHandlerPrompt ?>"
                    data-request-loading=".<?= $this->getId('input') ?>is-regenerating"
                >Execute as Prompt</a>
            </div>
        </div>
        <div style="padding: 5px;" class="position-absolute end-0">
            <button class="btn btn-sm btn-primary <?= $this->getId('input') ?>is-regenerating" type="button" style="display: none;">
                <span class="spinner-grow spinner-grow-sm"></span>
            </button>
        </div>
    </div>
    
</div>

<?php endif ?>