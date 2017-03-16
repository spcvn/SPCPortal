<?php

namespace SPCVN\Repositories\Category;

use SPCVN\Events\Category\Created;
use SPCVN\Events\Category\Deleted;
use SPCVN\Events\Category\Updated;
use SPCVN\Category;
use SPCVN\User;
use Carbon\Carbon;
use DB;
use SPCVN\Support\Authorization\CacheFlusherTrait;

class EloquentCategory implements CategoryRepository
{
    use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage = 30, $search = null)
    {
    	$query = Category::query();
        $query->where('del_flag', false);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('created', $search);
            });
        }

        $result = $query->orderBy('position', 'ASC')
                        ->orderBy('created', 'DESC')
            			->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }


    /**
     * {@inheritdoc}
     */
    public function find($id) 
    {
    	return Category::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Category::pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function count($condition = array()) 
    {
    	return true;
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name) 
    {
    	return true;
    }

    /**
     * {@inheritdoc}
     */
    public function create($data = array()) 
    {
    	$category = Category::create($data);
        event(new Created($category));
        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data = array()) 
    {
    	$category = $this->find($id);
        $category->update($data);
        event(new Updated($category));
        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id) 
    {
    	$category = $this->find($id);
        $category->update(['del_flag' => true]);
        event(new Deleted($category));
        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function updatePosition($data = array()) 
    {
        if (empty($data)) {
            return false;
        }

        try {
            DB::beginTransaction();

            foreach ($data as $position => $category_id) {
                $category = $this->find($category_id);
                $category->update(array('position' => $position));
            }

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function makeCategoryMultiLevel($category_id = 0)
    {
        $query = Category::query();
        $query->select('id', 'name', 'parent_id');
        $query->where('del_flag', false);
        $query->orderBY('position', 'ASC');
        $results = $query->get();

        $categories = [' '    =>  trans('app.select_one')];

        foreach ($results as $category) {
            
            if ($category_id == $category['id']) {
                continue;
            }

            if ($category['parent_id'] == 0) {
                $categories[$category['id']] = $category['name'];
                $categories = $categories + $this->getChildCategory($category['id'], $category_id, $results, '---- ');
            }
        }

        return $categories;
    }

    /**
     * {@inheritdoc}
     */
    private function getChildCategory($catID, $catSelected = 0, $datas, $ext = '---- ')
    {
        $categories = [];
        foreach ($datas as $data) {

            if ($catSelected == $data['id']) {
                continue;
            }

            if ($data['parent_id'] == $catID) {
                $categories[$data['id']] = $ext . $data['name'];
                $categories = $categories + $this->getChildCategory($data['id'], $catSelected, $datas, $ext . '---- ');
            }
        }

        return $categories;
    }
}