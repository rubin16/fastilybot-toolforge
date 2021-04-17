/**
 * Find files on both the Russian Wikipedia and Commons.  Lists all Wikipedia files.
 * Author: Fastily
 */
SELECT wi.img_name 
FROM ruwiki_p.image wi
INNER JOIN commonswiki_p.image ci
ON wi.img_sha1 = ci.img_sha1;
