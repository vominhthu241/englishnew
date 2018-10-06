<?php

namespace App\Admin\Controllers;

use App\Test;
use App\Section;
use App\TestSection;
use App\Http\Controllers\Controller;
use App\Admin\Tools\AddSectionToTest;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Http\Requests;

class TestController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id))
            ->body($this->getSections());

    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Test);

        $grid->id('Id');
        $grid->name('Name');
        $grid->time('Time');
        $grid->status('Status');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Test::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->time('Time');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Test);

        $form->text('name', 'Name');
        $form->time('time', 'Time')->default(date('H:i:s'));
        $form->switch('status', 'Status');

        return $form;
    }

    private function getSections(){
        $grid = new Grid(new Section);
        $grid->id('Id');
        $grid->content('Content');
        $grid->filemedia('Filemedia');
        $grid->fileimage('Fileimage');
        $grid->type_id('Type id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableActions(); 

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
                $batch->add("AddSection", new AddSectionToTest(0));
            });
        });

        return $grid;
    }

    public function addSections(Request $request) {
        $section_id = $request->section_id;
        $test_id = $request->test_id;
        foreach ($section_id as $sec_id) {
            $ts = new TestSection();

            $ts->test_id = $test_id;
            $ts->section_id = $sec_id;

            $ts->save();
        }
        // refresh lại table // check not exist ->insert, exist -> edit

    }
}
