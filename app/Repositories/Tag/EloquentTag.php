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
        return Tag::pluck($column, $key);
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
    public function findByName($name)
    {
        return Tag::where('name', $name)->first();
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
    public function update($id, array $data)
    {
        $tag = $this->find($id);

        $tag->update($data);

        event(new Updated($tag));

        return $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $tag = $this->find($id);

        event(new Deleted($tag));

        return $tag->delete();
    }
}
