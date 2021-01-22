<?php

/**
 * Removes the complete dir
 *
 * @param bool $withSelf [optional]. Default: true. If true, removes the directory as well
 */
function removeDirectoryStructure(string $dir, bool $withSelf = true): void
{
    if (trim($dir) === "" || trim($dir) === "/") {
        throw new Exception("Empty dir and / are not allowed!");
    }
    if (file_exists($dir) && is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object)) {
                    removeDirectoryStructure($dir."/".$object);
                } else {
                    unlink($dir."/".$object);
                }
            }
        }
        if ($withSelf) {
            rmdir($dir);
        }
    }
}