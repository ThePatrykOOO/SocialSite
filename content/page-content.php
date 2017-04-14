<div class="jumbotron col-lg-6">
    <h2><?php echo $name; ?>
        <?php
            if($admin == $_SESSION['iduser'])
                echo '<a href="edytuj-profil" class="dropdown-toggle" title="Edytuj Profil"><i class="fa fa-cog"></i></a>';
        ?>
    </h2>
    <table class="table table-bordered">
        <tbody><tr>
            <td><b>Nazwa</b></td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td><b>Opis</b></td>
            <td><?php echo $descrtiption; ?></td>
        </tr>
        <tr>
            <td><b>Kategoria</b></td>
            <td><?php echo $type; ?></td>
        </tr>
        <tr>
            <td><b>Polubienia</b></td>
            <td>3 NIEDOKOńCZONE</td>
        </tr>
        </tbody>
    </table>
    <div class="col-lg-12">
        <h4>Patryk Filipiak<small>13.03.2017</small></h4>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        <div class="optionsPost">
            <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i>Nie lubię</button>
            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-comment"></i>Komentarz</button>
            <button type="button" class="btn btn-info btn-xs"><i class="fa fa-hand-paper-o"></i>Zgłoś</button>
            <!-- <div class="commentSection">
              <span>Patryk Filipiak</span>
              <span><data>19.01.2020</data></span>
              <p>Lorem ipsum dolor sit amet</p>
              <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
            </div>  --><!-- comentSection -->
        </div>
    </div>
</div>