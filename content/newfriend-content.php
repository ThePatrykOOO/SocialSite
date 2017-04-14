<div class="jumbotron col-lg-6">
    <h3 class="text-center">Zaproszenia</h3>
    <table class="table">
        <?php

        \User\User::yourRequestFriend();
        ?>

    </table>
    <h3 class="text-center">Szukaj znajomych</h3>
    <div class="col-lg-12">
        <?php
            \User\User::showSearchFriend();
//            NIEDOKOńczone
        ?>
    </div>
</div>