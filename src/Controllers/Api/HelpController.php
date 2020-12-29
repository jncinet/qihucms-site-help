<?php

namespace Qihucms\SiteHelp\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Qihucms\SiteHelp\Models\SiteHelp;
use Qihucms\SiteHelp\Resources\SimpleHelpCollection;
use Qihucms\SiteHelp\Resources\Help as HelpResource;

class HelpController extends Controller
{
    /**
     * 后台选择帮助文档
     *
     * @param Request $request
     * @return mixed
     */
    public function findByQ(Request $request)
    {
        $q = $request->query('q');
        return SiteHelp::where('title', 'like', '%' . $q . '%')->select('id', 'title as text')->paginate();
    }

    /**
     * 文档列表
     *
     * @param Request $request
     * @return SimpleHelpCollection
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        
        $id = $request->get('id', 0);

        $condition = [['status', '>', 0]];

        if ($id > 0) {
            $condition[] = ['site_help_category_id', '=', $id];
        }

        $result = SiteHelp::where($condition)->orderBy('status', 'desc')->latest()->paginate($limit);

        return new SimpleHelpCollection($result);
    }

    /**
     * 文档详细
     *
     * @param int $id 文档ID
     * @return HelpResource
     */
    public function show($id)
    {
        $result = SiteHelp::where('id', $id)->where('status', '>', 0)->latest()->first();

        return new HelpResource($result);
    }
}