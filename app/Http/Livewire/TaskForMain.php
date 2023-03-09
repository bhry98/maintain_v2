<?php

namespace App\Http\Livewire;

use App\Models\Org\DepM;
use App\Models\Task\TaskM;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use PowerComponents\LivewirePowerGrid\Themes\Components\Editable;

final class TaskForMain extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput(),
            // ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Task\TaskM>
     */
    public function datasource(): Builder
    {
        return TaskM::query()->with('Dep')->orderBy('id', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            // ->addColumn('id')
            // ->addColumn('task_id')

            /** Example of custom column using a closure **/
            // ->addColumn('dep_name', function (DepM $model) {
            //     return strtolower(e($model->name));
            // })
            ->addColumn('id', function (TaskM $model) {
                return $model->id;
            })
            ->addColumn('dep_name', function (TaskM $model) {
                return $model->Dep->name;
            })
            ->addColumn('cli_name', function (TaskM $model) {
                // return $model->Cli->name;
                return $model->Cli == null ? "---" : $model->Cli->name;
            })
            ->addColumn('time', function (TaskM $model) {
                return $model->order_time->format(config('app.date.format'));
            })
            ->addColumn('stat', function (TaskM $model) {
                return $model->Status($model->status);
            })
            ->addColumn('ws_name', function (TaskM $model) {
                return $model->WShop == null ? '<button onclick="Livewire.emit(\'openModal\', \'modal.task.move\','.$model.')">Edit User</button>' : $model->WShop->name;
            })




            ->addColumn('dep.name')
            ->addColumn('mach_id')
            ->addColumn('cli_id')
            ->addColumn('order_time')
            ->addColumn('tittle')
            ->addColumn('details')
            ->addColumn('dep_id')
            ->addColumn('main_ok')
            ->addColumn('main_ok_id')
            ->addColumn('main_ok_time')
            ->addColumn('workshop_id')
            ->addColumn('emp_ok')
            ->addColumn('emp_id')
            ->addColumn('emp_start_time')
            ->addColumn('hold_time')
            ->addColumn('emp_end_time')
            ->addColumn('emp_done')
            ->addColumn('emp_done_note')
            ->addColumn('status')
            ->addColumn('cli_done')
            ->addColumn('is_close');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make(__("app.task.table.Code"), 'id')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),
            Column::make(__("app.task.table.Dep"), 'dep_name')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),
            Column::make(__("app.task.table.Cli"), 'cli_name')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),
            Column::make(__("app.task.table.Time"), 'time')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),
            Column::make(__("app.task.table.Status"), 'stat')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),
            Column::make(__("app.task.table.Ws"), 'ws_name')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid TaskM Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            //    ->route('task-m.edit', ['task-m' => 'id']),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('task-m.destroy', ['task-m' => 'id'])
            //        ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid TaskM Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($task-m) => $task-m->id === 1)
                ->hide(),
        ];
    }
    */
}
