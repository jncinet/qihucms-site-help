<?php

namespace Qihucms\SiteHelp\Controllers\Admin;

use App\Admin\Controllers\Controller;
use Qihucms\SiteHelp\Models\SiteHelpCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HelpCategoryController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '帮助分类';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteHelpCategory);

        $grid->model()->orderBy('sort', 'desc');

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('name', __('site-help::category.name'));
            $filter->equal('status', __('site-help::category.status.label'))
                ->select(__('site-help::category.status.value'));
        });

        $grid->column('ico', __('site-help::category.ico'))->image('', 66);
        $grid->column('sort', __('site-help::category.sort'))->editable();
        $grid->column('id', __('site-help::category.id'));
        $grid->column('name', __('site-help::category.name'));
        $grid->column('status', __('site-help::category.status.label'))
            ->using(__('site-help::category.status.value'));

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
        $show = new Show(SiteHelpCategory::findOrFail($id));

        $show->field('id', __('site-help::category.id'));
        $show->field('name', __('site-help::category.name'));
        $show->field('desc', __('site-help::category.desc'));
        $show->field('ico', __('site-help::category.ico'))->image();
        $show->field('sort', __('site-help::category.sort'));
        $show->field('status', __('site-help::category.status.label'))
            ->using(__('site-help::category.status.value'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SiteHelpCategory);

        $form->text('name', __('site-help::category.name'));
        $form->textarea('desc', __('site-help::category.desc'));
        $form->image('ico', __('site-help::category.ico'))
            ->uniqueName()
            ->removable()
            ->move('notice/ico');
        $form->number('sort', __('site-help::category.sort'))
            ->default(0);
        $form->select('status', __('site-help::category.status.label'))
            ->options(__('site-help::category.status.value'))
            ->default(1);

        return $form;
    }
}
