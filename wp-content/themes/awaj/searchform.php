<?php use App\Theme\Helper as _; ?>

<form method="get" class="search__form" action="<?= _::baseUrl() ?>">
    <ul>
        <li>
            <input type="search" class="search__form__field" placeholder="Type here …" value="" name="s">
        </li>
        <li>
            <button type="submit" class="search__form__field__button">Search</button>
        </li>
    </ul>
</form>
