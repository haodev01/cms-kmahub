<?php

namespace App\Helpers;

class FilterHelper
{
    public static function filterStatusFromRequest($query, $request,)
    {
        $status = $request->input('status');
        if (!empty($status)) {
            $query = self::filter($query, $status, 'status');
        }
        return $query;
    }

    public static function filterCourseFromRequest($query, $request,)
    {
        $course_id = $request->input('course_id');
        if (!empty($course_id)) {
            $query = self::filter($query, $course_id, 'course_id');
        }
        return $query;

    }

    public static function filterCreatedFromRequest($query, $request,)
    {
        $created_by_id = $request->input('created_by_id');
        if (!empty($created_by_id)) {
            $query = self::filter($query, $created_by_id, 'created_by_id');
        }
        return $query;
    }

    public static function filterLevelFromRequest($query, $request,)
    {
        $levels = $request->input('level');
        if (!empty($levels)) {
            $query = self::filter($query, $levels, 'level');
        }
        return $query;
    }

    public static function filterSearchFromRequest($query, $request, $column = 'name')
    {
        $keyword = $request->input('keyword');
        return self::search($query, $column, $keyword);
    }

    public static function search($query, $column = 'name', $keyword = '')
    {
        return $keyword && $column ? $query->where($column, 'like', "%$keyword%") : $query;
    }

    public static function filter($query, $value, $column = '')
    {
        if (!empty($column)) {
            $query->where($column, $value);
        }
        return $query;
    }
}
