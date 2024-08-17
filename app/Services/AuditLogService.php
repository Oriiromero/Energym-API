<?php

namespace App\Services;
use App\Models\AuditLog;

class AuditLogService {
    public function storeAction($action, $targetTable, $targetId, $userId)
    {
        AuditLog::create([
            'user_id' => $userId, 
             'action' => $action,
            'target_table' => $targetTable,
            'target_id' => $targetId,
        ]);
    }
}