<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Project;
use App\Models\Stage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class StageDialog extends Component
{
    public Project $project;
    public Stage $stage;
    /**
     * Create a new component instance.
     */
    public function __construct(Project $project, Stage $stage)
    {
        $this->project = $project;
        $this->stage = $stage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stageDialog');
    }
}
