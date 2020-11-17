<?php

namespace Qihucms\SiteHelp\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\SiteHelp\Models\SiteHelp;
use Qihucms\SiteHelp\Models\SiteHelpReply;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HelpReplyController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '帮助留言';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteHelpReply);

        $grid->model()->latest();

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('help.title', __('site-help::reply.site_help_id'));
            $filter->equal('user_id', __('site-help::reply.user_id'));
            $filter->equal('status', __('site-help::reply.status.label'))
                ->select(__('site-help::reply.status.value'));
        });

        $grid->column('id', __('site-help::reply.id'));
        $grid->column('help.title', __('site-help::reply.site_help_id'));
        $grid->column('user.username', __('site-help::reply.user_id'));
        $grid->column('status', __('site-help::reply.status.label'))
            ->using(__('site-help::reply.status.value'));
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
        $show = new Show(SiteHelpReply::findOrFail($id));

        $show->field('id', __('site-help::reply.id'));
        $show->field('site_help_id', __('site-help::reply.site_help_id'))
            ->as(function () {
                return $this->help ? $this->help->title : '内容不存在';
            });
        $show->field('user_id', __('site-help::reply.user_id'))
            ->as(function () {
                return $this->user ? $this->user->username : '会员不存在';
            });
        $show->field('content', __('site-help::reply.content'))->unescape();
        $show->field('reply', __('site-help::reply.reply'))->unescape();
        $show->field('status', __('site-help::reply.status.label'))
            ->using(__('site-help::reply.status.value'));
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
        $form = new Form(new SiteHelpReply);

        $form->select('site_help_id', __('site-help::reply.site_help_id'))
            ->options(function ($site_help_id) {
                $model = SiteHelp::find($site_help_id);
                if ($model) {
                    return [$model->id => $model->title];
                }
            })
            ->ajax(route('api.site-help.select'))
            ->required();
        $form->select('user_id', __('site-help::reply.user_id'))
            ->options(function ($id) {
                $user = User::find($id);
                if ($user) {
                    return [$user->id => $user->username];
                }
            })
            ->ajax(route('api.article.select.users.q'))
            ->required();
        $form->UEditor('content', __('site-help::reply.content'));
        $form->UEditor('reply', __('site-help::reply.reply'));
        $form->select('status', __('site-help::reply.status.label'))
            ->default(1)
            ->options(__('site-help::reply.status.value'));

        return $form;
    }
}
