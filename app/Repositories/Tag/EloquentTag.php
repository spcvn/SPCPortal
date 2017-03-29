<?php

namespace SPCVN\Repositories\Tag;

use SPCVN\Events\Tag\Created;
use SPCVN\Events\Tag\Deleted;
use SPCVN\Events\Tag\Updated;
use SPCVN\Tag;
use SPCVN\Support\Authorization\CacheFlusherTrait;
use DB;

class EloquentTag implements TagRepository
{
    use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Tag::all();
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return  Tag::where('del_flg', '=' , 0)->pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        return Tag::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function find($tag_name)
    {
        $formatted_tags = [];

        $tags = Tag::select("id", "name", "del_flg")
                ->where("name", "LIKE", "%$tag_name%")
                ->where('del_flg', '=', 0)->get();

        foreach ($tags as $tag) {

            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return $formatted_tags;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $tag = Tag::create($data);

        event(new Created($tag));

        return $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $name)
    {

        $tag = Tag::find($id);

        $tag->name = $name;
        $tag->update();

        event(new Updated($tag));

        return $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $tag = Tag::find($id);

        $tag->del_flg = 1;

        event(new Updated($tag));

        return $tag->save();
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null)
    {
        $query = Tag::query()->with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }

        $result = $query->where('del_flg', 0)->orderBy('created_at', 'DESC')->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function checkExistsName($name, $id=null)
    {
        $res=false;

        if(Tag::where('name', strtolower($name))
            ->where('id', '<>', intval($id))
            ->where('del_flg', '=', 0)->count() > 0) {

            $res=true;
        }

        return $res;
    }
}
