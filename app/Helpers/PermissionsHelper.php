<?php

if (!function_exists('has_permission')) {
    /**
     * Check if the authenticated user has the specified permission and an active status.
     *
     * @param int $permissionId
     * @return bool
     */
    function has_permission($permissionId)
    {
        $user = auth()->user();

        // Ensure the user is authenticated, has a valid role, and an active status
        if (!$user || $user->status_id != 1 || !$user->role) {
            return false;
        }

        // Check if the user has the specified permission by ID
        return $user->role->permissions()->where('permissions.id', $permissionId)->exists();
    }
}