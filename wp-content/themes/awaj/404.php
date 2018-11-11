<?php
use App\Theme\Helper as _;
use App\Model\Post;

get_header();
?>

    <div class="page">
        <div class="page-content">
            <div class="page-icon color-danger">
                <i class="icon icon--large">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M507.494 426.066L282.864 53.537a31.372 31.372 0 0 0-53.73 0L4.506 426.066a31.37 31.37 0 0 0 26.864 47.569h449.259a31.372 31.372 0 0 0 26.865-47.569zM256.167 167.227c12.901 0 23.817 7.278 23.817 20.178 0 39.363-4.631 95.929-4.631 135.292 0 10.255-11.247 14.554-19.186 14.554-10.584 0-19.516-4.3-19.516-14.554 0-39.363-4.63-95.929-4.63-135.292 0-12.9 10.584-20.178 24.146-20.178zm.331 243.791c-14.554 0-25.471-11.908-25.471-25.47 0-13.893 10.916-25.47 25.471-25.47 13.562 0 25.14 11.577 25.14 25.47 0 13.562-11.578 25.47-25.14 25.47z"/></svg>
                </i>
            </div>
            <h2 class="page-header color-danger">404</h2>
            <div class="page-body">Sorry, the page you are looking for, doesn't exist or removed from server!</div>
            <div class="page-footer"><a href="<?= _::baseUrl() ?>">Go back to Home</a></div>
        </div>
    </div>

<?php
get_footer('dark');
