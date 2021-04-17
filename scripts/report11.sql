/**
 * Lists file description pages on ruwp without an associated file, shadowing a Commons file.
 * Author: Fastily (forked)
 */
SELECT wpg.page_title
FROM ruwiki_p.page wpg
INNER JOIN commonswiki_p.page cpg
ON wpg.page_title = cpg.page_title
LEFT JOIN ruwiki_p.image wpimg
ON wpimg.img_name = wpg.page_title
WHERE wpg.page_namespace=6 AND cpg.page_namespace=6 AND wpimg.img_name IS null;
