<?php

namespace Qihucms\SiteHelp\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\SiteHelp\Models\SiteHelpReply;
use Qihucms\SiteHelp\Requests\ReplyRequest;
use Qihucms\SiteHelp\Resources\HelpReply as HelpReplyResource;
use Qihucms\SiteHelp\Resources\SimpleHelpReplyCollection;

class ReplyController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * 我发布的评论
     *
     * @param Request $request
     * @return SimpleHelpReplyCollection
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        $result = SiteHelpReply::where('user_id', \Auth::id())->latest()->paginate($limit);

        return new SimpleHelpReplyCollection($result);
    }

    /**
     * 发布评论
     *
     * @param ReplyRequest $request
     * @return \Illuminate\Http\JsonResponse|HelpReplyResource
     */
    public function store(ReplyRequest $request)
    {
        $result = SiteHelpReply::create([
            'site_help_id' => $request->input('site_help_id'),
            'user_id' => \Auth::id(),
            'content' => $request->input('content'),
            'status' => 0
        ]);

        if ($request) {
            return new HelpReplyResource($result);
        }

        return $this->jsonResponse(['发布失败'], '', 422);
    }

    /**
     * 评论详细
     *
     * @param $id
     * @return HelpReplyResource
     */
    public function show($id)
    {
        $result = SiteHelpReply::where('status', '>', 0)->where('id', $id)->latest()->first();

        return new HelpReplyResource($result);
    }

    /**
     * 更新评论
     *
     * @param ReplyRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReplyRequest $request, $id)
    {
        $data = $request->only(['site_help_id', 'content']);
        $result = SiteHelpReply::where('id', $id)->where('user_id', \Auth::id())->update($data);

        if ($result) {
            return $this->jsonResponse(['id' => $id]);
        }

        return $this->jsonResponse(['更新失败'], '', 422);
    }

    /**
     * 删除评论
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (SiteHelpReply::where('user_id', \Auth::id())->where('id', $id)->delete()) {
            return $this->jsonResponse(['id' => $id]);
        }

        return $this->jsonResponse(['删除失败'], '', 422);
    }
}