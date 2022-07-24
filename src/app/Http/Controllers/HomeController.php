<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Timeline;
use App\Models\TimelineCache;
use App\Transformer\ArticleTransformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home/Index', [
            'articles' => $this->fetchArticles(),
        ]);
    }

    private function fetchArticles()
    {
        return Article::with('user')
            ->orderBy('created_at')
            ->get()
            ->transform(new ArticleTransformer)
            ->all();
    }

    public function my_timeline(Request $request)
    {
        $timeline_cache_public_query = TimelineCache::select([
            'id',
            'member_id',
            'timeline_id',
            'type',
            'comment_count',
            'like_count',
            'is_follow',
            'public_scope',
            'created_at'
        ]);

        $timeline_cache_public_query = $this->common_filters($timeline_cache_public_query, $request);

        $timeline_cache_follow_query = clone $timeline_cache_public_query;
        $timeline_cache_follow_query = $this->member_query($timeline_cache_follow_query, $request);

        $timeline_cache_public_query = $this->addition_query($timeline_cache_public_query);

        $timeline_cache_public_query->union($timeline_cache_follow_query);

        // videoとmediaで分岐してない方　ORDER句
        if (!empty($arrayParam['timeline_id']) && $normalSort) {
            $timeline_cache_public_query->orderRaw("timeline_id = {$timeline_id} DESC");
        } else if (isset($orderTimelineIds) && !$normalSort) {
            $timeline_cache_public_query->orderRaw(implode($orderTimelineIds));
        }
        $timeline_cache_public_query->orderByDesc('created_at');

        if ($keyword) $timeline_cache_public_query->where('keyword', 'like', "%{$keyword}%");

        $limit = 0;
        $offset = 0;
        if (!is_null($arrayParam['page_size']) && ($arrayParam['page_size'] !== "")) $limit = $arrayParam['page_size'];
        if (!$limit) $limit = (int)\Config::get('timeline.articles.limit');
        if ($limit > \Config::get('timeline.articles.limit_max')) $limit = \Config::get('timeline.articles.limit_max');
        if (!is_null($arrayParam['page_number']) && ($arrayParam['page_number'] !== "")) $offset = ($arrayParam['page_number'] - 1) * $arrayParam['page_size'];

        $timeline_cache_public_query->limit($limit);
        $timeline_cache_public_query->offset($offset);

        $query->get()
            ->transform(function ($v) {
                return [];
            })->toArray();
    }

    private function common_filters(Builder $query, Request $request): Builder
    {
        return $query
            ->with('timeline')
            ->with('timeline')
            ->where(function(Builder $q) use ($request){
                // requestじゃなくてtimeline_created_atはIDから取得するような気がする
                if ($request->timeline_created_at) $q->where('created_at', '<=', $request->timeline_created_at);
                if ($request->commercer_flag) $q->where('commercer_flag', 1);
                if ($request->benefiter_flag) $q->where('benefiter_flag', 1);

                //blockしているユーザーの取得を書く
                if ($blockList) $q->whereNotIn('member_id', $blockList);
                if ($hiddenTimelineIdList) $q->whereNotIn('timeline_id', $hiddenTimelineIdList);

                // checkはよくわかっていない
                // (benefit_id is NULL or (benefit_id is not NULL AND check_status != 1))
                if ($is_checked) $q->where('check_status', 1);

                if ($request->ignore) {
                    $q->where(function ($q) {
                        $q->whereNull('benefit_id')->orWhere(function ($q) {
                            $q->whereNotNull('benefit_id');
                            $q->where('pr_tweet_type', 4);
                        });
                    });
                }

                if (!is_null($arrayParam['hashtag'])) {
                    $hashtag_idx = 0;
                    $hashtag_array = array_map(function ($hashtag) use (&$parameters, &$hashtag_idx) {
                        $hashtag_idx++;
                        $param_hash_idx = 'hashtag' . $hashtag_idx;
                        $parameters[$param_hash_idx] = $hashtag;

                        return "FIND_IN_SET(:" . $param_hash_idx . ", LOWER(timeline.hashtag)) > 0";
                    }, $arrayParam['hashtag']);

                    $timeline_cache_public_query->whereHas('timeline', function ($q) {
                        $q->whereIn('hashtag', $hashtag_array);
                    });
                }

                // いいねの分岐

                // いいねされたの分岐

                // ブックマークの分岐

                // フォローの分岐
            });
    }

    private function addition_query()
    {
        // clone後にこっちのwhereとして追加
        if (!is_null($keyword)) {
            if (strpos($keyword, '_') !== false) {
                $arrayParam['keyword'] = str_replace("_", "#_", $keyword);
            }
            if (strpos($keyword, '%') !== false) {
                $arrayParam['keyword'] = str_replace("%", "#%", $keyword);
            }
            $timeline_cache_public_query->where('description', 'like', "%{$keyword}%");
            $timeline_cache_public_query->whereRaw("ESCAPE '#'");
        }

        $timeline_cache_public_query->where('is_follow', 0);
        $timeline_cache_public_query->where('public_scope', 1);

        $timeline_cache_public_query->whereHas('timeline', function ($q) {
            $q->where('is_draft', 0);
            $q->where('deleted_flg', 0);
            $q->where('exam_status', 1);
        });

        if ($is_recommend) $timeline_cache_public_query->where('is_recommend', 1);
        if ($is_fullscreen_video) $timeline_cache_public_query->where('is_fullscreen_video', 1);

        //Check filter by keyword
        if (!is_null($arrayParam['keyword'])) {
            $escape = "";
            if (strpos($arrayParam['keyword'], '_') !== false) {
                $arrayParam['keyword'] = str_replace("_", "#_", $arrayParam['keyword']);
                $escape = "ESCAPE '#' ";
            }
            if (strpos($arrayParam['keyword'], '%') !== false) {
                $arrayParam['keyword'] = str_replace("%", "#%", $arrayParam['keyword']);
                $escape = "ESCAPE '#' ";
            }

            $timeline_cache_public_query->whereHas('timeline', function ($q) {
                $q->where('description', 'like', "%{$keyword}%");
                $q->whereRaw("ESCAPE '#' ");
            });
        }
    }

    private function member_query(Builder $query, Request $request): Builder
    {
        return $query->where(function($q) use ($request){
            $q->whereRaw('
                WHERE NOT EXISTS (
                    SELECT
                        timeline_cache.id,
                        timeline_cache.member_id,
                        timeline_cache.timeline_id,
                        timeline_cache.type,
                        timeline_cache.comment_count,
                        timeline_cache.like_count,
                        timeline_cache.is_follow,
                        timeline_cache.public_scope,
                        timeline.created_at FROM timeline_cache
                    WHERE
                        timeline_cache.timeline_id = timeline.id
                )
                AND
                    timeline_cache.is_follow = 1
                AND
                    timeline.is_draft = 0
                AND
                    timeline.deleted_flg = 0
                AND
                    timeline.exam_status = 1
            ');

            if ($request->is_recommend) $q->where('is_recommend', 1);
            if ($request->is_fullscreen_vido) $q->where('is_fullscreen_video', 1);

            $q->where(function($q) use ($request) {
                $q->where(function($q){
                    $q->whereIn('public_scope', [1, 2])
                        ->whereIn('member_id', $follow_member_ids);
                });

                // 自分の投稿なら非公開も拾うこと
                $q->where(function($q) use ($request){
                    $q->where('public_scope', 4)
                        ->where('member_id', $request->self_member_id);
                });

//            $list_joined_group_id = \DB::select('gr.id')
//                ->from(['group', 'gr'])
//                ->join(['group_member', 'gm'])->on('gr.id', '=', 'gm.group_id')
//                ->where('gm.member_id', '=', $self_member_id)
//                ->execute()->as_array();

                // フォロワーグループ
                $q->where(function($q) use ($group_ids){
                    $q->where('public_scope', 3)
                        ->whereIn('group_id', $group_ids);
                });
            });
        });
    }
}
