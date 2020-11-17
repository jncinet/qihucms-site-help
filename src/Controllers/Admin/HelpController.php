<?php

namespace Qihucms\SiteHelp\Controllers\Admin;

use App\Admin\Controllers\Controller;
use Qihucms\SiteHelp\Models\SiteHelp;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Qihucms\SiteHelp\Models\SiteHelpCategory;

class HelpController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '帮助内容';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteHelp);

        $grid->model()->latest();

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->equal('site_help_category_id', __('site-help::help.site_help_category_id'))
                ->select(SiteHelpCategory::pluck('name', 'id'));
            $filter->like('title', __('site-help::help.title'));
            $filter->equal('status', __('site-help::help.status.label'))
                ->select(__('site-help::help.status.value'));
        });

        $grid->column('thumbnail', __('site-help::help.thumbnail'))->image('', 66);
        $grid->column('id', __('site-help::help.id'));
        $grid->column('category.name', __('site-help::help.site_help_category_id'));
        $grid->column('title', __('site-help::help.title'));
        $grid->column('useful', __('site-help::help.useful'));
        $grid->column('status', __('site-help::help.status.label'))
            ->using(__('site-help::help.status.value'));
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

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
        $show = new Show(SiteHelp::findOrFail($id));

        $show->field('id', __('site-help::help.id'));
        $show->field('site_help_category_id', __('site-help::help.site_help_category_id'))
            ->as(function () {
                return $this->category ? $this->category->name : '分类不存在';
            });
        $show->field('title', __('site-help::help.title'));
        $show->field('useful', __('site-help::help.useful'));
        $show->field('desc', __('site-help::help.desc'));
        $show->field('thumbnail', __('site-help::help.thumbnail'))->image();
        $show->field('content', __('site-help::help.content'))->unescape();
        $show->field('status', __('site-help::help.status.label'))
            ->using(__('site-help::help.status.value'));
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
        $form = new Form(new SiteHelp);

        $form->select('site_help_category_id', __('site-help::help.site_help_category_id'))
            ->options(SiteHelpCategory::pluck('name', 'id'));
        $form->text('title', __('site-help::help.title'));
        $form->number('useful', __('site-help::help.useful'))->default(0);
        $form->textarea('desc', __('site-help::help.desc'));
        $form->image('thumbnail', __('site-help::help.thumbnail'))
            ->removable()
            ->uniqueName()
            ->move('site-help');
        $form->UEditor('content', __('site-help::help.content'));
        $form->select('status', __('site-help::help.status.label'))
            ->default(1)
            ->options(__('site-help::help.status.value'));

        return $form;
    }
}
