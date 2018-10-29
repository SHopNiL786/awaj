<?php use App\Theme\Helper as _; ?>

<form role="search" method="get" class="search-form" action="<?= _::baseUrl() ?>">
    <label>
        <span class="screen-reader-text">Search for</span>
        <input type="search" class="search-field"
            placeholder="Search …"
            value="" name="s"
            title="Search for:">
    </label>
    <button type="submit" class="search-submit">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M337.509 305.372h-17.501l-6.571-5.486c20.791-25.232 33.922-57.054 33.922-93.257C347.358 127.632 283.896 64 205.135 64 127.452 64 64 127.632 64 206.629s63.452 142.628 142.225 142.628c35.011 0 67.831-13.167 92.991-34.008l6.561 5.487v17.551L415.18 448 448 415.086 337.509 305.372zm-131.284 0c-54.702 0-98.463-43.887-98.463-98.743 0-54.858 43.761-98.742 98.463-98.742 54.7 0 98.462 43.884 98.462 98.742 0 54.856-43.762 98.743-98.462 98.743z"/></svg>
    </button>
</form>
