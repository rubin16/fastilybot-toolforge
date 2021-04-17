/**
 * Russian Wikipedia files description pages without an associated file
 * Author: Fastily (forked)
 */
SELECT wpg.page_title
FROM ruwiki_p.page wpg
LEFT JOIN ruwiki_p.image wpimg
ON wpimg.img_name = wpg.page_title
WHERE wpg.page_namespace=6 AND wpimg.img_name IS null;
