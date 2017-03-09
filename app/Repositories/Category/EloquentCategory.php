<?php

namespace SPCVN\Repositories\Category;

use SPCVN\Category;
use SPCVN\User;
use Carbon\Carbon;
use DB;
//use Illuminate\Database\SQLiteConnection;
//use SPCVN\Support\Authorization\CacheFlusherTrait;

class EloquentCategory implements CategoryRepository
{
    //use CacheFlusherTrait;

    /**
     * {@inheritdoc}
     */
    public function all()
    {
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
    public function create(array $data) 
    {
    	$category = Category::create($data);

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data = array()) 
    {
    	$category = $this->find($id);
        $category->update($data);
        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id) 
    {
    	$category = $this->find($id);
        $category->update(['del_flag' => true]);
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
}