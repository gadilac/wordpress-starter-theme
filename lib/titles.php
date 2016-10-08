<?php

namespace Core\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'core');
    }
  } elseif (is_archive()) {
    // return get_the_archive_title();
	return single_cat_title( '', false );
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'core'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'core');
  } else {
    return get_the_title();
  }
}
