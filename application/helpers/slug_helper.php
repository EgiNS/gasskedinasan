<?php
 function generateSlug($name, $db, $table)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        $original_slug = $slug;
        $counter = 1;
        
        // Check if slug exists and modify if necessary
        while (slugExists($slug, $db, $table)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    function slugExists($slug, $db, $table)
    {
        $db->where('slug', $slug);
        return $db->count_all_results($table) > 0;
    }