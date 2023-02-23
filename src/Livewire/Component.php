<?php

namespace OEngine\Reojs\Livewire;

use OEngine\Platform\Traits\WithDoAction;
use Livewire\Component as ComponentBase;

class Component extends ComponentBase
{
    use WithDoAction;
    public $_dataTemps = [];
    protected function getListeners()
    {
        return ['refreshData' . $this->id => '__loadData'];
    }

    public function __loadData()
    {
    }

    public function refreshData($option = [])
    {
        if (!isset($option['id'])) $option['id'] = $this->id;
        $this->dispatchBrowserEvent('reload_component', $option);
    }

    public function redirectCurrent()
    {
        return redirect(request()->header('Referer'));;
    }
    public function showMessage($option)
    {
        $this->dispatchBrowserEvent('reojs-message', $option);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    protected function ensureViewHasValidLivewireLayout($view)
    {
        if ($view == null) {
            return;
        }
        parent::ensureViewHasValidLivewireLayout($view);
        $view->extends(theme_layout())->section('content');
    }
}
