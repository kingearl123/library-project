<?php

class RoleMiddleware {
    public static function only($role, $userRole) {
        if ($userRole !== $role) {
            http_response_code(403);
            exit(json_encode([
                'status' => false,
                'message' => 'Akses ditolak'
            ]));
        }
    }
}