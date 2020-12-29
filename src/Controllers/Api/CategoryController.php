<?php

namespace Qihucms\SiteHelp\Controllers\Api;

use App\Http\Controllers\Controller;
use Qihucms\SiteHelp\Models\SiteHelpCategory;
use Qihucms\SiteHelp\Resources\HelpCategoryCollection;
use Qihucms\SiteHelp\Resources\HelpCategory as HelpCategoryResource;

class CategoryController extends Controller
{
    /**
     * 所有分类
     *
     * @return HelpCategoryCollection
     */
    public function index()
    {
        $result = SiteHelpCategory::where('status', 1)->get();

        return new HelpCategoryCollection($result);
    }

    /**
     * 分类详细
     *
     * @param $id
     * @return HelpCategoryResource
     */
    public function show($id)
    {
        $result = SiteHelpCategory::where('status', 1)->where('id', $id)->first();

        return new HelpCategoryResource($result);
    }
}