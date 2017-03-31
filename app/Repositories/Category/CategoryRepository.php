<?php

namespace SPCVN\Repositories\Category;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;

interface CategoryRepository
{
    /**
     * Get all category.
     *
     * @param none
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function all();

    /**
     * Category pagination.
     *
     * @param (int) $perPage
     * @param (string) null $search
     * @param (string) null $status
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function paginate($perPage, $search = null);


    /**
     * Find category by id.
     *
     * @param (int) $id
     * @return null|Array
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function find($id);

    /**
     * Count category.
     *
     * @param (array) $condition
     * $condition = array (
     *		'parent_id'	=>	1,
     *		'name'		=> 'HTML',
     *		'user_id'	=>	1,
     *		'del_flag'	=>	0,
     *		'created'	=>	'2017-03-07 11:18:29'
     * );
     * Which key of $condition are corresponding with columns of table
     * @return int
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function count($condition);

    /**
     * Get list category by key => value.
     *
     * @param (string) $column
     * @param (int) $id
     * @return null|Array
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function lists($column = 'name', $key = 'id');

    /**
     * Find category by name.
     *
     * @param (string) $name
     * @return null|Array
	 * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function findByName($name);

    /**
     * Create new category.
     *
     * @param (array) $data
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function create($data);

    /**
     * Update category by id.
     *
     * @param (int) $id
     * @param (array) $data Data to update
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function update($id, $data);

    /**
     * Delete category by id.
     *
     * @param (int) $id
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function delete($id);

    /**
     * Update position of category by id.
     *
     * @param (array) $data
     * $data = array (
     *      0   => category_id,
     *      1   => category_id,
     *      2   => category_id
     * )
     *
     * Key is order, Value is category ID
     *
     * @return boolean
     * 
     * @author Dinh Van Huong
     * @since 2017.03.08
     * @version 1.0
     */
    public function updatePosition($data);

    /**
     * Make multiple level for category.
     *
     * @param (int) $category_id
     * @return mixed
     * 
     * @author Dinh Van Huong
     * @since 2017.03.07
     * @version 1.0
     */
    public function makeCategoryMultiLevel($category_id);


    /**
     * check exists category by name.
     *
     * @param array $data
     * $data => [
     *      category_id,
     *      parent_id,
     *      name
     * ]
     * @return boolse
     * 
     * @author Dinh Van Huong
     * @since 2017.03.20
     * @version 1.0
     */
    public function checkExists($data);

    /**
     * check exists sub category by IDs.
     *
     * @param int $category_id
     * @return boolse
     * 
     * @author Dinh Van Huong
     * @since 2017.03.28
     * @version 1.0
     */
    public function checkExistsSub($category_id);

}