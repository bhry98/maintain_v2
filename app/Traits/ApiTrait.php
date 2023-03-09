<?php

namespace App\Traits;

/**
 * 
 */
trait ApiTrait
{
    public function Return200($date, $note = null)
    {
        return response()->json([
            'code' => 200,
            'date' => $date,
            'note' => $note,
        ]);
    }
    public function Return404($date, $note = null)
    {
        return response()->json([
            'code' => 404,
            'date' => $date,
            'note' => $note,
        ]);
    }
}
