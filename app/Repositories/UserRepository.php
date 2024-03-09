<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * User repository to handle user table related CRUD operations
 */
class UserRepository
{

    /**
     * Create a new user
     *
     * @var array $data
     * @return User user object
     */
    public function create($data) {
        return User::create($data);
    }

    /**
     * Update a user by user Id
     *
     * @var array $data
     * @return User user object
     */
    public function edit($userId, $data) {
        $user = User::findOrFail($userId);
        $user->user_email = $data['user_email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];

        return $user->save();
    }

    /**
     * Delete a user by user Id
     * @return void
     */
    public function delete($userId) {
        $user = User::findOrFail($userId);
        $user->delete();
    }

    public function getUsers($filters = []) {
        $query = User::select(DB::raw("first_name || ' ' ||  last_name as full_name, user_email as email, id"));
        // default filters criteria
        $sort = 'ASC';

        if(!empty($filters['text'])) {
            $searchText = $filters['text'];
            $query->whereRaw("first_name LIKE '%$searchText%' OR user_email LIKE '%$searchText%'");
        }

        if (!empty($filters['sort']) ) {
            $sort = $filters['sort'];
        }

        return $query->orderBy('full_name', $sort)->paginate(5);
    }

    public function get($userId)
    {
        return User::findOrFail($userId);
    }
}
