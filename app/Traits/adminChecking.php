<?php


namespace App\Traits;


use App\Models\Admin;
use App\Models\AdminAuthToken;

trait adminChecking
{
    public function isAuthenticated($id, $token)
    {
        try {
            if (AdminAuthToken::where('admin_id', $id)->where('token', $token)->first()) {
                return $this->getAdmin($id);
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    private function getAdmin($id) {
        return Admin::findOrFail($id);
    }

}
