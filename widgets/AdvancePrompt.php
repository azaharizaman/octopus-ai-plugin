<?php namespace AzahariZaman\OctopusAI\Widgets;

use AzahariZaman\OctopusAI\Models\Record;
use Backend\Classes\WidgetBase;

class AdvancePrompt extends WidgetBase
{
    use \Backend\Traits\SearchableWidget;
    /**
     * @var string defaultAlias to identify this widget.
     */
    protected $defaultAlias = 'octopusai_advanceprompt';

    public $title = "OctopusAI Advance Prompt";

    protected $advancePromptFormWidget;

    public function bindToController()
    {
        parent::bindToController();
    }

    public function init()
    {
        $this->fillFromConfig([
            'title',
        ]);

        if (post('advanceprompt_flag')) {
            $this->getAdvancePromptFormWidget();
        }
    }

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('advanceprompt');
    }

    protected function loadAssets()
    {
        $this->addJsBundle('js/advanceprompt.js', 'global');
    }

    /**
     * prepareVars for display
     */
    public function prepareVars()
    {
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['title'] = $this->title;
        $this->vars['advancePromptWidget'] = $this->getAdvancePromptFormWidget();

    }

    public function getLoadValue()
    {
        return post('value');
    }

    public function onLoadPopup()
    {
        $this->controller->flushAssets();

        return $this->render();
    }

    public function onSearchPromptRecords()
    {
        $this->controller->flushAssets();

        $this->setSearchTerm(post('term'));

        return ['results' => $this->getSearchMatches()];
    }

    public function onRefreshPrompt()
    {
        // When a record is selected, the selected item will be available in post
        $data = post('PromptItem');
    }

    public function getAdvancePromptFormWidget()
    {
        if ($this->advancePromptFormWidget) {
            return $this->advancePromptFormWidget;
        }

        $model = new Record;
        $model->record_type = 'AdvancePrompt';

        if ($value = $this->getLoadValue()) {
            $model = Record::find($value) ?: $model;
        }

        $config = $this->makeConfig('$/azaharizaman/octopusai/models/record/fields.yaml');
        $config->model = $model;
        $config->alias = $this->alias . 'Select';
        $config->arrayName = 'AdvancePromptItems';

        $form = $this->makeWidget(\Backend\Widgets\Form::class, $config);
        $form->bindEvent('form.ExtendFields', function() use ($form) {
            $form->getField('search')->searchHandler($this->getEventHandler('onSearchRecord'));
        });

        $form->bindToController();

        return $this->advancePromptFormWidget = $form;

    }

    public function getSearchMatches()
    {
        $searchTerm = mb_strtolower($this->getSearchTerm());
        if (!strlen($searchTerm)) {
            return [];
        }

        $words = explode(' ', $searchTerm);

        $iterator = function ($references) use (&$iterator, $words) {
            $typeMatches = [];

            foreach ($references as $key => $referenceInfo) {
                $title = is_array($referenceInfo) ? $referenceInfo['title'] : $referenceInfo;
                if ($this->textMatchesSearch($words, $title)) {
                    $typeMatches[] = [
                        'id' => $key,
                        'text' => $title,
                    ];
                }

                if (isset($referenceInfo['generated']) && count($referenceInfo['generated'])) {
                    $typeMatches[] = array_merge($typeMatches, $iterator($referenceInfo['generated']));
                }
            }

            return $typeMatches;
        };

        $types = [];
        $item = new Record;
    }


}
