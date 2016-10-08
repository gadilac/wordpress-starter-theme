/* update siteurl */
UPDATE wp_options SET option_value = replace(option_value, 'http://localhost/demo', 'http://domain.com') WHERE option_name = 'home' OR option_name = 'siteurl';
/* update guid */
UPDATE wp_posts SET guid = REPLACE (guid, 'http://localhost/demo', 'http://domain.com');
/* update wp_content */
UPDATE wp_posts SET post_content = REPLACE (post_content, 'http://localhost/demo', 'http://domain.com');
/* update wp attachment link */
UPDATE wp_posts SET  guid = REPLACE (guid, 'http://localhost/demo', 'http://domain.com') WHERE post_type = 'attachment';
/* update post meta */
UPDATE wp_postmeta SET meta_value = REPLACE (meta_value, 'http://localhost/demo','http://domain.com');