<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Permission extends Component
{
    public $permission;
    public $role;

    public function __construct($permission = null, $role = null)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    public function shouldRender()
    {
        $user = auth()->user();
        
        if (!$user) {
            return false;
        }

        // Check role if specified
        if ($this->role && $user->role !== $this->role) {
            return false;
        }

        // Check permission if specified
        if ($this->permission && !$user->hasPermission($this->permission)) {
            return false;
        }

        return true;
    }

    public function render()
    {
        return function (array $data) {
            return $this->shouldRender() ? $data['slot'] : '';
        };
    }
}