<?php


/**
 * return seleted if old equls with expected.
 * 
 */
function OldSelected(
    null|string|int $old,
    string|int $expected,
    string $attribute = 'selected'
): ?String {
    // dd(old($old));
    return old($old) === $expected ? $attribute : null;
}
